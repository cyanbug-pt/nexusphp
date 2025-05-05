<?php

return [
    'actions' => [
        'install' => 'installeren',
        'delete' => 'verwijderen',
        'update' => 'upgraden',
        'install_or_update' => 'installeren/upgraden',
    ],
    'labels' => [
        'display_name' => 'Naam',
        'package_ name' => 'pakket_naam',
        'remote_url' => 'repository_adres',
        'installed_version' => 'geïnstalleerde_versie',
        'latest_version' => 'latest_versie',
        'status' => 'Status',
        'updated_at' => 'laatste_uitvoerde_actie',
        ' release_date' => 'bijgewerkt op',
        'install_title' => 'Ga naar de map: :web_root, en voer de volgende commando\'s uit om deze als root gebruiker te installeren: ',
        'introduce' => 'Beschrijving',
        'view_on_blog' => 'Bekijk op blog',
        ' config_plugin_address' => 'Configureren van plugin adres',
        'download_specific_version' => 'Download de extensie. De laatste versie wordt hier getoond als je een andere versie wilt installeren (bekijk een blog om alle versies te zien) vervang deze zelf',
        'execute_install' => 'Installatie uitvoeren',
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
