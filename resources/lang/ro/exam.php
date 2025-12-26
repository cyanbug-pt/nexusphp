<?php

return [
    'label' => 'Examen',
    'name' => 'Nume Exam',
    'index' => 'Indicele de examen',
    'time_range' => 'Timp de examen',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Creștere încărcare',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Media timpului seed-ului',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Descarcare increment',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Creștere bonus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Creștere puncte de referință',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Creștere torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Clasa utilizatorului',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Înregistrează intervalul de timp',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donat',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Intervalul zilelor de înregistrare',
    ],
    'require_value' => 'Necesită',
    'current_value' => 'Actuală',
    'result' => 'Rezultat',

    'result_pass_for_exam' => 'Trecut!',
    'result_pass_for_task' => 'Finalizat!',
    'result_not_pass_for_exam' => '<span style="color: red">Nu a trecut!</span>',
    'result_not_pass_for_task' => '<span style="color: red">nu a fost finalizat!</span>',
    'checkout_pass_message_subject_for_exam' => 'Exam trecut!',
    'checkout_pass_message_content_for_exam' => 'Felicitări! Ai trecut examenul: :exam_name în timp (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Exam-ul nu a trecut și contul este interzis!',
    'checkout_not_pass_message_content_for_exam' => 'Nu ai trecut examenul: :exam_name în timp (:start ~ :end), iar contul tău a fost interzis!',

    'checkout_pass_message_subject_for_task' => 'Sarcină finalizată!',
    'checkout_pass_message_content_for_task' => 'Felicitări! Ai încheiat sarcina: :exam_name în timp (:start ~ :end), primește bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Sarcina nu a fost finalizată!',
    'checkout_not_pass_message_content_for_task' => 'Nu ai îndeplinit sarcina: :exam_name în timp (:start ~ :end), deduce bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Nu este un examen complet: :exam_name în timp (:start ~ :end)',
    'ban_user_modcomment' => 'Din cauza examenului incomplet: :exam_name(:start ~ :end), interdicție de către sistem.',
    'admin' => [
        'list' => [
            'page_title' => 'Listă de Exam'
        ]
    ],
    'recurring' => 'recurent',
    'recurring_daily' => 'o dată pe zi',
    'recurring_weekly' => 'o dată pe săptămână',
    'recurring_monthly' => 'o dată pe lună',
    'recurring_help' => 'Dacă este specificată periodic, ora de început a examenului este ora de începere a ciclului curent, iar termenul final este termenul final al ciclului curent, care sunt toate zile/săptămâni/luni naturale așa cum se menționează aici. Dacă tipul este examen, la sfârşitul fiecărui ciclu, dacă utilizatorul îndeplineşte în continuare criteriile de screening, utilizatorului i se va atribui automat un examen pentru ciclul următor.' ,

    'time_condition_invalid' => 'Parametrul de timp nu are sens, există și doar unul din trei elemente: timp de început + sfârșit / durată / recurență',

    'type_exam' => 'Examen',
    'type_task' => 'Sarcină',
    'type' => 'Tip',
    'type_help' => 'Exam-ul este un examen regulat, iar lipsa acestuia va duce la interzicerea contului. Sarcinile pot fi setate să recompenseze bonus sau să deducă bonus în funcție de terminarea sau nu',

    'fail_deduct_bonus' => 'Bonus deductibil pentru eșec',
    'success_reward_bonus' => 'Bonus de recompensă pentru completare',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Sigur vrei să revendici?' ,
    'claim_by_yourself_only' => 'Revendică doar de unul singur!' ,
    'not_match_target_user' => 'Nu ești un utilizator țintă potrivit!' ,
    'has_other_on_the_way' => 'Există un alt :type_text în desfășurare!' ,
    'claimed_already' => 'Deja revendicat',
    'not_between_begin_end_time' => 'Nu între începere și sfârșit',
    'reach_max_user_count' => 'Numărul de utilizatori reclamați a atins maximul său',
    'claimed_user_count' => 'Revendicat',
    'max_user_count' => 'Număr maxim de utilizatori (0 înseamnă nelimitat)',
    'background_color' => 'Culoare fundal cutie de informații',
];
