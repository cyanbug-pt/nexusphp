<?php

return [

    'index' => [
        'page_title' => 'Seznam zpráv',
    ],
    'show' => [
        'page_title' => 'Detail zprávy',
    ],
    'field_value_change_message_body' => ':field is changed from :old to :new by :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field změněno',

    'download_disable' => [
        'subject' => 'Oprávnění ke stažení zrušeno',
        'body' => 'Vaše oprávnění ke stažení byla zrušena, možná kvůli nízké míře sdílení nebo špatnému chování. By: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Oprávnění ke stažení zrušeno',
        'body' => 'Vaše oprávnění ke stažení bylo zrušeno z důvodu nadměrné rychlosti nahrávání, prosím soubor, pokud jste uživatelem zdrojové schránky.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Oprávnění ke stažení zrušeno',
        'body' => 'Vaše oprávnění ke stažení bylo zrušeno kvůli příliš mnohokrát ohlášenému placenému torrentu, prosím ujistěte se, že máte dostatek bonusu.' ,
    ],
    'download_enable' => [
        'subject' => 'Oprávnění ke stažení obnoveno',
        'body' => 'Vaše oprávnění ke stažení byla obnovena, nyní můžete stahovat torrenty. By: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Dočasná pozvánka :change_type',
        'body' => 'Váš dočasný počet pozvání měl :change_type :count od :operátora, důvod: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Obdržet dárkovou medaili',
        'body' => "Uživatel :username koupil medal [:medal_name] za cenu :cost_bonus a dal vám ho. Medaile má cenu :price, poplatek je :gift_fee_total(factor: :gift_fee_factor), budete mít tuto medaili až do: :expire_at a faktor bonusového přídavku medaile je: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite přihlášení',
        'body' => <<<BODY
You logged in at::this_login_time, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
If it is not your own operation, the account password may have been leaked, please change it in time!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Upomínka k nákupu torrentu úspěšná',
        'body' => 'Utratili jste :bonus za úspěšné koupení torrentu: [url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Zkouška :exam_name ukončena změněna',
        'body' => 'Koncový čas zkoušky v průběhu :exam_name se změnil z :old_end_time na :new_end_time. admin: :operator, důvod: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Obdrželi jste PM.",
    'mail_sender' => "Odesílatel	",
    'mail_subject' => "Předmět	",
    'mail_date' => "Datum		",
    'mail_use_following_url' => "Kliknutím na&nbsp;",
    'mail_use_following_url_1' => "&nbsp;pro zobrazení zprávy (možná se budete muset přihlásit).",
    'mail_yours' => "<br />naše,",
    'mail_the_site_team' => "Tým %s.",
    'mail_received_pm_from' => "Obdrželi jste PM od ",
    'mail_here' => "ZÍSKAT",
    'msg_system' => "Systém",
    'msg_original_message_from' => "Původní zpráva od ",
];
