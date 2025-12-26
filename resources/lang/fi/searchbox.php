<?php

return [
    'category_label' => 'Kategoria',
    'sub_category_source_label' => 'Lähde',
    'sub_category_medium_label' => 'Media',
    'sub_category_standard_label' => 'Normaali',
    'sub_category_team_label' => 'Tiimi',
    'sub_category_processing_label' => 'Käsitellään',
    'sub_category_codec_label' => 'Koodi',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Näytä kansikuva torrent- listassa',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Näytä seed box -kuvake torrent- listassa',
    ],
    'sections' => [
        'browse' => 'Torrentit',
        'special' => 'Erityinen',
    ],
];
