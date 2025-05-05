<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'ユーザー',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => '管理者',
    ],
    'labels' => [
        'username_old' => '古いユーザー名',
        'username_new' => '新しいユーザー名',
        'change_type' => '種類の変更',
    ],
];
