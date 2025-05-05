<?php

return [
    'change_type' => [
        \App\Models\UsernameChangeLog::CHANGE_TYPE_USER => 'Χρήστης',
        \App\Models\UsernameChangeLog::CHANGE_TYPE_ADMIN => 'Διαχειριστής',
    ],
    'labels' => [
        'username_old' => 'Παλιό όνομα χρήστη',
        'username_new' => 'Νέο όνομα χρήστη',
        'change_type' => 'Αλλαγή τύπου',
    ],
];
