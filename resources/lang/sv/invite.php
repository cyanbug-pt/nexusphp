<?php

return [
    'invalid_inviter' => 'Ogiltig inbjudan! Inbjudningskoden är bannad!',
    'fields' => [
        'inviter' => 'Avsändare',
        'invitee' => 'Ta emot e-post',
        'time_invited' => 'Skicka tid',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Registrerat UID',
        'invitee_register_email' => 'Registrerad e-post',
        'invitee_register_username' => 'Registrerat användarnamn',
        'expired_at' => 'hash löpte ut den',
        'time_invited_begin' => 'Skicka tid gte',
        'time_invited_end' => 'Skicka tid lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Inbjudningssystemet är stängt',
        'no_permission' => 'Kräv :class eller högre för att skicka inbjudningar',
        'invite_not_enough' => 'Inbjudningar inte tillräckligt',
    ],
    'send_allow_text' => 'Bjud in någon',
    'pre_register_username' => 'Förregistrera användarnamn',
    'pre_register_username_help' => 'Användarnamn och e-post kommer inte att ändras när användaren registrerar sig med denna inbjudningskod',
    'require_pre_register_username' => "Förregistrera användarnamn kan inte vara tomt",
];
