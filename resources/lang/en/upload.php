<?php

return array (
    'invalid_price' => 'Invalid price: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Invalid section',
  'invalid_hr' => 'Invalid H&R value',
  'invalid_pos_state' => 'Invalid position: :pos_state',
  'invalid_pos_state_until' => 'Invalid position deadline',
  'not_supported_sub_category_field' => 'Unsupported subcategory fields: :field',
  'invalid_sub_category_value' => 'Subcategory field: :label(:field) value: :value invalid',
  'invalid_tag' => 'Invalid tag::tag',
  'invalid_pick_type' => 'Invalid recommendation::pick_type',
  'require_name' => 'The title cannot be empty',
  'price_too_much' => 'Price exceeds the allowable range',
  'approval_deny_reach_upper_limit' => 'The number of torrent rejected for the current review: %s reaches the upper limit and publishing is not allowed.',
  'special_section_not_enabled' => 'Special zone is not enabled.',
  'paid_torrent_not_enabled' => 'The paid torrent is not enabled.',
  'no_permission_to_set_torrent_hr' => 'No permission to set torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'There is no permission to set torrent top.',
  'no_permission_to_set_torrent_price' => 'No permission to set torrent charges.',
  'no_permission_to_pick_torrent' => 'No permission to recommend videos.',
  'no_permission_to_be_anonymous' => 'No permission to publish anonymously.',
  'torrent_save_dir_not_exists' => 'The torrent save directory does not exist.',
  'torrent_save_dir_not_writable' => 'The torrent save directory is not writable.',
  'save_torrent_file_failed' => 'Saving the torrent file failed.',
  'upload_failed' => 'Upload failed!',
  'missing_form_data' => 'Please fill in the required items',
  'missing_torrent_file' => 'Missing torrent file',
  'empty_filename' => 'The file name cannot be empty!',
  'zero_byte_nfo' => 'NFO file is empty',
  'nfo_too_big' => 'The NFO file is too large! Maximum allowable by 65,535 bytes.',
  'nfo_upload_failed' => 'NFO file upload failed',
  'blank_description' => 'You must fill in the introduction!',
  'category_unselected' => 'You have to choose the type!',
  'invalid_filename' => 'Invalid file name!',
  'filename_not_torrent' => 'Invalid file name (not .torrent file).',
  'empty_file' => 'Empty file!',
  'not_bencoded_file' => 'What the hell are you doing? What you uploaded is not a Bencode file!',
  'not_a_dictionary' => 'Not a directory',
  'dictionary_is_missing_key' => 'Directory missing value',
  'invalid_entry_in_dictionary' => 'Invalid directory entry',
  'invalid_dictionary_entry_type' => 'Invalid directory item type',
  'invalid_pieces' => 'Invalid file block',
  'missing_length_and_files' => 'Missing length and file',
  'filename_errors' => 'Error file name',
  'uploaded_not_offered' => 'You can only upload torrent that pass the candidate. Please return to select the appropriate project in <b>your candidate</b> before uploading!',
  'unauthorized_upload_freely' => 'You do not have the permission to upload freely!',
  'torrent_existed' => 'The torrent already exists!id: :id',
  'torrent_file_too_big' => 'The torrent file is too large! Maximum allowable',
  'remake_torrent_note' => 'bytes. Please re-create the torrent file with a larger block size, or split the content into multiple torrent to publish.',
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
  'email_notification_subject' => ':site_name New torrent notification',
);
