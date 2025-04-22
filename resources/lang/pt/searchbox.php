<?php

return [
    'category_label' => 'categoria',
    'sub_category_source_label' => 'fonte',
    'sub_category_medium_label' => 'Multimídia',
    'sub_category_standard_label' => 'Padrão',
    'sub_category_team_label' => 'Equipe',
    'sub_category_processing_label' => 'Processando',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'Codec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Exibir capa na lista de torrents',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Exibir ícone da semente box na lista do torrent',
    ],
    'sections' => [
        'browse' => 'Torrentes',
        'special' => 'Promoções',
    ],
];
