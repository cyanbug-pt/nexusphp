<?php

return [
    'label' => 'Medalj',
    'action_wearing' => 'Bär',
    'admin' => [
        'list' => [
            'page_title' => 'Lista över medaljer'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Utbyte',
        \App\Models\Medal::GET_TYPE_GRANT => 'Bevilja',
    ],
    'fields' => [
        'get_type' => 'Hämta typ',
        'description' => 'Beskrivning',
        'image_large' => 'Bild',
        'price' => 'Pris',
        'duration' => 'Giltig efter köp (dagar)',
        'sale_begin_time' => 'Rea börjar tid',
        'sale_begin_time_help' => 'Användaren kan köpa efter denna tid, lämna tomt utan begränsning',
        'sale_end_time' => 'Försäljning sluttid',
        'sale_end_time_help' => 'Användaren kan köpa innan denna tid, lämna tomt utan begränsning',
        'inventory' => 'Lager',
        'inventory_help' => 'Lämna tomt utan begränsning',
        'sale_begin_end_time' => 'Tillgänglig till salu',
        'users_count' => 'Sålda räknare',
        'bonus_addition_factor' => 'Bonus tillägg faktor',
        'bonus_addition' => 'Tillägg till bonus',
        'bonus_addition_factor_help' => 'Till exempel: 0,01 innebär 1% tillägg, lämna tomt inget tillägg',
        'gift_fee_factor' => 'Faktorer för gåvoavgift',
        'gift_fee' => 'Gåvoavgift',
        'gift_fee_factor_help' => 'Den extra avgiften för gåvor till andra användare är lika med priset multiplicerat med denna faktor',
    ],
    'buy_already' => 'Köp redan',
    'buy_btn' => 'Köp',
    'confirm_to_buy' => 'Visst vill du köpa?',
    'require_more_bonus' => 'Kräv mer bonus',
    'grant_only' => 'Bevilja endast',
    'before_sale_begin_time' => 'Innan rean börjar tid',
    'after_sale_end_time' => 'Efter försäljning sluttid',
    'inventory_empty' => 'Inventering tom',
    'gift_btn' => 'Gåva',
    'confirm_to_gift' => 'Bekräfta gåvan till användaren ',
    'max_allow_wearing' => 'Maximalt :count medaljer kan bäras samtidigt',
    'wearing_status_text' => [
        0 => 'Bär',
        1 => 'Bär inte'
    ],
];
