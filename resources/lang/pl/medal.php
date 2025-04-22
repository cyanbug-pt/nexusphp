<?php

return [
    'label' => 'Medal',
    'action_wearing' => 'Użycie',
    'admin' => [
        'list' => [
            'page_title' => 'Lista Medali'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Wymiana',
        \App\Models\Medal::GET_TYPE_GRANT => 'Przyznanie',
    ],
    'fields' => [
        'get_type' => 'Pobierz typ',
        'description' => 'Opis',
        'image_large' => 'Obraz',
        'price' => 'Cena',
        'duration' => 'Ważne po zakupie (dni)',
        'sale_begin_time' => 'Godzina rozpoczęcia sprzedaży',
        'sale_begin_time_help' => 'Użytkownik może kupić po tym czasie, pozostaw puste bez ograniczeń',
        'sale_end_time' => 'Godzina zakończenia sprzedaży',
        'sale_end_time_help' => 'Użytkownik może kupić przed tym czasem, pozostaw puste bez ograniczeń',
        'inventory' => 'Ekwipunek',
        'inventory_help' => 'Pozostaw puste bez ograniczeń',
        'sale_begin_end_time' => 'Dostępne na sprzedaż',
        'users_count' => 'Liczba sprzedanych',
        'bonus_addition_factor' => 'Współczynnik dodawania premii',
        'bonus_addition' => 'Dodanie bonusu',
        'bonus_addition_factor_help' => 'Na przykład: 0,01 oznacza dodanie 1 %, pozostawić puste pole bez dodawania',
        'gift_fee_factor' => 'Współczynnik opłaty za prezent',
        'gift_fee' => 'Opłata za prezent',
        'gift_fee_factor_help' => 'Dodatkowa opłata pobierana od darowizn dla innych użytkowników jest równa cenie pomnożonej przez ten czynnik',
    ],
    'buy_already' => 'Już kupiono',
    'buy_btn' => 'Kup',
    'confirm_to_buy' => 'Na pewno chcesz kupić?',
    'require_more_bonus' => 'Wymagaj więcej bonusów',
    'grant_only' => 'Tylko przyznawanie',
    'before_sale_begin_time' => 'Przed rozpoczęciem sprzedaży',
    'after_sale_end_time' => 'Czas zakończenia po sprzedaży',
    'inventory_empty' => 'Zapasy puste',
    'gift_btn' => 'Prezent',
    'confirm_to_gift' => 'Potwierdź podarunek dla użytkownika ',
    'max_allow_wearing' => 'Maksymalnie :count medali można nosić w tym samym czasie',
    'wearing_status_text' => [
        0 => 'Wejście w życie',
        1 => 'O masie liniowej mniejszej niż 125 decyteksów, ale nie mniejszej niż 192,31 decyteksa (o numerze metrycznym przekraczającym 94, ale nieprzekraczającym 120)'
    ],
];
