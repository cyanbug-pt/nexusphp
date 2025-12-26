<?php

return [
    'actions' => [
        'install' => 'installer',
        'delete' => 'slet',
        'update' => 'opgrader',
        'install_or_update' => 'installér/opgradering',
    ],
    'labels' => [
        'display_name' => 'navn',
        'package_ name' => 'pakke_navn',
        'remote_url' => 'repository_address',
        'installed_version' => 'installeret_version',
        'latest_version' => 'latest_version',
        'status' => 'status',
        'updated_at' => 'last_eksekveret_handling',
        ' release_date' => 'opdateret på',
        'install_title' => 'Gå til mappen: :web_root, og kør følgende kommandoer for at installere det som root bruger: ',
        'introduce' => 'Detaljer',
        'view_on_blog' => 'Vis på blog',
        ' config_plugin_address' => 'Indstil plugin adresse',
        'download_specific_version' => 'Download udvidelsen. Den seneste version vises her, hvis du har brug for at installere en anden version (visning på blog for at se alle versioner) erstatte det selv',
        'execute_install' => 'Udfør installation',
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
