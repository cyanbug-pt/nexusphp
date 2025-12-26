<?php

return [
    'actions' => [
        'install' => 'installer',
        'delete' => 'supprimer',
        'update' => 'mise à jour',
        'install_or_update' => 'installer/mettre à jour',
    ],
    'labels' => [
        'display_name' => 'Nom',
        'package_ name' => 'nom_du_paquet',
        'remote_url' => 'Adresse du dépôt',
        'installed_version' => 'Version installée',
        'latest_version' => 'dernier_version',
        'status' => 'statuts',
        'updated_at' => 'action_dernière_exécutée',
        ' release_date' => 'mis à jour le',
        'install_title' => 'Allez dans le répertoire: :web_root, et exécutez les commandes suivantes pour l\'installer en tant qu\'utilisateur root: ',
        'introduce' => 'Détails du produit',
        'view_on_blog' => 'Voir sur le blog',
        ' config_plugin_address' => 'Configurer l\'adresse du plugin',
        'download_specific_version' => 'Télécharger l\'extension. La dernière version est affichée ici, si vous avez besoin d\'installer une autre version (afficher sur le blog pour voir toutes les versions) le remplacer vous-même',
        'execute_install' => 'Exécuter l\'installation',
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
