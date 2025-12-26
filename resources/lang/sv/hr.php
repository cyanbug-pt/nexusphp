<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspekterar',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Nått',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Onådd',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Pardonerad',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Inaktiverad',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuell',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globalt',

    'reached_by_seed_time_comment' => 'Upp till：:now,seed time: :seed_time Timme(s) nått :seed_time_minimum Timme(s)',
    'reached_by_share_ratio_comment' => "Upp till：:now \nseed time: :seed_time Tim(er) Onått :seed_time_minimum Tim(er) \nShare ratio: :share_ratio nått standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Din användarklass: :user_class_text eller donerad användare, ignorera denna H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) har uppnåtts!',
    'reached_message_content' => 'Grattis! torrenten: :torrent_name(ID: :torrent_id) du laddar ner på: :completed_at har nått kravet.',

    'unreached_comment' => "Upp till：:now \nseed time： :seed_time Hour(s) Unreached the requirement：:seed_time_minimum Hour(s) \nshare ratio：:share_ratio unreached the requirement：:ignore_when_ratio_reach too",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) onåd!',
    'unreached_message_content' => 'Torrent :torrent_name(ID: :torrent_id) du laddade ner på :completed_at: nåddes inte! Observera att ackumulering av ett visst antal H&R ditt konto kommer att inaktiveras.',

    'unreached_disable_comment' => 'H&R-kvantitet nådde den övre gränsen och kontot inaktiverades av systemet',
    'unreached_disable_message_content' => 'Ditt konto har inaktiverats eftersom det kumulativa H&R-antalet har nått systemgränsen: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'spendera :bonus avbruten',
    'remove_confirm_msg' => 'Eliminera en H&R genom att dra av :bonus bonus, OK?',
];
