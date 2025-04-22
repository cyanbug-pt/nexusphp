<?php

return [
    'label' => 'Tentamen',
    'name' => 'Tentamens namn',
    'index' => 'Tentamen index',
    'time_range' => 'Tentamen tid',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Uppladdnings ökning',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Genomsnittlig frötid',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Hämta ökning',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonus ökning',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Gradering av fröpunkter',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Ladda upp torrent ökning',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Användarlektion',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrera tidsintervall',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donerad',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Utbud av dagar för registrering',
    ],
    'require_value' => 'Kräv',
    'current_value' => 'Nuvarande',
    'result' => 'Resultat',

    'result_pass_for_exam' => 'Passerad!',
    'result_pass_for_task' => 'Klart!',
    'result_not_pass_for_exam' => '<span style="color: red">ej godkänd!</span>',
    'result_not_pass_for_task' => '<span style="color: red">är inte klar!</span>',
    'checkout_pass_message_subject_for_exam' => 'Tentamen godkänd!',
    'checkout_pass_message_content_for_exam' => 'Grattis! Du har klarat provet: :exam_name i tid(:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Tentamen godkänns inte, och kontot är bannlyst!',
    'checkout_not_pass_message_content_for_exam' => 'Du klarade inte provet: :exam_name i tid(:begin ~ :end), och ditt konto har förbjudits!',

    'checkout_pass_message_subject_for_task' => 'Uppgiften slutförd!',
    'checkout_pass_message_content_for_task' => 'Grattis! Du har slutfört uppgiften: :exam_name i tid(:start ~ :end), fick bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Uppgiften är inte slutförd!',
    'checkout_not_pass_message_content_for_task' => 'Du kan inte slutföra uppgiften: :exam_name i tid (:start ~ :end), dra av bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Ej fullständig tentamen: :exam_name i tid(:start ~ :end)',
    'ban_user_modcomment' => 'På grund av att inte fullständig tentamen: :exam_name(:begin ~ :end), bannlysa efter system.',
    'admin' => [
        'list' => [
            'page_title' => 'Tentamen lista'
        ]
    ],
    'recurring' => 'återkommande',
    'recurring_daily' => 'en gång om dagen',
    'recurring_weekly' => 'en gång i veckan',
    'recurring_monthly' => 'en gång i månaden',
    'recurring_help' => 'Om det anges som periodisk, är starttiden för testet starttiden för den aktuella cykeln, och sluttiden är sluttiden för den nuvarande cykeln, som alla är naturliga dagar/veckor/månader som anges här. Om typen är examen, i slutet av varje cykel, om användaren fortfarande uppfyller kriterierna för screening, användaren kommer automatiskt att tilldelas ett prov för nästa cykel.' ,

    'time_condition_invalid' => 'Tidsparametern är inte vettig, det finns och endast en av tre punkter: starttid + sluttid / varaktighet / återkommande',

    'type_exam' => 'Tentamen',
    'type_task' => 'Uppgift',
    'type' => 'Typ',
    'type_help' => 'Tentamen är regelbunden examen och underlåtenhet dem kommer att resultera i konto bannlysning. Uppgifter kan sättas till belöning bonus eller dra bonus beroende på om de är avslutade eller inte',

    'fail_deduct_bonus' => 'Dra bonus för misslyckande',
    'success_reward_bonus' => 'Belöningsbonus för slutförandet',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Visst vill du hävda?' ,
    'claim_by_yourself_only' => 'Begär endast av dig själv!' ,
    'not_match_target_user' => 'Du är inte en matchande målanvändare!' ,
    'has_other_on_the_way' => 'Det finns en annan :type_text pågår!' ,
    'claimed_already' => 'Redan hävdad',
    'not_between_begin_end_time' => 'Inte mellan start & sluttid',
    'reach_max_user_count' => 'Antalet skadade användare har nått sitt maximum',
    'claimed_user_count' => 'Bekräftad',
    'max_user_count' => 'Max anspråk användarkonto(0 betyder obegränsat)',
    'background_color' => 'Info box bakgrundsfärg',
];
