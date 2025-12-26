<?php

return array (
    'invalid_price' => 'Ugyldig pris: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Ugyldig seksjon',
  'invalid_hr' => 'Ugyldig H&R-verdi',
  'invalid_pos_state' => 'Ugyldig posisjon: :pos_state',
  'invalid_pos_state_until' => 'Ugyldig posisjonsfrist',
  'not_supported_sub_category_field' => 'Ustøttet underkategorifelt: :field',
  'invalid_sub_category_value' => 'Underkategorifelt: :label(:field) verdi: :value invalid',
  'invalid_tag' => 'Ugyldig tag::tag',
  'invalid_pick_type' => 'Ugyldig anbefaling::pick_type',
  'require_name' => 'Tittelfeltet kan ikke være tom',
  'price_too_much' => 'Pris overskrider tillatt område',
  'approval_deny_reach_upper_limit' => 'Tallet av torrent avvist for gjeldende gjennomsyn: %s når øvre grense og publisering er ikke tillatt.',
  'special_section_not_enabled' => 'Spesialsone er ikke aktivert.',
  'paid_torrent_not_enabled' => 'Den betalte torrenten er ikke aktivert.',
  'no_permission_to_set_torrent_hr' => 'Ingen tillatelse til å angi torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Det finnes ingen tillatelse til å angi torrent topp.',
  'no_permission_to_set_torrent_price' => 'Ikke tillatelse til å angi torrent-anslag.',
  'no_permission_to_pick_torrent' => 'Ingen tillatelse til å anbefale videoer.',
  'no_permission_to_be_anonymous' => 'Ingen tillatelse til å publisere anonymt.',
  'torrent_save_dir_not_exists' => 'Torrent-lagringsmappen eksisterer ikke.',
  'torrent_save_dir_not_writable' => 'Torrent-lagringsmappen er ikke skrivbar.',
  'save_torrent_file_failed' => 'Lagring av torrent-fil mislyktes.',
  'upload_failed' => 'Opplasting feilet!',
  'missing_form_data' => 'Vennligst fyll ut påkrevde produkter',
  'missing_torrent_file' => 'Manglende torrentfil',
  'empty_filename' => 'Filnavnet kan ikke være tomt!',
  'zero_byte_nfo' => 'NFO-filen er tom',
  'nfo_too_big' => 'NFO-filen er for stor! Maksimalt tillatt med 65,535 byte.',
  'nfo_upload_failed' => 'NFO filopplasting feilet',
  'blank_description' => 'Du må fylle inn introduksjonen!',
  'category_unselected' => 'Du må velge typen!',
  'invalid_filename' => 'Ugyldig filnavn!',
  'filename_not_torrent' => 'Ugyldig filnavn (ikke .torrent-fil).',
  'empty_file' => 'Tom fil!',
  'not_bencoded_file' => 'Hva i helvete gjør du? Hva du lastet opp er en Bencode fil!',
  'not_a_dictionary' => 'Ikke en katalog',
  'dictionary_is_missing_key' => 'Mappe mangler verdi',
  'invalid_entry_in_dictionary' => 'Ugyldig katalog oppføring',
  'invalid_dictionary_entry_type' => 'Ugyldig mappe elementtype',
  'invalid_pieces' => 'Ugyldig filblokk',
  'missing_length_and_files' => 'Mangler lengde og fil',
  'filename_errors' => 'Feil filnavn',
  'uploaded_not_offered' => 'Du kan bare laste opp torrenten som sender kandidaten. Vennligst gå tilbake for å velge riktig prosjekt til <b>kandidat</b> før opplasting!',
  'unauthorized_upload_freely' => 'Du har ikke tillatelse til å laste opp gratis!',
  'torrent_existed' => 'Torrenten finnes allerede! :id',
  'torrent_file_too_big' => 'Torrent-filen er for stor! Maksimum tillatt',
  'remake_torrent_note' => 'bytes. Lag torrent-filen på nytt med en større blokkstørrelse, eller del innholdet i flere torrent for publisering.',
  'email_notification_body' => 'Hei,
En ny torrent er lastet opp.

Navn::name
Størrelse: :size
Type::kategori
Opplasting: :upload_by

Innledning
:description

Se mer detaljert informasjon og last den ned (du må kanskje logge in), klikk her: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>her</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Melding fra ny torrent',
);
