<?php

return [

    'index' => [
        'page_title' => 'Nachrichtenliste',
    ],
    'show' => [
        'page_title' => 'Nachrichtendetails',
    ],
    'field_value_change_message_body' => ':field wurde von :old zu :new von :operator geändert. Grund：:reason.',
    'field_value_change_message_subject' => ':field geändert',

    'download_disable' => [
        'subject' => 'Download-Berechtigung abgebrochen',
        'body' => 'Ihre Download-Berechtigungen wurden widerrufen, möglicherweise wegen niedriger Freigaberaten oder Fehlverhalten. Bann: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Download-Berechtigung abgebrochen',
        'body' => 'Ihre Download-Berechtigung wurde wegen übermäßiger Upload-Geschwindigkeit abgebrochen. Bitte Datei wenn Sie ein Seed Box-Benutzer sind.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Download-Berechtigung abgebrochen',
        'body' => 'Deine Download-Berechtigung wurde wegen zu vielen Ankündigungen an bezahlten Torrent abgebrochen, bitte stelle sicher, dass du genug Bonus hast.' ,
    ],
    'download_enable' => [
        'subject' => 'Download-Berechtigung wiederhergestellt',
        'body' => 'Ihre Download-Berechtigungen wiederhergestellt, Sie können jetzt Torrents herunterladen. Von: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Temporäre Einladung :change_type',
        'body' => 'Ihre temporäre Einladungsanzahl hatte :change_type :count von :operator, Grund: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Geschenkmedaille erhalten',
        'body' => "User :username kaufte eine Medaille [:medal_name] auf Kosten von :cost_bonus und gab sie Ihnen. Die Medaille ist wert :price, die Gebühr ist :gift_fee_total(Faktor: :gift_fee_factor), Sie haben diese Medaille bis :expire_at, und der Bonusfaktor der Medaille ist: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite-Login-Alarm',
        'body' => <<<BODY
Du hast dich bei at::this_login_time eingeloggt, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
Wenn es nicht Ihre eigene Operation ist, wurde das Passwort möglicherweise durchgesickert, bitte ändern Sie es rechtzeitig!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Erfolgreiche Torrent-Kauf-Erinnerung',
        'body' => 'Du hast :bonus ausgegeben um den Torrent erfolgreich zu kaufen:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Prüfung :exam_name Endzeit geändert',
        'body' => 'Die Endzeit deiner in-progress Prüfung :exam_name hat sich von :old_end_time zu :new_end_time geändert. admin: :operator, Grund: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Du hast eine Nachricht erhalten.",
    'mail_sender' => "Absender	",
    'mail_subject' => "Betreff	",
    'mail_date' => "Datum		",
    'mail_use_following_url' => "Sie können&nbsp; klicken",
    'mail_use_following_url_1' => "&nbsp;um die Nachricht anzusehen (Sie müssen sich möglicherweise einloggen).",
    'mail_yours' => "<br />Deins,",
    'mail_the_site_team' => "Das %s Team.",
    'mail_received_pm_from' => "Sie haben eine PN erhalten von ",
    'mail_here' => "HIER",
    'msg_system' => "System",
    'msg_original_message_from' => "Originalnachricht von ",
];
