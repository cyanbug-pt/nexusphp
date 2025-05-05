<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Undersøk',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Oppnådd',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Unådd',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Benådet',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Deaktivert',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuell',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globalt',

    'reached_by_seed_time_comment' => 'Opp til：:now,seed time: :seed_time Tur(er) nådd :seed_time_minimum timour(s)',
    'reached_by_share_ratio_comment' => "Opptil：:now \nseed time: :seed_time Hour(s) Ikke nådd :seed_time_minimum Hour(s) \nDelforhold: :share_ratio nådd standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Din brukerklasse: :user_class_text eller donert bruker, ignorer denne H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) er nådd!',
    'reached_message_content' => 'Gratulerer! torrent: :torrent_name(ID: :torrent_id) laster ned på: fullført_at kravet er nådd.',

    'unreached_comment' => "Up to：:now \nseed time： :seed_time Hour(s) Unreached the requirement：:seed_time_minimum Hour(s) \nshare ratio：:share_ratio unreached the requirement：:ignore_when_ratio_reach too",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) er ikke nådd!',
    'unreached_message_content' => 'Taktoren :torrent_name(ID: :torrent_id) du lastet ned på :completed_at: ble ikke nådd! Vær oppmerksom på at som akkumulerer et visst antall håndverksmessige kontoer vil bli deaktivert.',

    'unreached_disable_comment' => 'H&R antall nådd øvre grense og konto ble deaktivert av systemet',
    'unreached_disable_message_content' => 'Kontoen din har blitt deaktivert fordi det samlede antallet H&R har blitt nådd systemgrensen: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'spend :bonus avbrutt',
    'remove_confirm_msg' => 'Eliminere en H&R ved å trekke fra :bonus bonus, OK?',
];
