<?php

return [
    'actions' => [
        'install' => 'εγκατάσταση',
        'delete' => 'διαγραφή',
        'update' => 'αναβάθμιση',
        'install_or_update' => 'εγκατάσταση/αναβάθμιση',
    ],
    'labels' => [
        'display_name' => 'όνομα',
        'package_ name' => 'όνομα πακέτου',
        'remote_url' => 'repository_address',
        'installed_version' => 'εγκατεστημένη_έκδοση',
        'latest_version' => 'latest_version',
        'status' => 'κατάσταση',
        'updated_at' => 'last_executed_action',
        ' release_date' => 'ενημερώθηκε στις',
        'install_title' => 'Μεταβείτε στον κατάλογο: :web_root, και εκτελέστε τις ακόλουθες εντολές για να τις εγκαταστήσετε ως χρήστη root: ',
        'introduce' => 'Λεπτομέρειες',
        'view_on_blog' => 'Προβολή στο ιστολόγιο',
        ' config_plugin_address' => 'Ρύθμιση διεύθυνσης πρόσθετου',
        'download_specific_version' => 'Κατεβάστε την επέκταση. Η τελευταία έκδοση εμφανίζεται εδώ, αν χρειαστεί να εγκαταστήσετε μια άλλη έκδοση (δείτε στο blog για να δείτε όλες τις εκδόσεις) αντικαταστήστε τον εαυτό σας',
        'execute_install' => 'Εκτέλεση εγκατάστασης',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Κανονικό',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Δεν έχει εγκατασταθεί',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Έτοιμο για εγκατάσταση',
        \App\Models\Plugin::STATUS_INSTALLING => 'Εγκατάσταση',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Αποτυχία εγκατάστασης',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Έτοιμο για αναβάθμιση',
        \App\Models\Plugin::STATUS_UPDATING => 'Αναβάθμιση',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Αποτυχία αναβάθμισης',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Έτοιμο για αφαίρεση',
        \App\Models\Plugin::STATUS_DELETING => 'Αφαίρεση',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Κατάργηση αποτυχίας',
    ],
];
