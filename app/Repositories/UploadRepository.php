<?php
namespace App\Repositories;

use App\Auth\Permission;
use App\Enums\ModelEventEnum;
use App\Exceptions\NexusException;
use App\Http\Resources\SearchBoxResource;
use App\Models\BonusLogs;
use App\Models\Category;
use App\Models\File;
use App\Models\SearchBox;
use App\Models\Setting;
use App\Models\Torrent;
use App\Models\TorrentExtra;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Rhilip\Bencode\Bencode;
use Rhilip\Bencode\ParseException;

class UploadRepository extends BaseRepository
{
    /**
     * @throws NexusException
     */
    public function upload(Request $request)
    {
        $user = $request->user();
        if (empty($request->name)) {
            throw new NexusException(nexus_trans("upload.require_name"));
        }
        if (empty($request->descr)) {
            throw new NexusException(nexus_trans("upload.blank_description"));
        }
        if (empty($request->type)) {
            throw new NexusException(nexus_trans("upload.category_unselected"));
        }
        $category = Category::query()->find($request->type);
        if (!$category) {
            throw new NexusException(nexus_trans("upload.invalid_category"));
        }
        $torrentFile = $this->getTorrentFile($request);
        $filepath = $torrentFile->getRealPath();
        try {
            $dict = Bencode::load($filepath);
        } catch (ParseException $e) {
            do_log("Bencode load error:" . $e->getMessage(), 'error');
            throw new NexusException("upload.not_bencoded_file");
        }
        $info = $this->checkTorrentDict($dict, 'info');
        if (isset($dict['piece layers']) || isset($info['files tree']) || (isset($info['meta version']) && $info['meta version'] == 2)) {
            throw new NexusException("Torrent files created with Bittorrent Protocol v2, or hybrid torrents are not supported.");
        }
        $this->checkTorrentDict($info, 'piece length', 'integer');  // Only Check without use
        $dname = $this->checkTorrentDict($info, 'name', 'string');
        $pieces = $this->checkTorrentDict($info, 'pieces', 'string');
        if (strlen($pieces) % 20 != 0) {
            throw new NexusException(nexus_trans("upload.invalid_pieces"));
        }
        $dict['info']['private'] = 1;
        $dict['info']['source'] = sprintf("[%s] %s", Setting::getBaseUrl(), Setting::getSiteName());
        unset ($dict['announce-list']); // remove multi-tracker capability
        unset ($dict['nodes']); // remove cached peers (Bitcomet & Azareus)

        $infoHash = pack("H*", sha1(Bencode::encode($dict['info'])));
        $exists = Torrent::query()->where('info_hash', $infoHash)->first(['id']);
        if ($exists) {
            throw new NexusException(nexus_trans('upload.torrent_existed', ['id' => $exists->id]));
        }
        $subCategoriesAngTags = $this->getSubCategoriesAndTags($request, $category);
        $fileListInfo = $this->getFileListInfo($info, $dname);
        $posStateInfo = $this->getPosStateInfo($request);
        $pickInfo = $this->getPickInfo($request);
        $anonymous = "no";
        $uploaderUsername = $user->username;
        if ($request->uplver == 'yes') {
            if (!Permission::canBeAnonymous()) {
                throw new NexusException(nexus_trans('upload.no_permission_to_be_anonymous'));
            }
            $anonymous = "yes";
            $uploaderUsername = "Anonymous";
        }
        $torrentSavePath = $this->getTorrentSavePath();
        $nowStr = Carbon::now()->toDateTimeString();
        $torrentInsert = [
            'filename' => $torrentFile->getClientOriginalName(),
            'owner' => $user->id,
            'visible' => 'yes',
            'anonymous' => $anonymous,
            'name' => $request->name,
            'size' => $fileListInfo['totalLength'],
            'numfiles' => count($fileListInfo['fileList']),
            'type' => $fileListInfo['type'],
            'url' => parse_imdb_id($request->url ?? ''),
            'small_descr' => $request->small_descr ?? '',
            'category' => $category->id,
            'source' => $subCategoriesAngTags['subCategories']['source'],
            'medium' => $subCategoriesAngTags['subCategories']['medium'],
            'codec' => $subCategoriesAngTags['subCategories']['codec'],
            'audiocodec' => $subCategoriesAngTags['subCategories']['audiocodec'],
            'standard' => $subCategoriesAngTags['subCategories']['standard'],
            'processing' => $subCategoriesAngTags['subCategories']['processing'],
            'team' => $subCategoriesAngTags['subCategories']['team'],
            'save_as' => $dname,
            'sp_state' => $this->getSpState($fileListInfo['totalLength']),
            'added' => $nowStr,
            'last_action' => $nowStr,
            'info_hash' => $infoHash,
            'cover' => $this->getCover($request),
            'pieces_hash' => sha1($info['pieces']),
            'cache_stamp' => time(),
            'hr' => $this->getHitAndRun($request),
            'pos_state' => $posStateInfo['posState'],
            'pos_state_until' => $posStateInfo['posStateUntil'],
            'picktype' => $pickInfo['pickType'],
            'picktime' => $pickInfo['pickTime'],
            'approval_status' => $this->getApprovalStatus($request),
            'price' => $this->getPrice($request),
        ];
        $extraInsert = [
            'descr' => $request->descr ?? '',
            'media_info' => $request->technical_info ?? '',
            'nfo' => $this->getNfoContent($request),
            'created_at' => $nowStr,
            'pt_gen' => $request->pt_gen ?? '',
        ];
        $newTorrent = DB::transaction(function () use ($torrentInsert, $extraInsert, $fileListInfo, $subCategoriesAngTags, $dict, $torrentSavePath) {
            $newTorrent = Torrent::query()->create($torrentInsert);
            $id = $newTorrent->id;
            $torrentFilePath = "$torrentSavePath/$id.torrent";
            $saveResult = Bencode::dump($torrentFilePath, $dict);
            if ($saveResult === false) {
                do_log("save torrent failed: $torrentFilePath", 'error');
                throw new NexusException(nexus_trans('upload.save_torrent_file_failed'));
            }
            $extraInsert['torrent_id'] = $id;
            TorrentExtra::query()->insert($extraInsert);
            $fileInsert = [];
            foreach ($fileListInfo['fileList'] as $fileItem) {
                $fileInsert[] = [
                    'torrent' => $id,
                    'filename' => $fileItem[0],
                    'size' => $fileItem[1],
                ];
            }
            File::query()->insert($fileInsert);
            if (!empty($subCategoriesAngTags['tags'])) {
                insert_torrent_tags($id, $subCategoriesAngTags['tags']);
            }
            $this->sendReward($id);
            return $newTorrent;
        });
        $id = $newTorrent->id;
        $torrentRep = new TorrentRepository();
        $torrentRep->addPiecesHashCache($id, $torrentInsert['pieces_hash']);
        write_log("Torrent $id ($newTorrent->name) was uploaded by $uploaderUsername");
        fire_event(ModelEventEnum::TORRENT_CREATED, $newTorrent);
        return $newTorrent;
    }

