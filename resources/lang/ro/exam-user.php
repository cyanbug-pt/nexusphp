<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Utilizatori Exam'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Terminat',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Evitat',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normală',
    ],
    'end_can_not_before_begin' => "Ora de sfârșit: :end nu poate fi înainte de a începe: :start",
    'status_not_allow_update_end' => 'Starea curentă nu este::status_text, nu se poate schimba ora de sfârșit',
];
