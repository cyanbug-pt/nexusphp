<?php

return [
    'label' => 'Medalla',
    'action_wearing' => 'Vestido',
    'admin' => [
        'list' => [
            'page_title' => 'Lista de medallas'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Intercambio',
        \App\Models\Medal::GET_TYPE_GRANT => 'Otorgar',
    ],
    'fields' => [
        'get_type' => 'Obtener tipo',
        'description' => 'Descripción',
        'image_large' => 'Imagen',
        'price' => 'Precio',
        'duration' => 'Válido después de comprar (días)',
        'sale_begin_time' => 'Hora de inicio de venta',
        'sale_begin_time_help' => 'El usuario puede comprar después de este tiempo, dejar en blanco sin restricciones',
        'sale_end_time' => 'Hora de venta',
        'sale_end_time_help' => 'El usuario puede comprar antes de esta hora, dejar en blanco sin restricciones',
        'inventory' => 'Inventario',
        'inventory_help' => 'Dejar en blanco sin restricciones',
        'sale_begin_end_time' => 'Disponible para la venta',
        'users_count' => 'Conteos vendidos',
        'bonus_addition_factor' => 'Factor de adición extra',
        'bonus_addition' => 'Agregado de bonus',
        'bonus_addition_factor_help' => 'Por ejemplo: 0.01 significa 1% adicional, no dejar en blanco',
        'gift_fee_factor' => 'Factor de tarifa de regalo',
        'gift_fee' => 'Gasto de regalo',
        'gift_fee_factor_help' => 'El cargo adicional por regalos para otros usuarios es igual al precio multiplicado por este factor',
    ],
    'buy_already' => 'Comprar',
    'buy_btn' => 'Comprar',
    'confirm_to_buy' => '¿Seguro que quieres comprar?',
    'require_more_bonus' => 'Requiere más bonos',
    'grant_only' => 'Otorgar sólo',
    'before_sale_begin_time' => 'Antes de que comience la venta',
    'after_sale_end_time' => 'Hora de finalización de la venta',
    'inventory_empty' => 'Inventario vacío',
    'gift_btn' => 'Regalo',
    'confirm_to_gift' => 'Confirmar regalo al usuario ',
    'max_allow_wearing' => 'Un máximo de :count medallas pueden ser usadas al mismo tiempo',
    'wearing_status_text' => [
        0 => 'Vestido',
        1 => 'Sin usar'
    ],
];
