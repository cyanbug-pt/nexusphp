<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Utilisateurs de l\'examen'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Terminé',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Évité',
        \App\Models\ExamUser::STATUS_NORMAL => 'Normale',
    ],
    'end_can_not_before_begin' => "Heure de fin: :end ne peut pas être avant l'heure de début: :start",
    'status_not_allow_update_end' => 'Le statut actuel n\'est pas::status_text, impossible de changer l\'heure de fin',
];
