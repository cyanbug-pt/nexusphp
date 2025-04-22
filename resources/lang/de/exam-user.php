<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Prüfungs-Benutzer'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Beendet',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Vermeiden',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normal',
    ],
    'end_can_not_before_begin' => "Endzeit: :end kann nicht vor der Startzeit liegen: :start",
    'status_not_allow_update_end' => 'Aktueller Status ist nicht::status_text, die Endzeit kann nicht geändert werden',
];