    private function getTorrentFile(Request $request): UploadedFile
    {
        $file = $request->file('file');
        if (empty($file)) {
            throw new NexusException(nexus_trans('upload.missing_torrent_file'));
        }
        if (!$file->isValid()) {
            do_log("torrent file is invalid: " . nexus_json_encode($_FILES), 'error');
            throw new NexusException("upload torrent file error");
        }
        $size = $file->getSize();
        $maxAllowSize = Setting::getUploadTorrentMaxSize();
        if ($size > $maxAllowSize) {
            $msg = sprintf("%s%s%s",
                nexus_trans("upload.torrent_file_too_big"),
                number_format($maxAllowSize),
                nexus_trans("upload.remake_torrent_note")
            );
            throw new NexusException($msg);
        }
        if ($size == 0) {
            throw new NexusException("upload.empty_file");
        }
        $filename = $file->getClientOriginalName();
        if (!validfilename($filename)) {
            throw new NexusException("upload.invalid_filename");
        }
        if (!preg_match('/^(.+)\.torrent$/si', $filename, $matches)) {
            throw new NexusException("upload.filename_not_torrent");
        }
        return $file;
    }

    private function getNfoContent(Request $request): string
    {
        $enableNfo = get_setting("main.enablenfo") == "yes";
        if (!$enableNfo) {
            return '';
        }
        $file = $request->file('nfo');
        if (empty($file)) {
            return '';
        }
        if (!$file->isValid()) {
            throw new NexusException(nexus_trans("upload.nfo_upload_failed"));
        }
        $size = $file->getSize();
        if ($size == 0) {
            throw new NexusException(nexus_trans("upload.zero_byte_nfo"));
        }
        if ($size > 65535) {
            throw new NexusException(nexus_trans("upload.nfo_too_big"));
        }
        return str_replace("\x0d\x0d\x0a", "\x0d\x0a", $file->getContent());
    }

