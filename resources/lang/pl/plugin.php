<?php

return [
    'actions' => [
        'install' => 'Zainstaluj',
        'delete' => 'Usuń',
        'update' => 'Ulepsz',
    ],
    'labels' => [
        'display_name' => 'Nazwisko',
        'package_name' => 'Nazwa pakietu',
        'remote_url' => 'Adres repozytorium',
        'installed_version' => 'Zainstalowana wersja',
        'status' => 'Status',
        'updated_at' => 'Ostatnia akcja w',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normalny',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Nie zainstalowano',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Gotowy do zainstalowania',
        \App\Models\Plugin::STATUS_INSTALLING => 'Instalowanie',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Nieudana instalacja',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Gotowy do uaktualnienia',
        \App\Models\Plugin::STATUS_UPDATING => 'Aktualizacja',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Aktualizacja nie powiodła się',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Gotowy do usunięcia',
        \App\Models\Plugin::STATUS_DELETING => 'Usuwanie',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Usunięcie nie powiodło się',
    ],
];
