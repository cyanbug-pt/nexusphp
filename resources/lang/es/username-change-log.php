<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Usuario',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Administrador',
    ],
    'labels' => [
        'username_old' => 'Usuario antiguo',
        'username_new' => 'Nuevo nombre de usuario',
        'change_type' => 'Cambiar tipo',
    ],
];