    private function getApprovalStatus(Request $request): int
    {
        if (Permission::canTorrentApprovalAllowAutomatic()) {
            return Torrent::APPROVAL_STATUS_ALLOW;
        }
        return Torrent::APPROVAL_STATUS_NONE;
    }

    private function getPrice(Request $request): int
    {
        $price =  $request->price ?: 0;
        if (!is_numeric($price)) {
            throw new NexusException(nexus_trans('upload.invalid_price', ['price' => $price]));
        }
        if ($price > 0) {
            if (!Permission::canSetTorrentPrice()) {
                throw new NexusException(nexus_trans("upload.no_permission_to_set_torrent_price"));
            }
            $paidTorrentEnabled = Setting::getIsPaidTorrentEnabled();
            if (!$paidTorrentEnabled) {
                throw new NexusException(nexus_trans("upload.paid_torrent_not_enabled"));
            }
            $maxPrice = Setting::getUploadTorrentMaxPrice();
            if ($maxPrice > 0 && $price > $maxPrice) {
                throw new NexusException(nexus_trans('upload.price_too_much'));
            }
        }
        return intval($price);
    }

    private function getHitAndRun(Request $request): int
    {
        $hr = $request->hr ?? 0;
        if ($hr > 0 && !Permission::canSetTorrentHitAndRun()) {
            throw new NexusException(nexus_trans("upload.no_permission_to_set_torrent_hr"));
        }
        if (!in_array($hr, [0, 1])) {
            throw new NexusException(nexus_trans('upload.invalid_hr'));
        }
        return intval($hr);
    }

    private function getPosStateInfo(Request $request): array
    {
        $posState = $request->pos_state ?: Torrent::POS_STATE_STICKY_NONE;
        $posStateUntil = $request->pos_state_until ?: null;
        if ($posState !== Torrent::POS_STATE_STICKY_NONE) {
            if (!Permission::canSetTorrentPosState()) {
                throw new NexusException("upload.no_permission_to_set_torrent_pos_state");
            }
            if (!isset(Torrent::$posStates[$posState])) {
                throw new NexusException(nexus_trans('upload.invalid_pos_state', ['pos_state' => $posState]));
            }
        }
        if ($posState == Torrent::POS_STATE_STICKY_NONE) {
            $posStateUntil = null;
        }
        if ($posStateUntil && Carbon::parse($posStateUntil)->lt(Carbon::now())) {
            throw new NexusException(nexus_trans('upload.invalid_pos_state_until'));
        }
        return compact('posState', 'posStateUntil');
    }

    private function getPickInfo(Request $request): array
    {
        $pickType = $request->pick_type ?: Torrent::PICK_NORMAL;
        $pickTime = null;
        if ($pickType != Torrent::PICK_NORMAL) {
            if (!isset(Torrent::$pickTypes[$pickType])) {
                throw new NexusException(nexus_trans('upload.invalid_pick_type', ['pick_type' => $pickType]));
            }
            if (!Permission::canPickTorrent()) {
                throw new NexusException("upload.no_permission_to_pick_torrent");
            }
            $pickTime = Carbon::now();
        }
        return compact('pickType', 'pickTime');
    }

