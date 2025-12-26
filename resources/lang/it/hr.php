<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Ispezione',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Raggiunto',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Non Raggiunto',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Perdonato',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Disabilitato',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuale',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globale',

    'reached_by_seed_time_comment' => 'Fino a：:now,seed time: :seed_time Hour(s) raggiunto :seed_time_minimum Hour(s)',
    'reached_by_share_ratio_comment' => "Fino a：:now \ntempo del seme: :seed_time Ore non raggiunte :seed_time_minimum Ore \nShare ratio: :share_ratio ha raggiunto lo standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "La tua classe utente: :user_class_text o utente donato, ignora questo H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) raggiunto!',
    'reached_message_content' => 'Congratulazioni! Il torrent: :torrent_name(ID: :torrent_id) che scarichi a: :completed_at ha raggiunto il requisito.',

    'unreached_comment' => "Fino a：:now \ntempo di seed： :seed_time Ore non raggiunte il requisito：:seed_time_minimum Ore \nratio：:share_ratio non raggiunse il requisito：:ignore_when_ratio_reach too",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) non raggiunto!',
    'unreached_message_content' => 'Il torrent :torrent_name(ID: :torrent_id) che hai scaricato su :completed_at: non è stato raggiunto! Nota che accumulare un certo numero di H&R il tuo account sarà disabilitato.',

    'unreached_disable_comment' => 'La quantità di H&R ha raggiunto il limite superiore e l\'account è stato disabilitato dal sistema',
    'unreached_disable_message_content' => 'Il tuo account è stato disabilitato perché il conteggio H&R cumulativo è stato raggiunto il limite di sistema: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'spendere :bonus annullato',
    'remove_confirm_msg' => 'Eliminare un H&R detraendo :bonus bonus, OK?',
];
