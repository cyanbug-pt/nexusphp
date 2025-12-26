<?php

return [
    'actions' => [
        'install' => 'インストール',
        'delete' => '削除',
        'update' => 'アップグレード',
        'install_or_update' => 'インストール/アップグレード',
    ],
    'labels' => [
        'display_name' => '名前',
        'package_ name' => 'package_name',
        'remote_url' => 'リポジトリのアドレス',
        'installed_version' => 'installed_version',
        'latest_version' => 'latest_version',
        'status' => 'ステータス',
        'updated_at' => 'last_executed_action',
        ' release_date' => '更新日時',
        'install_title' => 'ディレクトリに移動します: :web_root 以下のコマンドを実行して、ルートユーザーとしてインストールします。 ',
        'introduce' => '詳細',
        'view_on_blog' => 'ブログで表示',
        ' config_plugin_address' => 'プラグインアドレスを設定',
        'download_specific_version' => '拡張機能をダウンロードします。 最新のバージョンがここに表示されます。別のバージョンをインストールする必要がある場合（すべてのバージョンを表示するには、ブログで表示）は、自分で置き換えます',
        'execute_install' => 'インストールを実行',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => '標準',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'インストールされていません',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'インストールの準備ができました',
        \App\Models\Plugin::STATUS_INSTALLING => 'インストール中',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'インストールに失敗しました',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'アップグレード準備完了',
        \App\Models\Plugin::STATUS_UPDATING => 'アップグレード中',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'アップグレードに失敗しました',

        \App\Models\Plugin::STATUS_PRE_DELETE => '削除する準備ができました',
        \App\Models\Plugin::STATUS_DELETING => '削除中',
        \App\Models\Plugin::STATUS_DELETE_FAILED => '削除に失敗しました',
    ],
];
