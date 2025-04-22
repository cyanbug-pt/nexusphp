<?php

return [

    'index' => [
        'page_title' => 'Lista de mesaje',
    ],
    'show' => [
        'page_title' => 'Detalii mesaj',
    ],
    'field_value_change_message_body' => ':field este schimbat de la :old la :new de :operator. Motivul：:reason.',
    'field_value_change_message_subject' => ':field modificat',

    'download_disable' => [
        'subject' => 'Permisiune de descărcare anulată',
        'body' => 'Privilegiile tale de descărcare au fost revocate, posibil din cauza ratelor scăzute de partajare sau a comportamentului necorespunzător. Da: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Permisiune de descărcare anulată',
        'body' => 'Permisiunea dvs. de descărcare a fost anulată din cauza vitezei excesive de încărcare, vă rugăm să introduceți fișierul dacă sunteți un utilizator de căsuță seed.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Permisiune de descărcare anulată',
        'body' => 'Permisiunea ta de descărcare a fost anulată din cauza anunțării torentului plătit de prea multe ori, te rugăm să te asiguri că ai suficiente bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Permisiunea de descărcare restaurată',
        'body' => 'Privilegii de descărcare restaurate, acum poți descărca torrente. Dy: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Invitație temporară :change_type',
        'body' => 'Numărul tău de invitații temporare a fost :change_type :count de :operator, motiv: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Primește medalia cadou',
        'body' => "Utilizatorul :username a cumpărat o medalie [:medal_name] la un preț de :cost_bonus și ți-a dat. Medalia valorează :price, taxa este :gift_fee_total(factor: :gift_fee_factor), vei avea această medalie până la: :expire_at, iar factorul de adăugare bonus al medaliei este: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Alertă de autentificare :site_name Offsite',
        'body' => <<<BODY
Te-ai autentificat la::this_login_time, IP::this_ip, locație::this_location.<br/>
Data ultimei autentificări:last_login_time, IP::last_ip, locație:::last_location.<br/>
Dacă nu este propria operațiune, este posibil ca parola contului să fi fost pierdută, te rugăm să o schimbi la timp!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Memento pentru achiziționarea torentului cu succes',
        'body' => 'Ai cheltuit :bonus pentru a cumpăra cu succes torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Timpul de sfârșit al examenului :exam_name a fost schimbat',
        'body' => 'Timpul de sfârșit al examenului în curs de desfășurare :exam_name s-a schimbat din :old_end_time în :new_end_time. admin: :operator, motiv: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Ați primit un MP.",
    'mail_sender' => "Expeditor	",
    'mail_subject' => "Subiect	",
    'mail_date' => "Data		",
    'mail_use_following_url' => "Puteți da clic pe&nbsp;",
    'mail_use_following_url_1' => "&nbsp;pentru a vizualiza mesajul (poate trebuie să te autentifici).",
    'mail_yours' => "<br />Ta,",
    'mail_the_site_team' => "Echipa %s.",
    'mail_received_pm_from' => "Ați primit un PM de la ",
    'mail_here' => "AICI",
    'msg_system' => "Sistem",
    'msg_original_message_from' => "Mesaj original de la ",
];
