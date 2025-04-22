<?php

return [

    'index' => [
        'page_title' => 'Meddelandelista',
    ],
    'show' => [
        'page_title' => 'Detaljerad meddelande',
    ],
    'field_value_change_message_body' => ':field har ändrats från :old till :new av :operator. Anledning：:reason.',
    'field_value_change_message_subject' => ':field ändrad',

    'download_disable' => [
        'subject' => 'Åtkomst till hämtning avbruten',
        'body' => 'Dina nedladdningsprivilegier har återkallats, möjligen på grund av låga delningsfrekvens eller dåligt uppförande. Av: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Åtkomst till hämtning avbruten',
        'body' => 'Din hämtningsbehörighet har avbrutits på grund av överdriven uppladdningshastighet, vänligen fil om du är en seed box-användare.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Åtkomst till hämtning avbruten',
        'body' => 'Din nedladdningsbehörighet har avbrutits på grund av att du har betalat torrent för många gånger, se till att du har tillräckligt med bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Åtkomst till hämtning återställd',
        'body' => 'Dina nedladdningsprivilegier återställdes, du kan nu ladda ner torrenter. Av: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Tillfällig inbjudan :change_type',
        'body' => 'Ditt tillfälliga antal inbjudningar hade :change_type :count av :operator, anledning: :orsak.',
    ],
    'receive_medal' => [
        'subject' => 'Ta emot presentmedalj',
        'body' => "Användaren :username köpte en medalj [:medal_name] till en kostnad av :cost_bonus och gav den till dig. Medaljen är värd :price, avgiften är :gift_fee_total(faktor: :gift_fee_factor), du kommer att ha denna medalj till: expire_at, och medaljens bonus addition faktor är: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite login alert',
        'body' => <<<BODY
Du loggade in på:this_login_time, IP::this_ip, location::this_location.<br/>
Senast inloggningstid::last_login_time, IP:last_ip, location::last_location.<br/>
Om det inte är din egen verksamhet kan kontots lösenord ha läckt ut, vänligen ändra det i tid!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Lyckad torrent-påminnelse om köp',
        'body' => 'Du spenderade :bonus bonus för att framgångsrikt köpa torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Tentamen :exam_name sluttid ändrad',
        'body' => 'Sluttiden för din pågående tentamen :exam_name har ändrats från :old_end_time till :new_end_time. admin: :operator, anledning: :orsak.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Du har fått en PM.",
    'mail_sender' => "Avsändare	",
    'mail_subject' => "Ämne	",
    'mail_date' => "Datum<unk>		",
    'mail_use_following_url' => "Du kan klicka på&nbsp;",
    'mail_use_following_url_1' => "&nbsp;för att visa meddelandet (du kan behöva logga in).",
    'mail_yours' => "<br />Er,",
    'mail_the_site_team' => "%s -teamet.",
    'mail_received_pm_from' => "Du har fått ett PM från ",
    'mail_here' => "HÄR",
    'msg_system' => "System",
    'msg_original_message_from' => "Ursprungligt meddelande från ",
];
