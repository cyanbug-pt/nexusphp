<?php

return [
    'invalid_inviter' => 'Ugyldig invitationskode! Invitationskoden er bandlyst!',
    'fields' => [
        'inviter' => 'Afsender',
        'invitee' => 'Modtag e-mail',
        'time_invited' => 'Send tid',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Registreret UID',
        'invitee_register_email' => 'Registreret e-mail',
        'invitee_register_username' => 'Registreret brugernavn',
        'expired_at' => 'hash udløbet den',
        'time_invited_begin' => 'Send tid gte',
        'time_invited_end' => 'Send tid lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Invitationssystem er lukket',
        'no_permission' => 'Kræv :class eller derover for at sende invitationer',
        'invite_not_enough' => 'Invitationer ikke nok',
    ],
    'send_allow_text' => 'Inviter nogen',
    'pre_register_username' => 'Forudregistrer brugernavn',
    'pre_register_username_help' => 'Brugernavn og e-mail vil ikke blive ændret, når brugeren registrerer sig med denne invitationskode',
    'require_pre_register_username' => "Præ-register brugernavn må ikke være tomt",
];
