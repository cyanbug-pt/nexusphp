<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspektion',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Nået',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Unået',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Tilladt',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Deaktiveret',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuelt',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globalt',

    'reached_by_seed_time_comment' => 'Op til：:nu,seed tid:seed_time Timer nået :seed_time_minimum Timer',
    'reached_by_share_ratio_comment' => "Op til：:now \nsåtid: :seed_time Timer Unået :seed_time_minimum Timer \nDelingsforhold: :share_ratio nåede standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Din brugerklasse: :user_class_text eller doneret bruger, ignorér denne H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) nået!',
    'reached_message_content' => 'Tillykke! Torrenten: :torrent_name(ID: :torrent_id) du downloader på: :completed_at har nået kravet.',

    'unreached_comment' => "Op til：:now \nseed time： :seed_time Timer Ikke nået kravet：:seed_time_minimum Timer \naktieforhold：:share_ratio ikke nået kravet：:ignore_when_ratio_reach også",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) ikke nået!',
    'unreached_message_content' => 'Torrent :torrent_name(ID: :torrent_id), du hentede på :completed_at: nåede ikke! Bemærk, at akkumulering af et bestemt antal H&R din konto vil blive deaktiveret.',

    'unreached_disable_comment' => 'H&R mængde nåede den øvre grænse og konto blev deaktiveret af systemet',
    'unreached_disable_message_content' => 'Din konto er blevet deaktiveret fordi den kumulative H&R tæller er nået systemets grænse: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'bruger :bonus annulleret',
    'remove_confirm_msg' => 'Eliminer en H&R ved at fradrage :bonus bonus, OK?',
];
