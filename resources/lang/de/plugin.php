<?php

return [
    'actions' => [
        'install' => 'installieren',
        'delete' => 'löschen',
        'update' => 'upgraden',
        'install_or_update' => 'installieren/upgraden',
    ],
    'labels' => [
        'display_name' => 'name',
        'package_ name' => 'package_name',
        'remote_url' => 'repository_adresse',
        'installed_version' => 'installierte Version',
        'latest_version' => 'neueste Version',
        'status' => 'status',
        'updated_at' => 'zuletzt ausgeführte Aktion',
        ' release_date' => 'aktualisiert am',
        'install_title' => 'Gehen Sie zum Verzeichnis: :web_root und führen Sie die folgenden Befehle aus, um es als Root-Benutzer zu installieren: ',
        'introduce' => 'Details',
        'view_on_blog' => 'Im Blog anzeigen',
        ' config_plugin_address' => 'Plugin-Adresse konfigurieren',
        'download_specific_version' => 'Die Erweiterung herunterladen. Die neueste Version wird hier angezeigt, wenn Sie eine andere Version installieren müssen (im Blog sehen, um alle Versionen zu sehen) ersetzen Sie sie selbst',
        'execute_install' => 'Installation ausführen',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Nicht installiert',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Bereit zur Installation',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installiere',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Installation fehlgeschlagen',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Bereit zum Upgrade',
        \App\Models\Plugin::STATUS_UPDATING => 'Upgrade',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Upgrade fehlgeschlagen',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Bereit zum Entfernen',
        \App\Models\Plugin::STATUS_DELETING => 'Entfernen',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Fehler entfernen',
    ],
];
