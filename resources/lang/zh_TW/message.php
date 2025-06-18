<?php

return [

    'index' => [
        'page_title' => '私信列表',
    ],
    'show' => [
        'page_title' => '私信詳情',
    ],
    'field_value_change_message_body' => ':field 被管理員 :operator 從 :old 改為 :new。理由：:reason。',
    'field_value_change_message_subject' => ':field 改變',
    'download_disable' => [
        'subject' => '下載權限取消',
        'body' => '你的下載權限被取消，可能的原因是過低的分享率或行為不當。By: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => '下載權限取消',
        'body' => '你因上傳速度過快下載權限被取消，若是盒子用戶請備案。',
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => '下载权限取消',
        'body' => '你因向付費種子匯報失敗次數過多下載權限被取消，請確保你有足夠的魔力。',
    ],
    'download_disable_fake_announce' => [
        'subject' => '下载权限取消',
        'body' => '你因虛假匯報下載權限被取消。',
    ],
    'download_enable' => [
        'subject' => '下載權限恢復',
        'body' => '你的下載權限恢復，你現在可以下載種子。By: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => '臨時邀請:change_type',
        'body' => '你的臨時邀請被管理員 :operator :change_type :count 個，理由：:reason。',
    ],
    'receive_medal' => [
        'subject' => '收到贈送勛章',
        'body' => '用戶 :username 花費魔力 :cost_bonus 購買了勛章[:medal_name]並贈送與你。此勛章價值 :price，手續費 :gift_fee_total(系數：:gift_fee_factor)，你將擁有此勛章有效期至: :expire_at，勛章的魔力加成系數為: :bonus_addition_factor。',
    ],
    'login_notify' => [
        'subject' => ':site_name 異地登錄提醒',
        'body' => <<<BODY
你於：:this_login_time 進行了登錄操作，IP：:this_ip，位置：:this_location。<br/>
上次登錄時間：:last_login_time，IP：:last_ip，位置：:last_location。<br/>
若不是你本人操作，賬號密碼可能已經泄露，請及時修改！
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => '成功購買種子提醒',
        'body' => '你花費 :bonus 魔力成功購買了種子：[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => '考核 :exam_name 結束時間變更',
        'body' => '你進行中的考核：:exam_name 的結束時間由 :old_end_time 變更為 :new_end_time。管理員：:operator，原因：:reason。',
    ],

    'mail_dear' => "尊敬的",
    'mail_you_received_a_pm' => "你收到了一條新短訊。",
    'mail_sender' => "發送者	",
    'mail_subject' => "主題	",
    'mail_date' => "日期		",
    'mail_use_following_url' => "你可以點擊",
    'mail_use_following_url_1' => "來查看該短訊（你可能需要登錄）",
    'mail_yours' => "",
    'mail_the_site_team' => "%s網站",
    'mail_received_pm_from' => "你有新短訊，來自",
    'mail_here' => "這裏",
    'msg_system' => "系統",
    'msg_original_message_from' => "原短訊來自",
];
