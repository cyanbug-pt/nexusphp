<?php

return array (
    'invalid_price' => '価格が無効です: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => '無効なセクション',
  'invalid_hr' => '無効なH&R値',
  'invalid_pos_state' => '無効な位置: :pos_state',
  'invalid_pos_state_until' => '無効なポジションの期限',
  'not_supported_sub_category_field' => 'サポートされていないサブカテゴリフィールド: :field',
  'invalid_sub_category_value' => 'サブカテゴリフィールド: :label(:field) 値: :value 無効',
  'invalid_tag' => '無効な tag::tag',
  'invalid_pick_type' => 'Invalid recommendation::pick_type',
  'require_name' => 'タイトルは空にできません',
  'price_too_much' => '価格が許容範囲を超えています',
  'approval_deny_reach_upper_limit' => '現在のレビューで拒否されたトレントの数: %s は上限に達し、公開は許可されていません。',
  'special_section_not_enabled' => '特別ゾーンが有効ではありません。',
  'paid_torrent_not_enabled' => '有料トレントが有効になっていません。',
  'no_permission_to_set_torrent_hr' => 'Torrent H&R を設定する権限がありません。',
  'no_permission_to_set_torrent_pos_state' => 'トレントトップを設定する権限がありません。',
  'no_permission_to_set_torrent_price' => 'トレント料金を設定する権限がありません。',
  'no_permission_to_pick_torrent' => 'ビデオを推奨する権限がありません。',
  'no_permission_to_be_anonymous' => '匿名で公開する権限がありません。',
  'torrent_save_dir_not_exists' => 'Torrent の保存ディレクトリが存在しません。',
  'torrent_save_dir_not_writable' => 'Torrent の保存ディレクトリに書き込みができません。',
  'save_torrent_file_failed' => 'Torrent ファイルの保存に失敗しました。',
  'upload_failed' => 'アップロードに失敗しました！',
  'missing_form_data' => '必須項目を入力してください',
  'missing_torrent_file' => 'Torrent ファイルがありません',
  'empty_filename' => 'ファイル名を空にすることはできません！',
  'zero_byte_nfo' => 'NFO ファイルが空です',
  'nfo_too_big' => 'NFO ファイルが大きすぎます。最大許容バイト数は65,535です。',
  'nfo_upload_failed' => 'NFO ファイルのアップロードに失敗しました',
  'blank_description' => '紹介を記入しなければなりません！',
  'category_unselected' => 'タイプを選択する必要があります!',
  'invalid_filename' => '無効なファイル名です！',
  'filename_not_torrent' => '無効なファイル名 (.Torrent ファイルではありません)。',
  'empty_file' => 'ファイルが空です！',
  'not_bencoded_file' => '一体何をしているのですか？アップロードしたのはBencodeファイルではありません！',
  'not_a_dictionary' => 'ディレクトリではありません',
  'dictionary_is_missing_key' => 'ディレクトリの値がありません',
  'invalid_entry_in_dictionary' => '無効なディレクトリエントリ',
  'invalid_dictionary_entry_type' => '無効なディレクトリアイテムタイプ',
  'invalid_pieces' => '無効なファイルブロック',
  'missing_length_and_files' => '長さとファイルがありません',
  'filename_errors' => 'エラーファイル名',
  'uploaded_not_offered' => '候補者に合格したトレントのみをアップロードできます。アップロードする前に、 <b>あなたの候補者</b> で適切なプロジェクトを選択してください！',
  'unauthorized_upload_freely' => '自由にアップロードする権限がありません！',
  'torrent_existed' => 'トレントは既に存在します!id: :id',
  'torrent_file_too_big' => 'Torrent ファイルが大きすぎます！許可される最大値',
  'remake_torrent_note' => 'bytes. Please re-create the Torrent file with a large block size, or separate the content to multiple Torrent to publish.',
  'email_notification_body' => 'Hello,
A new torrent has been uploaded.

Name::name
Size::size
Type::category
Uploader::upload_by

Introduction:
:description

View more detailed information and download it (you may need to log in), please click here: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>here</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name 新しいトレント通知',
);
