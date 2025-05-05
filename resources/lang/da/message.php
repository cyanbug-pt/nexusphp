<?php

return [

    'index' => [
        'page_title' => 'Besked liste',
    ],
    'show' => [
        'page_title' => 'Besked detaljer',
    ],
    'field_value_change_message_body' => ':field er ændret fra :old til :new af :operator. Årsag：:årsag.',
    'field_value_change_message_subject' => ':field ændret',

    'download_disable' => [
        'subject' => 'Download tilladelse annulleret',
        'body' => 'Dine download-privilegier er tilbagekaldt, muligvis på grund af lave delingshastigheder eller fejladfærd. Af: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Download tilladelse annulleret',
        'body' => 'Din downloadtilladelse er blevet annulleret på grund af overdreven uploadhastighed, venligst fil, hvis du er en hovedboksbruger.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Download tilladelse annulleret',
        'body' => 'Din downloadtilladelse er blevet annulleret på grund af at annoncere til betalt torrent for mange gange, skal du sørge for at du har nok bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Download tilladelse gendannet',
        'body' => 'Dine download-privilegier genoprettet, du kan nu downloade torrents. Af: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Midlertidig invitation :change_type',
        'body' => 'Din midlertidige invitationstæller havde :change_type :count af :operator, årsag: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Modtag gave medalje',
        'body' => "Bruger :username købt en medalje [:medal_name] på bekostning af :cost_bonus og gav det til dig. Medaljen er værd :price, gebyret er :gift_fee_total(faktor: :gift_fee_factor), du vil have denne medalje indtil :expire_at, og medaljens bonus addition faktor er: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite login-alarm',
        'body' => <<<BODY
Du er logget ind på::this_login_time, IP::this_ip, location::this_location.<br/>
Sidste login-tid:::last_login_time, IP::last_ip, location::last_location.<br/>
Hvis det ikke er din egen drift, kan kontoadgangskoden være blevet lækket, ændr den venligst i tide!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Påmindelse om torrent køb med succes',
        'body' => 'Du brugte :bonus bonus til med held at købe torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Eksamen :exam_name sluttidspunkt ændret',
        'body' => 'Sluttidspunktet for din igangværende eksamen :exam_name er ændret fra :old_end_time til :new_end_time. admin: :operator, årsag: :årsag.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Du har modtaget en PM.",
    'mail_sender' => "Afsenderen	",
    'mail_subject' => "Emne	",
    'mail_date' => "Dato:		",
    'mail_use_following_url' => "Du kan klikke på&nbsp;",
    'mail_use_following_url_1' => "&nbsp;for at se beskeden (du skal muligvis logge ind).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "%s Team.",
    'mail_received_pm_from' => "Du har modtaget en PM fra ",
    'mail_here' => "HER",
    'msg_system' => "System",
    'msg_original_message_from' => "Oprindelig besked fra ",
];
