<?php

return [
    'invalid_inviter' => '無効な招待者です！招待コードは禁止されています！',
    'fields' => [
        'inviter' => '送信者',
        'invitee' => 'メールを受け取る',
        'time_invited' => '時間を送信',
        'valid' => 'Valid',
        'invitee_register_uid' => '登録UID',
        'invitee_register_email' => '登録されたメールアドレス',
        'invitee_register_username' => '登録されたユーザー名',
        'expired_at' => 'ハッシュの有効期限が切れた日時',
        'time_invited_begin' => '時間gteを送信',
        'time_invited_end' => '送信時間 lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => '招待システムは閉じられています',
        'no_permission' => '招待状を送信するには:class以上が必要です',
        'invite_not_enough' => '招待が足りません',
    ],
    'send_allow_text' => '誰かを招待',
    'pre_register_username' => 'ユーザー名を事前登録',
    'pre_register_username_help' => 'この招待コードでユーザーが登録した場合、ユーザー名とメールアドレスは変更されません',
    'require_pre_register_username' => "事前登録ユーザー名を空にすることはできません",
];
