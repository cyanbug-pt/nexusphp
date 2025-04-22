<?php

return [
    'category_label' => 'Категория',
    'sub_category_source_label' => 'Источник',
    'sub_category_medium_label' => 'Медиа',
    'sub_category_standard_label' => 'Стандартный',
    'sub_category_team_label' => 'Команда',
    'sub_category_processing_label' => 'Обработка',
    'sub_category_codec_label' => 'Кодек',
    'sub_category_audiocodec_label' => 'Аудиокодек',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Показывать обложку в списке торрентов',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Отображать значок мнемоники в списке торрентов',
    ],
    'sections' => [
        'browse' => 'Торренты',
        'special' => 'Особый',
    ],
];
