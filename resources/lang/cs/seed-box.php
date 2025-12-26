<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Uživatel',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrátor',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Nezobrazené',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Povoleno',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Zamítnuto',
    ],
    'status_change_message' => [
        'subject' => 'Stav záznamu SeedBox byl změněn',
        'body' => 'Stav vašeho SeedBox záznamu s ID :id byl změněn :operator z :old_status na :new_status. Důvod: :reason',
    ],
    'is_seed_box_yes' => 'Tato IP adresa je SeedBox',
    'is_seed_box_no' => 'Tato IP adresa není SeedBox',
];
