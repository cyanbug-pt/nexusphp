<?php

return [
    'invalid_inviter' => 'Ungültige Einladung! Der Einladungscode ist gesperrt!',
    'fields' => [
        'inviter' => 'Absender',
        'invitee' => 'E-Mail erhalten',
        'time_invited' => 'Sendezeit',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Registrierte UID',
        'invitee_register_email' => 'Registrierte E-Mail',
        'invitee_register_username' => 'Registrierter Benutzername',
        'expired_at' => 'hash abgelaufen um',
        'time_invited_begin' => 'Sendezeit gte',
        'time_invited_end' => 'Sendezeit lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Einladungssystem ist geschlossen',
        'no_permission' => 'Benötigt :class oder höher um Einladungen zu senden',
        'invite_not_enough' => 'Einladungen nicht genug',
    ],
    'send_allow_text' => 'Jemanden einladen',
    'pre_register_username' => 'Vorregistrierung Benutzername',
    'pre_register_username_help' => 'Benutzername und E-Mail werden nicht geändert, wenn sich ein Benutzer mit diesem Einladungscode registriert',
    'require_pre_register_username' => "Vorregistrierung Benutzername darf nicht leer sein",
];
