<?php

return [
    'label' => 'Tentti',
    'name' => 'Tenttien nimi',
    'index' => 'Tenttien indeksi',
    'time_range' => 'Tenttien aika',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Lataa lisäys',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Seed-lukuajan keskiarvo',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Lataa lisäys',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonus lisäys',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Siemenpisteiden lisäys',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Lataa torrent-tiedoston lisäys',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Käyttäjän luokka',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Rekisteröi aikaväli',
        \App\Models\Exam::FILTER_USER_DONATE => 'Lahjoitettu',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Rekisteröinnin päivien vaihteluväli',
    ],
    'require_value' => 'Vaadi',
    'current_value' => 'Nykyinen',
    'result' => 'Tulos',

    'result_pass_for_exam' => 'Hyväksytty!',
    'result_pass_for_task' => 'Valmis!',
    'result_not_pass_for_exam' => '<span style="color: red">Ei Siirtynyt!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Ei Suoritettu!</span>',
    'checkout_pass_message_subject_for_exam' => 'Tentti ohi!',
    'checkout_pass_message_content_for_exam' => 'Onneksi olkoon! Olet läpäissyt tentin: :exam_name ajoissa (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Tentti ei läpäise ja tili on estetty!',
    'checkout_not_pass_message_content_for_exam' => 'Et läpäissyt tenttiä: :exam_name ajoissa (:start ~ :end), ja tilisi on kielletty!',

    'checkout_pass_message_subject_for_task' => 'Tehtävä suoritettu!',
    'checkout_pass_message_content_for_task' => 'Onneksi olkoon! Tehtäväsi on suoritettu: :exam_name ajoissa (:start ~ :end), sai bonuksen: success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Tehtävää ei ole suoritettu!',
    'checkout_not_pass_message_content_for_task' => 'Et tee tehtävää loppuun : :exam_name ajoissa (:start ~ :end), vähennä bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Ei täydellinen esimerkki: :exam_name ajoissa (:start ~ :end)',
    'ban_user_modcomment' => 'Koska et ole valmis tentti: :exam_name(:start ~ :end), kielto järjestelmällä.',
    'admin' => [
        'list' => [
            'page_title' => 'Tenttien Luettelo'
        ]
    ],
    'recurring' => 'toistuva',
    'recurring_daily' => 'kerran päivässä',
    'recurring_weekly' => 'kerran viikossa',
    'recurring_monthly' => 'kerran kuukaudessa',
    'recurring_help' => 'Jos se on määritelty jaksoksi, kokeen alkamisaika on nykyisen syklin alkamisaika, ja päättymisaika on nykyisen syklin päättymisaika, joka on kaikki luonnollisia päiviä/viikkoja/kuukausia, kuten tässä on todettu. Jos tyyppi on tutkittu, kunkin syklin lopussa, jos käyttäjä vielä täyttää seulontakriteerit, käyttäjälle osoitetaan automaattisesti tentti seuraavaa jaksoa varten.' ,

    'time_condition_invalid' => 'Aikaparametri ei ole järkevä, on olemassa ja vain yksi kolmesta kohteesta: alkamisaika + päättymisaika / kesto / toistuva',

    'type_exam' => 'Tentti',
    'type_task' => 'Tehtävä',
    'type' => 'Tyyppi',
    'type_help' => 'Tentti on säännöllinen tentti ja epäonnistuminen johtaa tilin kieltäminen. Tehtävät voidaan määrittää palkita bonus tai vähentää bonus riippuen siitä, ovatko ne valmistuneet tai eivät',

    'fail_deduct_bonus' => 'Vähennä bonus epäonnistumisen vuoksi',
    'success_reward_bonus' => 'Palkintobonus valmistumisesta',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Oletko varma, että haluat lunastaa?' ,
    'claim_by_yourself_only' => 'Lunasta vain itse!' ,
    'not_match_target_user' => 'Et ole täsmäävä kohdekäyttäjä!' ,
    'has_other_on_the_way' => 'On olemassa muu :type_text käynnissä!' ,
    'claimed_already' => 'Lunastettu jo',
    'not_between_begin_end_time' => 'Ei aloitus- ja lopetusajan välillä',
    'reach_max_user_count' => 'Väitettyjen käyttäjien määrä on saavuttanut enimmäismäärän.',
    'claimed_user_count' => 'Vaadittu',
    'max_user_count' => 'Maksimi lunastuksen käyttäjämäärä (0 tarkoittaa rajoittamaton)',
    'background_color' => 'Info box taustaväri',
];
