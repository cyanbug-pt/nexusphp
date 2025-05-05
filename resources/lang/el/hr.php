<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Επιθεώρηση',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Έφτασε',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Αδύνατο',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Σκελετός',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Απενεργοποιημένο',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Χειροκίνητα',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Καθολικό',

    'reached_by_seed_time_comment' => 'Έως το：:now,seed time: :seed_time Ώρα(ες) έφτασε το :seed_time_minimum Ώρα(ες)',
    'reached_by_share_ratio_comment' => "Up to：:now \nseed time: :seed_time Hour(s) Unreached :seed_time_minimum Hour(s) \nShare ratio: :share_ratio reached standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Η κλάση χρήστη σας: :user_class_text ή ο χρήστης που δωρήθηκε, αγνοήστε αυτό το H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) έφτασε!',
    'reached_message_content' => 'Συγχαρητήρια! Το torrent: :torrent_name(ID: :torrent_id) που κατεβάζετε στο: :completed_at έχει φτάσει την απαίτηση.',

    'unreached_comment' => "Μέχρι το：:now \nχρόνος σπόρου： :seed_time Ώρα(ες) Δεν πληρούται η απαίτηση：:seed_time_minimum Ώρα(ες) \nαναλογία μετοχής：:share_ratio δεν έφτασε στην απαίτηση：:ignore_when_ratio_reach πάρα πολύ",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) δεν επιτεύχθηκε!',
    'unreached_message_content' => 'Το torrent :torrent_name(ID: :torrent_id) που κατεβάσατε στο :completed_at: δεν έφτασε! Παρακαλώ σημειώστε ότι η συσσώρευση ενός ορισμένου αριθμού H&R του λογαριασμού σας θα απενεργοποιηθεί.',

    'unreached_disable_comment' => 'Η ποσότητα H&R έφτασε το ανώτατο όριο και ο λογαριασμός απενεργοποιήθηκε από το σύστημα',
    'unreached_disable_message_content' => 'Ο λογαριασμός σας έχει απενεργοποιηθεί επειδή έχει επιτευχθεί αθροιστική μέτρηση H&R στο όριο συστήματος: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'δαπάνησε :bonus ακυρώθηκε',
    'remove_confirm_msg' => 'Εξαλείψτε ένα H&R αφαιρώντας :bonus μπόνους, OK?',
];
