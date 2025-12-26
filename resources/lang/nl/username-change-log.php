<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Gebruiker',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Beheerder',
    ],
    'labels' => [
        'username_old' => 'Oude gebruikersnaam',
        'username_new' => 'Nieuwe gebruikersnaam',
        'change_type' => 'Verander type',
    ],
];
