<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspectarea',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Realizat',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Neatins',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Pardonat',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Dezactivat',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manual',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Global',

    'reached_by_seed_time_comment' => 'Până la：:now,timp seed_time: :seed_time Ora (ore) atins(e) :seed_time_minimum Ore',
    'reached_by_share_ratio_comment' => "Până la：:now \ntimp seed_time Ora (ore) Neatins :seed_time_minimum Ore \nRaport de partajare: :share_ratio a atins standardul：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Clasa ta de utilizator: :user_class_text sau utilizator donat, ignoră acest H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) a ajuns!',
    'reached_message_content' => 'Felicitări! Torentul: :torrent_name(ID: :torrent_id) pe care îl descarci la: :completed_at a atins cerința.',

    'unreached_comment' => "Până la：:now \nora seed_time： :seed_time Ora (ore) Neatins cerința：:seed_time_minimum Ora (Ora) \nrata de partajare：:share_ratio neatins cerința：:ignore_when_ratio_reach de asemenea",
    'unreached_message_subject' => '&R(ID: :hit_and_run_id) inaccesibil!',
    'unreached_message_content' => 'Torentul :torrent_name(ID: :torrent_id) pe care l-ai descărcat în :completed_at: nu a ajuns! Te rugăm să reții că acumularea unui anumit număr de H&R contul tău va fi dezactivat.',

    'unreached_disable_comment' => 'Cantitatea H&R a atins limita superioară și contul a fost dezactivat de către sistem',
    'unreached_disable_message_content' => 'Contul tău a fost dezactivat deoarece numărul cumulat de H&R a fost atins limita de sistem: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'cheltuiala :bonus anulată',
    'remove_confirm_msg' => 'Eliminați H&R prin deducerea bonusului :bonus, ok?',
];
