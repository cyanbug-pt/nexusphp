<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Bruker',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administratorsiden',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Urevidert',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Tillatt',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Avvist',
    ],
    'status_change_message' => [
        'subject' => 'SeedBox poststatus endret',
        'body' => 'Statusen for SeedBox oppføringen med ID :id ble endret av :operator fra :old_status til :new_status. Årsak: :reason',
    ],
    'is_seed_box_yes' => 'Denne IP er SeedBox',
    'is_seed_box_no' => 'Denne IP er ikke SeedBox',
];
