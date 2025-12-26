<?php

return [
    'category_label' => 'Categoría',
    'sub_category_source_label' => 'Fuente',
    'sub_category_medium_label' => 'Medios',
    'sub_category_standard_label' => 'Estándar',
    'sub_category_team_label' => 'Equipo',
    'sub_category_processing_label' => 'Procesando',
    'sub_category_codec_label' => 'Codec',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Mostrar portada en la lista de torrent',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Mostrar icono del cuadro de semillas en la lista de torrents',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Especial',
    ],
];
