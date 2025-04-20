<?php

return [
    'edit_ban_reason' => 'Deaktivér af administrator',
    'deleted_username' => 'bruger findes ikke',
    'admin' => [
        'list' => [
            'page_title' => 'Bruger liste'
        ]
    ],
    'labels' => [
        'seedbonus' => 'Bonus',
        'seed_points' => 'Seed point',
        'uploaded' => 'Uploadet',
        'downloaded' => 'Downloadet',
        'invites' => 'Invitationer',
        'attendance_card' => 'Deltag i kort',
        'props' => 'Props',
        'class' => 'Klasse',
        'vip_added' => 'VIP status er opnået ved bonus',
        'vip_added_help' => 'VIP-status indløses af bonus.',
        'vip_until' => 'VIP status sluttidspunkt',
        'vip_until_help' => "Tidsformatet er 'Året-Året-Måned-Dag Time: Minute:Sekund Den tid, hvor VIP-status slutter. VIP status er opnået ved bonus' skal sættes til 'Ja', for at denne regel kan træde i kraft.",
    ],
    'class_names' => [
        \App\Models\User::CLASS_VIP => 'Vip',
        \App\Models\User::CLASS_RETIREE => 'Afbryd',
        \App\Models\User::CLASS_UPLOADER => 'Uploader',
        \App\Models\User::CLASS_MODERATOR => 'Moderator',
        \App\Models\User::CLASS_ADMINISTRATOR => 'Administrator',
        \App\Models\User::CLASS_SYSOP => 'Sysop',
        \App\Models\User::CLASS_STAFF_LEADER => 'Personale Leder',
    ],
    'change_username_lte_min_interval' => 'Sidste ændringstid: :last_change_time, unmet minimum interval: :interval dage',
    'destroy_by_admin' => 'Fysisk sletning af administrator',
    'disable_by_admin' => 'Deaktivér af administrator',
    'genders' => [
        \App\Models\User::GENDER_MALE => 'Mand',
        \App\Models\User::GENDER_FEMALE => 'Kvinde',
        \App\Models\User::GENDER_UNKNOWN => 'Ukendt',
    ],
    'grant_props_notification' => [
        'subject' => 'Get Props：:name',
        'body' => ':operatør Tildel dig:navn, Gyldighedsperiode: :varighed.',
    ],
    'metas' => [
        'already_valid_forever' => ':meta_key_text allerede gyldig for evigt',
    ],
    'edit_notifications' => [
        'change_class' => [
            'promote' => 'Fremme',
            'demote' => 'Demote',
            'subject' => 'Klasse ændret',
            'body' => 'Du havde været :action til :new_class, administrator: :operator, årsag: :årsag.',
        ],
    ],
    'username_already_exists' => 'Brugernavn::brugernavn findes allerede',
    'username_invalid' => 'Brugernavn::brugernavn ugyldigt',
];
