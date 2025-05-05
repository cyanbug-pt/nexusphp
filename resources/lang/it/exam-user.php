<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Utenti dell\'esame'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Finito',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Evitata',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normale',
    ],
    'end_can_not_before_begin' => "Ora di fine: la fine non può essere prima dell'ora di inizio: :start",
    'status_not_allow_update_end' => 'Lo stato attuale non è status_text, non è in grado di modificare l\'ora di fine',
];
