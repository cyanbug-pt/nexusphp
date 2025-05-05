<?php

return [

    'index' => [
        'page_title' => 'Elenco messaggi',
    ],
    'show' => [
        'page_title' => 'Dettaglio messaggio',
    ],
    'field_value_change_message_body' => ':field è cambiato da :old a :new da :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field cambiato',

    'download_disable' => [
        'subject' => 'Autorizzazione di download annullata',
        'body' => 'I tuoi privilegi di download sono stati revocati, forse a causa di bassi tassi di condivisione o di comportamenti errati. Da: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Autorizzazione di download annullata',
        'body' => 'Il tuo permesso di download è stato annullato a causa della velocità di caricamento eccessiva, per favore file se sei un utente di seed box.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Autorizzazione di download annullata',
        'body' => 'Il tuo permesso di download è stato annullato a causa di un annuncio di torrent pagato troppe volte, assicurati di avere abbastanza bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Autorizzazione download ripristinata',
        'body' => 'I tuoi privilegi di download ripristinati, ora puoi scaricare i torrent. Dy: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Invito temporaneo :change_type',
        'body' => 'Il tuo numero di inviti temporanei aveva :change_type :count da :operator, motivo: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Ricevi medaglia regalo',
        'body' => "Utente :username ha acquistato una medaglia [:medal_name] al costo di :cost_bonus e l'ha dato a voi. La medaglia vale :price, la commissione è :gift_fee_total(fattore: :gift_fee_factor), avrai questa medaglia fino a: :expire_at, e il fattore bonus della medaglia è: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Avviso di accesso fuori sito',
        'body' => <<<BODY
Hai effettuato l'accesso at::this_login_time, IP::this_ip, location::this_location.<br/>
Ultima volta di login::last_login_time, IP::last_ip, location::last_location.<br/>
Se non è la tua operazione, la password dell'account potrebbe essere stata perduta, per favore cambiala in tempo!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Promemoria acquisto torrent riuscito',
        'body' => 'Hai speso :bonus bonus per acquistare con successo il torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Esami :exam_name tempo di fine cambiato',
        'body' => 'L\'ora di fine dell\'esame in corso :exam_name è cambiata da :old_end_time a :new_end_time. admin: :operator, reason: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Hai ricevuto un PM.",
    'mail_sender' => "SendererName	",
    'mail_subject' => "Soggetto.	",
    'mail_date' => "Data<unk>		",
    'mail_use_following_url' => "Puoi cliccare su&nbsp;",
    'mail_use_following_url_1' => "&nbsp;per visualizzare il messaggio (potrebbe essere necessario effettuare il login).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "La Squadra %s.",
    'mail_received_pm_from' => "Hai ricevuto un PM da ",
    'mail_here' => "QUI",
    'msg_system' => "Sistema",
    'msg_original_message_from' => "Messaggio originale da ",
];
