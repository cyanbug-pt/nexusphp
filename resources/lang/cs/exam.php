<?php

return [
    'label' => 'Zkouška',
    'name' => 'Název zkoušky',
    'index' => 'Index zkoušky',
    'time_range' => 'Doba zkoušky',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Nahrát zvýšení',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Průměr času semínka',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Stáhnout přírůstek',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Přírůstek bonusu',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Přírůstek osiv bodů',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Nahrát torrent přírůstek',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Třída uživatele',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrovat časový rozsah',
        \App\Models\Exam::FILTER_USER_DONATE => 'Darovat',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Rozsah dnů registrace',
    ],
    'require_value' => 'Vyžadovat',
    'current_value' => 'Aktuální',
    'result' => 'Výsledek',

    'result_pass_for_exam' => 'Proběhla!',
    'result_pass_for_task' => 'Dokončeno!',
    'result_not_pass_for_exam' => '<span style="color: red">Neprošelo!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Nedokončeno!</span>',
    'checkout_pass_message_subject_for_exam' => 'Zkouška prošla!',
    'checkout_pass_message_content_for_exam' => 'Gratulujeme! Zkouška: :exam_name v čase (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Zkouška neproběhne a účet je zakázán!',
    'checkout_not_pass_message_content_for_exam' => 'Neprošli jste zkouškou: :exam_name v čase (:start ~ :end), a váš účet byl zabanován!',

    'checkout_pass_message_subject_for_task' => 'Úkol dokončen!',
    'checkout_pass_message_content_for_task' => 'Gratulujeme! Dokončili jste úkol: :exam_name v čase(:start ~ :end), získáte bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Úkol není dokončen!',
    'checkout_not_pass_message_content_for_task' => 'Úkol se nepodařilo dokončit načase: :exam_name (:start ~ :end), odečíst bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Nedokončete zkoušku: :exam_name v čase (:start ~ :end)',
    'ban_user_modcomment' => 'Z důvodu neúplné zkoušky: :exam_name(:start ~ :end), ban podle systému.',
    'admin' => [
        'list' => [
            'page_title' => 'Seznam zkoušek'
        ]
    ],
    'recurring' => 'opakující se',
    'recurring_daily' => 'jednou za den',
    'recurring_weekly' => 'jednou týdně',
    'recurring_monthly' => 'jednou za měsíc',
    'recurring_help' => 'Je-li specifikováno jako periodické, je počáteční doba zkoušky časem zahájení aktuálního cyklu, a koncovým časem je konec současného cyklu, který jsou všechny přirozené dny/týdny/měsíce, jak je uvedeno zde. Pokud je typ zkoušen na konci každého cyklu, pokud uživatel stále splňuje kritéria screeningu, uživateli bude automaticky přiřazena zkouška pro další cyklus.' ,

    'time_condition_invalid' => 'Parametr času nemá smysl, existuje a pouze jedna ze tří položek: čas zahájení + čas ukončení / doba trvání / opakování',

    'type_exam' => 'Zkouška',
    'type_task' => 'Úkol',
    'type' => 'Typ',
    'type_help' => 'Zkouška je pravidelná zkouška a její selhání povede k zákazu účtů. Úkoly lze nastavit na odměnu nebo odečtení bonusu v závislosti na tom, zda jsou dokončeny, či ne',

    'fail_deduct_bonus' => 'Odpočet bonusu za selhání',
    'success_reward_bonus' => 'Bonus za dokončení',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Jistě chcete nárokovat?' ,
    'claim_by_yourself_only' => 'Zažijte pouze vy sami!' ,
    'not_match_target_user' => 'Nejste odpovídající cílový uživatel!' ,
    'has_other_on_the_way' => 'Probíhá další :type_text!' ,
    'claimed_already' => 'Již bylo vyžádáno',
    'not_between_begin_end_time' => 'Ne mezi začátkem a koncem',
    'reach_max_user_count' => 'Počet přihlášených uživatelů dosáhl svého maxima',
    'claimed_user_count' => 'nárokováno',
    'max_user_count' => 'Maximální počet uživatelů žádosti (0 znamená neomezeně)',
    'background_color' => 'Barva pozadí informačního pole',
];
