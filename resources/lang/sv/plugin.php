<?php

return [
    'actions' => [
        'install' => 'installera',
        'delete' => 'radera',
        'update' => 'uppgradera',
        'install_or_update' => 'installera/uppgradera',
    ],
    'labels' => [
        'display_name' => 'namn',
        'package_ name' => 'paketnamn',
        'remote_url' => 'Adress',
        'installed_version' => 'Version',
        'latest_version' => 'Senaste version',
        'status' => 'status',
        'updated_at' => 'Åtgärd',
        ' release_date' => 'uppdaterades den',
        'install_title' => 'Gå till katalogen: :web_root, och kör följande kommandon för att installera det som root användare: ',
        'introduce' => 'Detaljer',
        'view_on_blog' => 'Visa på bloggen',
        ' config_plugin_address' => 'Konfigurera tilläggsadress',
        'download_specific_version' => 'Ladda ner tillägget. Den senaste versionen visas här, om du behöver installera en annan version (visa på bloggen för att se alla versioner) ersätta den själv',
        'execute_install' => 'Utför installation',
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
