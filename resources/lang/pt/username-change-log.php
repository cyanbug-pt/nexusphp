<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Usuário',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrador',
    ],
    'labels' => [
        'username_old' => 'Usuário antigo',
        'username_new' => 'Novo nome de usuário',
        'change_type' => 'Mudar tipo',
    ],
];
