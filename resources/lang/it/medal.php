<?php

return [
    'label' => 'Medaglia',
    'action_wearing' => 'Indossare',
    'admin' => [
        'list' => [
            'page_title' => 'Elenco medaglie'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Borsa',
        \App\Models\Medal::GET_TYPE_GRANT => 'Concedi',
    ],
    'fields' => [
        'get_type' => 'Ottieni tipo',
        'description' => 'Descrizione',
        'image_large' => 'Immagine',
        'price' => 'Prezzo',
        'duration' => 'Valido dopo l\'acquisto (giorni)',
        'sale_begin_time' => 'Tempo inizio vendita',
        'sale_begin_time_help' => 'L\'utente può acquistare dopo questo tempo, lasciare vuoto senza restrizioni',
        'sale_end_time' => 'Tempo di fine vendita',
        'sale_end_time_help' => 'L\'utente può acquistare prima di questo periodo, lasciare vuoto senza restrizioni',
        'inventory' => 'Inventario',
        'inventory_help' => 'Lascia vuoto senza restrizioni',
        'sale_begin_end_time' => 'Disponibile per la vendita',
        'users_count' => 'Conti venduti',
        'bonus_addition_factor' => 'Fattore di addizione bonus',
        'bonus_addition' => 'Aggiunta bonus',
        'bonus_addition_factor_help' => 'Per esempio: 0,01 significa 1% di aggiunta, lasciare vuoto senza aggiunta',
        'gift_fee_factor' => 'Fattore commissione regalo',
        'gift_fee' => 'Tariffa regalo',
        'gift_fee_factor_help' => 'Il costo aggiuntivo addebitato per i regali ad altri utenti è pari al prezzo moltiplicato per questo fattore',
    ],
    'buy_already' => 'Già acquistato',
    'buy_btn' => 'Acquista',
    'confirm_to_buy' => 'Sei sicuro di voler comprare?',
    'require_more_bonus' => 'Richiedi più bonus',
    'grant_only' => 'Concedi solo',
    'before_sale_begin_time' => 'Prima della vendita inizia il tempo',
    'after_sale_end_time' => 'Tempo di fine vendita',
    'inventory_empty' => 'Inventario vuoto',
    'gift_btn' => 'Regalo',
    'confirm_to_gift' => 'Conferma per regalare all\'utente ',
    'max_allow_wearing' => 'Un massimo di :count medaglie può essere indossato allo stesso tempo',
    'wearing_status_text' => [
        0 => 'Indossare',
        1 => 'Non indossato'
    ],
];
