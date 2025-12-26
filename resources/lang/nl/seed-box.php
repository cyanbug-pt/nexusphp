<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Gebruiker',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Beheerder',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Ongeautoriseerd',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Toegestaan',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Geweigerd',
    ],
    'status_change_message' => [
        'subject' => 'SeedBox record status veranderd',
        'body' => 'De status van uw SeedBox record met ID :id is veranderd door :operator van :old_status naar :new_status. Reden: :reason',
    ],
    'is_seed_box_yes' => 'Dit IP is SeedBox',
    'is_seed_box_no' => 'Dit IP-adres is geen SeedBox',
];
