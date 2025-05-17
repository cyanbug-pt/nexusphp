<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Usuário',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrador',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Não auditado',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Permitido',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Negado',
    ],
    'status_change_message' => [
        'subject' => 'Status do registro SeedBox alterado',
        'body' => 'O status do seu registro de SeedBox com ID :id foi alterado por :operator de :old_status para :new_status. Motivo: :reason',
    ],
    'is_seed_box_yes' => 'Este IP é SeedBox',
    'is_seed_box_no' => 'Este IP não é SeedBox',
];
