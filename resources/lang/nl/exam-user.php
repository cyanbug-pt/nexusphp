<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'examen gebruikers'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Beëindigd',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Vervallen',
        \App\Models\ExamUser::STATUS_NORMAL => 'normaal',
    ],
    'end_can_not_before_begin' => "Eindtijd: :end kan niet voor de begintijd zijn: :begin",
    'status_not_allow_update_end' => 'Huidige status is niet:status_text, niet mogelijk de eindtijd te wijzigen',
];
