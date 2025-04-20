<?php

return array (
    'invalid_price' => 'Ugyldig pris: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Ugyldig sektion',
  'invalid_hr' => 'Ugyldig H&R værdi',
  'invalid_pos_state' => 'Ugyldig position: :pos_state',
  'invalid_pos_state_until' => 'Ugyldig positionsfrist',
  'not_supported_sub_category_field' => 'Ikke-understøttede underkategorifelter: :field',
  'invalid_sub_category_value' => 'Underkategori felt: :label(:field) værdi: :value invalid',
  'invalid_tag' => 'Ugyldigt tag::tag',
  'invalid_pick_type' => 'Ugyldig anbefaling::pick_type',
  'require_name' => 'Titlen må ikke være tom',
  'price_too_much' => 'Prisen overstiger det tilladte interval',
  'approval_deny_reach_upper_limit' => 'Antallet af torrent afvist for den aktuelle gennemgang: %s når den øvre grænse og publicering er ikke tilladt.',
  'special_section_not_enabled' => 'Speciel zone er ikke aktiveret.',
  'paid_torrent_not_enabled' => 'Den betalte torrent er ikke aktiveret.',
  'no_permission_to_set_torrent_hr' => 'Ingen tilladelse til at angive torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Der er ingen tilladelse til at indstille torrent top.',
  'no_permission_to_set_torrent_price' => 'Ingen tilladelse til at indstille torrent afgifter.',
  'no_permission_to_pick_torrent' => 'Ingen tilladelse til at anbefale videoer.',
  'no_permission_to_be_anonymous' => 'Ingen tilladelse til at udgive anonymt.',
  'torrent_save_dir_not_exists' => 'Torrent- gearemappen eksisterer ikke.',
  'torrent_save_dir_not_writable' => 'Mappen til at gemme torrent er ikke skrivbar.',
  'save_torrent_file_failed' => 'Lagring af torrent- filen mislykkedes.',
  'upload_failed' => 'Upload mislykkedes!',
  'missing_form_data' => 'Udfyld venligst de påkrævede elementer',
  'missing_torrent_file' => 'Manglende torrent fil',
  'empty_filename' => 'Filnavnet må ikke være tomt!',
  'zero_byte_nfo' => 'NFO- fil er tom',
  'nfo_too_big' => 'NFO-filen er for stor! Maksimal tilladt med 65, 535 bytes.',
  'nfo_upload_failed' => 'Upload af NFO fil mislykkedes',
  'blank_description' => 'Du skal udfylde indledningen!',
  'category_unselected' => 'Du skal vælge den type!',
  'invalid_filename' => 'Ugyldigt filnavn!',
  'filename_not_torrent' => 'Ugyldigt filnavn (ikke .torrent fil).',
  'empty_file' => 'Tom fil!',
  'not_bencoded_file' => 'Hvad helvede gør du? Hvad du uploadede er ikke en Bencode fil!',
  'not_a_dictionary' => 'Ikke en mappe',
  'dictionary_is_missing_key' => 'Mappe mangler værdi',
  'invalid_entry_in_dictionary' => 'Ugyldig mappeindgang',
  'invalid_dictionary_entry_type' => 'Ugyldig mappeelementtype',
  'invalid_pieces' => 'Ugyldig filblok',
  'missing_length_and_files' => 'Manglende længde og fil',
  'filename_errors' => 'Fejl filnavn',
  'uploaded_not_offered' => 'Du kan kun uploade torrent der passerer kandidaten. Gå tilbage for at vælge det relevante projekt i <b>din kandidat</b> før du uploader!',
  'unauthorized_upload_freely' => 'Du har ikke tilladelse til at uploade frit!',
  'torrent_existed' => 'Torrenten findes allerede!id: :id',
  'torrent_file_too_big' => 'Torrent-filen er for stor! Maksimal tilladt',
  'remake_torrent_note' => 'bytes. Genopret torrentfilen med en større blokstørrelse, eller opdel indholdet i flere torrent for at publicere.',
  'email_notification_body' => 'Hej,
En ny torrent er blevet uploadet.

Navn::name
Størrelse::size
Type::kategori
Uploader::upload_by

Indledning:
:description

Se mere detaljeret information og download den (du skal muligvis logge ind), klik her: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>her</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Ny torrent notifikation',
);
