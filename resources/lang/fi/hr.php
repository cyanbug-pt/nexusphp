<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Tarkastus',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Saavutettu',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Päättämätön',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Parantunut',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Pois Käytöstä',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuaalinen',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globaali',

    'reached_by_seed_time_comment' => 'Jopa：:now,seed time: :seed_time Tunti(s) reached :seed_time_minimum Tunti(s)',
    'reached_by_share_ratio_comment' => "Enintään：:now \nseed time: :seed_time Tunti(t) Päättämättä :seed_time_minimum Tunti(t) \nJaa suhde: :share_ratio saavutti standardin：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Käyttäjäluokka: :user_class_text tai lahjoittanut käyttäjän, ohita tämä H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) saavutettu!',
    'reached_message_content' => 'Onneksi olkoon! Torrent: :torrent_name(ID: :torrent_id) lataat osoitteeseen: :completed_at täyttää vaatimuksen.',

    'unreached_comment' => "Enintään：:now \nseed time： :seed_time Tunti(t) Päättämättä vaatimusta：:seed_time_minimum Tun(s) \nshare ratio：:share_ratio ei saavuttanut vaatimusta：:ignore_when_ratio_reach too",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) ei saavutettu!',
    'unreached_message_content' => 'Torrentti :torrent_name(ID: :torrent_id) jonka latasit :completed_at: ei saavutettu! Huomaa, että tietyn määrän H&R kerääntyminen on pois päältä.',

    'unreached_disable_comment' => 'H&R-määrä saavutti ylärajan, ja järjestelmä poisti tilin käytöstä',
    'unreached_disable_message_content' => 'Tilisi on poistettu käytöstä, koska kumulatiivinen H&R-määrä on saavutettu järjestelmäraja: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'käytä :bonus peruutettu',
    'remove_confirm_msg' => 'Poista HT&R vähentämällä :bonus bonus, OK?',
];
