<?php

return [
    'label' => 'Medalje',
    'action_wearing' => 'Bær',
    'admin' => [
        'list' => [
            'page_title' => 'Medalje liste'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Børs',
        \App\Models\Medal::GET_TYPE_GRANT => 'Tildel',
    ],
    'fields' => [
        'get_type' => 'Hent type',
        'description' => 'Varebeskrivelse',
        'image_large' => 'Billede',
        'price' => 'Pris',
        'duration' => 'Gyldig efter køb (dage)',
        'sale_begin_time' => 'Udsalg starttid',
        'sale_begin_time_help' => 'Brugeren kan købe efter dette tidspunkt, efterlad blank uden begrænsning',
        'sale_end_time' => 'Udsalg sluttidspunkt',
        'sale_end_time_help' => 'Brugeren kan købe før dette tidspunkt, efterlad blank uden begrænsning',
        'inventory' => 'Inventar',
        'inventory_help' => 'Efterlad blank uden begrænsning',
        'sale_begin_end_time' => 'Tilgængelig til salg',
        'users_count' => 'Solgt antal',
        'bonus_addition_factor' => 'Bonus addition faktor',
        'bonus_addition' => 'Bonus tilføjelse',
        'bonus_addition_factor_help' => 'For eksempel: 0,01 betyder 1% tilføjelse, efterlad blank ingen tilføjelse',
        'gift_fee_factor' => 'Gave gebyr faktor',
        'gift_fee' => 'Gave gebyr',
        'gift_fee_factor_help' => 'Tillægsgebyret for gaver til andre brugere er lig med prisen ganget med denne faktor',
    ],
    'buy_already' => 'Køb allerede',
    'buy_btn' => 'Køb',
    'confirm_to_buy' => 'Sikker på, at du vil købe?',
    'require_more_bonus' => 'Kræv mere bonus',
    'grant_only' => 'Tildel kun',
    'before_sale_begin_time' => 'Før salg begynder tid',
    'after_sale_end_time' => 'Efter salg sluttidspunkt',
    'inventory_empty' => 'Inventar tom',
    'gift_btn' => 'Gave',
    'confirm_to_gift' => 'Bekræft gave til brugeren ',
    'max_allow_wearing' => 'Et maksimum af :count medaljer kan bæres på samme tid',
    'wearing_status_text' => [
        0 => 'Iført',
        1 => 'Ikke iført'
    ],
];
