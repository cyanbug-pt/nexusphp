<?php

return [
    'label' => 'Eksamen',
    'name' => 'Eksamen navn',
    'index' => 'Exam index',
    'time_range' => 'Eksamen tid',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Størrelse på opplasting',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'CategoryName (t)',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Nedlastning av tid',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Tilleggstillegg for bonus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Størrelse på hovedpunkter',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Last opp torrentøkning',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Bruker klasse',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrere tidsperiode',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donert',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Antall dager registreringen skal være',
    ],
    'require_value' => 'Krev',
    'current_value' => 'Nåværende',
    'result' => 'Resultat',

    'result_pass_for_exam' => 'Bestått!',
    'result_pass_for_task' => 'Fullført!',
    'result_not_pass_for_exam' => '<span style="color: red">ikke passert!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Ikke fullført!</span>',
    'checkout_pass_message_subject_for_exam' => 'Eksamen passert!',
    'checkout_pass_message_content_for_exam' => 'Gratulerer! Du har bestått eksamenen: :exam_name i tide (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Exam not pass, and account is banned!',
    'checkout_not_pass_message_content_for_exam' => 'Du har ikke bestått eksamenen: :exam_name i time(:start ~ :end), og kontoen din har blitt utestengt!',

    'checkout_pass_message_subject_for_task' => 'Oppgave fullført!',
    'checkout_pass_message_content_for_task' => 'Gratulerer! Du har fullført oppgaven: :exam_name i tide (:begin ~ :end), fikk bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Oppgave ikke fullført!',
    'checkout_not_pass_message_content_for_task' => 'You dit ikke fullfører oppgaven: :exam_name in time (:start ~ :end), deduct bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Ikke fullført eksamen: :exam_name i tide (:begin ~ :end)',
    'ban_user_modcomment' => 'På grunn av ikke fullført eksamen: :exam_name(:begin ~ :end), utestengelse av systemet.',
    'admin' => [
        'list' => [
            'page_title' => 'Eksamen liste'
        ]
    ],
    'recurring' => 'periodisk',
    'recurring_daily' => 'én gang per dag',
    'recurring_weekly' => 'én gang i uken',
    'recurring_monthly' => 'én gang i måneden',
    'recurring_help' => 'Hvis det angis som periode, er starttidspunktet for eksamen starttidspunktet for gjeldende syklus, og slutttiden er slutttiden for denne syklusen, som er alle naturlige dager/uker/måneder slik det er angitt her. Hvis typen undersøker ved slutten av hver syklus, hvis brukeren fremdeles oppfyller kriteriene for screening, brukeren blir automatisk tildelt en eksam til neste syklus.' ,

    'time_condition_invalid' => 'Tidsparameteren gir ikke mening, det er bare én av tre elementer: start tid + sluttid / varighet / gjentakende',

    'type_exam' => 'Eksamen',
    'type_task' => 'Oppgave',
    'type' => 'Type:',
    'type_help' => 'Exam er regelmessig eksamen og mislykkes vil resultere i utestengelse. Oppgaver kan settes til å gi belønning eller fratrekk bonus avhengig av om de er gjennomført eller ikke',

    'fail_deduct_bonus' => 'Trekk fra bonus ved feil',
    'success_reward_bonus' => 'BelÃ¸nnings bonus for fullføring',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Sikker på at du ønsker å kreve?' ,
    'claim_by_yourself_only' => 'Krev kun av deg selv!' ,
    'not_match_target_user' => 'Du er ikke en matchende målbruker.' ,
    'has_other_on_the_way' => 'Det er en annen :type_text som pågår!' ,
    'claimed_already' => 'Allerede hentet',
    'not_between_begin_end_time' => 'Ikke mellom start og slutt tid',
    'reach_max_user_count' => 'Antallet påståtte brukere har nådd sin maksimale',
    'claimed_user_count' => 'Påtatt',
    'max_user_count' => 'Max krav bruker count(0 betyr ubegrenset)',
    'background_color' => 'Info boks bakgrunnsfarge',
];
