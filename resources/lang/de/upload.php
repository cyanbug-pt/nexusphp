<?php

return array (
    'invalid_price' => 'Ungültiger Preis: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Ungültiger Abschnitt',
  'invalid_hr' => 'Ungültiger H&R-Wert',
  'invalid_pos_state' => 'Ungültige Position: :pos_state',
  'invalid_pos_state_until' => 'Ungültige Positionsfrist',
  'not_supported_sub_category_field' => 'Nicht unterstützte Unterkategoriefelder: :field',
  'invalid_sub_category_value' => 'Unterkategoriefeld: :label(:field) Wert: :value ungültig',
  'invalid_tag' => 'Tag ungültig',
  'invalid_pick_type' => 'Ungültige Empfehlung::pick_type',
  'require_name' => 'Der Titel darf nicht leer sein',
  'price_too_much' => 'Preis überschreitet den zulässigen Bereich',
  'approval_deny_reach_upper_limit' => 'Die Anzahl der Torrents für die aktuelle Bewertung abgelehnt: %s erreicht die Obergrenze und das Publizieren ist nicht zulässig.',
  'special_section_not_enabled' => 'Sonderzone ist nicht aktiviert.',
  'paid_torrent_not_enabled' => 'Der bezahlte Torrent ist nicht aktiviert.',
  'no_permission_to_set_torrent_hr' => 'Keine Berechtigung zum Setzen von Torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Es gibt keine Berechtigung Torrent-oben zu setzen.',
  'no_permission_to_set_torrent_price' => 'Keine Berechtigung zum Festlegen von Torrentgebühren.',
  'no_permission_to_pick_torrent' => 'Keine Berechtigung um Videos zu empfehlen.',
  'no_permission_to_be_anonymous' => 'Keine Berechtigung anonym zu veröffentlichen.',
  'torrent_save_dir_not_exists' => 'Das Torrent-Speicherverzeichnis existiert nicht.',
  'torrent_save_dir_not_writable' => 'Das Verzeichnis zum Speichern von Torrent ist nicht beschreibbar.',
  'save_torrent_file_failed' => 'Speichern der Torrent-Datei fehlgeschlagen.',
  'upload_failed' => 'Upload fehlgeschlagen!',
  'missing_form_data' => 'Bitte füllen Sie die benötigten Elemente aus',
  'missing_torrent_file' => 'Fehlende Torrent-Datei',
  'empty_filename' => 'Der Dateiname darf nicht leer sein!',
  'zero_byte_nfo' => 'NFO-Datei ist leer',
  'nfo_too_big' => 'Die NFO-Datei ist zu groß! Maximal 65.535 Bytes erlaubt.',
  'nfo_upload_failed' => 'NFO-Datei-Upload fehlgeschlagen',
  'blank_description' => 'Sie müssen die Einleitung ausfüllen!',
  'category_unselected' => 'Sie müssen den Typ wählen!',
  'invalid_filename' => 'Ungültiger Dateiname!',
  'filename_not_torrent' => 'Ungültiger Dateiname (nicht .torrent-Datei).',
  'empty_file' => 'Leere Datei!',
  'not_bencoded_file' => 'Was die Hölle machst du? Was du hochgeladen hast ist keine Bencode-Datei!',
  'not_a_dictionary' => 'Kein Verzeichnis',
  'dictionary_is_missing_key' => 'Verzeichnis fehlt Wert',
  'invalid_entry_in_dictionary' => 'Ungültiger Verzeichniseintrag',
  'invalid_dictionary_entry_type' => 'Ungültiger Verzeichniselementtyp',
  'invalid_pieces' => 'Ungültiger Dateiblock',
  'missing_length_and_files' => 'Fehlende Länge und Datei',
  'filename_errors' => 'Fehler Dateiname',
  'uploaded_not_offered' => 'Sie können nur Torrent hochladen, der den Kandidaten passt. Bitte kehren Sie zurück, um das passende Projekt in <b>Ihren Kandidaten</b> auszuwählen, bevor Sie hochladen!',
  'unauthorized_upload_freely' => 'Du hast keine Berechtigung zum freien Hochladen!',
  'torrent_existed' => 'Der Torrent existiert bereits!id: :id',
  'torrent_file_too_big' => 'Die Torrent-Datei ist zu groß! Maximal erlaubt',
  'remake_torrent_note' => 'Bytes. Bitte erstellen Sie die Torrent-Datei mit einer größeren Blockgröße neu oder teilen Sie den Inhalt in mehrere Torrent-Dateien zu veröffentlichen.',
  'email_notification_body' => 'Hallo,
Ein neuer Torrent wurde hochgeladen.

Name::name
Grösse
Type::category
Uploader::upload_by

Einführung:
:description

Schau dir detailliertere Informationen an (möglicherweise musst du dich einloggen), bitte hier klicken: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>hier</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Neue Torrent-Benachrichtigung',
);
