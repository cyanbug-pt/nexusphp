<?php

return [
    'label' => 'Medaille',
    'action_wearing' => 'Tragen',
    'admin' => [
        'list' => [
            'page_title' => 'Medaillenliste'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Umtausch',
        \App\Models\Medal::GET_TYPE_GRANT => 'Zuschuss',
    ],
    'fields' => [
        'get_type' => 'Typ abrufen',
        'description' => 'Beschreibung',
        'image_large' => 'Bild',
        'price' => 'Preis',
        'duration' => 'Gültig nach dem Kauf (Tage)',
        'sale_begin_time' => 'Verkaufs-Startzeit',
        'sale_begin_time_help' => 'Benutzer kann nach dieser Zeit kaufen, leer lassen ohne Einschränkung',
        'sale_end_time' => 'Verkaufsende Endzeit',
        'sale_end_time_help' => 'Benutzer kann vor dieser Zeit kaufen, leer lassen ohne Einschränkung',
        'inventory' => 'Inventar',
        'inventory_help' => 'Leer lassen ohne Einschränkung',
        'sale_begin_end_time' => 'Zum Verkauf verfügbar',
        'users_count' => 'Verkaufte Anzahl',
        'bonus_addition_factor' => 'Bonus Zusatzfaktor',
        'bonus_addition' => 'Bonus Zusatz',
        'bonus_addition_factor_help' => 'Zum Beispiel: 0,01 bedeutet 1% Zusatz, leer lassen',
        'gift_fee_factor' => 'Geschenkkostenfaktor',
        'gift_fee' => 'Geschenkgebühr',
        'gift_fee_factor_help' => 'Die zusätzliche Gebühr für Geschenke an andere Nutzer ist gleich dem Preis multipliziert mit diesem Faktor',
    ],
    'buy_already' => 'Bereits kaufen',
    'buy_btn' => 'Kaufen',
    'confirm_to_buy' => 'Sicher, Sie wollen kaufen?',
    'require_more_bonus' => 'Mehr Bonus erforderlich',
    'grant_only' => 'Nur gewähren',
    'before_sale_begin_time' => 'Vor Verkaufsbeginn',
    'after_sale_end_time' => 'Endzeit nach dem Verkauf',
    'inventory_empty' => 'Inventar leer',
    'gift_btn' => 'Geschenk',
    'confirm_to_gift' => 'Bestätigen, um dem Benutzer zu schenken ',
    'max_allow_wearing' => 'Maximal :count Medaillen können gleichzeitig getragen werden',
    'wearing_status_text' => [
        0 => 'Tragen',
        1 => 'Nicht tragen'
    ],
];
