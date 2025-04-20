<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspekce',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Dosaženo',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Nedosaženo',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Prošívané',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Zakázáno',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Ruční',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globální',

    'reached_by_seed_time_comment' => 'Až do：:now,čas semínka: :seed_time dosáhne :seed_time_minimum hodin',
    'reached_by_share_ratio_comment' => "Až do：:now \nčas seedu: :seed_time Hhours Nedosažen :seed_time_minimum Hodin \npoměr sdílení :share_ratio dosáhl standardu：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Vaše uživatelská třída: :user_class_text nebo uživatel daroval, ignorujte tento H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) dosaženo!',
    'reached_message_content' => 'Gratulujeme! Torrent: :torrent_name(ID: :torrent_id) stahujete na: :completed_at dosáhne požadavku.',

    'unreached_comment' => "Až do：:now \nseed-time： :seed_time h Nedosahal požadavek：:seed_time_minimum Hour(s) \npoměr sdílení：:share_ratio nedosáhl požadavku：:ignore_when_ratio_reach i",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) nedostupné!',
    'unreached_message_content' => 'Torrent :torrent_name(ID: :torrent_id) byl stažen v :completed_at: nebyl dosažen! Vezměte prosím na vědomí, že nahromadění určitého počtu H&R vašeho účtu bude zakázáno.',

    'unreached_disable_comment' => 'H&R bylo dosaženo horního limitu a účet byl systémem deaktivován',
    'unreached_disable_message_content' => 'Váš účet byl zakázán, protože kumulativní počet H&R dosáhl systémového limitu: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'útrata :bonus zrušena',
    'remove_confirm_msg' => 'Zrušit H&R odečtením bonusu :bonus, OK?',
];
