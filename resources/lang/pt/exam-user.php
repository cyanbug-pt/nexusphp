<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Usuários de prova'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Finalizado.',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Evitado',
        \App\Models\ExamUser::STATUS_NORMAL => 'normal',
    ],
    'end_can_not_before_begin' => "Hora de término: :end não pode ser antes do início: :start",
    'status_not_allow_update_end' => 'Estado atual não é ::status_text, incapaz de alterar a hora de término',
];
