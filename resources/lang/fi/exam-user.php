<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Tenttien käyttäjät'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Valmis',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Vältä',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normaali',
    ],
    'end_can_not_before_begin' => "Päättymisaika: :end ei voi olla ennen alkamisaikaa: :start",
    'status_not_allow_update_end' => 'Nykyinen tila ei::status_text, ei voi muuttaa päättymisaikaa',
];
