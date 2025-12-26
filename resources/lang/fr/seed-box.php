<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Utilisateur',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Administrateur',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Non audité',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Autorisé',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Refusé',
    ],
    'status_change_message' => [
        'subject' => 'Le statut de l\'enregistrement de la SeedBox a été modifié',
        'body' => 'Le statut de votre enregistrement SeedBox avec l\'ID :id a été changé par :operator de :old_status à :new_status. Raison: :reason',
    ],
    'is_seed_box_yes' => 'Cette adresse IP est SeedBox',
    'is_seed_box_no' => 'Cette adresse IP n\'est pas SeedBox',
];
