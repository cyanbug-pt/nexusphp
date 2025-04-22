<?php

return [
    'actions' => [
        'install' => 'Установить',
        'delete' => 'Удалить',
        'update' => 'Улучшить',
    ],
    'labels' => [
        'display_name' => 'Наименование',
        'package_name' => 'Имя пакета',
        'remote_url' => 'Адрес репозитория',
        'installed_version' => 'Установленная версия',
        'status' => 'Статус',
        'updated_at' => 'Последнее действие в',
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
