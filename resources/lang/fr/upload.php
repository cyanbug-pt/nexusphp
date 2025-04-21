<?php

return array (
    'invalid_price' => 'Prix invalide : :price',
  'invalid_category' => 'Invalid type',
  'invalid_section' => 'Section non valide',
  'invalid_hr' => 'Valeur H&R invalide',
  'invalid_pos_state' => 'Position invalide : :pos_state',
  'invalid_pos_state_until' => 'Date limite de position invalide',
  'not_supported_sub_category_field' => 'Champs de sous-catégorie non pris en charge : :field',
  'invalid_sub_category_value' => 'Champ de sous-catégorie: :label(:field) valeur: :value invalide',
  'invalid_tag' => 'tag::tag invalide',
  'invalid_pick_type' => 'Recommenation::pick_type invalide',
  'require_name' => 'Le titre ne peut pas être vide',
  'price_too_much' => 'Le prix dépasse la plage admissible',
  'approval_deny_reach_upper_limit' => 'Le nombre de torrents rejetés pour la revue en cours : %s atteint la limite supérieure et la publication n\'est pas autorisée.',
  'special_section_not_enabled' => 'La zone spéciale n\'est pas activée.',
  'paid_torrent_not_enabled' => 'Le torrent payant n\'est pas activé.',
  'no_permission_to_set_torrent_hr' => 'Aucune permission pour définir la H&R du torrent.',
  'no_permission_to_set_torrent_pos_state' => 'Il n\'y a pas de permission de définir le haut du torrent.',
  'no_permission_to_set_torrent_price' => 'Aucune permission pour définir les frais de torrent.',
  'no_permission_to_pick_torrent' => 'Aucune permission pour recommander des vidéos.',
  'no_permission_to_be_anonymous' => 'Aucune permission de publier anonymement.',
  'torrent_save_dir_not_exists' => 'Le répertoire de sauvegarde du torrent n\'existe pas.',
  'torrent_save_dir_not_writable' => 'Le répertoire de sauvegarde de torrent n\'est pas accessible en écriture.',
  'save_torrent_file_failed' => 'La sauvegarde du fichier torrent a échoué.',
  'upload_failed' => 'Échec du téléversement !',
  'missing_form_data' => 'Veuillez remplir les éléments requis',
  'missing_torrent_file' => 'Fichier torrent manquant',
  'empty_filename' => 'Le nom du fichier ne peut pas être vide!',
  'zero_byte_nfo' => 'Le fichier NFO est vide',
  'nfo_too_big' => 'Le fichier NFO est trop volumineux ! Maximum autorisé de 65 535 octets.',
  'nfo_upload_failed' => 'Échec du téléchargement du fichier NFO',
  'blank_description' => 'Vous devez renseigner l\'introduction !',
  'category_unselected' => 'Vous devez choisir le type !',
  'invalid_filename' => 'Nom de fichier invalide !',
  'filename_not_torrent' => 'Nom de fichier invalide (pas de fichier .torrent).',
  'empty_file' => 'Fichier vide!',
  'not_bencoded_file' => 'Que faites-vous ? Ce que vous avez téléchargé n\'est pas un fichier Bencode!',
  'not_a_dictionary' => 'Pas un répertoire',
  'dictionary_is_missing_key' => 'Répertoire valeur manquante',
  'invalid_entry_in_dictionary' => 'Entrée de répertoire invalide',
  'invalid_dictionary_entry_type' => 'Type d\'élément de répertoire invalide',
  'invalid_pieces' => 'Bloc de fichier invalide',
  'missing_length_and_files' => 'Longueur et fichier manquants',
  'filename_errors' => 'Erreur de nom de fichier',
  'uploaded_not_offered' => 'Vous ne pouvez télécharger que des torrents qui passent le candidat. Veuillez revenir pour sélectionner le projet approprié dans <b>votre candidat</b> avant de télécharger !',
  'unauthorized_upload_freely' => 'Vous n\'avez pas la permission de télécharger gratuitement !',
  'torrent_existed' => 'Le torrent existe déjà!id : :id',
  'torrent_file_too_big' => 'Le fichier torrent est trop volumineux! Maximum autorisé',
  'remake_torrent_note' => 'octets. Veuillez recréer le fichier torrent avec une taille de bloc plus grande, ou diviser le contenu en plusieurs torrent pour publier.',
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
  'email_notification_subject' => ':site_name Nouvelle notification torrent',
);
