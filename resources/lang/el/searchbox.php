<?php

return [
    'category_label' => 'Κατηγορία',
    'sub_category_source_label' => 'Πηγή',
    'sub_category_medium_label' => 'Πολυμέσα',
    'sub_category_standard_label' => 'Τυπικό',
    'sub_category_team_label' => 'Ομάδα',
    'sub_category_processing_label' => 'Επεξεργασία',
    'sub_category_codec_label' => 'Κωδικοποιητής',
    'sub_category_audiocodec_label' => 'AudioCodec',
    'extras' => [
        \App\Models\SearchBox::EXTRA_DISPLAY_COVER_ON_TORRENT_LIST => 'Εμφάνιση εξώφυλλου στη λίστα torrent',
        \App\Models\SearchBox::EXTRA_DISPLAY_SEED_BOX_ICON_ON_TORRENT_LIST => 'Εμφάνιση εικονιδίου πλαισίου seed στη λίστα torrent',
    ],
    'sections' => [
        'browse' => 'Torrents',
        'special' => 'Ειδικό',
    ],
];
