<?php

return [
    'label' => 'Medalha',
    'action_wearing' => 'Wear',
    'admin' => [
        'list' => [
            'page_title' => '勲章一覧'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => '交換',
        \App\Models\Medal::GET_TYPE_GRANT => '許可',
    ],
    'fields' => [
        'get_type' => '種類を取得',
        'description' => '説明',
        'image_large' => '画像',
        'price' => '価格',
        'duration' => '購入後有効（日数）',
        'sale_begin_time' => '販売開始時刻',
        'sale_begin_time_help' => 'ユーザーはこの時間後に購入できます。制限なしに空白のままにします。',
        'sale_end_time' => '販売終了時間',
        'sale_end_time_help' => 'ユーザーはこの時間の前に購入することができます。制限なしに空白のままにします。',
        'inventory' => '棚卸し',
        'inventory_help' => '制限なしに空白のままにする',
        'sale_begin_end_time' => '販売可能',
        'users_count' => '売却回数',
        'bonus_addition_factor' => 'ボーナス加算係数',
        'bonus_addition' => 'ボーナス追加',
        'bonus_addition_factor_help' => '例: 0.01 は1%の加算を意味します。空白のままにします。',
        'gift_fee_factor' => 'ギフト料金係数',
        'gift_fee' => 'ギフト手数料',
        'gift_fee_factor_help' => '他のユーザーへのギフトに対する追加料金は、この因子を掛けた価格と同じです',
    ],
    'buy_already' => '既に購入',
    'buy_btn' => '購入',
    'confirm_to_buy' => '購入しますか？',
    'require_more_bonus' => 'さらにボーナスが必要',
    'grant_only' => '許可のみ',
    'before_sale_begin_time' => '販売開始前の時間',
    'after_sale_end_time' => '販売終了時間',
    'inventory_empty' => '在庫がありません',
    'gift_btn' => 'ギフト',
    'confirm_to_gift' => 'Confirm to gift to user ',
    'max_allow_wearing' => '最大:count個のメダルは同時に着用できます',
    'wearing_status_text' => [
        0 => '着用中',
        1 => '着用していません'
    ],
];
