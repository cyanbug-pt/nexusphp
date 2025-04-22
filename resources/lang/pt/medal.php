<?php

return [
    'label' => 'Medalha',
    'action_wearing' => 'Desgaste',
    'admin' => [
        'list' => [
            'page_title' => 'Lista de Medalhas'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Câmbio',
        \App\Models\Medal::GET_TYPE_GRANT => 'Conceder',
    ],
    'fields' => [
        'get_type' => 'Pegar tipo',
        'description' => 'Descrição:',
        'image_large' => 'Imagem:',
        'price' => 'Quantidade',
        'duration' => 'Válido após a compra (dias)',
        'sale_begin_time' => 'Hora do início da venda',
        'sale_begin_time_help' => 'O usuário pode comprar após este tempo, deixar em branco sem restrições',
        'sale_end_time' => 'Hora Final da Venda',
        'sale_end_time_help' => 'O usuário pode comprar antes desta hora, deixe em branco sem restrições',
        'inventory' => 'Inventório',
        'inventory_help' => 'Deixe em branco sem restrição',
        'sale_begin_end_time' => 'Disponível para venda',
        'users_count' => 'Contagens vendidas',
        'bonus_addition_factor' => 'Fator de adição bônus',
        'bonus_addition' => 'Adição de bônus',
        'bonus_addition_factor_help' => 'Por exemplo: 0,01 significa 1% de adição, sem adição em branco',
        'gift_fee_factor' => 'Fator de taxa de presente',
        'gift_fee' => 'Taxa de presente',
        'gift_fee_factor_help' => 'A taxa adicional cobrada por presentes para outros usuários é igual ao preço multiplicado por este fator',
    ],
    'buy_already' => 'Já compra',
    'buy_btn' => 'Comprar',
    'confirm_to_buy' => 'Tem certeza que quer comprar?',
    'require_more_bonus' => 'Exigir mais bônus',
    'grant_only' => 'Somente conceder',
    'before_sale_begin_time' => 'Antes do início da venda',
    'after_sale_end_time' => 'Hora final da venda',
    'inventory_empty' => 'Estoque vazio',
    'gift_btn' => 'Presente',
    'confirm_to_gift' => 'Confirme o presente para o usuário ',
    'max_allow_wearing' => 'Um máximo de :count medalhas pode ser usado ao mesmo tempo',
    'wearing_status_text' => [
        0 => 'Usando',
        1 => 'Não está usando'
    ],
];
