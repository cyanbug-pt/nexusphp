<?php

return [
    'invalid_inviter' => 'Virheellinen kutsuja! Kutsukoodi on estetty!',
    'fields' => [
        'inviter' => 'Lähettäjä',
        'invitee' => 'Vastaanota sähköposti',
        'time_invited' => 'Lähetä aika',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Rekisteröity UID',
        'invitee_register_email' => 'Rekisteröity sähköpostiosoite',
        'invitee_register_username' => 'Rekisteröity käyttäjänimi',
        'expired_at' => 'hash vanhentunut',
        'time_invited_begin' => 'Lähetä aika gte',
        'time_invited_end' => 'Lähetä kellonaika lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Kutsu järjestelmä on suljettu',
        'no_permission' => 'Vaadi :class tai above lähettääksesi kutsuja',
        'invite_not_enough' => 'Kutsut eivät riitä',
    ],
    'send_allow_text' => 'Kutsu joku',
    'pre_register_username' => 'Esirekisteröi käyttäjätunnus',
    'pre_register_username_help' => 'Käyttäjätunnusta ja sähköpostiosoitetta ei muuteta, kun käyttäjä rekisteröi kutsukoodilla',
    'require_pre_register_username' => "Esirekisteröinnin käyttäjänimi ei voi olla tyhjä",
];
