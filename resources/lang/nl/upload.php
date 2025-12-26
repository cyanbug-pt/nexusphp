<?php

return array (
    'invalid_price' => 'Ongeldige prijs: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Ongeldige sectie',
  'invalid_hr' => 'Ongeldige H&R waarde',
  'invalid_pos_state' => 'Ongeldige positie: :pos_state',
  'invalid_pos_state_until' => 'Ongeldige positie deadline',
  'not_supported_sub_category_field' => 'Niet-ondersteunde subcategorie velden: :field',
  'invalid_sub_category_value' => 'Subcategorie veld: :label(:field) waarde: :value ongeldig',
  'invalid_tag' => 'Ongeldige tag::tag',
  'invalid_pick_type' => 'Ongeldige aanbeveling::pick_type',
  'require_name' => 'De titel mag niet leeg zijn',
  'price_too_much' => 'Prijs overschrijdt het toegestane bereik',
  'approval_deny_reach_upper_limit' => 'Het aantal torrent afgewezen voor de huidige beoordeling: %s bereikt de bovengrens en publiceren is niet toegestaan.',
  'special_section_not_enabled' => 'Speciale zone is niet ingeschakeld.',
  'paid_torrent_not_enabled' => 'De betaalde torrent is niet ingeschakeld.',
  'no_permission_to_set_torrent_hr' => 'Geen toestemming om torrent H&R in te stellen.',
  'no_permission_to_set_torrent_pos_state' => 'Er is geen toestemming om torrent top te zetten.',
  'no_permission_to_set_torrent_price' => 'Geen toestemming om torrent kosten in te stellen.',
  'no_permission_to_pick_torrent' => 'Geen toestemming om video\'s aan te bevelen.',
  'no_permission_to_be_anonymous' => 'Geen toestemming om anoniem te publiceren.',
  'torrent_save_dir_not_exists' => 'De opslagmap van de torrent bestaat niet.',
  'torrent_save_dir_not_writable' => 'De opslagmap van de torrent is niet schrijfbaar.',
  'save_torrent_file_failed' => 'Opslaan van het torrentbestand is mislukt.',
  'upload_failed' => 'Uploaden mislukt!',
  'missing_form_data' => 'Vul de vereiste items in',
  'missing_torrent_file' => 'Ontbrekend torrentbestand',
  'empty_filename' => 'Bestandsnaam mag niet leeg zijn!',
  'zero_byte_nfo' => 'NFO-bestand is leeg',
  'nfo_too_big' => 'Het NFO-bestand is te groot! Maximale toelaatbaar met 65,535 bytes.',
  'nfo_upload_failed' => 'NFO-bestand uploaden mislukt',
  'blank_description' => 'U moet de inleiding invullen!',
  'category_unselected' => 'Je moet het type kiezen!',
  'invalid_filename' => 'Ongeldige bestandsnaam!',
  'filename_not_torrent' => 'Ongeldige bestandsnaam (niet .torrent bestand).',
  'empty_file' => 'Leeg bestand!',
  'not_bencoded_file' => 'Wat ben je aan het doen? Wat je hebt geüpload is geen Bencode bestand!',
  'not_a_dictionary' => 'Geen map',
  'dictionary_is_missing_key' => 'Ontbrekende map waarde',
  'invalid_entry_in_dictionary' => 'Ongeldige map',
  'invalid_dictionary_entry_type' => 'Ongeldig maptype item type',
  'invalid_pieces' => 'Ongeldig bestandsblok',
  'missing_length_and_files' => 'Ontbrekende lengte en bestand',
  'filename_errors' => 'Fout bestandsnaam',
  'uploaded_not_offered' => 'U kunt alleen torrent uploaden die door de kandidaat komt. Ga terug om het juiste project te selecteren in <b>uw kandidaat</b> voordat u uploadt!',
  'unauthorized_upload_freely' => 'Je hebt geen toestemming om vrij te uploaden!',
  'torrent_existed' => 'De torrent bestaat al!id: :id',
  'torrent_file_too_big' => 'Het torrentbestand is te groot! Maximaal toelaatbaar',
  'remake_torrent_note' => 'bytes. Maak het torrentbestand opnieuw aan met een groter blokformaat, of verdeel de inhoud in meerdere torrent om te publiceren.',
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
  'email_notification_subject' => ':site_name Nieuwe torrent melding',
);
