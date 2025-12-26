<?php

return array (
    'invalid_price' => 'Nieprawidłowa cena: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Nieprawidłowa sekcja',
  'invalid_hr' => 'Nieprawidłowa wartość H&R',
  'invalid_pos_state' => 'Nieprawidłowa pozycja: :pos_state',
  'invalid_pos_state_until' => 'Niepoprawny termin pozycji',
  'not_supported_sub_category_field' => 'Nieobsługiwane pola podkategorii: :field',
  'invalid_sub_category_value' => 'Pole podkategorii: :label(:field) wartość: :value nieprawidłowa',
  'invalid_tag' => 'Nieprawidłowy tag:::tag',
  'invalid_pick_type' => 'Nieprawidłowe rekomendacje::pick_type',
  'require_name' => 'Tytuł nie może być pusty',
  'price_too_much' => 'Cena przekracza dopuszczalny zakres',
  'approval_deny_reach_upper_limit' => 'Liczba torrentów odrzuconych dla bieżącej recenzji: %s osiąga górny limit, a publikacja jest niedozwolona.',
  'special_section_not_enabled' => 'Strefa specjalna nie jest włączona.',
  'paid_torrent_not_enabled' => 'Płatny torrent nie jest włączony.',
  'no_permission_to_set_torrent_hr' => 'Brak uprawnień do ustawiania H&R torrenta.',
  'no_permission_to_set_torrent_pos_state' => 'Nie ma uprawnień do ustawiania torrentów na wierzch.',
  'no_permission_to_set_torrent_price' => 'Brak uprawnień do ustawiania opłat za torrenty.',
  'no_permission_to_pick_torrent' => 'Brak uprawnień do rekomendowania filmów.',
  'no_permission_to_be_anonymous' => 'Brak uprawnień do anonimowego publikowania.',
  'torrent_save_dir_not_exists' => 'Katalog zapisu torrenta nie istnieje.',
  'torrent_save_dir_not_writable' => 'Katalog zapisu torrenta nie jest zapisywalny.',
  'save_torrent_file_failed' => 'Zapisywanie pliku torrent nie powiodło się.',
  'upload_failed' => 'Przesyłanie nie powiodło się!',
  'missing_form_data' => 'Proszę wypełnić wymagane elementy',
  'missing_torrent_file' => 'Brakujący plik torrent',
  'empty_filename' => 'Nazwa pliku nie może być pusta!',
  'zero_byte_nfo' => 'Plik NFO jest pusty',
  'nfo_too_big' => 'Plik NFO jest zbyt duży! Maksymalny dozwolony przez 65,535 bajtów.',
  'nfo_upload_failed' => 'Przesyłanie pliku NFO nie powiodło się',
  'blank_description' => 'Musisz wypełnić wstęp!',
  'category_unselected' => 'Musisz wybrać typ!',
  'invalid_filename' => 'Nieprawidłowa nazwa pliku!',
  'filename_not_torrent' => 'Nieprawidłowa nazwa pliku (nie .torrent).',
  'empty_file' => 'Pusty plik!',
  'not_bencoded_file' => 'Co robisz piekło? To, co wgrałeś(aś) to nie plik Bencode!',
  'not_a_dictionary' => 'To nie katalog',
  'dictionary_is_missing_key' => 'Brak wartości katalogu',
  'invalid_entry_in_dictionary' => 'Nieprawidłowy wpis katalogu',
  'invalid_dictionary_entry_type' => 'Nieprawidłowy typ elementu katalogu',
  'invalid_pieces' => 'Nieprawidłowy blok pliku',
  'missing_length_and_files' => 'Brakująca długość i plik',
  'filename_errors' => 'Błąd nazwy pliku',
  'uploaded_not_offered' => 'Możesz przesłać tylko torrent, który przekazuje kandydaturę. Proszę wróć aby wybrać odpowiedni projekt w <b>swojego kandydata</b> przed przesłaniem!',
  'unauthorized_upload_freely' => 'Nie masz uprawnień do bezpłatnego wysyłania!',
  'torrent_existed' => 'Torrent już istnieje!id: :id',
  'torrent_file_too_big' => 'Plik torrent jest zbyt duży! Maksymalny dozwolony',
  'remake_torrent_note' => 'bajty. Proszę ponownie utworzyć plik torrent o większym rozmiarze bloku lub podzielić zawartość na wiele torrentów, aby opublikować.',
  'email_notification_body' => 'Witaj,
Przesłano nowy torrent.

Nazwa::nazwa
Rozmiar::rozmiar
Typ:kategorii
Przesyła::upload_by

Wprowadzenie:
:description

Zobacz bardziej szczegółowe informacje i pobierz je (być może musisz się zalogować), kliknij tutaj: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>tutaj</a></b>
:torrent_url

:site_name',
  'email_notification_subject' => 'Powiadomienie :site_name New torrent',
);