    private function checkTorrentDict($dict, $key, $type = null)
    {
        if (!is_array($dict)) {
            throw new NexusException(nexus_trans("upload.not_a_dictionary"));
        }
        if (!isset($dict[$key])) {
            throw new NexusException(nexus_trans("upload.dictionary_is_missing_key"));
        }
        $value = $dict[$key];
        if (!is_null($type)) {
            $isFunction = 'is_' . $type;
            if (function_exists($isFunction) && !$isFunction($value)) {
                throw new NexusException(nexus_trans("upload.invalid_entry_in_dictionary"));
            }
        }
        return $value;
    }

    /**
     * @throws NexusException
     */
    private function getFileListInfo(array $info, string $dname): array
    {
        $filelist = array();
        $totallen = 0;
        if (isset($info['length'])) {
            $totallen = $info['length'];
            $filelist[] = array($dname, $totallen);
            $type = "single";
        } else {
            $flist = $this->checkTorrentDict($info, 'files', 'array');

            if (!count($flist)) {
                throw new NexusException(nexus_trans("upload.empty_file"));
            }
            foreach ($flist as $fn) {
                $ll = $this->checkTorrentDict($fn, 'length', 'integer');
                $path_key = isset($fn['path.utf-8']) ? 'path.utf-8' : 'path';
                $ff = $this->checkTorrentDict($fn, $path_key, 'list');

                $totallen += $ll;
                $ffa = array();
                foreach ($ff as $ffe) {
                    if (!is_string($ffe)) {
                        throw new NexusException(nexus_trans("upload.filename_errors"));
                    }
                    $ffa[] = $ffe;
                }

                if (!count($ffa)) {
                    throw new NexusException(nexus_trans("upload.filename_errors"));
                }
                $ffe = implode("/", $ffa);
                $filelist[] = array($ffe, $ll);
            }
            $type = "multi";
        }
        return [
            'type' => $type,
            'totalLength' => $totallen,
            'fileList' => $filelist,
        ];
    }

    private function canUploadToSection(SearchBox $section): bool
    {
        $user = Auth::user();
        $uploadDenyApprovalDenyCount = Setting::getUploadDenyApprovalDenyCount();
        $approvalDenyCount = Torrent::query()->where('owner', $user->id)
            ->where('approval_status', Torrent::APPROVAL_STATUS_DENY)
            ->count()
        ;
        if ($uploadDenyApprovalDenyCount > 0 && $approvalDenyCount >= $uploadDenyApprovalDenyCount) {
            throw new NexusException(nexus_trans("upload.approval_deny_reach_upper_limit"));
        }
        if ($section->isSectionBrowse()) {
            $offerSkipApprovedCount = Setting::getOfferSkipApprovedCount();
            if ($user->offer_allowed_count >= $offerSkipApprovedCount) {
                return true;
            }
            if (get_if_restricted_is_open()) {
                return true;
            }
            if (!Permission::canUploadToNormalSection()) {
                throw new NexusException(nexus_trans('upload.unauthorized_upload_freely'));
            }
            return true;
        } elseif ($section->isSectionSpecial()) {
            if (!Setting::getIsSpecialSectionEnabled()) {
                throw new NexusException(nexus_trans('upload.special_section_not_enabled'));
            }
            if (!Permission::canUploadToSpecialSection()) {
                throw new NexusException(nexus_trans('upload.unauthorized_upload_freely'));
            }
            return true;
        }
        throw new NexusException(nexus_trans('upload.invalid_section'));
    }

