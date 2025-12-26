<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Usuario',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrador',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Sin auditoría',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Permitido',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Denegado',
    ],
    'status_change_message' => [
        'subject' => 'Estado de registro SeedBox cambiado',
        'body' => 'El estado de su registro SeedBox con ID :id fue cambiado por :operator de :old_status a :new_status. Motivo: :reason',
    ],
    'is_seed_box_yes' => 'Esta IP es SeedBox',
    'is_seed_box_no' => 'Esta IP no es SeedBox',
];
