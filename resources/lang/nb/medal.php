<?php

return [
    'label' => 'Medalje',
    'action_wearing' => 'Bruk',
    'admin' => [
        'list' => [
            'page_title' => 'Medalje liste'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Børs',
        \App\Models\Medal::GET_TYPE_GRANT => 'Tillat',
    ],
    'fields' => [
        'get_type' => 'Få type',
        'description' => 'Beskrivelse',
        'image_large' => 'Bilde',
        'price' => 'Pris',
        'duration' => 'Gyldig etter kjøp (dager)',
        'sale_begin_time' => 'Start tid for salg',
        'sale_begin_time_help' => 'Brukeren kan kjøpe etter dette tidspunktet, la stå tomt uten restriksjoner',
        'sale_end_time' => 'Slutttid for salg',
        'sale_end_time_help' => 'Brukeren kan kjøpe før dette tidspunktet, la stå tomt uten restriksjoner',
        'inventory' => 'Inventar',
        'inventory_help' => 'La stå tomt uten restriksjoner',
        'sale_begin_end_time' => 'Tilgjengelig for salg',
        'users_count' => 'Solgte tellere',
        'bonus_addition_factor' => 'Bonus tillegg faktor',
        'bonus_addition' => 'Bonus tillegg',
        'bonus_addition_factor_help' => 'For eksempel: 0.01 betyr betyr 1 % tillegg, la feltet stå tomt',
        'gift_fee_factor' => 'Gave gebyr-faktor',
        'gift_fee' => 'Gave gebyr',
        'gift_fee_factor_help' => 'Tilleggsavgiften for gaver til andre brukere er lik prisen multiplisert med faktoren',
    ],
    'buy_already' => 'Allerede kjøp',
    'buy_btn' => 'Kjøp',
    'confirm_to_buy' => 'Sikker på at du vil kjøpe?',
    'require_more_bonus' => 'Krev mer bonus',
    'grant_only' => 'Bare gi',
    'before_sale_begin_time' => 'Før salget begynner tidspunkt',
    'after_sale_end_time' => 'Etter salgs slutt',
    'inventory_empty' => 'Inventar tomt',
    'gift_btn' => 'Gave',
    'confirm_to_gift' => 'Bekreft gave til bruker ',
    'max_allow_wearing' => 'Du kan bruke maksimalt :count medaljer samtidig',
    'wearing_status_text' => [
        0 => 'Retning',
        1 => 'Ikke på'
    ],
];
