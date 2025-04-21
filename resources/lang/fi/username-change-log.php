<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Käyttäjä',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Ylläpitäjä',
    ],
    'labels' => [
        'username_old' => 'Vanha käyttäjänimi',
        'username_new' => 'Uusi käyttäjänimi',
        'change_type' => 'Vaihda tyyppi',
    ],
];
