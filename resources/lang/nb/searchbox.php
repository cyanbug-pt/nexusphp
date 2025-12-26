<?php

return [
    'category_label' => 'Kategori',
    'sub_category_source_label' => 'Kilde',
    'sub_category_medium_label' => 'Medier',
    'sub_category_standard_label' => 'Vanlig',
    'sub_category_team_label' => 'Lag',
    'sub_category_processing_label' => 'Behandler',
    'sub_category_codec_label' => 'Kodek',
    'sub_category_audiocodec_label' => 'Lydkodeks',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Vis forside på torrentliste',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Vis hovedikon på torrent-liste',
    ],
    'sections' => [
        'browse' => 'Torrenter',
        'special' => 'Spesial',
    ],
];
