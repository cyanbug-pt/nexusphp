<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Bruker',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administratorsiden',
    ],
    'labels' => [
        'username_old' => 'Gammelt brukernavn',
        'username_new' => 'Nytt brukernavn',
        'change_type' => 'Endre type',
    ],
];
