<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Benutzer',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrator',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Ungeprüft',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Zulässig',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Verweigert',
    ],
    'status_change_message' => [
        'subject' => 'Status des SeedBox-Datensatzes geändert',
        'body' => 'Der Status Ihres SeedBox-Datensatzes mit der ID :id wurde von :operator von :old_status zu :new_status geändert. Grund: :reason',
    ],
    'is_seed_box_yes' => 'Diese IP ist SeedBox',
    'is_seed_box_no' => 'Diese IP ist nicht SeedBox',
];
