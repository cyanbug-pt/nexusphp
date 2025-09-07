<?php

namespace App\Jobs;

use App\Models\BonusLogs;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Nexus\Database\NexusDB;
use Nexus\Nexus;

class CalculateUserSeedBonus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $beginUid;

    private int $endUid;

    private string $idStr;

    private string $requestId;

    private string $idRedisKey;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $beginUid, int $endUid, string $idStr, string $idRedisKey, string $requestId = '')
    {
        $this->beginUid = $beginUid;
        $this->endUid = $endUid;
        $this->idStr = $idStr;
        $this->idRedisKey = $idRedisKey;
        $this->requestId = $requestId;
    }

    public $tries = 1;

    public $timeout = 3600;

    /**
     * 获取任务时，应该通过的中间件。
     *
     * @return array
     */
    public function middleware()
    {
        return [new WithoutOverlapping($this->idRedisKey)];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $beginTimestamp = time();
        $logPrefix = sprintf(
            "[CLEANUP_CLI_CALCULATE_SEED_BONUS_HANDLE_JOB], commonRequestId: %s, beginUid: %s, endUid: %s, idStr: %s, idRedisKey: %s",
            $this->requestId, $this->beginUid, $this->endUid, $this->idStr, $this->idRedisKey
        );
        do_log("$logPrefix, job start ...");
        $haremAdditionFactor = Setting::get('bonus.harem_addition');
        $officialAdditionFactor = Setting::get('bonus.official_addition');
        $donortimes_bonus = Setting::get('bonus.donortimes');
        $autoclean_interval_one = Setting::get('main.autoclean_interval_one');

        $idStr = $this->idStr;
        $delIdRedisKey = false;
        if (empty($idStr) && !empty($this->idRedisKey)) {
            $delIdRedisKey = true;
            $idStr = NexusDB::cache_get($this->idRedisKey);
        }
        if (empty($idStr)) {
            do_log("$logPrefix, no idStr or idRedisKey", "error");
            return;
        }
        $sql = sprintf("select %s from users where id in (%s)", implode(',', User::$commonFields), $idStr);
        $results = NexusDB::select($sql);
        if (empty($results)) {
            do_log("$logPrefix, no data from idStr: $idStr", "error");
            return;
        }
        $logFile = getLogFile("seed-bonus-points");
        do_log("$logPrefix, [GET_UID_REAL], count: " . count($results) . ", logFile: $logFile");
        $fd = fopen($logFile, 'a');
        $seedPointsUpdates = $seedPointsPerHourUpdates = $seedBonusUpdates = [];
        $seedingTorrentCountUpdates = $seedingTorrentSizeUpdates = [];
        $logStr = "";
        $bonusLogInsert = [];
        foreach ($results as $userInfo)
        {
            $uid = $userInfo['id'];
            $donorAddition = $officialAddition = $haremAddition = $medalAddition = 0;
            $isDonor = is_donor($userInfo);
            $seedBonusResult = calculate_seed_bonus($uid);
            $bonusLog = "[CLEANUP_CLI_CALCULATE_SEED_BONUS_HANDLE_USER], user: $uid, seedBonusResult: " . nexus_json_encode($seedBonusResult);
            $all_bonus = $basicBonus = $seedBonusResult['seed_bonus'];
            $bonusLog .= ", all_bonus: $all_bonus";
            if ($all_bonus == 0) {
                do_log("$bonusLog, all_bonus is zero, skip");
                continue;
            }
            if ($isDonor && $donortimes_bonus != 0) {
                $donorAddition = $basicBonus * $donortimes_bonus;
                $all_bonus += $donorAddition;
                $bonusLog .= ", isDonor, donortimes_bonus: $donortimes_bonus, all_bonus: $all_bonus";
            }
            if ($officialAdditionFactor > 0) {
                $officialAddition = $seedBonusResult['official_bonus'] * $officialAdditionFactor;
                $all_bonus += $officialAddition;
                $bonusLog .= ", officialAdditionFactor: $officialAdditionFactor, official_bonus: {$seedBonusResult['official_bonus']}, officialAddition: $officialAddition, all_bonus: $all_bonus";
            }
            if ($haremAdditionFactor > 0) {
                $haremBonus = calculate_harem_addition($uid);
                $haremAddition =  $haremBonus * $haremAdditionFactor;
                $all_bonus += $haremAddition;
                $bonusLog .= ", haremAdditionFactor: $haremAdditionFactor, haremBonus: $haremBonus, haremAddition: $haremAddition, all_bonus: $all_bonus";
            }
            if ($seedBonusResult['medal_additional_factor'] > 0) {
                $medalAddition = $seedBonusResult['medal_bonus'] * $seedBonusResult['medal_additional_factor'];
                $all_bonus += $medalAddition;
                $bonusLog .= ", medalAdditionFactor: {$seedBonusResult['medal_additional_factor']}, medalBonus: {$seedBonusResult['medal_bonus']}, medalAddition: $medalAddition, all_bonus: $all_bonus";
            }
            do_log($bonusLog);
            $dividend = 3600 / $autoclean_interval_one;
            $all_bonus = $all_bonus / $dividend;
            $seed_points = $seedBonusResult['seed_points'] / $dividend;
//            $updatedAt = now()->toDateTimeString();
//            $sql = "update users set seed_points = ifnull(seed_points, 0) + $seed_points, seed_points_per_hour = {$seedBonusResult['seed_points']}, seedbonus = seedbonus + $all_bonus, seed_points_updated_at = '$updatedAt' where id = $uid limit 1";
//            do_log("$bonusLog, query: $sql");
//            NexusDB::statement($sql);
            $seedPointsUpdates[] = sprintf("when %d then ifnull(seed_points, 0) + %f", $uid, $seed_points);
            $seedPointsPerHourUpdates[] = sprintf("when %d then %f", $uid, $seedBonusResult['seed_points']);
            $seedingTorrentCountUpdates[] = sprintf("when %d then %f", $uid, $seedBonusResult['count']);
            $seedingTorrentSizeUpdates[] = sprintf("when %d then %f", $uid, $seedBonusResult['size']);
            $seedBonusUpdates[] = sprintf("when %d then seedbonus + %f", $uid, $all_bonus);
            //here before/after not correct, don't record it, fill with -1
            $this->appendBonusLogInsert($bonusLogInsert, $uid, [
                BonusLogs::BUSINESS_TYPE_SEEDING_BASIC => $basicBonus,
                BonusLogs::BUSINESS_TYPE_SEEDING_DONOR_ADDITION => $donorAddition,
                BonusLogs::BUSINESS_TYPE_SEEDING_OFFICIAL_ADDITION => $officialAddition,
                BonusLogs::BUSINESS_TYPE_SEEDING_HAREM_ADDITION => $haremAddition,
                BonusLogs::BUSINESS_TYPE_SEEDING_MEDAL_ADDITION => $medalAddition,
            ]);
            if ($fd) {
                $log = sprintf(
                    '%s|%s|%s|%s|%s|%s|%s|%s',
                    date('Y-m-d H:i:s'), $uid,
                    $userInfo['seed_points'], number_format($seed_points, 1, '.', ''),  number_format($userInfo['seed_points'] + $seed_points, 1, '.', ''),
                    $userInfo['seedbonus'], number_format($all_bonus, 1, '.', ''),  number_format($userInfo['seedbonus'] + $all_bonus, 1, '.', '')
                );
//                fwrite($fd, $log . PHP_EOL);
                $logStr .= $log . PHP_EOL;
            } else {
                do_log("logFile: $logFile is not writeable!", 'error');
            }
        }
        $nowStr = now()->toDateTimeString();
        $sql = sprintf(
            "update users set seed_points = case id %s end, seed_points_per_hour = case id %s end, seedbonus = case id %s end, seeding_torrent_count = case id %s end, seeding_torrent_size = case id %s end, seed_points_updated_at = '%s' where id in (%s)",
            implode(" ", $seedPointsUpdates), implode(" ", $seedPointsPerHourUpdates), implode(" ", $seedBonusUpdates), implode(" ", $seedingTorrentCountUpdates), implode(" ", $seedingTorrentSizeUpdates), $nowStr, $idStr
        );
        $result = NexusDB::statement($sql);
        if ($delIdRedisKey) {
            NexusDB::cache_del($this->idRedisKey);
        }
        if (!empty($bonusLogInsert)) {
            BonusLogs::query()->insert($bonusLogInsert);
        }
        fwrite($fd, $logStr);
        $costTime = time() - $beginTimestamp;
        do_log(sprintf(
            "$logPrefix, [DONE], update user count: %s, result: %s, cost time: %s seconds",
            count($seedPointsUpdates), var_export($result, true), $costTime
        ));
        do_log("$logPrefix, sql: $sql", "debug");
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        do_log("failed: " . $exception->getMessage() . $exception->getTraceAsString(), 'error');
    }

    private function appendBonusLogInsert(array &$bonusLogInsert, int $userId, array $typeValues): void
    {
        foreach ($typeValues as $type => $value) {
            if ($value > 0) {
                $bonusLogInsert[] = [
                    'business_type' => $type,
                    'uid' => $userId,
                    'old_total_value' => -1,
                    'value' => $value,
                    'new_total_value' => -1,
                    'comment' => BonusLogs::$businessTypes[$type]['text'],
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];
            }
        }
    }
}
