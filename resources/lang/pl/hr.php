<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspekcja',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Osiągnięto',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Nieosiągnięty',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Przesłane',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Wyłączone',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Ręcznie',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globalny',

    'reached_by_seed_time_comment' => 'Do：:teraz,czas seed_time Godzin(y) :seed_time_minimum Godzin(y)',
    'reached_by_share_ratio_comment' => "Do：:teraz \nczas seed: :seed_time Godzin(y) :seed_time_minimum Godzin(y) \nWspółpraca: :share_ratio osiągnął standard：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Twoja klasa użytkownika: :user_class_text lub użytkownik darowizny, zignoruj ten H&R",
    'reached_message_subject' => 'Osiągnięto H&R(ID: :hit_and_run_id)!',
    'reached_message_content' => 'Gratulacje! Torrent: :torrent_name(ID: :torrent_id) pobierasz pod adresem: :completed_at spełnia wymagania.',

    'unreached_comment' => "Do：:teraz \nczas seed_time： :seed_time Hour(s) Nieosiągnął wymagania：:seed_time_minimum Godziny \nstosunek：:share_ratio nieosiągnął wymagania：:ignore_when_ratio_reach",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) nieosiągnięty!',
    'unreached_message_content' => 'Torrent :torrent_name(ID: :torrent_id) pobrany na :completed_at: nie został osiągnięty! Pamiętaj, że kumulacja pewnej liczby H&R Twojego konta zostanie wyłączona.',

    'unreached_disable_comment' => 'Ilość H&R osiągnęła górny limit, a konto zostało wyłączone przez system',
    'unreached_disable_message_content' => 'Twoje konto zostało wyłączone, ponieważ skumulowana liczba H&R osiągnęła limit systemowy: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'anulowano wypłatę :bonus',
    'remove_confirm_msg' => 'Wyeliminować H&R odejmując bonus :bonus, OK?',
];
