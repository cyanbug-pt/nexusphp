<?php

return [
    'actions' => [
        'install' => 'instalează',
        'delete' => 'şterge',
        'update' => 'upgradează',
        'install_or_update' => 'instalează/upgradează',
    ],
    'labels' => [
        'display_name' => 'nume',
        'package_ name' => 'nume_pachet',
        'remote_url' => 'adresă_repozitori_',
        'installed_version' => 'versiune instalată',
        'latest_version' => 'versiune latest_',
        'status' => 'status',
        'updated_at' => 'ultima acțiune_executată_',
        ' release_date' => 'actualizat la',
        'install_title' => 'Mergeți la director: :web_root, și executați următoarele comenzi pentru a le instala ca utilizator root: ',
        'introduce' => 'Detalii',
        'view_on_blog' => 'Vezi pe blog',
        ' config_plugin_address' => 'Configurați adresa extensiei',
        'download_specific_version' => 'Descarcă extensia. Cea mai recentă versiune este afișată aici, dacă ai nevoie să instalezi o altă versiune (vizualizare pe blog pentru a vedea toate versiunile) o înlocuiești.',
        'execute_install' => 'Execută instalarea',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normală',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Nu este instalat',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Gata de instalare',
        \App\Models\Plugin::STATUS_INSTALLING => 'Instalare',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Instalare eșuată',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Gata de actualizare',
        \App\Models\Plugin::STATUS_UPDATING => 'Actualizare',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Actualizare eșuată',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Pregătit pentru eliminare',
        \App\Models\Plugin::STATUS_DELETING => 'Eliminare',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Eliminare eșuată',
    ],
];
