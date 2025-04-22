<?php

return [
    'invalid_inviter' => '¡Invitador no válido! ¡El código de invitación está bloqueado!',
    'fields' => [
        'inviter' => 'Remitente',
        'invitee' => 'Recibir email',
        'time_invited' => 'Hora de envío',
        'valid' => 'Valid',
        'invitee_register_uid' => 'UID registrado',
        'invitee_register_email' => 'Email registrado',
        'invitee_register_username' => 'Nombre de usuario registrado',
        'expired_at' => 'hash caducó el',
        'time_invited_begin' => 'Hora de envío gte',
        'time_invited_end' => 'Enviar lte de hora',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'El sistema de invitación está cerrado',
        'no_permission' => 'Requiere :class o superior para enviar invitaciones',
        'invite_not_enough' => 'Invitaciones no suficientes',
    ],
    'send_allow_text' => 'Invitar a alguien',
    'pre_register_username' => 'Pre-registrar nombre de usuario',
    'pre_register_username_help' => 'El nombre de usuario y el correo electrónico no se cambiarán cuando el usuario se registre con este código de invitación',
    'require_pre_register_username' => "Nombre de usuario de pre-registro no puede estar vacío",
];
