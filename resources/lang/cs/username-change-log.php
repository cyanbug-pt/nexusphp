<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Uživatel',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrátor',
    ],
    'labels' => [
        'username_old' => 'Staré uživatelské jméno',
        'username_new' => 'Nové uživatelské jméno',
        'change_type' => 'Změnit typ',
    ],
];
