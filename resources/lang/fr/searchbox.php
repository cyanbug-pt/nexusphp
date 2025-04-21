<?php

return [
    'category_label' => 'Catégorie',
    'sub_category_source_label' => 'Source',
    'sub_category_medium_label' => 'Médias',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Equipe',
    'sub_category_processing_label' => 'Traitement en cours',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'Codec audio',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Afficher la couverture sur la liste des torrents',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Afficher l\'icône de la graine dans la liste des torrents',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Spécial',
    ],
];
