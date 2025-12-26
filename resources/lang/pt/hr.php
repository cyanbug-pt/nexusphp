<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspecionando',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Alcançado',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Inalcançado',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Pardoado',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Desabilitado',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manualmente',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Global',

    'reached_by_seed_time_comment' => 'Até：:now,tempo de sement: :seed_time Hora(s) alcançada(s) :seed_time_minimum Hora(s)',
    'reached_by_share_ratio_comment' => "Até：:now \ntempo de sement: :seed_time Hora(s) Não alcançada:seed_time_minimum Hora(s) \nTaxa de compartilhamento: :share_ratio atingiu o padrão：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "A classe de usuário: :user_class_text ou usuário doado, ignore este H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) alcançado!',
    'reached_message_content' => 'Parabéns! O torrent: :torrent_name(ID: :torrent_id) que você baixou em: :completed_at tem que atingir o requisito.',

    'unreached_comment' => "Até：:now \nseed time： :seed_time Hora(s)：:seed_time _minimum Hora(s) \nshare ratio：:share_ratio não atingiu o requisito：:ignore_when_ratio_reach também",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) não alcançado!',
    'unreached_message_content' => 'O torrent :torrent_name(ID: :torrent_id) que você baixou em :completed_at: não foi alcançado! Por favor, note que acumulando um certo número de H&R sua conta será desativada.',

    'unreached_disable_comment' => 'H&R quantidade atingiu o limite máximo e a conta foi desativada pelo sistema',
    'unreached_disable_message_content' => 'Sua conta foi desativada porque a contagem cumulativa de H&R atingiu o limite do sistema: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'gastar :bonus cancelado',
    'remove_confirm_msg' => 'Elimine um H&R deduzindo :bônus, OK?',
];
