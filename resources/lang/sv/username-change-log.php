<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Användare',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administratör',
    ],
    'labels' => [
        'username_old' => 'Gammalt användarnamn',
        'username_new' => 'Nytt användarnamn',
        'change_type' => 'Ändra typ',
    ],
];
