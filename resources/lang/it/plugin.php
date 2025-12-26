<?php

return [
    'actions' => [
        'install' => 'installa',
        'delete' => 'elimina',
        'update' => 'aggiorna',
        'install_or_update' => 'installa/aggiorna',
    ],
    'labels' => [
        'display_name' => 'nome',
        'package_ name' => 'nome_pacchetto',
        'remote_url' => 'indirizzo_repository',
        'installed_version' => 'installed_version',
        'latest_version' => 'latest_version',
        'status' => 'stato',
        'updated_at' => 'last_executed_action',
        ' release_date' => 'aggiornato il',
        'install_title' => 'Vai alla directory: :web_root, ed esegui i seguenti comandi per installarlo come utente root. ',
        'introduce' => 'Dettagli',
        'view_on_blog' => 'Visualizza sul blog',
        ' config_plugin_address' => 'Configura indirizzo plugin',
        'download_specific_version' => 'Scarica l\'estensione. L\'ultima versione è mostrata qui, se è necessario installare un\'altra versione (visualizzare sul blog per vedere tutte le versioni) sostituirlo da soli',
        'execute_install' => 'Esegui installazione',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normale',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Non installato',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Pronto per l\'installazione',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installazione',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installazione fallita',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Pronto per l\'aggiornamento',
        \App\Models\Plugin::STATUS_UPDATING => 'Aggiornamento',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Aggiornamento fallito',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Pronto a rimuovere',
        \App\Models\Plugin::STATUS_DELETING => 'Rimozione',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Rimuovi fallito',
    ],
];
