<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nexus\Database\NexusDB;
use Nexus\Plugin\Plugin;

class MaintainPluginState
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enabled = Plugin::listEnabled();
        $key = "nexus_plugin_enabled";
        NexusDB::redis()->del($key);
        $nowStr = now()->toDateTimeString();
        foreach ($enabled as $name => $value) {
            NexusDB::redis()->hSet($key, $name, $nowStr);
        }
        do_log("$key: " . nexus_json_encode($enabled));
    }
}
