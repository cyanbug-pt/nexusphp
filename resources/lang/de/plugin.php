<?php

return [
    'actions' => [
        'install' => 'Installieren',
        'delete' => 'Entfernen',
        'update' => 'Upgrade',
    ],
    'labels' => [
        'display_name' => 'Name',
        'package_name' => 'Paketname',
        'remote_url' => 'Repository-Adresse',
        'installed_version' => 'Installierte Version',
        'status' => 'Status',
        'updated_at' => 'Letzte Aktion am',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Nicht installiert',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Bereit zur Installation',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installiere',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installation fehlgeschlagen',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Bereit zum Upgrade',
        \App\Models\Plugin::STATUS_UPDATING => 'Upgrade',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Upgrade fehlgeschlagen',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Bereit zum Entfernen',
        \App\Models\Plugin::STATUS_DELETING => 'Entfernen',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Fehler entfernen',
    ],
];
