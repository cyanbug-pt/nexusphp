<?php

return [
    'actions' => [
        'install' => 'Instalează',
        'delete' => 'Elimină',
        'update' => 'Actualizează',
    ],
    'labels' => [
        'display_name' => 'Nume',
        'package_name' => 'Numele pachetului',
        'remote_url' => 'Adresă depozit',
        'installed_version' => 'Versiunea instalată',
        'status' => 'Status',
        'updated_at' => 'Ultima acţiune la',
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
