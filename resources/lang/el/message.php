<?php

return [

    'index' => [
        'page_title' => 'Λίστα μηνυμάτων',
    ],
    'show' => [
        'page_title' => 'Λεπτομέρειες μηνύματος',
    ],
    'field_value_change_message_body' => ':field is changed from :old to :new by :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field άλλαξε',

    'download_disable' => [
        'subject' => 'Ακυρώθηκε η άδεια λήψης',
        'body' => 'Τα δικαιώματα λήψης σας έχουν ανακληθεί, πιθανώς λόγω χαμηλών ποσοστών κοινής χρήσης ή δυσσυμπεριφοράς. Από: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Ακυρώθηκε η άδεια λήψης',
        'body' => 'Η άδεια λήψης έχει ακυρωθεί λόγω υπερβολικής ταχύτητας μεταφόρτωσης, παρακαλώ κάντε αρχείο, αν είστε χρήστης του πλαισίου σπόρου.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Ακυρώθηκε η άδεια λήψης',
        'body' => 'Η άδεια λήψης έχει ακυρωθεί λόγω ανακοίνωσης σε πληρωμένο torrent πάρα πολλές φορές, βεβαιωθείτε ότι έχετε αρκετά μπόνους.' ,
    ],
    'download_enable' => [
        'subject' => 'Έγινε επαναφορά δικαιωμάτων λήψης',
        'body' => 'Τα προνόμια λήψης σας αποκαταστάθηκαν, μπορείτε τώρα να κατεβάσετε torrents. Από: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Προσωρινή πρόσκληση :change_type',
        'body' => 'Ο προσωρινός αριθμός πρόσκλησής σας είχε :change_type :count από :operator, λόγος: λόγος.',
    ],
    'receive_medal' => [
        'subject' => 'Λάβετε δώρο μετάλλιο',
        'body' => "Ο χρήστης :username αγόρασε ένα μετάλλιο [:medal_name] με κόστος :cost_bonus και σου το έδωσε. Το μετάλλιο αξίζει :price, η αμοιβή είναι :gift_fee_total(παράγοντας: :gift_fee_factor), θα έχετε αυτό το μετάλλιο μέχρι: :expire_at, και ο συντελεστής προσθήκης μπόνους του μεταλλίου είναι: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => ':site_name Συναγερμός σύνδεσης Offsite',
        'body' => <<<BODY
Συνδεθήκατε σε::this_login_time, IP::this_ip, τοποθεσία::this_location.<br/>
Τελευταία σύνδεση time:::last_login_time, IP:last_ip, τοποθεσία::last_location.<br/>
Αν δεν είναι δική σας λειτουργία, ο κωδικός πρόσβασης του λογαριασμού μπορεί να έχει διαρρεύσει, παρακαλώ αλλάξτε τον εγκαίρως!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Επιτυχής υπενθύμιση αγοράς torrent',
        'body' => 'Περάσατε :bonus για να αγοράσετε με επιτυχία το torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Η ώρα λήξης εξετάσεων :exam_name άλλαξε',
        'body' => 'Η ώρα λήξης της εξέτασης σας σε εξέλιξη :exam_name έχει αλλάξει από :old_end_time σε :new_end_time. admin: :operator, αιτία: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Έχετε λάβει ένα PM.",
    'mail_sender' => "Αποστολέας	",
    'mail_subject' => "Θέμα	",
    'mail_date' => "Ημερομηνία/Ημερομηνία		",
    'mail_use_following_url' => "You can click&nbsp;",
    'mail_use_following_url_1' => "&nbsp;to view the message (you may have to login).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "Η Ομάδα %s.",
    'mail_received_pm_from' => "Έχετε λάβει ένα PM από ",
    'mail_here' => "ΕΔΩ",
    'msg_system' => "Σύστημα",
    'msg_original_message_from' => "Αρχικό μήνυμα από ",
];
