<?php

return [
    'actions' => [
        'install' => 'installere',
        'delete' => 'slett',
        'update' => 'oppgradér',
        'install_or_update' => 'installere/oppgradering',
    ],
    'labels' => [
        'display_name' => 'navn',
        'package_ name' => 'pakke_navn',
        'remote_url' => 'repository_adresse',
        'installed_version' => 'installerte_versjon',
        'latest_version' => 'nyest_versjon',
        'status' => 'status',
        'updated_at' => 'siste_utført_handling',
        ' release_date' => 'oppdatert på',
        'install_title' => 'Gå til mappen: :web_root, og kjør følgende kommandoer for å installere den som root bruker: ',
        'introduce' => 'Detaljer',
        'view_on_blog' => 'Vis på blogg',
        ' config_plugin_address' => 'Konfigurer programtilleggets adresse',
        'download_specific_version' => 'Last ned utvidelsen. Den nyeste versjonen vises her, hvis du trenger å installere en annen versjon (vis på bloggen for å se alle versjoner) erstatte den selv',
        'execute_install' => 'Utfør installasjonen',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Vanlig',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Ikke installert',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Klar til å installere',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installerer',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installasjon mislyktes',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Klar for oppgradering',
        \App\Models\Plugin::STATUS_UPDATING => 'Oppgraderer',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Oppgradering feilet',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Klar til å fjerne',
        \App\Models\Plugin::STATUS_DELETING => 'Fjerner',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Fjerning mislyktes',
    ],
];
