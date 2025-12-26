<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'ユーザー',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => '管理者',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => '監査解除',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => '許可',
        \App\Models\SeedBoxRecord::STATUS_DENIED => '拒否しました',
    ],
    'status_change_message' => [
        'subject' => 'SeedBoxレコードの状態が変更されました',
        'body' => 'ID :idを持つSeedBoxレコードのステータスが:operatorによって:old_statusから:new_statusに変更されました。理由: ::reason',
    ],
    'is_seed_box_yes' => 'この IP は SeedBox です',
    'is_seed_box_no' => 'この IP は SeedBox ではありません',
];
