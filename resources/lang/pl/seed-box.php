<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Użytkownik',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrator',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Nieudane',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Dozwolone',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Odmowa',
    ],
    'status_change_message' => [
        'subject' => 'Status rekordu SeedBox zmieniony',
        'body' => 'Status Twojego rekordu SeedBox o ID :id został zmieniony przez :operator z :old_status na :new_status. Powód: :reason',
    ],
    'is_seed_box_yes' => 'Ten adres IP jest SeedBox',
    'is_seed_box_no' => 'Ten adres IP nie jest SeedBox',
];
