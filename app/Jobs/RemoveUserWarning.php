<?php

namespace App\Jobs;

use App\Enums\ModelEventEnum;
use App\Models\Message;
use App\Models\User;
use App\Models\UserModifyLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RemoveUserWarning
{
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::query()
            ->with('language')
            ->where('enabled', 'yes')
            ->where('warned', 'yes')
            ->where('warneduntil', '<', now())
            ->get();
        $userModifyLogs = [];
        foreach ($users as $user) {
            $locale = $user->locale;
            $userModifyLogs[] = [
                'user_id' => $user->id,
                'content' => "Warning removed by System.",
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $user->warned = 'no';
            $user->warneduntil = null;
            do_log(sprintf("update user %s => %s", $user->id, json_encode($user->getDirty())));
            $user->save();
            clear_user_cache($user->id);
            publish_model_event(ModelEventEnum::USER_UPDATED, $user->id);
            $subject = nexus_trans("cleanup.msg_warning_removed", [], $locale);
            $msg = nexus_trans("cleanup.msg_your_warning_removed", [], $locale);
            Message::add([
                'sender' => 0,
                'receiver' => $user->id,
                'added' => now(),
                'subject' => $subject,
                'msg' => $msg,
            ]);
        }
        if (!empty($userModifyLogs)) {
            UserModifyLog::query()->insert($userModifyLogs);
        }
        do_log("remove warning of users, success handle user count: " . $users->count());
    }
}
