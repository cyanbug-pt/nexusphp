<?php

return [
    'ban_user_with_leech_warning_expired' => 'Vypršela platnost zakázaného systémem z důvodu varování z leech.',
    'disable_user_unconfirmed' => 'Zakázat systémem z důvodu nepotvrzené nadměrné lhůty.',
    'disable_user_no_transfer_alt_last_access_time' => 'Zakázat neaktivní uživatelské účty, žádný převod. Alt: poslední čas přístupu.',
    'disable_user_no_transfer_alt_register_time' => 'Zakázat neaktivní uživatelské účty, bez převodu. Vše: zaregistrujte si čas.',
    'disable_user_not_parked' => 'Zakázat neaktivní uživatelské účty, není parkované.',
    'disable_user_parked' => 'Zakázat neaktivní uživatelské účty, parkované.',
    'destroy_disabled_account' => 'Načasováno fyzické odstranění zakázaných účtů',
    'alarm_email_subject' => '[:site_name] výjimka pro vyčištění úkolů pozadí',
    'alarm_email_body' => 'Aktuální čas: :now_time, level :level, čas posledního běhu byl: :last_time, to bylo více než: :elapsed_seconds s (:elapsed_seconds_human) od jeho spuštění, interval běhu sady je: :interval sekund(:interval_human), prosím zkontrolujte!',
    'alarm_email_subject_for_queue_failed_jobs' => '[:site_name]Asynchronní výjimka úkolu',
    'alarm_email_body_for_queue_failed_jobs' => 'Existuje celkem :count neúspěšných úloh od :since, zaznamenaných v databázové tabulce :failed_job_table, prosím zkontrolujte to!',
];
