<?php

return array (
    'invalid_price' => '無效的價格：:price',
  'invalid_category' => '無效的分類',
  'invalid_section' => '無效的分區',
  'invalid_hr' => '無效的 H&R 值',
  'invalid_pos_state' => '無效的位置：:pos_state',
  'invalid_pos_state_until' => '無效的位置截止時間',
  'not_supported_sub_category_field' => '不支持的子分類字段：:field',
  'invalid_sub_category_value' => '子分類字段：:label(:field) 的值：:value 無效',
  'invalid_tag' => '無效的標籤：:tag',
  'invalid_pick_type' => '無效的推薦：:pick_type',
  'require_name' => '標題不能為空',
  'price_too_much' => '價格超過允許範圍',
  'approval_deny_reach_upper_limit' => '當前審核被拒絕的種子數：%s 達到上限，不允許發布。',
  'special_section_not_enabled' => '特別區未啟用。',
  'paid_torrent_not_enabled' => '收費種子未啟用。',
  'no_permission_to_set_torrent_hr' => '沒有權限設置種子 H&R。',
  'no_permission_to_set_torrent_pos_state' => '沒有權限設置種子置頂。',
  'no_permission_to_set_torrent_price' => '沒有權限設置種子收費。',
  'no_permission_to_pick_torrent' => '沒有權限推薦影片。',
  'no_permission_to_be_anonymous' => '沒有權限匿名發布。',
  'torrent_save_dir_not_exists' => '種子保存目錄不存在。',
  'torrent_save_dir_not_writable' => '種子保存目錄不可寫。',
  'save_torrent_file_failed' => '保存種子文件失敗。',
  'upload_failed' => '上傳失敗！',
  'missing_form_data' => '請填寫必填項目',
  'missing_torrent_file' => '缺少種子文件',
  'empty_filename' => '文件名不能為空！',
  'zero_byte_nfo' => 'NFO文件為空',
  'nfo_too_big' => 'NFO文件過大！最大允許65,535 bytes。',
  'nfo_upload_failed' => 'NFO文件上傳失敗',
  'blank_description' => '你必須填寫簡介！',
  'category_unselected' => '你必須選擇類型！',
  'invalid_filename' => '無效的文件名！',
  'filename_not_torrent' => '無效的文件名(不是.torrent文件).',
  'empty_file' => '空文件！',
  'not_bencoded_file' => '你在搞什麼鬼？你上傳的不是Bencode文件！',
  'not_a_dictionary' => '不是目錄',
  'dictionary_is_missing_key' => '目錄缺少值',
  'invalid_entry_in_dictionary' => '無效的目錄項',
  'invalid_dictionary_entry_type' => '無效的目錄項類型',
  'invalid_pieces' => '無效的文件塊',
  'missing_length_and_files' => '缺少長度和文件',
  'filename_errors' => '文件名錯誤',
  'uploaded_not_offered' => '你只能上傳通過候選的種子，請返回在<b>你的候選</b>中選擇合適項目後再上傳！',
  'unauthorized_upload_freely' => '你沒有自由上傳的權限！',
  'torrent_existed' => '該種子已存在！id: :id',
  'torrent_file_too_big' => '種子文件過大！最大允許',
  'remake_torrent_note' => 'bytes。請使用更大的區塊大小重新製作種子文件，或者將內容分為多個種子發布。',
  'email_notification_body' => '你好，
一個新的種子已經上傳.

名稱：:name
大小：:size
類型：:category
上傳者：:upload_by

簡介：
:description

查看更為詳細的信息並下載（你可能需要登錄），請點擊這裡：<b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>這裡</a></b>
:torrent_url

:site_name 網站',
  'email_notification_subject' => ':site_name 新種子通知',
);
