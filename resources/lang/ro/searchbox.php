<?php

return [
    'category_label' => 'Categorie',
    'sub_category_source_label' => 'Sursa',
    'sub_category_medium_label' => 'Media',
    'sub_category_standard_label' => 'Standard',
    'sub_category_team_label' => 'Echipă',
    'sub_category_processing_label' => 'Prelucrare',
    'sub_category_codec_label' => 'Codecul',
    'sub_category_audiocodec_label' => 'Codec audio',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Afișează coperta pe lista torentelor',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Afişează pictograma căsuţei secrete pe lista de torente',
    ],
    'sections' => [
        'browse' => 'Torente',
        'special' => 'Special',
    ],
];
