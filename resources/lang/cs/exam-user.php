<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Uživatelé zkoušek'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Dokončeno',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Zamezeno',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normální',
    ],
    'end_can_not_before_begin' => "Čas ukončení: :end nemůže být před časem zahájení: :start",
    'status_not_allow_update_end' => 'Aktuální stav není::status_text, nelze změnit čas ukončení',
];
