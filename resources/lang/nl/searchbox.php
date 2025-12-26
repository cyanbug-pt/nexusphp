<?php

return [
    'category_label' => 'categorie',
    'sub_category_source_label' => 'Bron',
    'sub_category_medium_label' => 'Medium',
    'sub_category_standard_label' => 'Standaard',
    'sub_category_team_label' => 'Team',
    'sub_category_processing_label' => 'Verwerken',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Toon cover op torrentlijst',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Toon seed-box icoon op torrentlijst',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Speciaal',
    ],
];
