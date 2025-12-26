<?php

return [

    'index' => [
        'page_title' => 'Liste over meldinger',
    ],
    'show' => [
        'page_title' => 'Meldings detaljer',
    ],
    'field_value_change_message_body' => ':field endres fra :old til :old til :new av :operator. Årsak：:reason.',
    'field_value_change_message_subject' => ':field endret',

    'download_disable' => [
        'subject' => 'Tillatelse for nedlasting avbrutt',
        'body' => 'Dine nedlastingsrettigheter har opphevet, muligens på grunn av lave delingsrater eller feiloppførsel. Av: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Tillatelse for nedlasting avbrutt',
        'body' => 'Du har avbrutt nedlastingstilgang på grunn av overdreven hastighet, fil dersom du er bruker en hovedboks.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Tillatelse for nedlasting avbrutt',
        'body' => 'Din nedlastningstillatelse er avbrutt på grunn av annonsering til å betalt torrent for mange ganger, sørg for at du har nok bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Nedlastings tillatelse gjenopprettet',
        'body' => 'Dine nedlastingsrettigheter gjenopprettet. Nå kan du laste ned torrenter. Av: Operatør',
    ],
    'temporary_invite_change' => [
        'subject' => 'Midlertidig invitasjon :change_type',
        'body' => 'Din midlertidige invitasjonstelling hadde :change_type :count av :operator, grunn: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Motta gave medalje',
        'body' => "Bruker :username kjøpte en medalje [:medal_name] som kostet :cost_bonus og ga den til deg. Medalje er verd :price, gebyret er :gift_fee_total(faktor: :gift_fee_factor), du vil ha denne medaljen: :expire_at, og medal's bonus-tilleggs-faktor er: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name påloggingsinformasjon utenfor siden',
        'body' => <<<BODY
Du logget inn ::this_login_time, IP:this_ip, location::this_location.<br/>
Sist påloggingstid: ::last_login_time, IP::last_ip, location::last_location.<br/>
Hvis det ikke er din egen operasjon, kan kontopassordet ha blitt lekket og endre det i tide!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Vellykket påminnelse om kjøp av torrent',
        'body' => 'Du brukte :bonus for vellykket kjøp, torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Exam :exam_name sluttid endret',
        'body' => 'Sluttiden for exam :exam_name er endret fra :old_end_time til :new_end_time. admin: :operator, grunn: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Du har mottatt en PM.",
    'mail_sender' => "Avsenderenses	",
    'mail_subject' => "Subjekt	",
    'mail_date' => "Datofarmaka		",
    'mail_use_following_url' => "Du kan klikke på&nbsp;",
    'mail_use_following_url_1' => "&nbsp;å vise meldingen (du må kanskje logge inn).",
    'mail_yours' => "<br />år,",
    'mail_the_site_team' => "%s teamet.",
    'mail_received_pm_from' => "Du har mottatt en PM fra ",
    'mail_here' => "HER",
    'msg_system' => "Systemadministrasjon",
    'msg_original_message_from' => "Opprinnelig melding fra ",
];
