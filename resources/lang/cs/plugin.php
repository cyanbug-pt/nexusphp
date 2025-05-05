<?php

return [
    'actions' => [
        'install' => 'instalovat',
        'delete' => 'smazat',
        'update' => 'upgradovat',
        'install_or_update' => 'instalovat/aktualizovat',
    ],
    'labels' => [
        'display_name' => 'jméno',
        'package_ name' => 'jméno_balíčku',
        'remote_url' => 'repozitář_adresa',
        'installed_version' => 'instalovaná_verze',
        'latest_version' => 'latest_verze',
        'status' => 'Stav',
        'updated_at' => 'poslední vykonaná akce',
        ' release_date' => 'aktualizováno v',
        'install_title' => 'Přejděte do adresáře: :web_root a spusťte následující příkazy pro instalaci jako root uživatel: ',
        'introduce' => 'Detaily',
        'view_on_blog' => 'Zobrazit na blogu',
        ' config_plugin_address' => 'Konfigurace adresy pluginu',
        'download_specific_version' => 'Stáhněte rozšíření. Zde je zobrazena nejnovější verze, pokud potřebujete nainstalovat jinou verzi (zobrazit na blogu, abyste viděli všechny verze) ji přepište sami',
        'execute_install' => 'Spustit instalaci',
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
