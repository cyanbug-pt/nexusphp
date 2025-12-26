<?php

return [
    'actions' => [
        'install' => 'install',
        'delete' => 'delete',
        'update' => 'upgrade',
        'install_or_update' => 'install/upgrade',
    ],
    'labels' => [
        'display_name' => 'name',
        'package_ name' => 'package_name',
        'remote_url' => 'repository_address',
        'installed_version' => 'installed_version',
        'latest_version' => 'latest_version',
        'status' => 'status',
        'updated_at' => 'last_executed_action',
        ' release_date' => 'updated at',
        'install_title' => 'Go to the directory: :web_root, and run the following commands in order to install it as the root user: ',
        'introduce' => 'Details',
        'view_on_blog' => 'View on blog',
        ' config_plugin_address' => 'Configure plugin address',
        'download_specific_version' => 'Download the extension. The latest version is shown here, if you need to install another version (view on blog to see all versions) replace it yourself',
        'execute_install' => 'Execute installation',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Not installed',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Ready to install',
        \App\Models\Plugin::STATUS_INSTALLING => 'Installing',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Install fail',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Ready to upgrade',
        \App\Models\Plugin::STATUS_UPDATING => 'Upgrading',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Upgrade fail',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Ready to remove',
        \App\Models\Plugin::STATUS_DELETING => 'Removing',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Remove fail',
    ],
];
