<?php

return [
    'label' => 'Médaille',
    'action_wearing' => 'Porter',
    'admin' => [
        'list' => [
            'page_title' => 'Liste des médailles'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Échanger',
        \App\Models\Medal::GET_TYPE_GRANT => 'Accorder',
    ],
    'fields' => [
        'get_type' => 'Obtenir le type',
        'description' => 'Libellé',
        'image_large' => 'Image',
        'price' => 'Prix',
        'duration' => 'Valide après achat (jours)',
        'sale_begin_time' => 'Heure de début de la vente',
        'sale_begin_time_help' => 'L\'utilisateur peut acheter après ce temps, laisser vide sans restriction',
        'sale_end_time' => 'Heure de fin de vente',
        'sale_end_time_help' => 'L\'utilisateur peut acheter avant cette date, laisser vide sans restriction',
        'inventory' => 'Inventaire',
        'inventory_help' => 'Laisser vide sans restriction',
        'sale_begin_end_time' => 'Disponible à la vente',
        'users_count' => 'Nombre de ventes',
        'bonus_addition_factor' => 'Facteur d\'ajout de bonus',
        'bonus_addition' => 'Ajout de bonus',
        'bonus_addition_factor_help' => 'Par exemple : 0,01 signifie 1 % d\'ajout, laisser vide sans ajout',
        'gift_fee_factor' => 'Facteur de frais de cadeau',
        'gift_fee' => 'Frais de cadeau',
        'gift_fee_factor_help' => 'Les frais supplémentaires facturés aux autres utilisateurs pour les cadeaux sont égaux au prix multiplié par ce facteur',
    ],
    'buy_already' => 'Déjà acheté',
    'buy_btn' => 'Acheter',
    'confirm_to_buy' => 'Êtes-vous sûr de vouloir acheter ?',
    'require_more_bonus' => 'Requiert plus de bonus',
    'grant_only' => 'Accorder uniquement',
    'before_sale_begin_time' => 'Avant le début de la vente',
    'after_sale_end_time' => 'Heure de fin de la vente',
    'inventory_empty' => 'Inventaire vide',
    'gift_btn' => 'Cadeau',
    'confirm_to_gift' => 'Confirmer le cadeau à l\'utilisateur ',
    'max_allow_wearing' => 'Un maximum de :count médailles peut être porté en même temps',
    'wearing_status_text' => [
        0 => 'Portage',
        1 => 'Ne pas porter'
    ],
];
