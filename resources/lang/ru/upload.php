<?php

return array (
    'invalid_price' => 'Недопустимая цена: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Неверная секция',
  'invalid_hr' => 'Недопустимое HR значение',
  'invalid_pos_state' => 'Недопустимое положение: :pos_state',
  'invalid_pos_state_until' => 'Недопустимый крайний срок',
  'not_supported_sub_category_field' => 'Неподдерживаемые поля подкатегории: :field',
  'invalid_sub_category_value' => 'Поле подкатегории: :label(:field) значение: :value недопустимо',
  'invalid_tag' => 'Неверный тег::tag',
  'invalid_pick_type' => 'Недопустимая рекомендация::pick_type',
  'require_name' => 'Название не может быть пустым',
  'price_too_much' => 'Цена превышает допустимый диапазон',
  'approval_deny_reach_upper_limit' => 'Количество торрентов, отвергнутых для текущей рецензии: %s достигает верхнего предела и публикация запрещена.',
  'special_section_not_enabled' => 'Специальная зона не включена.',
  'paid_torrent_not_enabled' => 'Оплаченный торрент не включен.',
  'no_permission_to_set_torrent_hr' => 'Недостаточно прав для установки торрента H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Нет разрешения на установку торрент-топа.',
  'no_permission_to_set_torrent_price' => 'Нет разрешения на установку торрентных платежей.',
  'no_permission_to_pick_torrent' => 'Нет разрешения на рекомендацию видео.',
  'no_permission_to_be_anonymous' => 'Нет разрешения на анонимную публикацию.',
  'torrent_save_dir_not_exists' => 'Каталог для сохранения торрентов не существует.',
  'torrent_save_dir_not_writable' => 'Папка сохранения торрента недоступна для записи.',
  'save_torrent_file_failed' => 'Не удалось сохранить торрент-файл.',
  'upload_failed' => 'Ошибка загрузки!',
  'missing_form_data' => 'Пожалуйста, заполните необходимые элементы',
  'missing_torrent_file' => 'Отсутствует торрент-файл',
  'empty_filename' => 'Имя файла не может быть пустым!',
  'zero_byte_nfo' => 'NFO файл пуст',
  'nfo_too_big' => 'Файл NFO слишком большой! Максимально допустимый на 65,535 байт.',
  'nfo_upload_failed' => 'NFO файл не удалось загрузить',
  'blank_description' => 'Вы должны заполнить введение!',
  'category_unselected' => 'Вы должны выбрать тип!',
  'invalid_filename' => 'Неверное имя файла!',
  'filename_not_torrent' => 'Неверное имя файла (не .torrent файла).',
  'empty_file' => 'Пустой файл!',
  'not_bencoded_file' => 'Что вы делаете? Загруженный вами файл не Бенкод!',
  'not_a_dictionary' => 'Не папка',
  'dictionary_is_missing_key' => 'Отсутствует значение каталога',
  'invalid_entry_in_dictionary' => 'Неверная запись каталога',
  'invalid_dictionary_entry_type' => 'Неверный тип элемента каталога',
  'invalid_pieces' => 'Неверный файловый блок',
  'missing_length_and_files' => 'Отсутствует длина и файл',
  'filename_errors' => 'Имя файла с ошибкой',
  'uploaded_not_offered' => 'You can only upload torrent that pass the candidate. Please return to select the appropriate project in <b>your candidate</b> before uploading!',
  'unauthorized_upload_freely' => 'У вас нет разрешения на бесплатную загрузку!',
  'torrent_existed' => 'Торрент уже существует!id: :id',
  'torrent_file_too_big' => 'Слишком большой торрент-файл! Максимально допустимый',
  'remake_torrent_note' => 'байт. Пожалуйста, пересоздайте торрент-файл с большим размером блока или разделите содержимое на несколько торрентов для публикации.',
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
  'email_notification_subject' => ':site_name Новое уведомление торрента',
);
