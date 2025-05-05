<?php

return [
    'invalid_inviter' => 'Ugyldig invitasjon! Invitasjonskoden er utestengt!',
    'fields' => [
        'inviter' => 'Avsender',
        'invitee' => 'Motta e-post',
        'time_invited' => 'Sende tid',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Registrert UID',
        'invitee_register_email' => 'Registrert e-post',
        'invitee_register_username' => 'Registrert brukernavn',
        'expired_at' => 'hash utløpt ved',
        'time_invited_begin' => 'Sende tid gte',
        'time_invited_end' => 'Sende tid lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Invitasjonssystemet er lukket',
        'no_permission' => 'Krev :class eller over for å sende invitasjoner',
        'invite_not_enough' => 'Invitasjoner ikke nok',
    ],
    'send_allow_text' => 'Inviter noen',
    'pre_register_username' => 'Forhåndsregistrer brukernavn',
    'pre_register_username_help' => 'Brukernavn og e-post vil ikke bli endret når bruker registrerer seg med denne invitasjonskoden',
    'require_pre_register_username' => "Pre-register brukernavn kan ikke være tomt",
];
