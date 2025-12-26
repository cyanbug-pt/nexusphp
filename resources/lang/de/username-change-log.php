<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Benutzer',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrator',
    ],
    'labels' => [
        'username_old' => 'Alter Benutzername',
        'username_new' => 'Neuer Benutzername',
        'change_type' => 'Typ ändern',
    ],
];
