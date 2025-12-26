<?php

return [

    'index' => [
        'page_title' => 'Viestien luettelo',
    ],
    'show' => [
        'page_title' => 'Viestin tiedot',
    ],
    'field_value_change_message_body' => ':field is changed from :old to :new by :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field muutettu',

    'download_disable' => [
        'subject' => 'Oikeus lataukseen peruttu',
        'body' => 'Latausoikeutesi ovat peruneet, mahdollisesti alhaisten jakamisnopeuksien tai väärinkäytösten vuoksi. Mitä: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Oikeus lataukseen peruttu',
        'body' => 'Lataus käyttöoikeutesi on peruutettu liiallisen latausnopeuden vuoksi, ole hyvä ja kirjoita jos olet seed box -käyttäjä.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Oikeus lataukseen peruttu',
        'body' => 'Lataus lupa on peruutettu koska ilmoittaa maksettu torrent-tiedosto liian monta kertaa, varmista, että sinulla on tarpeeksi bonusta.' ,
    ],
    'download_enable' => [
        'subject' => 'Lataus oikeudet palautettu',
        'body' => 'Lataus oikeudet palautettu, voit nyt ladata torrents. Kirjoittaja: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Väliaikainen kutsu :change_type',
        'body' => 'Tilapäinen kutsumääräsi oli :change_type :count :operator, syy: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Vastaanota lahjamitali',
        'body' => "Käyttäjä :username osti mitalin [:medal_name] hinnalla :cost_bonus ja antoi sen sinulle. Mitali on arvoinen :price, maksu on :gift_fee_total(factor: :gift_fee_factor), sinulla on tämä mitali ennen: :expire_at, ja mitalin bonustekijä on: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Offsite kirjautumishälytys',
        'body' => <<<BODY
Kirjauduit sisään:::this_login_time, IP::this_ip, location:::this_location.<br/>
Viimeinen sisäänkirjautumisaika:::last_login_time, IP::last_ip, location::last_location.<br/>
Jos se ei ole oma operaatiosi, tilin salasana on ehkä vuotanut, vaihda se ajoissa!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Muistutus torrent-tiedoston ostosta onnistui',
        'body' => 'Vietit :bonus ostaaksesi torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Tentti :exam_name päättymisaika vaihdettu',
        'body' => 'Meneillään olevan kokeen loppuaika :exam_name on muuttunut :old_end_time -ajasta :new_end_time. admin: :operator, reason: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Olet saanut PM:n.",
    'mail_sender' => "Lähettäjä	",
    'mail_subject' => "Aihe	",
    'mail_date' => "Päivämäärä		",
    'mail_use_following_url' => "Voit klikata&nbsp;",
    'mail_use_following_url_1' => "&nbsp;nähdäksesi viestin (saatat joutua kirjautumaan).",
    'mail_yours' => "<br />Sinua,",
    'mail_the_site_team' => "%s -tiimi.",
    'mail_received_pm_from' => "Olet saanut PM:n osoitteesta ",
    'mail_here' => "TÄSTÄ",
    'msg_system' => "Järjestelmä",
    'msg_original_message_from' => "Alkuperäinen viesti ",
];
