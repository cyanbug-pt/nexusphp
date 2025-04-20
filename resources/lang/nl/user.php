<?php

return [
    'edit_ban_reason' => 'Uitschakelen door beheerder',
    'deleted_username' => 'gebruiker bestaat niet',
    'admin' => [
        'list' => [
            'page_title' => 'Gebruikers lijst'
        ]
    ],
    'labels' => [
        'seedbonus' => 'Bonus',
        'seed_points' => 'Seed punten',
        'uploaded' => 'Geüpload',
        'downloaded' => 'Gedownload',
        'invites' => 'Uitnodigingen',
        'attendance_card' => 'Kaart bijwonen',
        'props' => 'Eigenschappen',
        'class' => 'Les',
        'vip_added' => 'VIP status is ontvangen door een bonus',
        'vip_added_help' => 'Is de VIP-status door bonus verkregen?',
        'vip_until' => 'Eindtijd van de VIP-status',
        'vip_until_help' => "Het tijdformaat is 'Jaar-Jaar-Maand-Maandag uur:Minute:Tweede De tijd wanneer de VIP-status eindigt. VIP status wordt verkregen door bonus' s moet op ja staan om deze regel van kracht te laten worden.",
    ],
    'class_names' => [
        \App\Models\User::CLASS_VIP => 'Vip',
        \App\Models\User::CLASS_RETIREE => 'Retirees',
        \App\Models\User::CLASS_UPLOADER => 'Uploader',
        \App\Models\User::CLASS_MODERATOR => 'Moderator',
        \App\Models\User::CLASS_ADMINISTRATOR => 'Beheerder',
        \App\Models\User::CLASS_SYSOP => 'Sysop',
        \App\Models\User::CLASS_STAFF_LEADER => 'Medewerker Leider',
    ],
    'change_username_lte_min_interval' => 'Laatste verandering tijd: :last_change_time, unmet minimum interval: :interval dagen',
    'destroy_by_admin' => 'Fysieke verwijdering door beheerder',
    'disable_by_admin' => 'Uitschakelen door beheerder',
    'genders' => [
        \App\Models\User::GENDER_MALE => 'Mannelijk',
        \App\Models\User::GENDER_FEMALE => 'Vrouwelijk',
        \App\Models\User::GENDER_UNKNOWN => 'onbekend',
    ],
    'grant_props_notification' => [
        'subject' => 'Get Props：:name',
        'body' => ':operator Grant je :name, validiteitsperiode: :duration.',
    ],
    'metas' => [
        'already_valid_forever' => ':meta_key_text is voor altijd geldig',
    ],
    'edit_notifications' => [
        'change_class' => [
            'promote' => 'Promoveren',
            'demote' => 'Degraderen',
            'subject' => 'Les gewijzigd',
            'body' => 'Je was :action voor :new_class, beheerder: :operator, reden: :reason.',
        ],
    ],
    'username_already_exists' => 'Gebruikersnaam::gebruikersnaam bestaat al',
    'username_invalid' => 'Gebruikersnaam::Gebruikersnaam ongeldig',
];
