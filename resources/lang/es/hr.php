<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspección',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Alcanzado',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'No alcanzado',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Perdonado',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Deshabilitado',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manual',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Global',

    'reached_by_seed_time_comment' => 'Hasta：:ahora,tiempo de semilla: :seed_time Hora(s) alcanzó :seed_time_minimum Hora(s)',
    'reached_by_share_ratio_comment' => "Hasta：:now \nhora de semilla: :seed_time Hora(s) Unreached :seed_time_minimum Hora(s) \nRatio de comisión: :share_ratio alcanzó el estándar：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Tu clase de usuario: :user_class_text o usuario donado, ignora este H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) alcanzado!',
    'reached_message_content' => '¡Felicidades! El torrent: :torrent_name(ID: :torrent_id) que descarga en: :completed_at ha alcanzado el requisito.',

    'unreached_comment' => "Hasta：:now \nhora de semilla： :seed_time Hora(s) No alcanzó el requerimiento：:seed_time_minimum Hora(s) \nratio de acciones：:share_ratio tampoco alcanzó el requerimiento：:ignore_when_ratio_reach",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) inalcanzado!',
    'unreached_message_content' => '¡El torrent :torrent_name(ID: :torrent_id) que descargaste en :completed_at: no se alcanzó! Por favor, ten en cuenta que acumulando un cierto número de H&R tu cuenta será deshabilitada.',

    'unreached_disable_comment' => 'La cantidad de H&R alcanzó el límite superior y la cuenta fue deshabilitada por el sistema',
    'unreached_disable_message_content' => 'Su cuenta ha sido desactivada porque el recuento acumulado de H&R ha llegado al límite del sistema: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'gasto :bonus cancelado',
    'remove_confirm_msg' => 'Eliminar un H&R deduciendo :bonus bonus, ¿OK?',
];
