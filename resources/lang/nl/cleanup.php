<?php

return [
    'ban_user_with_leech_warning_expired' => 'Verboden door het systeem vanwege leech warning is verlopen.',
    'disable_user_unconfirmed' => 'Uitschakelen door het systeem vanwege onbevestigde overtollige deadline.',
    'disable_user_no_transfer_alt_last_access_time' => 'Schakel inactieve gebruikersaccounts uit, inclusief overboeking. Bijvoorbeeld: laatst toegang.',
    'disable_user_no_transfer_alt_register_time' => 'Schakel inactieve gebruikersaccounts uit, geen overdracht. Bijvoorbeeld: registratie van tijd.',
    'disable_user_not_parked' => 'Schakel inactieve gebruikersaccounts uit, niet geparkeerd.',
    'disable_user_parked' => 'Schakel inactieve gebruikersaccounts uit, geparkeerd.',
    'destroy_disabled_account' => 'Timed fysieke verwijdering van uitgeschakelde accounts',
    'alarm_email_subject' => '[:site_name] achtergrond opschonen taak uitzondering',
    'alarm_email_body' => 'Huidige tijd: :now_time, level :level, Laatste looptijd was: :last_time, het is meer dan: :elapsed_seconden seconden(:elapsed_seconds_human) sinds het draaien, de set run interval is: :interval seconden(:interval_human), controleer alstublieft!',
    'alarm_email_subject_for_queue_failed_jobs' => '[:site_name]Asynchrone taak uitzondering',
    'alarm_email_body_for_queue_failed_jobs' => 'Er zijn in totaal :count mislukte asynchrone jobs sinds :since, opgenomen in de database tabel :failed_job_table gelieve het te controleren!',
];
