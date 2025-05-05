<?php

return [
    'actions' => [
        'install' => 'instalar',
        'delete' => 'Excluir',
        'update' => 'atualização',
        'install_or_update' => 'instalar/atualizar',
    ],
    'labels' => [
        'display_name' => 'Nome',
        'package_ name' => 'nome_pacote',
        'remote_url' => 'endereço_repositório',
        'installed_version' => 'versão_instalada',
        'latest_version' => 'última_versão',
        'status' => 'Status',
        'updated_at' => 'última_ação_executada_',
        ' release_date' => 'atualizado em',
        'install_title' => 'Vá para o diretório: :web_root, e execute os seguintes comandos para instalá-lo como usuário raiz: ',
        'introduce' => 'detalhes',
        'view_on_blog' => 'Ver no blog',
        ' config_plugin_address' => 'Configurar endereço do plugin',
        'download_specific_version' => 'Baixe a extensão. A versão mais recente é exibida aqui, se você precisar instalar outra versão (ver no blog para ver todas as versões) substitua-a você mesmo.',
        'execute_install' => 'Executar instalação',
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
