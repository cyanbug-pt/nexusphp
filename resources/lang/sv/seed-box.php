<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Användare',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administratör',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Ogranskad',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Tillåten',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Nekad',
    ],
    'status_change_message' => [
        'subject' => 'SeedBox poststatus ändrad',
        'body' => 'Status för din SeedBox post med ID :id ändrades av :operator från :old_status till :new_status. Anledning: :reason',
    ],
    'is_seed_box_yes' => 'Denna IP är SeedBox',
    'is_seed_box_no' => 'Denna IP är inte SeedBox',
];
