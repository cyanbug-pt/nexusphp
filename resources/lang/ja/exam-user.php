<?php

return [
    'admin' => [
        'list' => [
            'page_title' => '試験ユーザー'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => '完了',
        \App\Models\ExamUser::STATUS_AVOIDED => '回避',
        \App\Models\ExamUser::STATUS_NORMAL => '標準',
    ],
    'end_can_not_before_begin' => "終了時間: :end cannot be before begin: :begin",
    'status_not_allow_update_end' => '現在のステータスはnot::status_textで、終了時刻を変更できません',
];
