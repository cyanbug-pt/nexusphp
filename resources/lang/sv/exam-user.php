<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Testanvändare'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Slutförd',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Avoided',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normal',
    ],
    'end_can_not_before_begin' => "Sluttid: :end kan inte vara före starttid: :start",
    'status_not_allow_update_end' => 'Nuvarande status är inte:status_text, kan inte ändra sluttid',
];
