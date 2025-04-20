<?php

return [
    'category_label' => 'Kategori',
    'sub_category_source_label' => 'Kilde',
    'sub_category_medium_label' => 'Medier',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Hold',
    'sub_category_processing_label' => 'Behandler',
    'sub_category_codec_label' => 'Kodec',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Vis omslag på torrent liste',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Vis seed box ikon på torrent liste',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Speciel',
    ],
];
