<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Пользователь',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Администратор',
    ],
    'labels' => [
        'username_old' => 'Старый логин',
        'username_new' => 'Новое имя пользователя',
        'change_type' => 'Изменить тип',
    ],
];
