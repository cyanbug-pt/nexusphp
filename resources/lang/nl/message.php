<?php

return [

    'index' => [
        'page_title' => 'Berichten lijst',
    ],
    'show' => [
        'page_title' => 'Bericht details',
    ],
    'field_value_change_message_body' => ':field is gewijzigd van :old naar :new door :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field gewijzigd',

    'download_disable' => [
        'subject' => 'Downloadmachtiging geannuleerd',
        'body' => 'De downloadrechten zijn ingetrokken, mogelijk als gevolg van lage deeltarieven of verkeerd gedrag. Door: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Downloadmachtiging geannuleerd',
        'body' => 'Uw download toestemming is geannuleerd vanwege een te hoge upload snelheid, gelieve een bestand te maken als u een seed box gebruiker bent.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Downloadmachtiging geannuleerd',
        'body' => 'Uw downloadmachtiging is geannuleerd als gevolg van het al te vaak aankondigen van betaalde torrent. Zorg ervoor dat u genoeg bonus heeft.' ,
    ],
    'download_enable' => [
        'subject' => 'Downloadmachtiging hersteld',
        'body' => 'Je downloadrechten zijn hersteld, je kan nu torrents downloaden door: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Tijdelijke uitnodiging :change_type',
        'body' => 'Je tijdelijke uitnodiging telde :change_type :count met :operator, reden: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Cadeaumedaille ontvangen',
        'body' => "Gebruiker :username heeft een medaille [:medal_name] gekocht ten koste van :cost_bonus en heeft het aan u gegeven. De medaille is :price waard, de vergoeding is :gift_fee_total(factor: :gift_fee_factor), je zal deze medaille hebben tot: :expire_at, en de bonus toevoeging factor van de medaille is: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite login waarschuwing',
        'body' => <<<BODY
You logged in at::this_login_time, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
If it is not your own operation, the account password may have been leaked, please change it in time!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Succesvolle torrent aankoop herinnering',
        'body' => 'Je hebt :bonus bonus uitgegeven voor het kopen van de torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Eindtijd :exam_name veranderd',
        'body' => 'De eindtijd van uw examen in uw exam_name is veranderd van :old_end_time naar :new_end_time. admin: :operator, reden: reden.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Je hebt een PM ontvangen.",
    'mail_sender' => "Afzender	",
    'mail_subject' => "Onderwerp:	",
    'mail_date' => "DatumLett		",
    'mail_use_following_url' => "Je kunt op&nbsp; klikken",
    'mail_use_following_url_1' => "&nbsp;om het bericht te bekijken (je moet mogelijk inloggen).",
    'mail_yours' => "<br />Jouren,",
    'mail_the_site_team' => "Het %s Team.",
    'mail_received_pm_from' => "Je hebt een PM ontvangen van ",
    'mail_here' => "HIER",
    'msg_system' => "Systeem",
    'msg_original_message_from' => "Oorspronkelijke bericht van ",
];
