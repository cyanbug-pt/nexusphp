<?php

return array (
  'index' => 
  array (
    'page_title' => 'プライベートメッセージリスト',
  ),
  'show' => 
  array (
    'page_title' => 'プライベートメッセージの詳細',
  ),
  'field_value_change_message_body' => '：フィールドが変更されます：old：new by the Administrator：Operator。理由::理由。',
  'field_value_change_message_subject' => '：フィールド変更',
  'download_disable' => 
  array (
    'subject' => 'キャンセルされた許可をダウンロードします',
    'body' => 'ダウンロード許可は、おそらく共有率が低すぎるか、不適切な動作が原因でキャンセルされます。 by ：：オペレーター',
  ),
  'download_disable_upload_over_speed' => 
  array (
    'subject' => 'キャンセルされた許可をダウンロードします',
    'body' => 'アップロード速度が高速であるため、ダウンロード許可はキャンセルされました。ボックスユーザーの場合は、登録してください。',
  ),
  'download_disable_announce_paid_torrent_too_many_times' => 
  array (
    'subject' => 'キャンセルされた許可をダウンロードします',
    'body' => 'ダウンロード許可は、有料の種子に報告する過剰な数の失敗のためにキャンセルされました。十分な魔法があることを確認してください。',
  ),
  'download_enable' => 
  array (
    'subject' => '許可リカバリをダウンロードしてください',
    'body' => 'ダウンロード許可が復元され、シードをダウンロードできるようになりました。 by ：：オペレーター',
  ),
  'temporary_invite_change' => 
  array (
    'subject' => '一時的な招待状：change_type',
    'body' => '一時的な招待状は、管理者：オペレーター：Change_Type：Count、Reason ::理由です。',
  ),
  'receive_medal' => 
  array (
    'subject' => 'メダルを受け取りました',
    'body' => 'ユーザー：ユーザー名は魔法を支出します：cost_bonusはメダル[：medal_name]を購入し、それをあなたに与えました。このメダルの価値は次のとおりです。価格、取り扱い料は次のとおりです。Gift_fee_total（factor ：： gift_fee_factor）、このメダルが有効になります。',
  ),
  'login_notify' => 
  array (
    'subject' => '：別の場所でログインするためのsite_nameリマインダー',
    'body' => '：： this_login_timeにログインしました。 IP :: this_ip、場所:: this_location。 <br/>
最終ログイン時間：： last_login_time、ip ：： last_ip、location ：： last_location。 <br/>
自分の操作がなければ、アカウントのパスワードが漏れていた可能性があります。時間内に変更してください！',
  ),
  'buy_torrent_success' => 
  array (
    'subject' => '種子の購入を成功させるためのリマインダー',
    'body' => 'あなたが使った：ボーナスマジックはシードを成功裏に購入しました：[url =：url]：torrent_name [/url]',
  ),
  'exam_user_end_time_updated' => 
  array (
    'subject' => '評価：Exam_Name終了時間の変更',
    'body' => '継続的な評価：Exam_Nameの終了時間は、old_end_timeへ：new_end_timeから変更されました。管理者::オペレーター、理由::理由。',
  ),
);
