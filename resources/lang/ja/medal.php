<?php

return array (
  'label' => 'メダル',
  'action_wearing' => '着る',
  'admin' => 
  array (
    'list' => 
    array (
      'page_title' => 'メダルリスト',
    ),
  ),
  'get_types' => 
  array (
    1 => '交換',
    2 => '付与',
  ),
  'fields' => 
  array (
    'get_type' => '取得方法',
    'description' => '説明する',
    'image_large' => '写真',
    'price' => '価格',
    'duration' => '購入後の有効期間（日）',
    'sale_begin_time' => 'リリースの開始時間',
    'sale_begin_time_help' => 'この時間以降に購入できますが、制限はありません',
    'sale_end_time' => '終了時間をリストします',
    'sale_end_time_help' => 'この時間前に購入することはできませんが、制限はありません',
    'inventory' => '在庫あり',
    'inventory_help' => '無限を示すために空白のままにします',
    'sale_begin_end_time' => '購入時間',
    'users_count' => '販売数量',
    'bonus_addition_factor' => 'マジックボーナス係数',
    'bonus_addition' => 'マジックボーナス',
    'bonus_addition_factor_help' => '例：0.01は1％のボーナスを意味し、ボーナスを残しません',
    'gift_fee_factor' => '自由処理料金係数',
    'gift_fee' => '処理料',
    'gift_fee_factor_help' => '他のユーザーに提供する場合、追加の取り扱い料金はこの係数を掛けた価格に等しくなります',
  ),
  'buy_already' => 'すでに購入しています',
  'buy_btn' => '買う',
  'confirm_to_buy' => 'あなたはそれを買いたいですか？',
  'require_more_bonus' => 'もっと魔法のポイントが必要です',
  'grant_only' => '確定のみ',
  'before_sale_begin_time' => '購入時間はありません',
  'after_sale_end_time' => '購入時間が経過しました',
  'inventory_empty' => '在庫が不十分です',
  'gift_btn' => '贈り物',
  'confirm_to_gift' => 'ユーザーに与えることを確認します',
  'max_allow_wearing' => '最大：カウントメダルは同時に許可されています',
  'wearing_status_text' => 
  array (
    0 => '着用していません',
    1 => 'すでに着用しています',
  ),
);
