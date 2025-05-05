<?php

return [
    'label' => 'Μετάλλιο',
    'action_wearing' => 'Φοράτε',
    'admin' => [
        'list' => [
            'page_title' => 'Λίστα μεταλλίων'
        ]
    ],
    'get_types' => [
        \App\Models\Medal::GET_TYPE_EXCHANGE => 'Χρηματιστήριο',
        \App\Models\Medal::GET_TYPE_GRANT => 'Παραχώρηση',
    ],
    'fields' => [
        'get_type' => 'Λήψη τύπου',
        'description' => 'Περιγραφή',
        'image_large' => 'Εικόνα',
        'price' => 'Τιμή',
        'duration' => 'Ισχύει μετά την αγορά (ημέρες)',
        'sale_begin_time' => 'Ώρα έναρξης πώλησης',
        'sale_begin_time_help' => 'Ο χρήστης μπορεί να αγοράσει μετά από αυτό το διάστημα, αφήστε κενό χωρίς περιορισμό',
        'sale_end_time' => 'Χρόνος λήξης πώλησης',
        'sale_end_time_help' => 'Ο χρήστης μπορεί να αγοράσει πριν από αυτή τη φορά, αφήστε κενό χωρίς περιορισμό',
        'inventory' => 'Απόθεμα',
        'inventory_help' => 'Αφήστε κενό χωρίς περιορισμό',
        'sale_begin_end_time' => 'Διαθέσιμο για πώληση',
        'users_count' => 'Πλήθος πουλιών',
        'bonus_addition_factor' => 'Συντελεστής προσθήκης μπόνους',
        'bonus_addition' => 'Επιπλέον μπόνους',
        'bonus_addition_factor_help' => 'Για παράδειγμα: 0.01 σημαίνει 1% addition, leave blank no addition',
        'gift_fee_factor' => 'Συντελεστής τέλους δώρων',
        'gift_fee' => 'Χρέωση δώρου',
        'gift_fee_factor_help' => 'Το πρόσθετο τέλος που χρεώνεται για δώρα σε άλλους χρήστες ισούται με την τιμή πολλαπλασιαζόμενη με αυτόν τον συντελεστή',
    ],
    'buy_already' => 'Ήδη αγοράστε',
    'buy_btn' => 'Αγορά',
    'confirm_to_buy' => 'Σίγουρα θέλετε να αγοράσετε?',
    'require_more_bonus' => 'Απαιτείται περισσότερο μπόνους',
    'grant_only' => 'Μόνο χορήγηση',
    'before_sale_begin_time' => 'Πριν από την πώληση ώρα έναρξης',
    'after_sale_end_time' => 'Μετά την πώληση ώρα λήξης',
    'inventory_empty' => 'Κενό απόθεμα',
    'gift_btn' => 'Δώρο',
    'confirm_to_gift' => 'Επιβεβαίωση δώρου στο χρήστη ',
    'max_allow_wearing' => 'Ένα μέγιστο :count μετάλλια μπορεί να φορεθεί ταυτόχρονα',
    'wearing_status_text' => [
        0 => 'Φορώντας',
        1 => 'Δεν φοράει'
    ],
];
