<?php

return [
    'invalid_inviter' => 'Μη έγκυρο inviter! Ο κωδικός πρόσκλησης έχει αποκλειστεί!',
    'fields' => [
        'inviter' => 'Αποστολέας',
        'invitee' => 'Λήψη email',
        'time_invited' => 'Χρόνος αποστολής',
        'valid' => 'Valid',
        'invitee_register_uid' => 'Εγγεγραμμένο UID',
        'invitee_register_email' => 'Εγγεγραμμένο email',
        'invitee_register_username' => 'Όνομα χρήστη',
        'expired_at' => 'το hash έληξε στις',
        'time_invited_begin' => 'Αποστολή χρόνου gte',
        'time_invited_end' => 'Αποστολή ώρας lte',
    ],
    'send_deny_reasons' => [
        'invite_system_closed' => 'Το σύστημα πρόσκλησης είναι κλειστό',
        'no_permission' => 'Απαίτηση :class ή πάνω για αποστολή προσκλήσεων',
        'invite_not_enough' => 'Δεν υπάρχουν αρκετές προσκλήσεις',
    ],
    'send_allow_text' => 'Προσκαλέστε κάποιον',
    'pre_register_username' => 'Προ-εγγραφή ονόματος χρήστη',
    'pre_register_username_help' => 'Το όνομα χρήστη και το email δεν θα αλλάξουν όταν ο χρήστης εγγραφεί με αυτόν τον κωδικό πρόσκλησης',
    'require_pre_register_username' => "Το προεγγεγραμμένο όνομα χρήστη δεν μπορεί να είναι κενό",
];
