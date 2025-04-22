<?php

return [
    'actions' => [
        'install' => 'Installera',
        'delete' => 'Radera',
        'update' => 'Uppgradera',
    ],
    'labels' => [
        'display_name' => 'Namn',
        'package_name' => 'Paketets namn',
        'remote_url' => 'Utvecklingskatalog',
        'installed_version' => 'Installerad version',
        'status' => 'Status',
        'updated_at' => 'Senaste åtgärd den',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Inte installerad',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Redo att installera',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installerar',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installationen misslyckades',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Redo att uppgradera',
        \App\Models\Plugin::STATUS_UPDATING => 'Uppgraderar',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Uppgradering misslyckades',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Redo att ta bort',
        \App\Models\Plugin::STATUS_DELETING => 'Tar bort',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Borttagning misslyckades',
    ],
];
