<?php

return [
    'label' => 'Proefwerk',
    'name' => 'Naam examen',
    'index' => 'Index examen',
    'time_range' => 'Examens tijd',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Upload ophoging',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Seed tijd gemiddelde',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Download ophoging',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonus ophoging',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Seed punten verhogen',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Upload torrent increment',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Les gebruiker',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registreer tijdbereik',
        \App\Models\Exam::FILTER_USER_DONATE => 'Gedoneerd',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Bereik van dagen van registratie',
    ],
    'require_value' => 'Vereisen',
    'current_value' => 'Stroom',
    'result' => 'Resultaat',

    'result_pass_for_exam' => 'Geslaagd!',
    'result_pass_for_task' => 'Voltooid!',
    'result_not_pass_for_exam' => '<span style="color: red">niet geslaagd!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Niet voltooid!</span>',
    'checkout_pass_message_subject_for_exam' => 'examen geslaagd!',
    'checkout_pass_message_content_for_exam' => 'Gefeliciteerd! Je hebt het examen verlopen: :exam_name op tijd (:begin ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Examen, account is verbannen!',
    'checkout_not_pass_message_content_for_exam' => 'Je bent niet geslaagd voor het examen: :exam_name op tijd (:begin ~ :end), en je account is verbannen!',

    'checkout_pass_message_subject_for_task' => 'Taak voltooid!',
    'checkout_pass_message_content_for_task' => 'Gefeliciteerd! Je hebt de taak volbracht: exam_name op tijd (:begin ~ :end), kreeg bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Taak niet voltooid!',
    'checkout_not_pass_message_content_for_task' => 'Je voltooide taak niet: :exam_name op tijd (:begin ~ :end), aftrek bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Niet voltooid examen: :exam_name op tijd (:begin ~ :end)',
    'ban_user_modcomment' => 'Door het niet voltooien van examen: :exam_name(:begin ~ :end), ban door het systeem.',
    'admin' => [
        'list' => [
            'page_title' => 'Lijst examen'
        ]
    ],
    'recurring' => 'periodiek',
    'recurring_daily' => 'eenmaal per dag',
    'recurring_weekly' => 'eenmaal per week',
    'recurring_monthly' => 'eenmaal per maand',
    'recurring_help' => 'Indien aangegeven als periodic, is de begintijd van het examen de begintijd van de huidige cyclus, en de eindtijd is de eindtijd van de huidige cyclus, die alle natuurlijke dagen/weken/maanden zijn, zoals hier is gezegd. Als het type examen is, aan het einde van elke cyclus als de gebruiker nog steeds voldoet aan de screeningscriteria. de gebruiker krijgt automatisch een examen toegewezen voor de volgende cyclus.' ,

    'time_condition_invalid' => 'De tijdsparameter heeft geen zin, er zijn en slechts één van de drie items: starttijd + eindtijd/tijdsduur / terugkerende tijd',

    'type_exam' => 'Proefwerk',
    'type_task' => 'Opdracht',
    'type' => 'Type',
    'type_help' => 'Examens zijn reguliere examens, en door ze te laten mislukken, leiden ze tot een accountverbod. Taken kunnen worden ingesteld op beloning bonus of aftrek bonus afhankelijk van of ze al dan niet zijn voltooid',

    'fail_deduct_bonus' => 'Bonus aftrekken voor fout',
    'success_reward_bonus' => 'Beloningsbonus voor voltooiing',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Weet je zeker dat je wilt claimen?' ,
    'claim_by_yourself_only' => 'Claim alleen door jezelf!' ,
    'not_match_target_user' => 'Je bent geen overeenkomende doelgebruiker!' ,
    'has_other_on_the_way' => 'Er is een andere :type_text in uitvoering!' ,
    'claimed_already' => 'Al geclaimd',
    'not_between_begin_end_time' => 'Niet tussen begin- en eindtijd',
    'reach_max_user_count' => 'Het aantal geclaimde gebruikers heeft zijn maximum bereikt',
    'claimed_user_count' => 'Opgeëist',
    'max_user_count' => 'Maximale aantal claim gebruikers (0 betekent ongelimiteerd)',
    'background_color' => 'Achtergrondkleur informatiekader',
];
