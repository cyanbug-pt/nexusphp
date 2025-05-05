<?php

return [
    'label' => 'Esame',
    'name' => 'Nome dell\'esame',
    'index' => 'Indice di esame',
    'time_range' => 'Tempo di esame',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Incremento caricamento',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Media tempo di seme',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Incremento download',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Incremento bonus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Incremento punti seme',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Carica incremento torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Classe utente',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Intervallo orario di registrazione',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donato',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Intervallo di giorni di registrazione',
    ],
    'require_value' => 'Richiede',
    'current_value' => 'Corrente',
    'result' => 'Risultato',

    'result_pass_for_exam' => 'Passato!',
    'result_pass_for_task' => 'Completato!',
    'result_not_pass_for_exam' => '<span style="color: red">Non Passato!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Non Completato!</span>',
    'checkout_pass_message_subject_for_exam' => 'Esami passato!',
    'checkout_pass_message_content_for_exam' => 'Congratulazioni! Hai superato l\'esame: :exam_name in tempo(:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'L\'esame non passa, e l\'account è bandito!',
    'checkout_not_pass_message_content_for_exam' => 'Non hai superato l\'esame: :exam_name in tempo(:start ~ :end), e il tuo account è stato bandito!',

    'checkout_pass_message_subject_for_task' => 'Attività completata!',
    'checkout_pass_message_content_for_task' => 'Congratulazioni! Hai completato il compito: :exam_name in tempo(:start ~ :end), ottenuto bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Attività non completata!',
    'checkout_not_pass_message_content_for_task' => 'Non si completa il compito: :exam_name in tempo (:start ~ :end), dedurre bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Esame non completo: :exam_name in tempo(:start ~ :end)',
    'ban_user_modcomment' => 'A causa dell\'esame non completo: :exam_name(:start ~ :end), ban by system.',
    'admin' => [
        'list' => [
            'page_title' => 'Elenco Esami'
        ]
    ],
    'recurring' => 'ricorrente',
    'recurring_daily' => 'una volta al giorno',
    'recurring_weekly' => 'una volta alla settimana',
    'recurring_monthly' => 'una volta al mese',
    'recurring_help' => 'Se specificato come periodico, l\'ora di inizio dell\'esame è l\'ora di inizio del ciclo corrente, e l\'ora di fine è l\'ora di fine del ciclo corrente, che sono tutti i giorni naturali/settimane/mesi come indicato in questa sede. Se il tipo è esame, alla fine di ogni ciclo, se l\'utente soddisfa ancora i criteri di screening, all\'utente verrà assegnato automaticamente un esame per il ciclo successivo.' ,

    'time_condition_invalid' => 'Il parametro orario non ha senso, ci sono e solo uno dei tre elementi: ora di inizio + ora di fine / durata / ricorrente',

    'type_exam' => 'Esame',
    'type_task' => 'Attività',
    'type' => 'Tipo',
    'type_help' => 'L\'esame è esame regolare e fallendoli comporterà il divieto dell\'account. Le attività possono essere impostate per ricompensare bonus o dedurre bonus a seconda che siano completati o meno',

    'fail_deduct_bonus' => 'Deduca bonus per fallimento',
    'success_reward_bonus' => 'Bonus ricompensa per il completamento',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Sei sicuro di voler reclamare?' ,
    'claim_by_yourself_only' => 'Richiedi solo da soli!' ,
    'not_match_target_user' => 'Non sei un utente di destinazione corrispondente!' ,
    'has_other_on_the_way' => 'C\'è un altro :type_text in corso!' ,
    'claimed_already' => 'Già reclamato',
    'not_between_begin_end_time' => 'Non tra l\' ora di inizio e di fine',
    'reach_max_user_count' => 'Il numero di utilizzatori rivendicati ha raggiunto il suo massimo',
    'claimed_user_count' => 'Richiesto',
    'max_user_count' => 'Numero massimo di utenti della richiesta (0 significa illimitato)',
    'background_color' => 'Colore sfondo casella informazioni',
];
