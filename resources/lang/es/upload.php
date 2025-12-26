<?php

return array (
    'invalid_price' => 'Precio no válido: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Sección inválida',
  'invalid_hr' => 'Valor de H&R no válido',
  'invalid_pos_state' => 'Posición no válida: :pos_state',
  'invalid_pos_state_until' => 'Fecha límite de posición no válida',
  'not_supported_sub_category_field' => 'Campos de subcategoría no soportados: :field',
  'invalid_sub_category_value' => 'Campo de subcategoría: :label(:field) valor: :value inválido',
  'invalid_tag' => 'Tag::tag no válido',
  'invalid_pick_type' => 'Recomendación no válida::pick_type',
  'require_name' => 'El título no puede estar vacío',
  'price_too_much' => 'El precio excede el rango permitido',
  'approval_deny_reach_upper_limit' => 'El número de torrent rechazado para la revisión actual: %s alcanza el límite superior y la publicación no está permitida.',
  'special_section_not_enabled' => 'Zona especial no activada.',
  'paid_torrent_not_enabled' => 'El torrent de pago no está habilitado.',
  'no_permission_to_set_torrent_hr' => 'Sin permiso para establecer el torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'No hay permiso para establecer la parte superior del torrent.',
  'no_permission_to_set_torrent_price' => 'Sin permiso para establecer cargos por torrent.',
  'no_permission_to_pick_torrent' => 'Sin permiso para recomendar videos.',
  'no_permission_to_be_anonymous' => 'Sin permiso para publicar anónimamente.',
  'torrent_save_dir_not_exists' => 'El directorio de guardado del torrent no existe.',
  'torrent_save_dir_not_writable' => 'El directorio de guardado del torrent no tiene permisos de escritura.',
  'save_torrent_file_failed' => 'Error al guardar el archivo torrent.',
  'upload_failed' => '¡Carga fallida!',
  'missing_form_data' => 'Por favor, rellene los artículos requeridos',
  'missing_torrent_file' => 'Falta un archivo torrent',
  'empty_filename' => '¡El nombre del archivo no puede estar vacío!',
  'zero_byte_nfo' => 'El archivo NFO está vacío',
  'nfo_too_big' => 'El archivo NFO es demasiado grande! Máximo permitido por 65,535 bytes.',
  'nfo_upload_failed' => 'Error al subir el archivo NFO',
  'blank_description' => '¡Debes rellenar la introducción!',
  'category_unselected' => '¡Tienes que elegir el tipo!',
  'invalid_filename' => 'Nombre de archivo inválido!',
  'filename_not_torrent' => 'Nombre de archivo no válido (no archivo .torrent).',
  'empty_file' => '¡Archivo vacío!',
  'not_bencoded_file' => '¿Qué es lo que estás haciendo? ¡Lo que has subido no es un archivo Bencode!',
  'not_a_dictionary' => 'No es un directorio',
  'dictionary_is_missing_key' => 'Falta el valor del directorio',
  'invalid_entry_in_dictionary' => 'Entrada de directorio no válida',
  'invalid_dictionary_entry_type' => 'Tipo de artículo de directorio no válido',
  'invalid_pieces' => 'Bloque de archivo no válido',
  'missing_length_and_files' => 'Falta la longitud y archivo',
  'filename_errors' => 'Nombre del archivo de error',
  'uploaded_not_offered' => 'Solo puedes subir un torrent que pase al candidato. ¡Por favor, vuelve para seleccionar el proyecto apropiado en <b>tu candidata</b> antes de subir!',
  'unauthorized_upload_freely' => '¡No tienes permiso para subir libremente!',
  'torrent_existed' => 'El torrent ya existe!id: :id',
  'torrent_file_too_big' => '¡El archivo torrent es demasiado grande! Máximo permitido',
  'remake_torrent_note' => 'bytes. Por favor, vuelva a crear el archivo torrent con un tamaño de bloque más grande, o divida el contenido en múltiples torrent para publicar.',
  'email_notification_body' => 'Hola,
Se ha subido un nuevo torrent.

Nombre::name
Size::size
Type::category
Uploader::upload_by

Introducción:
:description

Ver información más detallada y descargarla (es posible que necesite iniciar sesión), por favor haga clic aquí: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>aquí</a></b>
:torrent_url

:site_name sitio web',
  'email_notification_subject' => 'Nueva notificación de torrent :site_name',
);
