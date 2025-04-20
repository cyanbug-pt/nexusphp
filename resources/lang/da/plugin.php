<?php

return [
    'actions' => [
        'install' => 'Installér',
        'delete' => 'Fjern',
        'update' => 'Opgradér',
    ],
    'labels' => [
        'display_name' => 'Navn',
        'package_name' => 'Pakke navn',
        'remote_url' => 'Repository adresse',
        'installed_version' => 'Installeret version',
        'status' => 'Status',
        'updated_at' => 'Seneste handling på',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Ikke installeret',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Klar til installation',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installerer',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installationen mislykkedes',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Klar til opgradering',
        \App\Models\Plugin::STATUS_UPDATING => 'Opgradering',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Opgradering mislykkedes',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Klar til at fjerne',
        \App\Models\Plugin::STATUS_DELETING => 'Fjerner',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Fjern mislykkedes',
    ],
];
