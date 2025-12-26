<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Bruger',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrator',
    ],
    'labels' => [
        'username_old' => 'Gammelt brugernavn',
        'username_new' => 'Nyt brugernavn',
        'change_type' => 'Skift type',
    ],
];
