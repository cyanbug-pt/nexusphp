<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Utilizator',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrator',
    ],
    'labels' => [
        'username_old' => 'Nume utilizator vechi',
        'username_new' => 'Nume utilizator nou',
        'change_type' => 'Schimbă tipul',
    ],
];
