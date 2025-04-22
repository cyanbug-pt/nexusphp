<?php

return [
    'actions' => [
        'install' => 'Instale',
        'delete' => 'Excluir',
        'update' => 'PRO',
    ],
    'labels' => [
        'display_name' => 'Nome:',
        'package_name' => 'Nome do pacote',
        'remote_url' => 'Endereço do repositório',
        'installed_version' => 'Versão instalada',
        'status' => 'SItuação',
        'updated_at' => 'Última ação em',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'normal',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Não instalado',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Pronto para instalar',
        \App\Models\Plugin::STATUS_INSTALLING => 'Instalando',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Falha na instalação',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Pronto para atualização',
        \App\Models\Plugin::STATUS_UPDATING => 'Atualizando',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Falha na atualização',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Pronto para remover',
        \App\Models\Plugin::STATUS_DELETING => 'Removendo',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Remover falha',
    ],
];
