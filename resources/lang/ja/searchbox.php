<?php

return [
    'category_label' => 'カテゴリ',
    'sub_category_source_label' => 'ソース',
    'sub_category_medium_label' => 'メディア',
    'sub_category_standard_label' => '標準',
    'sub_category_team_label' => 'チーム',
    'sub_category_processing_label' => '処理中',
    'sub_category_codec_label' => 'コーデック：',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'トレントリストにカバーを表示',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Torrent リストにシードボックスのアイコンを表示する',
    ],
    'sections' => [
        'browse' => 'Torrent',
        'special' => 'Special',
    ],
];
