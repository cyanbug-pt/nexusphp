<?php

return [
    'invalid_inviter' => 'Недопустимый игрок! Код приглашения забанен!',
    'fields' => [
        'inviter' => 'Отправитель',
        'invitee' => 'E-mail получателя',
        'time_invited' => 'Время отправки',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Зарегистрированный UID',
        'invitee_register_email' => 'Зарегистрированный email',
        'invitee_register_username' => 'Зарегистрированное имя пользователя',
        'expired_at' => 'хэш истек в',
        'time_invited_begin' => 'Период отправки',
        'time_invited_end' => 'Время отправки',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Система приглашений закрыта',
        'no_permission' => 'Запрашивать :class или выше для отправки приглашений',
        'invite_not_enough' => 'Недостаточно приглашений',
    ],
    'send_allow_text' => 'Пригласить кого-то',
    'pre_register_username' => 'Имя пользователя перед регистрацией',
    'pre_register_username_help' => 'Имя пользователя и адрес электронной почты не будут изменены при регистрации пользователя с этим кодом приглашения',
    'require_pre_register_username' => "Имя пользователя перед регистрацией не может быть пустым",
];
