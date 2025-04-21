<?php

return array (
    'invalid_price' => 'Virheellinen hinta: :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Virheellinen osio',
  'invalid_hr' => 'Virheellinen H&R-arvo',
  'invalid_pos_state' => 'Virheellinen sijainti: :pos_state',
  'invalid_pos_state_until' => 'Virheellinen sijainnin määräaika',
  'not_supported_sub_category_field' => 'Alakategorian kenttiä ei tueta: :field',
  'invalid_sub_category_value' => 'Alakategorian kenttä: :label(:field) arvo: :value invalid',
  'invalid_tag' => 'Virheellinen tunniste::tag',
  'invalid_pick_type' => 'Virheellinen suositus::pick_type',
  'require_name' => 'Otsikko ei voi olla tyhjä',
  'price_too_much' => 'Hinta ylittää sallitun vaihteluvälin',
  'approval_deny_reach_upper_limit' => 'Torrent-tiedosto hylättiin nykyisessä arviossa: %s saavuttaa ylärajan ja julkaiseminen ei ole sallittua.',
  'special_section_not_enabled' => 'Erityisvyöhyke ei ole käytössä.',
  'paid_torrent_not_enabled' => 'Maksettu torrentti ei ole käytössä.',
  'no_permission_to_set_torrent_hr' => 'Ei oikeuksia asettaa torrent H&R.',
  'no_permission_to_set_torrent_pos_state' => 'Ei ole oikeuksia asettaa torrent-tiedosto ylös.',
  'no_permission_to_set_torrent_price' => 'Ei oikeuksia asettaa torrent- maksuja.',
  'no_permission_to_pick_torrent' => 'Ei oikeutta suositella videoita.',
  'no_permission_to_be_anonymous' => 'Ei oikeutta julkaista nimettömänä.',
  'torrent_save_dir_not_exists' => 'Torrent-tiedoston tallennushakemistoa ei ole olemassa.',
  'torrent_save_dir_not_writable' => 'Torrent-tiedoston tallennushakemistoon ei voi kirjoittaa.',
  'save_torrent_file_failed' => 'Torrent-tiedoston tallennus epäonnistui.',
  'upload_failed' => 'Lähetys epäonnistui!',
  'missing_form_data' => 'Ole hyvä ja täytä vaaditut kohteet',
  'missing_torrent_file' => 'Puuttuva torrent-tiedosto',
  'empty_filename' => 'Tiedoston nimi ei voi olla tyhjä!',
  'zero_byte_nfo' => 'NFO tiedosto on tyhjä',
  'nfo_too_big' => 'NFO tiedosto on liian suuri! Suurin sallittu 65,535 tavua.',
  'nfo_upload_failed' => 'NFO tiedostojen lähettäminen epäonnistui',
  'blank_description' => 'Sinun täytyy täyttää johdanto!',
  'category_unselected' => 'Sinun täytyy valita tyyppi!',
  'invalid_filename' => 'Virheellinen tiedostonimi!',
  'filename_not_torrent' => 'Virheellinen tiedostonimi (ei .torrent-tiedosto).',
  'empty_file' => 'Tyhjä tiedosto!',
  'not_bencoded_file' => 'Mitä helvetti olet tekemässä? Mitä lataat ei ole Bencode tiedosto!',
  'not_a_dictionary' => 'Ei ole kansio',
  'dictionary_is_missing_key' => 'Hakemiston puuttuva arvo',
  'invalid_entry_in_dictionary' => 'Virheellinen hakemistoon syöte',
  'invalid_dictionary_entry_type' => 'Virheellinen hakemiston nimikkeen tyyppi',
  'invalid_pieces' => 'Virheellinen tiedostolohko',
  'missing_length_and_files' => 'Puuttuva pituus ja tiedosto',
  'filename_errors' => 'Virhe tiedoston nimi',
  'uploaded_not_offered' => 'Voit ladata vain ehdokkaan läpäisevän torrentin. Ole hyvä ja palaa valitsemaan sopiva projekti <b>ehdokkaasi</b> ennen lähettämistä!',
  'unauthorized_upload_freely' => 'Sinulla ei ole lupaa ladata ilmaiseksi !',
  'torrent_existed' => 'Torrentti on jo olemassa!id: :id',
  'torrent_file_too_big' => 'Torrent-tiedosto on liian suuri! Suurin sallittu',
  'remake_torrent_note' => 'tavua. Luo torrent-tiedosto uudelleen suuremmalla lohkokolla, tai jaa sisältö useisiin torrent-tiedostoihin julkaisemista varten.',
  'email_notification_body' => 'Hei,
Uusi torrentti on ladattu.

Nimi:::name
Koko::size
Tyyppi:luokka
Uploader::upload_by

Johdanto:
:description

Katso tarkempia tietoja ja lataa ne (saatat joutua kirjautumaan sisään), klikkaa tästä: <b><a href=javascript:void(null) onclick=window.open(\':torrent_url\')>tästä</a></b>
:torrent_url

:site_name Website',
  'email_notification_subject' => ':site_name Uusi torrent- ilmoitus',
);
