<?php

return [
    'actions' => [
        'install' => 'Installer',
        'delete' => 'Retirer',
        'update' => 'Mise à jour',
    ],
    'labels' => [
        'display_name' => 'Nom',
        'package_name' => 'Nom du paquet',
        'remote_url' => 'Adresse du dépôt',
        'installed_version' => 'Version installée',
        'status' => 'Statut',
        'updated_at' => 'Dernière action à',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normale',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Non installé',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Prêt à installer',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installation en cours',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Échec de l\'installation',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Prêt à mettre à jour',
        \App\Models\Plugin::STATUS_UPDATING => 'Mise à jour',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Échec de la mise à jour',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Prêt à supprimer',
        \App\Models\Plugin::STATUS_DELETING => 'Enlèvement',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Suppression échouée',
    ],
];
