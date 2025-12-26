<?php

return [
    'actions' => [
        'install' => 'zainstaluj',
        'delete' => 'usuń',
        'update' => 'aktualizacja',
        'install_or_update' => 'instalacja/aktualizacja',
    ],
    'labels' => [
        'display_name' => 'Nazwa',
        'package_ name' => 'nazwa_pakietu',
        'remote_url' => 'adres_repozytorium',
        'installed_version' => 'zainstalowana_wersja',
        'latest_version' => 'Ostatnia wersja',
        'status' => 'status',
        'updated_at' => 'Ostatni_wykonane_akcji_',
        ' release_date' => 'zaktualizowano w',
        'install_title' => 'Przejdź do katalogu: :web_root i uruchom następujące polecenia w celu zainstalowania go jako użytkownika głównego: ',
        'introduce' => 'Szczegóły',
        'view_on_blog' => 'Zobacz na blogu',
        ' config_plugin_address' => 'Skonfiguruj adres wtyczki',
        'download_specific_version' => 'Pobierz rozszerzenie. Najnowsza wersja jest tutaj wyświetlana, jeśli chcesz zainstalować inną wersję (zobacz na blogu, aby zobaczyć wszystkie wersje) zastąp ją sam.',
        'execute_install' => 'Wykonaj instalację',
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
