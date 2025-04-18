<?php

return array (
  'name' => '名前',
  'email' => '郵便',
  'image' => '写真',
  'expire_at' => '有効期限',
  'username' => 'ユーザー',
  'status' => '州',
  'enabled' => '有効にする',
  'disabled' => '無効',
  'created_at' => '作成時間',
  'updated_at' => '時間を更新します',
  'begin' => '開始時間',
  'end' => '終了時間',
  'uploaded' => 'ボリュームをアップロードします',
  'downloaded' => 'ダウンロード',
  'ratio' => '共有率',
  'seed_time_required' => 'まだ植える必要があります',
  'inspect_time_left' => '残りの時間の検査',
  'added' => '時間を追加します',
  'last_access' => '最後の訪問時間',
  'priority' => '優先度',
  'priority_help' => '値が大きいほど、より高い',
  'comment' => '述べる',
  'duration' => '間隔',
  'description' => '説明する',
  'price' => '価格',
  'deadline' => '締め切り',
  'permanent' => '永続的に効果的です',
  'operator' => 'オペレーター',
  'action' => '動作します',
  'submit' => '提出する',
  'cancel' => 'キャンセル',
  'reset' => 'リセット',
  'anonymous' => '匿名',
  'infinite' => '無制限',
  'save' => '保存',
  'country' => '国家',
  'city' => '市',
  'client' => 'クライアント',
  'reason' => '理由',
  'change' => '改訂',
  'create' => '作成する',
  'created_at_begin' => '作成時間が始まります',
  'created_at_end' => '作成時間の終わり',
  'setting' => 
  array (
    'nav_text' => '設定',
    'backup' => 
    array (
      'tab_header' => 'バックアップ',
      'enabled' => '有効にするかどうか',
      'enabled_help' => 'バックアップ機能を有効にするかどうか',
      'frequency' => '頻度',
      'frequency_help' => 'バックアップ周波数',
      'hour' => '時間',
      'hour_help' => 'この時間にバックアップ',
      'minute' => '分',
      'minute_help' => '前のマイナスのこの瞬間にバックアップ。周波数が「時給」を押すと、この値は無視されます',
      'google_drive_client_id' => 'GoogleドライブクライアントID',
      'google_drive_client_secret' => 'Googleドライブクライアントの秘密',
      'google_drive_refresh_token' => 'Googleドライブの更新トークン',
      'google_drive_folder_id' => 'GoogleドライブフォルダーID',
      'via_ftp' => 'FTP経由で保存します',
      'via_ftp_help' => 'FTP経由で保存するかどうか。渡された場合は、構成情報を.envファイルに追加します。',
      'via_sftp' => 'SFTPを介して保存します',
      'via_sftp_help' => 'SFTP経由で保存するかどうか。渡された場合は、構成情報を.envファイルに追加します。',
    ),
    'hr' => 
    array (
      'tab_header' => 'H＆R',
      'mode' => 'モデル',
      'inspect_time' => '検査期間',
      'inspect_time_help' => '検査時間は、ダウンロードが完了した後に計算されます、ユニット：時間',
      'seed_time_minimum' => '種子の期間',
      'seed_time_minimum_help' => '標準を満たすための最小種子生産時間、ユニット：時間、検査時間よりも短い必要があります',
      'ignore_when_ratio_reach' => 'コンプライアンスの共有率',
      'ignore_when_ratio_reach_help' => '会議基準の最小共有率',
      'ban_user_when_counts_reach' => 'H＆R数量制限',
      'ban_user_when_counts_reach_help' => 'H＆Rの数がこの値に達すると、アカウントは無効になります',
      'include_rate' => '完了率に含まれています',
      'include_rate_help' => 'H＆Rは、ダウンロード完了率（0〜1の小数）がこの値に達した場合にのみカウントされます。デフォルト：1',
    ),
    'seed_box' => 
    array (
      'tab_header' => 'シードボックス',
      'enabled_help' => 'シードボックスルールを有効にするかどうか',
      'no_promotion' => '割引なし',
      'no_promotion_help' => '割引はありません、アップロードボリューム/ダウンロードボリュームは実際の値に基づいて計算されます',
      'max_uploaded' => '最大アップロード倍数',
      'max_uploaded_help' => 'アップロードの最大数は、その体積の数です。そのような制限は0に設定されていません',
      'not_seed_box_max_speed' => '非シードボックスの最大速度制限',
      'not_seed_box_max_speed_help' => 'ユニット：MBPS。この値が超過してSeedboxレコードと一致できない場合、ダウンロード許可は無効になります。',
      'max_uploaded_duration' => '最大アップロード複数の有効な時間範囲',
      'max_uploaded_duration_help' => 'ユニット：時間。この時間の範囲内で、種子が放出された後、最大アップロードされた複数の倍数が有効になり、この範囲の後は有効になりません。 0に設定し、常に有効になります',
    ),
    'meilisearch' => 
    array (
      'tab_header' => '私を検索してください',
      'enabled' => 'Meilisearchを有効にするかどうか',
      'enabled_help' => '最初にデータをインストールして設定して、有効にする前にデータをインストールしてください。そうしないと、シード検索にデータがありません',
      'search_description' => '説明を検索するかどうか',
      'search_description_help' => 'デフォルト：「いいえ」。 「はい」の場合、説明に含まれるキーワードも返され、さらにヒットがある可能性があります。変更の直後に再輸入されます',
      'default_search_mode' => 'デフォルトの検索モード',
      'default_search_mode_help' => 'デフォルト：「正確」。 \'そして、「正確」は区別されません',
    ),
    'system' => 
    array (
      'tab_header' => 'システム',
      'change_username_card_allow_characters_outside_the_alphabets' => '名前の変更カードは、英語の文字以外の文字を許可していますか？',
      'change_username_min_interval_in_days' => 'ユーザー名の変更の間の最小日数',
      'maximum_number_of_medals_can_be_worn' => 'ウェアラブルメダルの最大数',
      'cookie_valid_days' => 'Cookie有効な日',
      'maximum_upload_speed' => '最大アップロード速度',
      'maximum_upload_speed_help' => 'この値は、詐欺師の検出に影響を及ぼし、保守的な検出レベルの最大アップロード速度です。実際の速度制限=最大アップロード速度/検出レベル、保守的〜疑わしいものから1〜4まで。最大速度制限が1000の場合、検出レベルは保守的で、実際の速度制限は1000/1 = 1000、検出レベルは疑わしく、実際の速度制限は1000/4 = 250です。単一のアップロード速度が実際の速度制限を超えると、アカウントはすぐに無効になります。ここのユニットは、次のようなMBPSです。100Mbps= 12.5 MB/s。',
      'is_invite_pre_email_and_username' => '電子メールとユーザー名の招待を予約するかどうか',
      'is_invite_pre_email_and_username_help' => 'デフォルト：「いいえ」。予約を行うと、ユーザーは登録時に電子メールアドレスとユーザー名を変更できません。',
      'access_admin_class_min' => 'ログイン管理の背景の最小レベル',
      'access_admin_class_min_help' => 'デフォルト：管理者、ユーザーレベルが設定値以上のユーザーが管理の背景にログインできるユーザー',
      'alarm_email_receiver' => 'アラームメール受信者',
      'alarm_email_receiver_help' => 'ユーザーUIDに入力し、複数のスペースを個別に入力すると、システム例外アラームメールが対応するユーザーのメールアドレスに送信されます。記入されていない場合、それは実行ログに書き込まれ、ログレベルはエラーです',
    ),
    'image_hosting' => 
    array (
      'driver' => 'ストレージの場所',
      'driver_help' => '[ローカル]を選択すると、対応するデフォルトはウェブサイトがあるサーバーにローカルに保存されます。それ以外の場合は、対応する画像サーバーにアップロードされます。',
      'tab_header' => '写真ベッド',
      'upload_api_endpoint' => 'インターフェイスアドレスをアップロードします',
      'base_url' => '画像URLプレフィックス',
      'upload_token' => 'トークンをアップロードします',
    ),
  ),
  'user' => 
  array (
    'label' => 'ユーザー',
    'uploaded' => 'ボリュームをアップロードします',
    'downloaded' => 'ダウンロード',
    'invites' => '招待する',
    'seedbonus' => '魔法',
    'attendance_card' => 'カードを再署名します',
    'class' => '学年',
    'status' => '州',
    'enabled' => '有効にする',
    'username' => 'ユーザー名',
    'invite_by' => '招待者',
    'two_step_authentication' => '2段階の検証',
    'seed_points' => 'スコアを作ります',
    'downloadpos' => '許可をダウンロードします',
    'parked' => '電話を切る',
    'offer_allowed_count' => '候補者の数',
    'tmp_invites' => '一時的な招待',
  ),
  'medal' => 
  array (
    'label' => 'メダル',
    'image_large' => '大きな写真',
    'image_small' => '小さな写真',
    'get_type' => '取得方法',
    'duration' => '有効な期間',
    'duration_help' => 'ユニット：日。空白のままにすると、ユーザーは常にそれを持っています',
    'display_on_medal_page' => 'メダルページに表示されます',
  ),
  'user_medal' => 
  array (
    'label' => 'ユーザーメダル',
  ),
  'exam' => 
  array (
    'label' => '評価とタスク',
    'is_done' => 'それは完了ですか',
    'is_discovered' => '自動発見',
    'register_time_range' => 
    array (
      'begin' => '登録時間が始まります',
      'end' => '登録時間の終了',
    ),
    'register_days_range' => 
    array (
      'begin' => '登録日の最小数',
      'end' => '最も登録日',
    ),
    'donated' => '寄付するかどうか',
    'index_formatted' => '評価指標',
    'filter_formatted' => 'ターゲットユーザー',
    'section_base_info' => '基本情報',
    'priority_help' => '値が高いほど、優先度が高くなります。ユーザーが複数の評価を一致させると、優先度の高い割り当てが優先度が高くなります。',
    'section_time' => '時間',
    'duration_help' => 'ユニット：日。ユーザーに割り当てられた場合、開始/終了時間が指定されている場合、ユーザー評価の時間範囲はこの範囲です。それ以外の場合、ユーザー評価の開始時間は割り当てられた時間であり、終了時間は開始時間と期間です。',
    'section_target_user' => 'ターゲットユーザー',
    'index_required_value' => '必要な数量',
    'index_required_label' => '索引',
    'index_placeholder' => '増分/ダウンロード増分ユニットはGBで、平均時間単位は次のとおりです。',
    'index_current_value' => '現在の量',
    'index_result' => '結果',
  ),
  'exam_user' => 
  array (
    'label' => 'ユーザー評価',
    'is_done' => 'それは完了ですか',
  ),
  'torrent' => 
  array (
    'label' => 'シード',
    'owner' => '発行',
    'size' => 'サイズ',
    'ttl' => '生存の時間',
    'seeders' => '種を作る',
    'leechers' => 'ダウンロード',
    'times_completed' => '完了時間数',
    'category' => 'タイプ',
    'approval_status' => 'ステータスを確認します',
    'pos_state' => 'トップ',
    'sp_state' => '割引',
    'visible' => '生きている種',
    'source' => 'ソース',
    'codec' => 'コーディング',
    'audiocodec' => 'オーディオエンコーディング',
    'medium' => '中くらい',
    'team' => '制作チーム',
    'processing' => '対処する',
    'standard' => '解決',
    'picktype' => '推薦する',
    'promotion_time_type' => '割引時間タイプ',
    'hr' => 'H＆R',
    'added_begin' => '以下のリリース時間',
    'added_end' => 'リリース時間は未満です',
    'size_begin' => 'より大きい',
    'size_end' => 'より小さい',
    'price' => '価格',
    'price_help' => 'ユーザーがシードをダウンロードすると、出版社は収入を受け取りますが、対応する税率は差し引かれます。現在の税率:: tax_factor',
    'max_price_help' => '最大許可:: max_price',
  ),
  'hit_and_run' => 
  array (
    'label' => 'ユーザーH＆R',
  ),
  'tag' => 
  array (
    'label' => 'ラベル',
    'color' => '背景色',
    'font_color' => 'フォントカラー',
    'font_size' => 'フォントサイズ',
    'margin' => '外縁',
    'padding' => '内側のマージン',
    'border_radius' => '境界線の角',
    'torrents_count' => '種子の数',
    'torrents_sum_size' => 'シードボリューム',
  ),
  'agent_allow' => 
  array (
    'label' => 'クライアントを許可します',
    'family' => 'シリーズ',
    'start_name' => '開始名',
    'peer_id_start' => 'ピアIDスタート',
    'peer_id_pattern' => 'ピアIDの規則性',
    'peer_id_matchtype' => 'ピアIDマッチタイプ',
    'peer_id_match_num' => 'ピアIDの一致時間',
    'agent_start' => 'エージェントスタート',
    'agent_pattern' => 'エージェントの規則性',
    'agent_matchtype' => 'エージェントマッチタイプ',
    'agent_match_num' => 'エージェントマッチ',
    'exception' => '除外します',
    'allowhttps' => 'HTTPSを許可します',
  ),
  'agent_deny' => 
  array (
    'label' => 'クライアントを拒否します',
    'peer_id' => 'ピアIDスタート',
    'agent' => 'エージェント',
  ),
  'claim' => 
  array (
    'label' => '受信したユーザー',
    'last_settle_at' => '最後のチェックアウト時間',
    'seed_time_this_month' => '今月の植え付け時間',
    'uploaded_this_month' => '今月はアップロードします',
    'is_reached_this_month' => '今月は基準が満たされますか',
  ),
  'torrent_state' => 
  array (
    'label' => 'サイト全体の割引',
    'global_sp_state' => 'サイト全体の割引',
  ),
  'role' => 
  array (
    'class' => '関連するユーザーレベル',
  ),
  'ability' => 
  array (
    'name' => 'ロゴ',
    'title' => '名前',
  ),
  'seed_box_record' => 
  array (
    'label' => 'シードボックスレコード',
    'type' => 'タイプを追加します',
    'operator' => 'オペレーター',
    'bandwidth' => '帯域幅（MBPS）',
    'ip' => 'IP（セグメント）',
    'ip_begin' => 'IPを開始します',
    'ip_end' => 'IPを終了します',
    'ip_help' => 'asn/start ip + end ip/ip（segment）に入力してください。同時に記入しないでください',
    'status' => '州',
    'is_allowed' => 'ホワイトリストですか？',
    'is_allowed_help' => 'ホワイトリストのIPSはシードボックスルールの影響を受けません',
    'asn' => 'asn',
  ),
  'menu' => 
  array (
    'label' => 'メニューをカスタマイズします',
    'enable_help' => 'カスタムメニューを有効にするかどうか',
  ),
  'menu_item' => 
  array (
    'label' => 'メニュー項目',
    'url' => 'リンク',
    'text' => 'テキストを表示します',
    'target' => 'オープンメソッド',
    'style' => 'スタイル',
    'parent_id' => '親メニュー',
    'min_class' => '最小可視レベル',
  ),
  'user_meta' => 
  array (
    'meta_keys' => 
    array (
      'CHANGE_USERNAME' => '名前の変更カード',
      'PERSONALIZED_USERNAME' => 'レインボーID',
    ),
  ),
  'search_box' => 
  array (
    'label' => '分類モード',
    'name' => '名前',
    'section_name' => 'パーティション名',
    'section_name_help' => '設定すると、メニューに表示されます',
    'is_default' => 'デフォルトかどうか',
    'showsubcat' => 'サブカテゴリ',
    'taxonomies' => '分類方法',
    'taxonomy_display_text' => 'ドキュメントを表示します',
    'torrent_field' => 'シードテーブルフィールド',
    'catsperrow' => '1行あたりのアイテム数',
    'catsperrow_help' => '「8」など、検索ボックスに各行に表示されるアイテムの数を設定します。',
    'catpadding' => 'プロジェクト間隔',
    'catpadding_help' => 'ユニットはピクセルです。 「3」など、ボックス内のアイテムの水平間隔距離を検索します。',
    'custom_fields' => '自己単語の意味フィールドを有効にします',
    'custom_fields_display_name' => 'カスタムフィールド表示名',
    'custom_fields_display' => 'カスタムフィールド表示',
    'custom_fields_display_help' => '特別なラベルを使用して、フィールドの名前と価値を表します。フィールドにアーティストの名前がある場合、その名前は次のとおりです。',
    'category' => '分類',
    'torrent_field_duplicate' => 'シードテーブルフィールド：：フィールドは再利用できません！',
    'other' => '他の',
    'taxonomy' => 
    array (
      'name' => '名前',
      'sort_index' => '選別',
      'sort_index_help' => 'インクリメンタルソート、つまり、「0」が上部にあります。',
      'class_name' => 'クラス属性値',
      'class_name_help' => '画像のクラス属性値を指定します。そうでない場合は、空白のままにしてください。許可された文字：[a-z]（小文字）、[0-9]、[_]、最初の文字は文字でなければなりません。',
      'image' => '画像ファイル名',
      'image_help' => '画像ファイルの名前。許可された文字：[a-z]（小文字）、[0-9]、[_。/]。',
      'icon_id' => 'カテゴリアイコン',
      'mode' => '分類モード',
      'mode_help' => 'すべてのクラスモードに適用するために空白のままにします',
    ),
  ),
  'icon' => 
  array (
    'label' => 'カテゴリアイコン',
    'folder' => 'アイコンフォルダー',
    'folder_help' => 'カテゴリアイコンが存在するフォルダーの名前。許可された文字：[a-z]（小文字）、[0-9]、[_。/]。 「mycaticon/」など、最後にスラッシュ（/）を追加する必要があります',
    'cssfile' => 'CSSファイル',
    'cssfile_help' => 'この分類アイコンにCSSファイルを指定します。 「スタイル/sceneTorrents.css」などのフルパスを埋めます。そうでない場合は、空白のままにしてください。許可された文字：[a-z]（小文字）、[0-9]、[_。/]。',
    'multilang' => '多言語',
    'multilang_help' => '異なる言語で異なる分類アイコンを使用するかどうか。 「はい」に設定されている場合、「en」という名前のフォルダー、「CHS」などに複数のアイコンを入れます。',
    'secondicon' => '2番目のアイコン',
    'secondicon_help' => '2番目のアイコンを使用して補足情報を表示するかどうか。 「はい」に設定されている場合、2番目のアイコンを通常のアイコンディレクトリに「追加」という名前のフォルダーに配置します。',
    'designer' => 'デザイナー',
    'designer_help' => 'このアイコンセットのデザイナー。',
    'comment' => '説明します',
    'comment_help' => 'このアイコンセットの説明。',
    'desc' => '次の設定を機能させるには、サーバーの正しいディレクトリにアイコンファイルを配置する必要があります。通常の分類アイコンを「PIC/カテゴリ/分類パターン名/アイコンフォルダー[言語略語/]」に入れ、2番目のアイコンを「PIC/カテゴリ/分類パターン名/アイコンフォルダー[言語略語/]追加/」に入れます。わかりませんか？次の例を参照してください。
いつ
    分類パターン名= \'NHD\'
    ICON FOLDER = \'SceneTorrents/\'
    MultiNINGUAL = \'はい\'
    2番目のicon = \'no\'
英語ムービータイプのアイコン（ \'movies.png\'など）ファイルを「pic/category/nhd/scenetorrents/en/」に入れる必要があります。
いつ
    分類パターンname = \'chd\'
    アイコンフォルダー= \'nanosofts/\'
    MultIningual = \'no\'
    2番目のアイコン= \'はい\'
ムービータイプのアイコン（ \'movies.png\'など）ファイルを「pic/category/chd/nanosofts/」に、2番目のアイコン（ \'bdh264.png\'など）に「pic/category/chd/nanosofts/aditional/\'に入れる必要があります。

注：1.8では、「カテゴリパターン名」の部分を省略できます。つまり、ルールは「pic/category/iconフォルダー[言語略語/]」です。',
  ),
  'second_icon' => 
  array (
    'label' => '2番目のアイコン',
    'name' => '名前',
    'name_help' => '長すぎる名前を使用しないでください。 10文字以内にすることをお勧めします。',
    'image' => '画像ファイル名',
    'image_help' => '画像ファイルの名前。許可された文字：[a-z]（小文字）、[0-9]、[_。/]。',
    'class_name' => 'クラス属性値',
    'class_name_help' => '画像のクラス属性値を指定します。そうでない場合は、空白のままにしてください。許可された文字：[a-z]（小文字）、[0-9]、[_]、最初の文字は文字でなければなりません。',
    'select_section' => '選ぶ',
    'select_section_help' => '選択が指定されていない場合、そのすべてのオプションはこのルールに準拠しています。少なくとも1つの選択を指定する必要があります。',
  ),
);