    private function getSpState($torrentSize): int
    {
        $largeTorrentSize = Setting::getLargeTorrentSize();
        if ($largeTorrentSize > 0 && $torrentSize > $largeTorrentSize * 1073741824) {
            $largeTorrentSpState = Setting::getLargeTorrentSpState();
            if (isset(Torrent::$promotionTypes[$largeTorrentSpState])) {
                do_log("large torrent, sp state from config: $largeTorrentSpState");
                return $largeTorrentSpState;
            }
            do_log("invalid large torrent sp state: $largeTorrentSpState", 'error');
            return Torrent::PROMOTION_NORMAL;
        } else {
            $probabilities = [
                Torrent::PROMOTION_FREE => Setting::getUploadTorrentFreeProbability(),
                Torrent::PROMOTION_TWO_TIMES_UP => Setting::getUploadTorrentTwoTimesUpProbability(),
                Torrent::PROMOTION_FREE_TWO_TIMES_UP => Setting::getUploadTorrentFreeTwoTimesUpProbability(),
                Torrent::PROMOTION_HALF_DOWN => Setting::getUploadTorrentHalfDownProbability(),
                Torrent::PROMOTION_HALF_DOWN_TWO_TIMES_UP => Setting::getUploadTorrentHalfDownTwoTimesUpProbability(),
                Torrent::PROMOTION_ONE_THIRD_DOWN => Setting::getUploadTorrentOneThirdDownProbability(),
            ];
            $sum = array_sum($probabilities);
            if ($sum == 0) {
                do_log("no random sp state", 'warning');
                return Torrent::PROMOTION_NORMAL;
            }
            $random = mt_rand(1, $sum);
            $currentProbability = 0;
            foreach ($probabilities as $k => $v) {
                $currentProbability += $v;
                if ($random <= $currentProbability) {
                    do_log(sprintf("random sp state, probabilities: %s, get result: %s by probability: %s", json_encode($probabilities), $k, $v));
                    return $k;
                }
            }
            throw new \RuntimeException();
        }
    }

    /**
     * @throws NexusException
     */
    private function getSubCategoriesAndTags(Request $request, Category $category): array
    {
        $searchBoxRep = new SearchBoxRepository();
        $sections = $searchBoxRep->listSections(SearchBox::listAllSectionId())->keyBy('id');
        if (!$sections->has($category->mode)) {
            throw new NexusException(nexus_trans('upload.invalid_section'));
        }
        /**
         * @var $section SearchBox
         */
        $section = $sections->get($category->mode);
        $this->canUploadToSection($section);

        $sectionResource = new SearchBoxResource($section);
        $sectionData = $sectionResource->response()->getData(true);
        $sectionInfo = $sectionData['data'];
        $categories = array_column($sectionInfo['categories'], 'id');
        if (!in_array($category->id, $categories)) {
            throw new NexusException(nexus_trans('upload.invalid_category'));
        }
        $subCategoryInfo = array_column($sectionInfo['sub_categories'], null, 'field');
        $subCategories = [];
        foreach (SearchBox::$taxonomies as $name => $info) {
            $value = $request->get($name, 0);
            if ($value > 0) {
                if (!isset($subCategoryInfo[$name])) {
                    throw new NexusException(nexus_trans('upload.not_supported_sub_category_field', ['field' => $name]));
                }
                $subCategoryValues = array_column($subCategoryInfo[$name]['data'], 'name', 'id');
                if (!isset($subCategoryValues[$value])) {
                    throw new NexusException(nexus_trans(
                        'upload.invalid_sub_category_value',
                        ['field' => $name, 'label' => $subCategoryInfo[$name]['label'], 'value' => $value]
                    ));
                }
            }
            $subCategories[$name] = $value;
        }
        $tags = $request->tags ?: [];
        if (!is_array($tags)) {
            $tags = explode(',', $tags);
        }
        $allTags = array_column($sectionInfo['tags'], 'name', 'id');
        foreach ($tags as $tag) {
            if (!isset($allTags[$tag])) {
                throw new NexusException(nexus_trans('upload.invalid_tag', ['tag' => $tag]));
            }
        }
        return compact('subCategories', 'tags');
    }

