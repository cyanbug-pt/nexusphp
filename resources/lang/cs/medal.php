<?php

return [
    'label' => 'Medaile',
    'action_wearing' => 'Nosit',
    'admin' => [
        'list' => [
            'page_title' => 'Mediální seznam'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Výměna',
        \App\Models\Medal::GET_TYPE_GRANT => 'Udělit',
    ],
    'fields' => [
        'get_type' => 'Získat typ',
        'description' => 'L 343, 22.12.2009, s. 1).',
        'image_large' => 'Obrázek',
        'price' => 'Cena',
        'duration' => 'Platné po koupi (dny)',
        'sale_begin_time' => 'Čas zahájení prodeje',
        'sale_begin_time_help' => 'Uživatel může nakupovat po tomto čase, ponechte prázdné bez omezení',
        'sale_end_time' => 'Čas ukončení prodeje',
        'sale_end_time_help' => 'Uživatel může koupit před tímto časem, ponechte prázdné bez omezení',
        'inventory' => 'Inventář',
        'inventory_help' => 'Ponechte prázdné bez omezení',
        'sale_begin_end_time' => 'Dostupné k prodeji',
        'users_count' => 'Počet prodaných',
        'bonus_addition_factor' => 'Faktor přídavku bonusu',
        'bonus_addition' => 'Přidání bonusu',
        'bonus_addition_factor_help' => 'Například: 0,01 znamená 1% navíc, nechte prázdné',
        'gift_fee_factor' => 'Faktor dárkového poplatku',
        'gift_fee' => 'Dárkový poplatek',
        'gift_fee_factor_help' => 'Dodatečný poplatek účtovaný za dary ostatním uživatelům se rovná ceně vynásobené tímto činitelem',
    ],
    'buy_already' => 'Již koupit',
    'buy_btn' => 'Koupit',
    'confirm_to_buy' => 'Jistě, chcete si koupit?',
    'require_more_bonus' => 'Vyžadovat další bonus',
    'grant_only' => 'Pouze udělovat',
    'before_sale_begin_time' => 'Před začátkem prodeje',
    'after_sale_end_time' => 'Po ukončení prodeje',
    'inventory_empty' => 'Prázdný inventář',
    'gift_btn' => 'Dárek',
    'confirm_to_gift' => 'Potvrdit darování uživateli ',
    'max_allow_wearing' => 'Maximálně :count medailí může být nošen současně',
    'wearing_status_text' => [
        0 => 'Odolnost',
        1 => 'Neoblečené'
    ],
];
