<?php

namespace App\Jobs;

use App\Models\TorrentBuyLog;
use App\Repositories\BonusRepository;
use App\Repositories\TorrentRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuyTorrent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $userId;

    public int $torrentId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $userId, int $torrentId)
    {
        $this->userId = $userId;
        $this->torrentId = $torrentId;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        $logPrefix = sprintf("user: %s, torrent: %s", $this->userId, $this->torrentId);
        $torrentRep = new TorrentRepository();
        $userId = $this->userId;
        $torrentId = $this->torrentId;

        $buyLog = TorrentBuyLog::query()
            ->where("uid", $userId)
            ->where("torrent_id", $torrentId)
            ->first();
        ;
        if ($buyLog) {
            //标记购买成功
            do_log("$logPrefix, already bought");
            $torrentRep->addBuySuccessCache($userId, $torrentId, $buyLog->id);
            return;
        }
        try {
            $bonusRep = new BonusRepository();
            $buyLog = $bonusRep->consumeToBuyTorrent($this->userId, $this->torrentId);
            //标记购买成功
            do_log("$logPrefix, buy torrent success");
            $torrentRep->addBuySuccessCache($userId, $torrentId, $buyLog->id);
        } catch (\Throwable $throwable) {
            //标记购买失败，缓存 3600 秒，这个时间内不能再次购买
            do_log("$logPrefix, buy torrent fail: " . $throwable->getMessage(), "error");
            $torrentRep->addBuyFailCache($userId, $torrentId);
            throw $throwable;
        }
    }
}
