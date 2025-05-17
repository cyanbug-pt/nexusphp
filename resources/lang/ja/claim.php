<?php

return [
    'title_for_torrent' => 'トレント請求の詳細',
    'title_for_user' => 'ユーザークレームの詳細',
    'th_id' => 'ID',
    'th_username' => 'ユーザー',
    'th_torrent_name' => 'トレント名',
    'th_torrent_size' => 'トレントサイズ',
    'th_torrent_ttl' => 'Torrent TTL',
    'th_claim_at' => '請求先',
    'th_last_settle' => '最終決済日時',
    'th_seed_time_this_month' => '今月',
    'th_uploaded_this_month' => '今月のアップ',
    'th_reached_or_not' => '到達しました',
    'th_action' => 'アクション',

    'msg_title' => '先月決済結果を請求(:month):',
    'msg_subject' => ':month クレーム決済',
    'claim_total' => 'トレント総額： [b]:total[/b]',
    'claim_reached_counts' => 'トレント数に達しました： [b]:counts[/b]',
    'claim_reached_summary' => 'トレントが1時間あたりボーナスを獲得しました: [b]:bonus_per_hour[/b], シード時間平均(時間): [b]:hours[/b], ボーナス合計: [b]:bonus_total[/b]',
    'claim_unreached_remain_counts' => '未達トレントの残り数： [b]:counts[/b]',
    'claim_unreached_remove_counts' => '未達の Torrent 削除数： [b]:counts[/b]',
    'claim_unreached_summary' => '未到のトレント：[b]:deduct_per_torrent[/b]、合計控除額: [b]:deduct_total[/b]',
    'slice_tip' => ':slice_count 個目のアイテムのみ表示',

    'confirm_give_up' => 'このトレントの主張を放棄してもよろしいですか？',
    'add_claim' => 'Claim',
    'add_claim_confirm' => '請求しますか？',
    'remove_claim' => '諦めます',
    'remove_claim_confirm' => '請求を放棄しますか？',
    'already_claimed' => '請求済み',
    'not_claim_yet' => '未請求',
    'fields' => [
        'torrent_id' => 'Torrent ID',
    ],
    'claim_all_seeding_confirmation' => '現在シード中のすべてのトレントを請求してもよろしいですか？' ,
];
