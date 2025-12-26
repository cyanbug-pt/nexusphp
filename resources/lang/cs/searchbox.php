<?php

return [
    'category_label' => 'Kategorie',
    'sub_category_source_label' => 'Zdroj',
    'sub_category_medium_label' => 'Média',
    'sub_category_standard_label' => 'Standardní',
    'sub_category_team_label' => 'Tým',
    'sub_category_processing_label' => 'Zpracovávání',
    'sub_category_codec_label' => 'Kodek',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Zobrazit obal v seznamu torrentů',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Zobrazit ikonu seedu v seznamu torrentů',
    ],
    'sections' => [
        'browse' => 'Torrenty',
        'special' => 'Speciální',
    ],
];
