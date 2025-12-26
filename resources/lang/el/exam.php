<?php

return [
    'label' => 'Εξετάσεις',
    'name' => 'Όνομα εξέτασης',
    'index' => 'Δείκτης εξετάσεων',
    'time_range' => 'Χρόνος εξέτασης',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Αύξηση ανεβάσματος',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Μέσος χρόνος σπόρου',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Αύξηση λήψης',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Προσφορά μπόνους',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Αύξηση σημείων σπόρου',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Ανεβάστε προσαύξηση torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Κλάση χρήστη',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Εγγραφή χρονικού εύρους',
        \App\Models\Exam::FILTER_USER_DONATE => 'Δωρεά',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Εύρος ημερών εγγραφής',
    ],
    'require_value' => 'Απαιτείται',
    'current_value' => 'Τρέχων',
    'result' => 'Αποτέλεσμα',

    'result_pass_for_exam' => 'Πέρασε!',
    'result_pass_for_task' => 'Ολοκληρώθηκε!',
    'result_not_pass_for_exam' => '<span style="color: red">Not Passed!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Not Completed!</span>',
    'checkout_pass_message_subject_for_exam' => 'Η εξέταση πέρασε!',
    'checkout_pass_message_content_for_exam' => 'Συγχαρητήρια! Έχετε περάσει την εξέταση: :exam_name εγκαίρως (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Οι εξετάσεις δεν περνούν και ο λογαριασμός έχει αποκλειστεί!',
    'checkout_not_pass_message_content_for_exam' => 'Δεν περάσατε τις εξετάσεις: :exam_name εγκαίρως (:start ~ :end), και ο λογαριασμός σας έχει αποκλειστεί!',

    'checkout_pass_message_subject_for_task' => 'Η εργασία ολοκληρώθηκε!',
    'checkout_pass_message_content_for_task' => 'Συγχαρητήρια! Έχετε ολοκληρώσει την εργασία: :exam_name εγκαίρως (:start ~ :end), πήρε μπόνους: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Η εργασία δεν ολοκληρώθηκε!',
    'checkout_not_pass_message_content_for_task' => 'Δεν ολοκληρώνετε την εργασία: :exam_name εγκαίρως (:begin ~ :end), deduct bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Μη πλήρης εξέταση: :exam_name στο χρόνο (:start ~ :end)',
    'ban_user_modcomment' => 'Λόγω μη πλήρη εξέταση: :exam_name(:start ~ :end), απαγόρευση από το σύστημα.',
    'admin' => [
        'list' => [
            'page_title' => 'Λίστα Εξετάσεων'
        ]
    ],
    'recurring' => 'επαναλαμβανόμενη',
    'recurring_daily' => 'μία φορά την ημέρα',
    'recurring_weekly' => 'μία φορά την εβδομάδα',
    'recurring_monthly' => 'μία φορά το μήνα',
    'recurring_help' => 'Εάν ορίζεται ως περιοδική, ο χρόνος έναρξης της εξέτασης είναι ο χρόνος έναρξης του τρέχοντος κύκλου, και ο χρόνος λήξης είναι ο χρόνος λήξης του τρέχοντος κύκλου, που είναι όλες οι φυσικές ημέρες/εβδομάδες/μήνες όπως αναφέρεται εδώ. Εάν ο τύπος εξετάζεται, στο τέλος κάθε κύκλου, εάν ο χρήστης εξακολουθεί να πληροί τα κριτήρια διαλογής, ο χρήστης θα ανατεθεί αυτόματα μια εξέταση για τον επόμενο κύκλο.' ,

    'time_condition_invalid' => 'Η παράμετρος χρόνου δεν έχει νόημα, υπάρχουν και μόνο ένα από τα τρία στοιχεία: χρόνος έναρξης + χρόνος λήξης / διάρκεια / επαναλαμβανόμενη',

    'type_exam' => 'Εξετάσεις',
    'type_task' => 'Εργασία',
    'type' => 'Τύπος',
    'type_help' => 'Οι εξετάσεις είναι τακτικές εξετάσεις και η αποτυχία τους θα οδηγήσει στην απαγόρευση του λογαριασμού. Οι εργασίες μπορούν να ρυθμιστούν σε μπόνους ανταμοιβής ή έκπτωση μπόνους ανάλογα με το αν έχουν ολοκληρωθεί ή όχι',

    'fail_deduct_bonus' => 'Μείωση μπόνους για αποτυχία',
    'success_reward_bonus' => 'Επιπλέον ανταμοιβή για την ολοκλήρωση',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Σίγουρα θέλετε να αξιώσετε?' ,
    'claim_by_yourself_only' => 'Διεκδικήστε μόνο από τον εαυτό σας!' ,
    'not_match_target_user' => 'Δεν είστε χρήστης που να ταιριάζει!' ,
    'has_other_on_the_way' => 'Υπάρχει ένα άλλο :type_text σε εξέλιξη!' ,
    'claimed_already' => 'Ήδη διεκδικημένο',
    'not_between_begin_end_time' => 'Όχι μεταξύ της ώρας έναρξης & λήξης',
    'reach_max_user_count' => 'Ο αριθμός των ισχυριζόμενων χρηστών έχει φτάσει το μέγιστο όριο',
    'claimed_user_count' => 'Διεκδικείται',
    'max_user_count' => 'Μέγιστη μέτρηση αξίωση χρήστη (0 σημαίνει απεριόριστη)',
    'background_color' => 'Χρώμα φόντου πλαισίου πληροφοριών',
];
