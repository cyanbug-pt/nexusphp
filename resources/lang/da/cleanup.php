<?php

return [
    'ban_user_with_leech_warning_expired' => 'Forbudt af systemet på grund af igleadvarsel udløbet.',
    'disable_user_unconfirmed' => 'Deaktivér efter system på grund af ubekræftet overskridelsesfrist.',
    'disable_user_no_transfer_alt_last_access_time' => 'Deaktivér inaktive brugerkonti, ingen overførsel. Alt: sidste adgangstid.',
    'disable_user_no_transfer_alt_register_time' => 'Deaktivér inaktive brugerkonti, ingen overførsel. Alt: registrer tid.',
    'disable_user_not_parked' => 'Deaktivér inaktive brugerkonti, ikke parkeret.',
    'disable_user_parked' => 'Deaktivér inaktive brugerkonti, parkeret.',
    'destroy_disabled_account' => 'Tidspunkt for fysisk sletning af deaktiverede konti',
    'alarm_email_subject' => '[:site_name] undtagelse af opgaveoprydning i baggrunden',
    'alarm_email_body' => 'Nuværende tid: :now_time, level :level, Last run time var: :last_time, it has been more than: :elapsed_seconds seconds(:elapsed_seconds_human) since it was run, det indstillede kørselsinterval er: :interval sekunder(:interval_human), tjek venligst!',
    'alarm_email_subject_for_queue_failed_jobs' => '[:site_name]Asynkron Opgave Undtagelse',
    'alarm_email_body_for_queue_failed_jobs' => 'Der er i alt :count mislykkedes asynkron job siden :since, registreret i database tabellen :failed_job_table, tjek det!',
];
