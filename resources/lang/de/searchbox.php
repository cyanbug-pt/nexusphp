<?php

return [
    'category_label' => 'Kategorie',
    'sub_category_source_label' => 'Quelle',
    'sub_category_medium_label' => 'Medien',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Team',
    'sub_category_processing_label' => 'Verarbeitung',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Cover auf Torrent-Liste anzeigen',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Seed-Box-Symbol in der Torrent-Liste anzeigen',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Spezial',
    ],
];
