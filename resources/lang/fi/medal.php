<?php

return [
    'label' => 'Mitali',
    'action_wearing' => 'Kuluminen',
    'admin' => [
        'list' => [
            'page_title' => 'Mitalin lista'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Vaihto',
        \App\Models\Medal::GET_TYPE_GRANT => 'Myönnä',
    ],
    'fields' => [
        'get_type' => 'Hae tyyppi',
        'description' => 'Kuvaus',
        'image_large' => 'Kuva',
        'price' => 'Hinta',
        'duration' => 'Voimassa ostamisen jälkeen (päivää)',
        'sale_begin_time' => 'Myynti alkaa aika',
        'sale_begin_time_help' => 'Käyttäjä voi ostaa tämän ajan jälkeen, jättää tyhjäksi rajoituksetta',
        'sale_end_time' => 'Myynnin lopetusaika',
        'sale_end_time_help' => 'Käyttäjä voi ostaa ennen tätä aikaa, jättää tyhjäksi rajoituksetta',
        'inventory' => 'Tavaraluettelo',
        'inventory_help' => 'Jätä tyhjäksi rajoituksetta',
        'sale_begin_end_time' => 'Saatavilla myytävänä',
        'users_count' => 'Myydyt määrät',
        'bonus_addition_factor' => 'Bonuksen lisäkerroin',
        'bonus_addition' => 'Bonus lisä',
        'bonus_addition_factor_help' => 'Esimerkiksi: 0,01 tarkoittaa 1% lisäksi, jätä tyhjäksi ei lisää',
        'gift_fee_factor' => 'Lahjamaksun tekijä',
        'gift_fee' => 'Lahjan maksu',
        'gift_fee_factor_help' => 'Muille käyttäjille annettavista lahjoista perittävä lisämaksu on yhtä suuri kuin tällä tekijällä kerrottu hinta.',
    ],
    'buy_already' => 'Osta jo',
    'buy_btn' => 'Osta',
    'confirm_to_buy' => 'Haluatko varmasti ostaa?',
    'require_more_bonus' => 'Vaadi lisää bonusta',
    'grant_only' => 'Vain avustus',
    'before_sale_begin_time' => 'Ennen myyntiä alkaa aika',
    'after_sale_end_time' => 'Myynnin jälkeinen lopetusaika',
    'inventory_empty' => 'Varasto tyhjä',
    'gift_btn' => 'Lahja',
    'confirm_to_gift' => 'Vahvista lahja käyttäjälle ',
    'max_allow_wearing' => 'Enintään :count mitalit voidaan käyttää samaan aikaan',
    'wearing_status_text' => [
        0 => 'Yllään',
        1 => 'Ei yllään'
    ],
];
