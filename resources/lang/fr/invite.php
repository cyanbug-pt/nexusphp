<?php

return [
    'invalid_inviter' => 'Invitation invalide ! Le code d\'invitation est banni !',
    'fields' => [
        'inviter' => 'Expéditeur',
        'invitee' => 'Recevoir un e-mail',
        'time_invited' => 'Date d\'envoi',
        'valid' => 'Valid',
        'invitee_register_uid' => 'UID enregistré',
        'invitee_register_email' => 'Courriel enregistré',
        'invitee_register_username' => 'Nom d\'utilisateur enregistré',
        'expired_at' => 'hash expiré à',
        'time_invited_begin' => 'Envoyer le temps gte',
        'time_invited_end' => 'Envoyer lte temps',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Le système d\'invitation est fermé',
        'no_permission' => 'Nécessite :class ou plus pour envoyer des invitations',
        'invite_not_enough' => 'Invitations insuffisantes',
    ],
    'send_allow_text' => 'Inviter quelqu\'un',
    'pre_register_username' => 'Pré-enregistrer le nom d\'utilisateur',
    'pre_register_username_help' => 'Le nom d\'utilisateur et l\'e-mail ne seront pas modifiés lorsque l\'utilisateur s\'inscrira avec ce code d\'invitation',
    'require_pre_register_username' => "Le prénom d'utilisateur ne peut pas être vide",
];
