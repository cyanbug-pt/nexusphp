<?php

return [
    'label' => 'Medalie',
    'action_wearing' => 'Uzură',
    'admin' => [
        'list' => [
            'page_title' => 'Listă de medalii'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Schimb',
        \App\Models\Medal::GET_TYPE_GRANT => 'Acordă',
    ],
    'fields' => [
        'get_type' => 'Obține tipul',
        'description' => 'Descriere',
        'image_large' => 'Imagine',
        'price' => 'Preț',
        'duration' => 'Valabil după cumpărare (zile)',
        'sale_begin_time' => 'Ora începerii vânzării',
        'sale_begin_time_help' => 'Utilizatorul poate cumpăra după această perioadă, lăsați necompletat fără restricții',
        'sale_end_time' => 'Timpul de finalizare vanzare',
        'sale_end_time_help' => 'Utilizatorul poate cumpăra înainte de această dată, lăsați necompletat fără restricții',
        'inventory' => 'Inventar',
        'inventory_help' => 'Lăsați necompletat fără restricții',
        'sale_begin_end_time' => 'Disponibil pentru vânzare',
        'users_count' => 'Numărul de vânzări',
        'bonus_addition_factor' => 'Factor de adăugare bonus',
        'bonus_addition' => 'Adăugare bonus',
        'bonus_addition_factor_help' => 'De exemplu: 0,01 înseamnă 1 %, nu mai adăugați nicio completare',
        'gift_fee_factor' => 'Factor de taxă cadou',
        'gift_fee' => 'Taxă cadou',
        'gift_fee_factor_help' => 'Taxa adițională percepută pentru cadouri pentru alți utilizatori este egală cu prețul înmulțit cu acest factor',
    ],
    'buy_already' => 'Cumpără deja',
    'buy_btn' => 'Cumpără',
    'confirm_to_buy' => 'Sigur doriți să cumpărați?',
    'require_more_bonus' => 'Necesită mai mult bonus',
    'grant_only' => 'Acordă numai',
    'before_sale_begin_time' => 'Înainte de începerea vânzării',
    'after_sale_end_time' => 'După terminarea vânzării, ora de sfârșit',
    'inventory_empty' => 'Inventar gol',
    'gift_btn' => 'Cadou',
    'confirm_to_gift' => 'Confirmă cadoul pentru utilizator ',
    'max_allow_wearing' => 'Un maxim de :count medalii poate fi purtat în același timp',
    'wearing_status_text' => [
        0 => 'Purta',
        1 => 'Nu purta'
    ],
];
