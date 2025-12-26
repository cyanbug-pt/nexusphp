<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Użytkownik',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrator',
    ],
    'labels' => [
        'username_old' => 'Stara nazwa użytkownika',
        'username_new' => 'Nowa nazwa użytkownika',
        'change_type' => 'Zmień typ',
    ],
];
