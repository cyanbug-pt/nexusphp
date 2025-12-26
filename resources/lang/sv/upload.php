<?php

return array (
    'invalid_price' => 'Ogiltigt pris: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Ogiltigt avsnitt',
  'invalid_hr' => 'Ogiltigt H&R-värde',
  'invalid_pos_state' => 'Ogiltig position: :pos_state',
  'invalid_pos_state_until' => 'Ogiltig position deadline',
  'not_supported_sub_category_field' => 'Underkategorifält som inte stöds: :field',
  'invalid_sub_category_value' => 'Underkategori: :label(:field) värde: :value invalid',
  'invalid_tag' => 'Ogiltig tag: :tag',
  'invalid_pick_type' => 'Ogiltig rekommendation::pick_type',
  'require_name' => 'Titeln kan inte vara tom',
  'price_too_much' => 'Priset överskrider det tillåtna intervallet',
  'approval_deny_reach_upper_limit' => 'Antalet torrent som avvisats för den aktuella granskningen: %s når den övre gränsen och publicering är inte tillåtet.',
  'special_section_not_enabled' => 'Särskild zon är inte aktiverad.',
  'paid_torrent_not_enabled' => 'Den betalda torrent är inte aktiverad.',
  'no_permission_to_set_torrent_hr' => 'Ingen behörighet att ställa in torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Det finns ingen behörighet att ställa in torrent top.',
  'no_permission_to_set_torrent_price' => 'Ingen behörighet att ställa in torrent avgifter.',
  'no_permission_to_pick_torrent' => 'Ingen behörighet att rekommendera videor.',
  'no_permission_to_be_anonymous' => 'Ingen behörighet att publicera anonymt.',
  'torrent_save_dir_not_exists' => 'Mappen torrent save finns inte.',
  'torrent_save_dir_not_writable' => 'Mappen torrent save är inte skrivbar.',
  'save_torrent_file_failed' => 'Kunde inte spara torrent-filen.',
  'upload_failed' => 'Uppladdning misslyckades!',
  'missing_form_data' => 'Vänligen fyll i de obligatoriska artiklarna',
  'missing_torrent_file' => 'Tyrent-fil saknas',
  'empty_filename' => 'Filnamnet kan inte vara tomt!',
  'zero_byte_nfo' => 'NFO-fil är tom',
  'nfo_too_big' => 'NFO-filen är för stor! Maximalt tillåten med 65.535 bytes.',
  'nfo_upload_failed' => 'NFO-filuppladdning misslyckades',
  'blank_description' => 'Du måste fylla i introduktionen!',
  'category_unselected' => 'Du måste välja typ!',
  'invalid_filename' => 'Ogiltigt filnamn!',
  'filename_not_torrent' => 'Ogiltigt filnamn (ej .torrent fil).',
  'empty_file' => 'Tom fil!',
  'not_bencoded_file' => 'Vad gör du i helvetet? Det du laddat upp är inte en Bencode-fil!',
  'not_a_dictionary' => 'Inte en katalog',
  'dictionary_is_missing_key' => 'Katalogens saknade värde',
  'invalid_entry_in_dictionary' => 'Ogiltig katalogpost',
  'invalid_dictionary_entry_type' => 'Ogiltig typ av katalogobjekt',
  'invalid_pieces' => 'Ogiltigt filblock',
  'missing_length_and_files' => 'Längd och fil saknas',
  'filename_errors' => 'Filnamn för fel',
  'uploaded_not_offered' => 'Du kan bara ladda upp torrent som klarar kandidaten. Vänligen återvänd för att välja lämpligt projekt i <b>din kandidat</b> innan du laddar upp!',
  'unauthorized_upload_freely' => 'Du har inte behörighet att ladda upp gratis!',
  'torrent_existed' => 'Torrent finns redan!id: :id',
  'torrent_file_too_big' => 'Torrent-filen är för stor! Maximalt tillåten',
  'remake_torrent_note' => 'bytes. Vänligen återskapa torrent-filen med en större blockstorlek, eller dela upp innehållet i flera torrent att publicera.',
  'email_notification_body' => 'Hej,
En ny torrent har laddats upp.

Namn::name
Storlek::storlek
Typ: :kategori
Uppladdare::upload_by

Introduktion:
:description

Visa mer detaljerad information och ladda ner den (du kan behöva logga in), klicka här: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>här</a></b>
:torrent_url

:site_name Webbplats',
  'email_notification_subject' => ':site_name Ny torrent-avisering',
);
