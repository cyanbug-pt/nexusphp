<?php

return [
    'actions' => [
        'install' => 'установить',
        'delete' => 'удалять',
        'update' => 'обновить',
        'install_or_update' => 'установка/обновление',
    ],
    'labels' => [
        'display_name' => 'имя',
        'package_ name' => 'имя пакета',
        'remote_url' => 'адрес репозитория',
        'installed_version' => 'установленная версия',
        'latest_version' => 'последняя версия',
        'status' => 'статус',
        'updated_at' => 'последний выполненный',
        ' release_date' => 'обновлено',
        'install_title' => 'Перейдите в каталог: :web_root, и выполните следующие команды, чтобы установить его как суперпользователя: ',
        'introduce' => 'Детали',
        'view_on_blog' => 'Посмотреть в блоге',
        ' config_plugin_address' => 'Настроить адрес плагина',
        'download_specific_version' => 'Скачать расширение. Последняя версия отображается здесь, если вам нужно установить другую версию (просмотреть в блоге, чтобы увидеть все версии) заменить ее самостоятельно',
        'execute_install' => 'Выполнить установку',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Обычный',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Не установлен',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Готов к установке',
        \App\Models\Plugin::STATUS_INSTALLING => 'Установка',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Ошибка установки',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Готов к обновлению',
        \App\Models\Plugin::STATUS_UPDATING => 'Обновление',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Сбой обновления',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Готов к удалению',
        \App\Models\Plugin::STATUS_DELETING => 'Удаление',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Сбой удаления',
    ],
];
