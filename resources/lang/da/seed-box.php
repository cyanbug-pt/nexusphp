<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Bruger',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrator',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Urevideret',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Tilladt',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Afvist',
    ],
    'status_change_message' => [
        'subject' => 'SeedBox rekordstatus ændret',
        'body' => 'Status på din SeedBox post med ID :id blev ændret af :operator fra :old_status til :new_status. Årsag:',
    ],
    'is_seed_box_yes' => 'Denne IP er SeedBox',
    'is_seed_box_no' => 'Denne IP er ikke SeedBox',
];
