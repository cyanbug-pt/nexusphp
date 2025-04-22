<?php

return [
    'actions' => [
        'install' => 'Instalar',
        'delete' => 'Eliminar',
        'update' => 'Mejorar',
    ],
    'labels' => [
        'display_name' => 'Nombre',
        'package_name' => 'Nombre del paquete',
        'remote_url' => 'Dirección del repositorio',
        'installed_version' => 'Versión instalada',
        'status' => 'Estado',
        'updated_at' => 'Última acción en',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'No instalado',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Listo para instalar',
        \App\Models\Plugin::STATUS_INSTALLING => 'Instalando',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Instalación fallida',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Listo para actualizar',
        \App\Models\Plugin::STATUS_UPDATING => 'Actualizando',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Fallo al actualizar',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Listo para eliminar',
        \App\Models\Plugin::STATUS_DELETING => 'Eliminando',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Error al eliminar',
    ],
];
