<?php

return [

    'index' => [
        'page_title' => 'メッセージ一覧',
    ],
    'show' => [
        'page_title' => 'メッセージの詳細',
    ],
    'field_value_change_message_body' => ':operatorによって:fieldが:oldから:new に変更されました。理由：:reason。',
    'field_value_change_message_subject' => ':フィールドが変更されました',

    'download_disable' => [
        'subject' => 'ダウンロード権限がキャンセルされました',
        'body' => 'ダウンロード権限が取り消されました。共有レートや誤動作が原因かもしれません。',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'ダウンロード権限がキャンセルされました',
        'body' => 'アップロード速度が高すぎるため、ダウンロード権限がキャンセルされました。シードボックスユーザーの場合はファイルを送信してください。' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'ダウンロード権限がキャンセルされました',
        'body' => 'お支払い済みのトレントを何度もお知らせしたため、ダウンロードの許可が取り消されました。ボーナスが十分あることを確認してください。' ,
    ],
    'download_enable' => [
        'subject' => 'ダウンロード権限が復元されました',
        'body' => 'ダウンロード権限が復元され、トレントをダウンロードできるようになりました。',
    ],
    'temporary_invite_change' => [
        'subject' => '一時招待：change_type',
        'body' => ':operator, reason: :reasonによる:change_type :count 回招待しました。',
    ],
    'receive_medal' => [
        'subject' => 'ギフト勲章を受け取る',
        'body' => "ユーザー名:usernameは:cost_bonの費用でメダル[:medal_name]を購入し、あなたにそれを与えました。 メダルは:priceの価値があり、手数料は :gift_fee_total(factor: :gift_fee_factor) です。このメダルは:expire_atまで、メダルのボーナス加算率は:bonus_addition_factorです。",
    ],
    'login_notify' => [
        'subject' => ':site_name オフサイトログインアラート',
        'body' => <<<BODY
You logged in at::this_login_time, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
If it is not your own operation, the account password may have been leaked, please change it in time!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Torrent 購入の通知に成功',
        'body' => 'トレントの購入に:bonus bonus を費やしました:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => '試験終了時刻が変更されました :exam_name',
        'body' => '進行中の試験の終了時刻が :exam_name から :new_end_time に変更されました。admin: :operator, reason: :reason',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "PMを受け取りました。",
    'mail_sender' => "Sender(sender)	",
    'mail_subject' => "Subject(主題)	",
    'mail_date' => "日付		",
    'mail_use_following_url' => "You can click&nbsp;",
    'mail_use_following_url_1' => "&nbsp;メッセージを表示するには (ログインする必要があるかもしれません)",
    'mail_yours' => "<br />あなたの,",
    'mail_the_site_team' => "%s チーム",
    'mail_received_pm_from' => "You have received a PM from ",
    'mail_here' => "ここ",
    'msg_system' => "システム",
    'msg_original_message_from' => "元のメッセージ： ",
];
