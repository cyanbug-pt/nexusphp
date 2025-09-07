<?php

namespace App\Console\Commands;

use App\Jobs\CheckQueueFailedJobs;
use App\Jobs\SettleClaim;
use App\Jobs\UpdateUserDownloadPrivilege;
use App\Models\ExamUser;
use App\Models\Language;
use App\Models\Message;
use App\Models\PersonalAccessToken;
use App\Models\Torrent;
use App\Models\TorrentExtra;
use App\Models\User;
use App\Repositories\ClaimRepository;
use App\Repositories\ExamRepository;
use App\Repositories\RequireSeedTorrentRepository;
use App\Repositories\SeedBoxRepository;
use App\Repositories\TokenRepository;
use App\Repositories\UploadRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Nexus\Database\NexusDB;
use Nexus\PTGen\PTGen;
use NexusPlugin\Menu\Filament\MenuItemResource\Pages\ManageMenuItems;
use NexusPlugin\Menu\MenuRepository;
use NexusPlugin\Menu\Models\MenuItem;
use NexusPlugin\Permission\Models\Role;
use NexusPlugin\PostLike\PostLikeRepository;
use NexusPlugin\StickyPromotion\Models\StickyPromotion;
use NexusPlugin\StickyPromotion\Models\StickyPromotionParticipator;
use NexusPlugin\Work\Models\RoleWork;
use NexusPlugin\Work\WorkRepository;
use Rhilip\Bencode\Bencode;
use Rhilip\Bencode\TorrentFile;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Just for test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rep = new RequireSeedTorrentRepository();
//        $rep->doRemove(Torrent::query()->whereIn('id', [58])->get());
        $rep->autoAddToListCronjob();
    }

}
