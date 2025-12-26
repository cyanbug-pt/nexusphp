<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Пользователи экзамена'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Завершено',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Избегать',
        \App\Models\ExamUser::STATUS_NORMAL => 'Обычный',
    ],
    'end_can_not_before_begin' => "Время окончания: :end не может быть раньше времени начала: :start",
    'status_not_allow_update_end' => 'Текущий статус не:status_text, невозможно изменить время окончания',
];
