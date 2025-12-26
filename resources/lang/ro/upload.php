<?php

return array (
    'invalid_price' => 'Preț nevalid: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Secțiune nevalidă',
  'invalid_hr' => 'Valoare H&R nevalidă',
  'invalid_pos_state' => 'Poziție invalidă: :pos_state',
  'invalid_pos_state_until' => 'Data limită a poziției invalidă',
  'not_supported_sub_category_field' => 'Câmpuri de subcategorii neacceptate: :field',
  'invalid_sub_category_value' => 'Câmp subcategorie: :label(:fieldd) valoare :value nevalidă',
  'invalid_tag' => 'Tel nevalid:tag',
  'invalid_pick_type' => 'Recomandare nevalidă::pick_type',
  'require_name' => 'Titlul nu poate fi gol',
  'price_too_much' => 'Prețul depășește intervalul admisibil',
  'approval_deny_reach_upper_limit' => 'Numărul de torente respinse pentru recenzia curentă: %s atinge limita superioară și publicarea nu este permisă.',
  'special_section_not_enabled' => 'Zona specială nu este activată.',
  'paid_torrent_not_enabled' => 'Torentul plătit nu este activat.',
  'no_permission_to_set_torrent_hr' => 'Nici o permisiune pentru a seta H&R torent.',
  'no_permission_to_set_torrent_pos_state' => 'Nu există permisiunea de a seta torentele torentelor.',
  'no_permission_to_set_torrent_price' => 'Nu există permisiunea de a seta costurile torentelor.',
  'no_permission_to_pick_torrent' => 'Nu ai permisiunea de a recomanda videoclipuri.',
  'no_permission_to_be_anonymous' => 'Fără permisiunea de a publica anonim.',
  'torrent_save_dir_not_exists' => 'Directorul de salvare al torentului nu exista.',
  'torrent_save_dir_not_writable' => 'Directorul de salvare a torentului nu permite scrierea.',
  'save_torrent_file_failed' => 'Salvarea fișierului torent a eșuat.',
  'upload_failed' => 'Încărcare eșuată!',
  'missing_form_data' => 'Vă rugăm să completaţi elementele necesare',
  'missing_torrent_file' => 'Fișier torrent lipsă',
  'empty_filename' => 'Numele fișierului nu poate fi gol!',
  'zero_byte_nfo' => 'Fișierul NFO este gol',
  'nfo_too_big' => 'Fișierul NFO este prea mare! Maximul permis de 65.535 octeți.',
  'nfo_upload_failed' => 'Încărcarea fișierului NFO a eșuat',
  'blank_description' => 'Trebuie să completați introducerea!',
  'category_unselected' => 'Trebuie să alegi tipul!',
  'invalid_filename' => 'Nume de fișier nevalid!',
  'filename_not_torrent' => 'Nume de fișier nevalid (nu fișierul .torrent).',
  'empty_file' => 'Fișier gol!',
  'not_bencoded_file' => 'Ce naiba faci? Ce ai încărcat nu este un fișier Bencod!',
  'not_a_dictionary' => 'Nu este un director',
  'dictionary_is_missing_key' => 'Valoare director lipsă',
  'invalid_entry_in_dictionary' => 'Înregistrare director nevalidă',
  'invalid_dictionary_entry_type' => 'Tip de element director nevalid',
  'invalid_pieces' => 'Bloc: Fișier nevalid',
  'missing_length_and_files' => 'Lungime și fișier lipsă',
  'filename_errors' => 'Nume fișier eroare',
  'uploaded_not_offered' => 'Poți încărca doar torrentul care trece de candidat. Te rugăm să te întorci pentru a selecta proiectul corespunzător în <b>candidatul</b> înainte de încărcare!',
  'unauthorized_upload_freely' => 'Nu ai permisiunea de a încărca gratuit!',
  'torrent_existed' => 'Torentul există deja!id: :id',
  'torrent_file_too_big' => 'Fișierul torrent este prea mare! Maximul admis',
  'remake_torrent_note' => 'octeți. Vă rugăm să recreați fișierul torent cu o dimensiune mai mare a blocului, sau să împărțiți conținutul în mai multe torente pentru a publica.',
  'email_notification_body' => 'Bună ziua,
Un nou torent a fost încărcat.

Nume:name
Dimensiune:size
Tip:::category
Uploader::upload_by

Introducere:
:description

Vezi mai multe informații detaliate și descarcă (ar putea fi necesar să te autentifici), faceţi clic aici: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>aici</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Notificare torrent nouă',
);
