<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Utente',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Amministratore',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Non verificato',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Consentito',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Negato',
    ],
    'status_change_message' => [
        'subject' => 'Stato record SeedBox cambiato',
        'body' => 'Lo stato del tuo record SeedBox con ID :id è stato cambiato da :operator da :old_status a :new_status. Motivo: :reason',
    ],
    'is_seed_box_yes' => 'Questo IP è SeedBox',
    'is_seed_box_no' => 'Questo IP non è SeedBox',
];
