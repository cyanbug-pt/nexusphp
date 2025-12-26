<?php

return [
    'label' => 'Eksamen',
    'name' => 'Eksamens navn',
    'index' => 'Eksamen indeks',
    'time_range' => 'Eksamen tid',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Upload trin',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Gennemsnitligt antal seeder',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Download trin',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonus stigning',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Stigning af seed-point',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Upload torrent trin',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Bruger klasse',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrer tidsinterval',
        \App\Models\Exam::FILTER_USER_DONATE => 'Doneret',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Varighed af dage for registrering',
    ],
    'require_value' => 'Kræv',
    'current_value' => 'Aktuel',
    'result' => 'Resultat',

    'result_pass_for_exam' => 'Gennemført!',
    'result_pass_for_task' => 'Afsluttet!',
    'result_not_pass_for_exam' => '<span style="color: red">Ikke Gennemført!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Ikke Fuldført!</span>',
    'checkout_pass_message_subject_for_exam' => 'Eksamen er bestået!',
    'checkout_pass_message_content_for_exam' => 'Tillykke! Du har bestået eksamen: :exam_name i tide (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Eksamen er ikke passeret, og kontoen er forbudt!',
    'checkout_not_pass_message_content_for_exam' => 'Du har ikke bestået eksamen: :exam_name i tide (:start ~ :end), og din konto er blevet bandlyst!',

    'checkout_pass_message_subject_for_task' => 'Opgave fuldført!',
    'checkout_pass_message_content_for_task' => 'Tillykke! Du har fuldført opgaven: :exam_name i tide (:start ~ :end), fik bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Opgave ikke fuldført!',
    'checkout_not_pass_message_content_for_task' => 'Du dit ikke fuldføre opgaven: :exam_name i gang (:begin ~ :end), fratrække bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Ikke komplet eksamen: :exam_name i tide (:start ~ :end)',
    'ban_user_modcomment' => 'På grund af ikke fuldstændig eksamen: :exam_name(:begin ~ :end), ban by system.',
    'admin' => [
        'list' => [
            'page_title' => 'Eksamen Liste'
        ]
    ],
    'recurring' => 'tilbagevendende',
    'recurring_daily' => 'én gang dagligt',
    'recurring_weekly' => 'en gang om ugen',
    'recurring_monthly' => 'en gang om måneden',
    'recurring_help' => 'Hvis angivet som periodisk, er starttidspunktet for eksamen starttidspunktet for den aktuelle cyklus, og sluttidspunktet er sluttidspunktet for den aktuelle cyklus, som er alle naturlige dage/uger/måneder som angivet her. Hvis typen er eksamen, ved afslutningen af hver cyklus, hvis brugeren stadig opfylder screeningskriterierne, brugeren vil automatisk blive tildelt en eksamen for den næste cyklus.' ,

    'time_condition_invalid' => 'Tidsparameteren giver ikke mening, der er og kun ét af tre elementer: starttid + sluttid / varighed / tilbagevendende',

    'type_exam' => 'Eksamen',
    'type_task' => 'Opgave',
    'type' => 'Type',
    'type_help' => 'Eksamen er regelmæssig eksamen og ikke dem vil resultere i kontoforbud. Opgaver kan indstilles til belønning bonus eller fratrække bonus afhængigt af om de er afsluttet eller ej',

    'fail_deduct_bonus' => 'Fradrag bonus for fiasko',
    'success_reward_bonus' => 'Belønningsbonus for fuldførelse',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Er du sikker på, at du vil gøre krav på?' ,
    'claim_by_yourself_only' => 'Påkrav kun af dig selv!' ,
    'not_match_target_user' => 'Du er ikke en matchende målbruger!' ,
    'has_other_on_the_way' => 'Der er en anden :type_text i gang!' ,
    'claimed_already' => 'Allerede hævdede',
    'not_between_begin_end_time' => 'Ikke mellem start og sluttidspunkt',
    'reach_max_user_count' => 'Antallet af påståede brugere har nået sit maksimum',
    'claimed_user_count' => 'Påstået',
    'max_user_count' => 'Maks. antal tilgodehavender (0 betyder ubegrænset)',
    'background_color' => 'Baggrundsfarve for infoboks',
];
