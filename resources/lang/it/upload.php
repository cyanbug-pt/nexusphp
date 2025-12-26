<?php

return array (
    'invalid_price' => 'Prezzo non valido: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Sezione non valida',
  'invalid_hr' => 'Valore H&R non valido',
  'invalid_pos_state' => 'Posizione non valida: :pos_state',
  'invalid_pos_state_until' => 'Scadenza posizione non valida',
  'not_supported_sub_category_field' => 'Campi di sottocategoria non supportati: :field',
  'invalid_sub_category_value' => 'Campo sottocategoria: :label(:field) valore: :value non valido',
  'invalid_tag' => 'Tag non valido:',
  'invalid_pick_type' => 'Raccomandazione non valida::pick_type',
  'require_name' => 'Il titolo non può essere vuoto',
  'price_too_much' => 'Il prezzo supera l\'intervallo ammissibile',
  'approval_deny_reach_upper_limit' => 'Il numero di torrent rifiutato per la recensione corrente: %s raggiunge il limite superiore e la pubblicazione non è consentita.',
  'special_section_not_enabled' => 'La zona speciale non è abilitata.',
  'paid_torrent_not_enabled' => 'Il torrent pagato non è abilitato.',
  'no_permission_to_set_torrent_hr' => 'Nessun permesso per impostare H&R torrente.',
  'no_permission_to_set_torrent_pos_state' => 'Non ci sono permessi per impostare il torrent top.',
  'no_permission_to_set_torrent_price' => 'Nessun permesso per impostare le spese del torrent.',
  'no_permission_to_pick_torrent' => 'Nessun permesso per raccomandare video.',
  'no_permission_to_be_anonymous' => 'Nessun permesso per la pubblicazione anonima.',
  'torrent_save_dir_not_exists' => 'La directory di salvataggio del torrent non esiste.',
  'torrent_save_dir_not_writable' => 'La directory di salvataggio del torrent non è scrivibile.',
  'save_torrent_file_failed' => 'Salvataggio del file torrent non riuscito.',
  'upload_failed' => 'Caricamento fallito!',
  'missing_form_data' => 'Si prega di compilare gli elementi richiesti',
  'missing_torrent_file' => 'File torrent mancante',
  'empty_filename' => 'Il nome del file non può essere vuoto!',
  'zero_byte_nfo' => 'Il file NFO è vuoto',
  'nfo_too_big' => 'Il file NFO è troppo grande! Massimo consentito per 65.535 byte.',
  'nfo_upload_failed' => 'Caricamento file NFO non riuscito',
  'blank_description' => 'Devi compilare l\'introduzione!',
  'category_unselected' => 'Devi scegliere il tipo!',
  'invalid_filename' => 'Nome file non valido!',
  'filename_not_torrent' => 'Nome file non valido (non file .torrent).',
  'empty_file' => 'File vuoto!',
  'not_bencoded_file' => 'Che diavolo stai facendo? Quello che hai caricato non è un file Bencode!',
  'not_a_dictionary' => 'Non è una directory',
  'dictionary_is_missing_key' => 'Valore mancante directory',
  'invalid_entry_in_dictionary' => 'Voce directory non valida',
  'invalid_dictionary_entry_type' => 'Tipo di elemento di directory non valido',
  'invalid_pieces' => 'Blocco file non valido',
  'missing_length_and_files' => 'Lunghezza e file mancanti',
  'filename_errors' => 'Errore nome file',
  'uploaded_not_offered' => 'Puoi caricare solo torrent che superano il candidato. Per favore torna a selezionare il progetto appropriato in <b>il tuo candidato</b> prima di caricare!',
  'unauthorized_upload_freely' => 'Non hai il permesso di caricare liberamente!',
  'torrent_existed' => 'Il torrent esiste già!id: :id',
  'torrent_file_too_big' => 'Il file torrent è troppo grande! Massimo consentito',
  'remake_torrent_note' => 'byte. Si prega di ricreare il file torrent con una dimensione di blocco più grande o dividere il contenuto in più torrent da pubblicare.',
  'email_notification_body' => 'Ciao,
Un nuovo torrent è stato caricato.

Name::name
Dimensione::size
Type::category
Uploader::upload_by

Introduzione:
:description

Visualizza informazioni più dettagliate e scaricarle (potrebbe essere necessario effettuare il login), clicca qui: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>qui</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Nuova notifica torrent',
);
