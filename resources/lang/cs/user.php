<?php

return [
    'edit_ban_reason' => 'Zakázat administrátorem',
    'deleted_username' => 'uživatel neexistuje',
    'admin' => [
        'list' => [
            'page_title' => 'Seznam uživatelů'
        ]
    ],
    'labels' => [
        'seedbonus' => 'Bonus',
        'seed_points' => 'Semenné body',
        'uploaded' => 'Nahráno',
        'downloaded' => 'Staženo',
        'invites' => 'Pozvánky',
        'attendance_card' => 'Účast na kartě',
        'props' => 'Příznivé',
        'class' => 'Třída:',
        'vip_added' => 'VIP status je získán bonusem',
        'vip_added_help' => 'Je VIP status vyplacen bonusem.',
        'vip_until' => 'VIP status končí čas',
        'vip_until_help' => "Formát času je 'Rok-Rok - měsíc hodina:Minute:Druhý čas, kdy VIP status skončí. VIP status je získán bonusem\" musí být nastaven na 'Ano', aby se toto pravidlo projevilo.",
    ],
    'class_names' => [
        \App\Models\User::CLASS_VIP => 'Vip',
        \App\Models\User::CLASS_RETIREE => 'Odebrat',
        \App\Models\User::CLASS_UPLOADER => 'Nahrávání',
        \App\Models\User::CLASS_MODERATOR => 'Moderátor',
        \App\Models\User::CLASS_ADMINISTRATOR => 'Administrátor',
        \App\Models\User::CLASS_SYSOP => 'Sysop',
        \App\Models\User::CLASS_STAFF_LEADER => 'Vedoucí štábu',
    ],
    'change_username_lte_min_interval' => 'Poslední změna: :last_change_time, nesplněný minimální interval: :interval dní',
    'destroy_by_admin' => 'Fyzické smazání administrátorem',
    'disable_by_admin' => 'Zakázat administrátorem',
    'genders' => [
        \App\Models\User::GENDER_MALE => 'Muž',
        \App\Models\User::GENDER_FEMALE => 'Samice',
        \App\Models\User::GENDER_UNKNOWN => 'Neznámý',
    ],
    'grant_props_notification' => [
        'subject' => 'Get Props：:name',
        'body' => ':operator vám udělí :name, dobu platnosti: :duration.',
    ],
    'metas' => [
        'already_valid_forever' => ':meta_key_text je již navždy platný',
    ],
    'edit_notifications' => [
        'change_class' => [
            'promote' => 'Propagovat',
            'demote' => 'Degradovat',
            'subject' => 'Třída změněna',
            'body' => 'Byli jste :action pro :new_class, administrátor: :operor, důvod: :reason.',
        ],
    ],
    'username_already_exists' => 'Uživatelské jméno: uživatelské jméno již existuje',
    'username_invalid' => 'Uživatelské jméno: neplatné uživatelské jméno',
];
