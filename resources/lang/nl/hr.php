<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspecteren',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Bereikt',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Onbereikt',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Geparseerd',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Uitgeschakeld',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Handleiding',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Wereldwijd',

    'reached_by_seed_time_comment' => 'Tot：:nee, zaad tijd: :seed_time uur(s) bereikten :seed_time_minimum uur(s)',
    'reached_by_share_ratio_comment' => "Tot：:now \nhersteltijd: :seed_time uur(s) niet bereikt :seed_time_minimumuren \nShare ratio: :share_ratio reached standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Je gebruikersklasse: :user_class_text of gedoneerde gebruiker, negeer deze H&R",
    'reached_message_subject' => '&R(ID: :hit_and_run_id) bereikt!',
    'reached_message_content' => 'Gefeliciteerd! De torrent: :torrent_name(ID: :torrent_id) die je downloadt op: :completed_at heeft de vereiste bereikt.',

    'unreached_comment' => "Tot aan：:now \nhersteltijd： :seed_time uur(s) Onbereikt de eis：:seed_time_minimumuren \nDeel de verhouding：:share_ratio onbereikt de eis：:ignore_when_ratio_reach too",
    'unreached_message_subject' => '&R(ID: :hit_and_run_id) niet bereikt!',
    'unreached_message_content' => 'De torrent :torrent_name(ID: :torrent_id) die je hebt gedownload op :completed_at: heeft niet bereikt! Houd er rekening mee dat het verzamelen van een bepaald aantal H&R van je account zal worden uitgeschakeld.',

    'unreached_disable_comment' => 'De H&R-hoeveelheid heeft de bovengrens bereikt en het account is uitgeschakeld door het systeem',
    'unreached_disable_message_content' => 'Uw account is uitgeschakeld omdat het cumulatieve H&R aantal de systeemlimiet is bereikt: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'Uitgaven: bonus geannuleerd',
    'remove_confirm_msg' => 'Een H&R verwijderen door :bonus bonus, oké?',
];