    private function getCover(Request $request):string
    {
        $descr = $request->descr ?? '';
        if (empty($descr)) {
            return '';
        }
        $descriptionArr = format_description($descr);
        return get_image_from_description($descriptionArr, true, false);
    }

    private function getTorrentSavePath(): string
    {
        $torrentSavePath = getFullDirectory(Setting::getTorrentSaveDir());
        if (!is_dir($torrentSavePath)) {
            do_log(sprintf("torrentSavePath: %s not exists", $torrentSavePath), 'error');
            throw new NexusException(nexus_trans('upload.torrent_save_dir_not_exists'));
        }
        if (!is_writable($torrentSavePath)) {
            do_log(sprintf("torrentSavePath: %s not writable", $torrentSavePath), 'error');
            throw new NexusException(nexus_trans('upload.torrent_save_dir_not_writable'));
        }
        return $torrentSavePath;
    }

    private function sendReward($torrentId): void
    {
        $user = Auth::user();
        $old = $user->seedbonus;
        $delta = Setting::getUploadTorrentRewardBonus();
        if ($delta > 0) {
            $new = $old + $delta;
            $user->increment('seedbonus', $delta);
            BonusLogs::add($user->id, $old, $delta, $new, "Upload torrent: $torrentId", BonusLogs::BUSINESS_TYPE_UPLOAD_TORRENT);
            do_log("upload torrent: $torrentId, success send reward: $delta");
        } else {
            do_log("upload torrent: $torrentId, no reward");
        }
    }

    public function sendEmailNotification(Torrent $torrent, $userId = 0): int
    {
        $logMsg = sprintf("torrent: %s, category: %s", $torrent->id, $torrent->category);
        if (!Setting::getIsAllowUserReceiveEmailNotification() || Setting::getSmtpType() == 'none') {
            do_log("$logMsg, not allow user receive email notification or smtp type is none");
            return 0;
        }
        $page = 1;
        $size = 1000;
        $query = User::query()
            ->where("notifs", "like", "%[cat$torrent->category]%")
            ->where("notifs", "like","%[email]%")
            ->normal()
        ;
        if ($userId > 0) {
            $query->where("id", $userId);
        }
        $total = (clone $query)->count();
        if ($total == 0) {
            do_log(sprintf("%s, no user receive email notification", $logMsg));
            return 0;
        }
        $toolRep = new ToolRepository();
        $categoryName = $torrent->basic_category->name;
        $torrentUploader = $torrent->user;
        $successCount = 0;
        while (true) {
            $logPage = "$logMsg, page: $page";
            $users = (clone $query)->with(['language'])->forPage($page, $size)->get(['id', 'email', 'lang']);
            if ($users->isEmpty()) {
                do_log(sprintf("%s, no more user", $logPage));
                break;
            }
            foreach ($users as $user) {
                $locale = $user->locale;
                $logUser = "$logPage, user $user->id, locale: $locale";
                $subject = nexus_trans("upload.email_notification_subject", [
                    'site_name' => Setting::getSiteName()
                ], $locale);
                $body = nexus_trans("upload.email_notification_body", [
                    'site_name' => Setting::getSiteName(),
                    'name' => $torrent->name,
                    'size' => mksize($torrent->size),
                    'category' => $categoryName,
                    'upload_by' => $this->handleAnonymous($torrentUploader->username, $torrentUploader, $user, $torrent),
                    'description' => Str::limit(strip_tags(format_comment($torrent->extra->descr)), 500),
                    'torrent_url' => sprintf("%s/details.php?id=%s&hit=1", getBaseUrl(), $torrent->id),
                ], $locale);
                $sendResult = $toolRep->sendMail($user->email, $subject, $body);
                do_log(sprintf("%s, send result: %s", $logUser, $sendResult));
                if ($sendResult) {
                    $successCount++;
                }
            }
            $page++;
        }
        do_log("$logMsg, receive email notification user total: $total, successCount: $successCount, done!");
        return $successCount;
    }



}
