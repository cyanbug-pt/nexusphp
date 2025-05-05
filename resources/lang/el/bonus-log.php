<?php

return [
    'business_types' => [
        \App\Models\BonusLogs::BUSINESS_TYPE_CANCEL_HIT_AND_RUN => 'Ακύρωση H&R',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_MEDAL => 'Αγορά μεταλλίου',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_ATTENDANCE_CARD => 'Αγοράστε την κάρτα παρουσίας',
        \App\Models\BonusLogs::BUSINESS_TYPE_STICKY_PROMOTION => 'Κολλημένη προώθηση',
        \App\Models\BonusLogs::BUSINESS_TYPE_POST_REWARD => 'Ανταμοιβή δημοσίευσης',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_UPLOAD => 'Το χρηματιστήριο ανέβηκε',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_INVITE => 'Αγορά πρόσκλησης',
        \App\Models\BonusLogs::BUSINESS_TYPE_CUSTOM_TITLE => 'Προσαρμοσμένος τίτλος',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_VIP => 'Αγορά VIP',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_SOMEONE => 'Δώρο σε κάποιον',
        \App\Models\BonusLogs::BUSINESS_TYPE_NO_AD => 'Ακύρωση διαφήμισης',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_LOW_SHARE_RATIO => 'Δώρο προς χαμηλή αναλογία μετοχής',
        \App\Models\BonusLogs::BUSINESS_TYPE_LUCKY_DRAW => 'Τυχερή ισοπαλία',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_DOWNLOAD => 'Το χρηματιστήριο λήφθηκε',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TEMPORARY_INVITE => 'Αγορά προσωρινής πρόσκλησης',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_RAINBOW_ID => 'Αγορά αναγνωριστικού ουράνιου τόξου',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_CHANGE_USERNAME_CARD => 'Αγοράστε αλλαγή κάρτας ονόματος χρήστη',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_MEDAL => 'Μετάλλιο δώρου',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TORRENT => 'Αγορά torrent',

        \App\Models\BonusLogs::BUSINESS_TYPE_ROLE_WORK_SALARY => 'Μισθός εργασίας ρόλων',
        \App\Models\BonusLogs::BUSINESS_TYPE_TORRENT_BE_DOWNLOADED => 'Κατεβάστε το Torrent',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_REWARD => 'Λήψη ανταμοιβής',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_GIFT => 'Λήψη δώρου',
        \App\Models\BonusLogs::BUSINESS_TYPE_UPLOAD_TORRENT => 'Μεταφόρτωση torrent',
    ],
    'fields' => [
        'business_type' => 'Τύπος επιχείρησης',
        'old_total_value' => 'Προσυναλλακτική αξία',
        'value' => 'Εμπορική αξία',
        'new_total_value' => 'Μετασυναλλακτική αξία',
    ],
];
