<?php

return [
    'actions' => [
        'install' => 'Installeren',
        'delete' => 'Verwijderen',
        'update' => 'Upgraden',
    ],
    'labels' => [
        'display_name' => 'naam',
        'package_name' => 'Pakket naam',
        'remote_url' => 'Repository adres',
        'installed_version' => 'Geinstalleerde versie',
        'status' => 'status',
        'updated_at' => 'Laatste actie op',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'normaal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Niet geïnstalleerd',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Klaar om te installeren',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installeren',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installatie mislukt',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Klaar om te upgraden',
        \App\Models\Plugin::STATUS_UPDATING => 'Upgraden',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Upgrade mislukt',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Klaar om te verwijderen',
        \App\Models\Plugin::STATUS_DELETING => 'Verwijderen',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Verwijderen mislukt',
    ],
];
