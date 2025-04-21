<?php

return [
    'business_types' => [
        \App\Models\BonusLogs::BUSINESS_TYPE_CANCEL_HIT_AND_RUN => 'Annuler H&R',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_MEDAL => 'Acheter une médaille',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_ATTENDANCE_CARD => 'Acheter une carte de présence',
        \App\Models\BonusLogs::BUSINESS_TYPE_STICKY_PROMOTION => 'Promotion épinglée',
        \App\Models\BonusLogs::BUSINESS_TYPE_POST_REWARD => 'Récompense de publication',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_UPLOAD => 'Échange téléchargé',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_INVITE => 'Acheter une invitation',
        \App\Models\BonusLogs::BUSINESS_TYPE_CUSTOM_TITLE => 'Titre personnalisé',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_VIP => 'Acheter un VIP',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_SOMEONE => 'Offrir à quelqu\'un',
        \App\Models\BonusLogs::BUSINESS_TYPE_NO_AD => 'Annuler l\'annonce',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_LOW_SHARE_RATIO => 'Ratio de cadeau à faible part',
        \App\Models\BonusLogs::BUSINESS_TYPE_LUCKY_DRAW => 'Tirage de la chance',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_DOWNLOAD => 'Exchange téléchargé',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TEMPORARY_INVITE => 'Acheter une invitation temporaire',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_RAINBOW_ID => 'Acheter un ID arc-en-ciel',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_CHANGE_USERNAME_CARD => 'Acheter changer le nom d\'utilisateur',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_MEDAL => 'Médaille cadeau',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TORRENT => 'Acheter le torrent',

        \App\Models\BonusLogs::BUSINESS_TYPE_ROLE_WORK_SALARY => 'Salaire de travail du rôle',
        \App\Models\BonusLogs::BUSINESS_TYPE_TORRENT_BE_DOWNLOADED => 'Torrent à télécharger',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_REWARD => 'Recevoir la récompense',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_GIFT => 'Recevoir un cadeau',
        \App\Models\BonusLogs::BUSINESS_TYPE_UPLOAD_TORRENT => 'Télécharger le torrent',
    ],
    'fields' => [
        'business_type' => 'Type d\'entreprise',
        'old_total_value' => 'Valeur avant négociation',
        'value' => 'Valeur de la négociation',
        'new_total_value' => 'Valeur post-négociation',
    ],
];
