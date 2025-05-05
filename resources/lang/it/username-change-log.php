<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Utente',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Amministratore',
    ],
    'labels' => [
        'username_old' => 'Vecchio nome utente',
        'username_new' => 'Nuovo nome utente',
        'change_type' => 'Cambia tipo',
    ],
];
