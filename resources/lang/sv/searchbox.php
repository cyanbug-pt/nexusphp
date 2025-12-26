<?php

return [
    'category_label' => 'Kategori',
    'sub_category_source_label' => 'Källa',
    'sub_category_medium_label' => 'Media',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Lag',
    'sub_category_processing_label' => 'Bearbetar',
    'sub_category_codec_label' => 'Kodek',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Visa omslag på torrentlistan',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Visa seed box-ikonen på torrentlistan',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Särskild',
    ],
];
