<?php

return [
    'actions' => [
        'install' => '安裝',
        'delete' => '刪除',
        'update' => '升級',
        'install_or_update' => '安裝/升級',
    ],
    'labels' => [
        'display_name' => '名稱',
        'package_name' => '包名',
        'remote_url' => '倉庫地址',
        'installed_version' => '已安裝版本',
        'latest_version' => '最新版本',
        'status' => '狀態',
        'updated_at' => '上次執行操作',
        'release_date' => '更新時間',
        'install_title' => '進入目錄: :web_root, 以 root 用戶的身份依次執行以下命令進行安裝: ',
        'introduce' => '詳細介紹',
        'view_on_blog' => '在博客上查看',
        'config_plugin_address' => '配置插件地址',
        'download_specific_version' => '下載擴展. 這裏展示的最新版本號, 如果需要安裝其他版本(打開查看頁面底部有顯示所有版本)自行替換',
        'execute_install' => '執行安裝',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => '正常',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => '未安裝',

        \App\Models\Plugin::STATUS_PRE_INSTALL => '準備安裝',
        \App\Models\Plugin::STATUS_INSTALLING => '安裝中',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => '安裝失敗',

        \App\Models\Plugin::STATUS_PRE_UPDATE => '準備升級',
        \App\Models\Plugin::STATUS_UPDATING => '升級中',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => '升級失敗',

        \App\Models\Plugin::STATUS_PRE_DELETE => '準備刪除',
        \App\Models\Plugin::STATUS_DELETING => '刪除中',
        \App\Models\Plugin::STATUS_DELETE_FAILED => '刪除失敗',
    ],
];
