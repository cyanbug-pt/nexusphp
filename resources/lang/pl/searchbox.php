<?php

return [
    'category_label' => 'Kategoria',
    'sub_category_source_label' => 'Źródło',
    'sub_category_medium_label' => 'Media',
    'sub_category_standard_label' => 'Standardowy',
    'sub_category_team_label' => 'Drużyna',
    'sub_category_processing_label' => 'Przetwarzanie',
    'sub_category_codec_label' => 'Kodek',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Wyświetl okładkę na liście torrentów',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Wyświetl ikonę skrzynki seed na liście torrentów',
    ],
    'sections' => [
        'browse' => 'Torrenty',
        'special' => 'Specjalne',
    ],
];
