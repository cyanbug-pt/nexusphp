<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Utilizator',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrator',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Nereauditate',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Permis',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Refuzat',
    ],
    'status_change_message' => [
        'subject' => 'Starea înregistrării SeedBox a fost modificată',
        'body' => 'Starea înregistrării SeedBox cu ID-ul :id a fost schimbată de :operator de la :old_status la :new_status. Motiv: :reason',
    ],
    'is_seed_box_yes' => 'Acest IP este SeedBox',
    'is_seed_box_no' => 'Acest IP nu este SeedBox',
];
