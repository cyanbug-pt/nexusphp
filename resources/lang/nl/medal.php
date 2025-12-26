<?php

return [
    'label' => 'Medaille',
    'action_wearing' => 'Draag',
    'admin' => [
        'list' => [
            'page_title' => 'Medaille lijst'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Ruil',
        \App\Models\Medal::GET_TYPE_GRANT => 'Toestaan',
    ],
    'fields' => [
        'get_type' => 'Soort ophalen',
        'description' => 'Beschrijving',
        'image_large' => 'Afbeelding',
        'price' => 'Prijs',
        'duration' => 'Geldig na aankoop (dagen)',
        'sale_begin_time' => 'Verkoop begintijd',
        'sale_begin_time_help' => 'Gebruiker kan na deze tijd kopen, laat leeg zonder beperking',
        'sale_end_time' => 'Verkoop eindtijd',
        'sale_end_time_help' => 'Gebruiker kan vóór deze tijd kopen, laat leeg zonder beperking',
        'inventory' => 'Voorraad',
        'inventory_help' => 'Laat leeg zonder beperking',
        'sale_begin_end_time' => 'Beschikbaar voor verkoop',
        'users_count' => 'Aantal verkocht',
        'bonus_addition_factor' => 'Bonus optel factor',
        'bonus_addition' => 'Bonus toevoeging',
        'bonus_addition_factor_help' => 'Bijvoorbeeld: 0.01 betekent 1% toevoeging, laat leeg geen toevoeging',
        'gift_fee_factor' => 'Cadeau vergoeding factor',
        'gift_fee' => 'Cadeau vergoeding',
        'gift_fee_factor_help' => 'De extra vergoeding voor geschenken aan andere gebruikers is gelijk aan de prijs vermenigvuldigd door deze factor',
    ],
    'buy_already' => 'Al gekocht',
    'buy_btn' => 'Kopen',
    'confirm_to_buy' => 'Weet je zeker dat je wilt kopen?',
    'require_more_bonus' => 'Vereis meer bonus',
    'grant_only' => 'Alleen verlenen',
    'before_sale_begin_time' => 'Tijd voor verkoop begint',
    'after_sale_end_time' => 'Na eindtijd verkoop',
    'inventory_empty' => 'Inventaris leeg',
    'gift_btn' => 'Geschenk',
    'confirm_to_gift' => 'Bevestig om te cadeau aan gebruiker ',
    'max_allow_wearing' => 'Een maximum van :count medailles kan tegelijkertijd gedragen worden',
    'wearing_status_text' => [
        0 => 'Dooring',
        1 => 'Niet dragen'
    ],
];
