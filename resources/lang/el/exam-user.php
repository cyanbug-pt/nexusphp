<?php

return [
    'admin' => [
        'list' => [
            'page_title' => 'Εξετάστε τους χρήστες'
        ]
    ],
    'status' => [
        \App\Models\ExamUser::STATUS_FINISHED => 'Ολοκληρώθηκε',
        \App\Models\ExamUser::STATUS_AVOIDED => 'Αποφυγή',
        \App\Models\ExamUser::STATUS_NORMAL => 'Κανονικό',
    ],
    'end_can_not_before_begin' => "Ώρα λήξης: :end δεν μπορεί να είναι πριν από την ώρα έναρξης: :begin",
    'status_not_allow_update_end' => 'Η τρέχουσα κατάσταση δεν::status_text, δεν μπορεί να αλλάξει την ώρα λήξης',
];
