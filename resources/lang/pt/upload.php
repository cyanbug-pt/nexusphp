<?php

return array (
    'invalid_price' => 'Preço inválido: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Seção inválida',
  'invalid_hr' => 'Valor de H&R inválido',
  'invalid_pos_state' => 'Posição inválida: :pos_state',
  'invalid_pos_state_until' => 'Prazo de posição inválido',
  'not_supported_sub_category_field' => 'Campos subcategorias não suportados: :field',
  'invalid_sub_category_value' => 'Campo da subcategoria: :label(:field) valor: :value inválido',
  'invalid_tag' => 'Tag inválida::tag',
  'invalid_pick_type' => 'Recomendação inválida::pick_type',
  'require_name' => 'O título não pode estar vazio',
  'price_too_much' => 'Preço excede o intervalo permitido',
  'approval_deny_reach_upper_limit' => 'O número de torrent rejeitados para a revisão atual: %s atinge o limite superior e a publicação não é permitida.',
  'special_section_not_enabled' => 'Zona especial não está habilitada.',
  'paid_torrent_not_enabled' => 'O torrent pago não está habilitado.',
  'no_permission_to_set_torrent_hr' => 'Sem permissão para definir torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Não há permissão para definir o torrent topo.',
  'no_permission_to_set_torrent_price' => 'Sem permissão para definir cargas de torrent.',
  'no_permission_to_pick_torrent' => 'Sem permissão para recomendar vídeos.',
  'no_permission_to_be_anonymous' => 'Sem permissão para publicar anonimamente.',
  'torrent_save_dir_not_exists' => 'O diretório de salvamento do torrent não existe.',
  'torrent_save_dir_not_writable' => 'O diretório de salvamento do torrent não é gravável.',
  'save_torrent_file_failed' => 'Falha ao salvar o arquivo torrent.',
  'upload_failed' => 'Falha no envio!',
  'missing_form_data' => 'Por favor, preencha os itens necessários',
  'missing_torrent_file' => 'Arquivo torrent ausente',
  'empty_filename' => 'O nome do arquivo não pode estar vazio!',
  'zero_byte_nfo' => 'Arquivo NFO está vazio',
  'nfo_too_big' => 'O arquivo NFO é muito grande! Máximo permitido em 65.535 bytes.',
  'nfo_upload_failed' => 'Falha no envio de arquivo NFO',
  'blank_description' => 'Você deve preencher a introdução!',
  'category_unselected' => 'Você deve escolher o tipo!',
  'invalid_filename' => 'Nome de arquivo inválido!',
  'filename_not_torrent' => 'Nome de arquivo inválido (não arquivo .torrent).',
  'empty_file' => 'Arquivo vazio!',
  'not_bencoded_file' => 'O que diabos você está fazendo? O que você enviou não é um arquivo Bencode!',
  'not_a_dictionary' => 'Não é um diretório',
  'dictionary_is_missing_key' => 'Valor faltando no diretório',
  'invalid_entry_in_dictionary' => 'Entrada de diretório inválida',
  'invalid_dictionary_entry_type' => 'Tipo de item do diretório inválido',
  'invalid_pieces' => 'Bloco de arquivo inválido',
  'missing_length_and_files' => 'Faltando comprimento e arquivo',
  'filename_errors' => 'Erro de nome',
  'uploaded_not_offered' => 'Você só pode carregar o torrent que passa no candidato. Por favor, volte para selecionar o projeto apropriado em <b>seu candidato</b> antes de enviar!',
  'unauthorized_upload_freely' => 'Você não tem permissão para carregar livremente!',
  'torrent_existed' => 'O torrent já existe!id: :id',
  'torrent_file_too_big' => 'O arquivo torrent é muito grande! Máximo permitido',
  'remake_torrent_note' => 'bytes. Por favor, re-crie o arquivo torrent com um tamanho de bloco maior, ou divida o conteúdo em vários torrent para publicar.',
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
  'email_notification_subject' => ':site_name Nova notificação de torrent',
);
