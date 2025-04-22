<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Prüfe',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Erreicht',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Nicht erreicht',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Verzeiht',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Deaktiviert',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuell',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globale',

    'reached_by_seed_time_comment' => 'Bis zu：:now,Seed Zeit: :seed_time Stunde(n) erreicht :seed_time_minimum Stunden(n)',
    'reached_by_share_ratio_comment' => "Bis zu：:now \nSeed-Zeit: :seed_time Stunde(n) unerreicht :seed_time_minimum Stunden(n) \nFreigabeverhältnis :share_Ratio erreicht Standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Deine Benutzerklasse: :user_class_text oder gespendeter Benutzer, ignoriere diese H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) erreicht!',
    'reached_message_content' => 'Herzlichen Glückwunsch! Der Torrent: :torrent_name(ID: :torrent_id) den Sie herunterladen unter: :completed_at hat die Anforderung erreicht.',

    'unreached_comment' => "Bis zu：:now \nseed time： :seed_time Hour(s) nicht erreicht die Anforderung：:seed_time_minimum Stunden \nFreigabeverhältnis：:share_ratio hat die Anforderung：:ignore_when_ratio_reach auch nicht erreicht",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) nicht erreicht!',
    'unreached_message_content' => 'Der Torrent :torrent_name(ID: :torrent_id), den Sie auf :completed_at: heruntergeladen haben, wurde nicht erreicht! Bitte beachten Sie, dass die Anhäufung einer bestimmten Anzahl von H&R Ihr Konto deaktiviert wird.',

    'unreached_disable_comment' => 'H&R-Menge hat die Obergrenze erreicht und Konto wurde vom System deaktiviert',
    'unreached_disable_message_content' => 'Ihr Konto wurde deaktiviert, weil die kumulative H&R-Anzahl das Systemlimit erreicht hat: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => ':bonus ausgeben storniert',
    'remove_confirm_msg' => 'Eliminieren Sie ein H&R durch Abzug :bonus Bonus, OK?',
];
