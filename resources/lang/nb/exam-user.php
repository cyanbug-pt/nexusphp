<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Exam users'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Ferdig',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Unntatt',
        \App\Models\ExamUser::STATUS_NORMAL => 'Vanlig',
    ],
    'end_can_not_before_begin' => "Slutttid: :end kan ikke være før første gang: :start",
    'status_not_allow_update_end' => 'Gjeldende status er ikke::status_text, kan ikke endre sluttklokkeslett',
];
