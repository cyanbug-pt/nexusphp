<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Użytkownicy egzaminu'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Zakończone',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Uniknięto',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normalny',
    ],
    'end_can_not_before_begin' => "Czas zakończenia: :end nie może być przed godziną rozpoczęcia: :start",
    'status_not_allow_update_end' => 'Obecny status nie jest::status_text, nie można zmienić czasu zakończenia',
];
