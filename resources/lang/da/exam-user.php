<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Eksamen brugere'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Færdig',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Undgået',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normal',
    ],
    'end_can_not_before_begin' => "Sluttid: :end kan ikke være før starttidspunkt: :start",
    'status_not_allow_update_end' => 'Nuværende status er ikke::status_text kan ikke ændre sluttidspunkt',
];
