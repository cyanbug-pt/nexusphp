<?php

return [
    'actions' => [
        'install' => 'Instalovat',
        'delete' => 'Odebrat',
        'update' => 'Vylepšit',
    ],
    'labels' => [
        'display_name' => 'Název',
        'package_name' => 'Název balíčku',
        'remote_url' => 'Adresa repozitáře',
        'installed_version' => 'Nainstalovaná verze',
        'status' => 'Stav',
        'updated_at' => 'Poslední akce na',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normální',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Není nainstalováno',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Připraveno k instalaci',
        \App\Models\Plugin::STATUS_INSTALLING => 'Instalace',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Instalace selhala',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Připraveno k aktualizaci',
        \App\Models\Plugin::STATUS_UPDATING => 'Modernizace',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Aktualizace se nezdařila',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Připraveno k odstranění',
        \App\Models\Plugin::STATUS_DELETING => 'Odstranění',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Odstranění selhalo',
    ],
];
