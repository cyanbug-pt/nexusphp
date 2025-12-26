<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => '検査',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => '到達しました',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => '未達です',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Pardoned',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => '無効',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'マニュアル',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'グローバル',

    'reached_by_seed_time_comment' => '：:now,seed時間:seed_time 時間が:seed_time_minimum Hours(s) に達しました',
    'reached_by_share_ratio_comment' => "：:now \nシード時間: :seed_time Hours(s) Unreached :seed_time_minimum Hours(s) \nシェア比率: :share_ratio が標準：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "あなたのユーザークラス: :user_class_text または寄付されたユーザーは、この H&R を無視してください",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) に達しました！',
    'reached_message_content' => 'おめでとうございます！ダウンロードしたトレント: :torrent_name(ID: :torrent_id) :completed_at が要件に達しました。',

    'unreached_comment' => "：:now \nシード時間： :seed_time 時間：:seed_time_minimum Hours(s) \nシェア率：:share_ratio が：:ignore_when_ratio_reach の要件に達していません",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) に達していません!',
    'unreached_message_content' => ':completed_at: にダウンロードした Torrent の :torrent_name(ID: :torrent_id) に到達しませんでした！アカウントが一定数のH&R を累積すると無効になりますのでご注意ください。',

    'unreached_disable_comment' => 'H&R数量が上限に達し、アカウントはシステムによって無効にされました',
    'unreached_disable_message_content' => 'H&Rの累積数がシステム上限に達したため、あなたのアカウントは無効になっています: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => ':ボーナスをキャンセルしました',
    'remove_confirm_msg' => ':bonus ボーナスを差し引いてH&Rを排除しますか？',
];
