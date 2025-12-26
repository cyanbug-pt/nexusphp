<?php

return array (
    'invalid_price' => 'Neplatná cena: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Neplatná sekce',
  'invalid_hr' => 'Neplatná hodnota H&R',
  'invalid_pos_state' => 'Neplatná pozice: :pos_state',
  'invalid_pos_state_until' => 'Neplatná lhůta pozice',
  'not_supported_sub_category_field' => 'Nepodporovaná pole podkategorií: :field',
  'invalid_sub_category_value' => 'Pole podkategorie: :label(:field) hodnota: :value je neplatná',
  'invalid_tag' => 'Neplatný štítek::tag',
  'invalid_pick_type' => 'Neplatné doporučení:pick_type',
  'require_name' => 'Název nemůže být prázdný',
  'price_too_much' => 'Cena přesahuje povolený rozsah',
  'approval_deny_reach_upper_limit' => 'Počet torrentu odmítnut pro aktuální recenzi: %s dosáhne horní meze a publikování není povoleno.',
  'special_section_not_enabled' => 'Speciální zóna není povolena.',
  'paid_torrent_not_enabled' => 'Placený torrent není povolen.',
  'no_permission_to_set_torrent_hr' => 'Nemáte oprávnění k nastavení torrentu H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Neexistuje žádné oprávnění k nastavení horní části torrentu.',
  'no_permission_to_set_torrent_price' => 'Nemáte oprávnění k nastavení torrentových poplatků.',
  'no_permission_to_pick_torrent' => 'Nemáte oprávnění k doporučení videí.',
  'no_permission_to_be_anonymous' => 'Nemáte oprávnění k anonymnímu publikování.',
  'torrent_save_dir_not_exists' => 'Adresář pro uložení torrentu neexistuje.',
  'torrent_save_dir_not_writable' => 'Adresář pro uložení torrentu není zapisovatelný.',
  'save_torrent_file_failed' => 'Uložení torrentu se nezdařilo.',
  'upload_failed' => 'Nahrání selhalo!',
  'missing_form_data' => 'Vyplňte požadované položky',
  'missing_torrent_file' => 'Chybějící torrent soubor',
  'empty_filename' => 'Název souboru nemůže být prázdný!',
  'zero_byte_nfo' => 'NFO soubor je prázdný',
  'nfo_too_big' => 'NFO soubor je příliš velký! Maximální povolený počet 65,535 bytů.',
  'nfo_upload_failed' => 'Nahrávání NFO souboru se nezdařilo',
  'blank_description' => 'Musíte vyplnit úvod!',
  'category_unselected' => 'Musíte si vybrat typ!',
  'invalid_filename' => 'Neplatný název souboru!',
  'filename_not_torrent' => 'Neplatný název souboru (ne .torrent soubor).',
  'empty_file' => 'Prázdný soubor!',
  'not_bencoded_file' => 'Co děláte peklo? Co jste nahráli, není soubor Bencod!',
  'not_a_dictionary' => 'Není adresář',
  'dictionary_is_missing_key' => 'Chybějící hodnota adresáře',
  'invalid_entry_in_dictionary' => 'Neplatná položka adresáře',
  'invalid_dictionary_entry_type' => 'Neplatný typ položky adresáře',
  'invalid_pieces' => 'Neplatný soubor',
  'missing_length_and_files' => 'Chybějící délka a soubor',
  'filename_errors' => 'Název chybového souboru',
  'uploaded_not_offered' => 'Můžete nahrát pouze torrent, který projde kandidátem. Před nahráním se prosím vraťte k výběru vhodného projektu v <b>tvůj kandidát</b>.',
  'unauthorized_upload_freely' => 'Nemáte oprávnění k nahrávání zdarma!',
  'torrent_existed' => 'Torrent již existuje!id: :id',
  'torrent_file_too_big' => 'Soubor torrentu je příliš velký! Maximální povolený',
  'remake_torrent_note' => 'bajtů. Vytvořte prosím soubor torrentu s větší velikostí bloku nebo rozdělte obsah na více torrentů pro publikování.',
  'email_notification_body' => 'Dobrý den,
Nový torrent byl nahrán. Odformat@@1 Název::name
Velikost::velikost
Typ::category
Uploader:::upload_by

Úvod:
:description

Zobrazit podrobnější informace a stáhnout je (možná se budete muset přihlásit), klikněte zde: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>zde</a></b>
:torrent_url

:site_name webové stránky',
  'email_notification_subject' => ':site_name Nové torrent oznámení',
);
