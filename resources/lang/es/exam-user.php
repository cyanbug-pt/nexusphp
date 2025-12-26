<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Usuarios de examen'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Terminado',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Evitado',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normal',
    ],
    'end_can_not_before_begin' => "Hora final: :end no puede ser antes de la hora de inicio: :begin",
    'status_not_allow_update_end' => 'El estado actual no::status_text, no se puede cambiar la hora final',
];
