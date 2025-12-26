<?php

return [
    'category_label' => 'Categoria',
    'sub_category_source_label' => 'Fonte',
    'sub_category_medium_label' => 'Media',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Squadra',
    'sub_category_processing_label' => 'Elaborazione',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Mostra copertina nella lista torrent',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Visualizza l\'icona della casella dei seed nell\'elenco dei torrent',
    ],
    'sections' => [
        'browse' => 'Torrent',
        'special' => 'Speciale',
    ],
];
