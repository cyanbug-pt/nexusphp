<?php

return [
    'actions' => [
        'install' => '安装',
        'delete' => '删除',
        'update' => '升级',
        'install_or_update' => '安装/升级',
    ],
    'labels' => [
        'display_name' => '名称',
        'package_name' => '包名',
        'remote_url' => '仓库地址',
        'installed_version' => '已安装版本',
        'latest_version' => '最新版本',
        'status' => '状态',
        'updated_at' => '上次执行操作',
        'release_date' => '更新时间',
        'install_title' => '进入目录: :web_root, 以 root 用户的身份依次执行以下命令进行安装: ',
        'introduce' => '详细介绍',
        'view_on_blog' => '在博客上查看',
        'config_plugin_address' => '配置插件地址',
        'download_specific_version' => '下载扩展. 这里展示的最新版本号, 如果需要安装其他版本(打开查看页面底部有显示所有版本)自行替换',
        'execute_install' => '执行安装',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => '正常',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => '未安装',

        \App\Models\Plugin::STATUS_PRE_INSTALL => '准备安装',
        \App\Models\Plugin::STATUS_INSTALLING => '安装中',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => '安装失败',

        \App\Models\Plugin::STATUS_PRE_UPDATE => '准备升级',
        \App\Models\Plugin::STATUS_UPDATING => '升级中',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => '升级失败',

        \App\Models\Plugin::STATUS_PRE_DELETE => '准备删除',
        \App\Models\Plugin::STATUS_DELETING => '删除中',
        \App\Models\Plugin::STATUS_DELETE_FAILED => '删除失败',
    ],
];
