<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Utilisateur',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrateur',
    ],
    'labels' => [
        'username_old' => 'Ancien nom d\'utilisateur',
        'username_new' => 'Nouveau nom d\'utilisateur',
        'change_type' => 'Changer le type',
    ],
];
