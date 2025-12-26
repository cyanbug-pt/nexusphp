<?php

return [
    'actions' => [
        'install' => 'instalar',
        'delete' => 'borrar',
        'update' => 'mejorar',
        'install_or_update' => 'instalar/actualizar',
    ],
    'labels' => [
        'display_name' => 'nombre',
        'package_ name' => 'paquete_name',
        'remote_url' => 'dirección_repositorio',
        'installed_version' => 'versión instalada',
        'latest_version' => 'última versión',
        'status' => 'estado',
        'updated_at' => 'última acción ejecutada',
        ' release_date' => 'actualizado el',
        'install_title' => 'Ve al directorio: :web_root, y ejecuta los siguientes comandos para instalarlo como usuario root: ',
        'introduce' => 'Detalles',
        'view_on_blog' => 'Ver en el blog',
        ' config_plugin_address' => 'Configurar la dirección del plugin',
        'download_specific_version' => 'Descargar la extensión. La última versión se muestra aquí, si necesitas instalar otra versión (ver en el blog para ver todas las versiones) reemplazarla tú mismo',
        'execute_install' => 'Ejecutar instalación',
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
