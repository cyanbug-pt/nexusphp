<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Χρήστης',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Διαχειριστής',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Μη ελεγμένο',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Επιτρέπεται',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Απορρίφθηκε',
    ],
    'status_change_message' => [
        'subject' => 'Η κατάσταση εγγραφής SeedBox άλλαξε',
        'body' => 'Η κατάσταση της εγγραφής σας στο SeedBox με ID :id άλλαξε από :operator από :old_status σε :new_status. Λόγος: :reason',
    ],
    'is_seed_box_yes' => 'Αυτό το IP είναι SeedBox',
    'is_seed_box_no' => 'Αυτό το IP δεν είναι SeedBox',
];
