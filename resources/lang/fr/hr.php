<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Inspection en cours',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Atteint',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Non atteint',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Pardon',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Désactivé',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Manuelle',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Globale',

    'reached_by_seed_time_comment' => 'Jusqu\'à：:now,durée de la seed : :seed_time Hour(s) atteinte(s) :seed_time_minimum(s)',
    'reached_by_share_ratio_comment' => "Jusqu'à：:now \ndurée de la graine: :seed_time Hour(s) Inatteinte(s) :seed_time_minimum Hour(s) \nRatio Partage: :share_ratio atteint la norme：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Votre classe utilisateur : :user_class_text ou un utilisateur donné, ignorez cette H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) atteint !',
    'reached_message_content' => 'Félicitations ! Le torrent: :torrent_name(ID: :torrent_id) que vous téléchargez à: :completed_at a atteint cette exigence.',

    'unreached_comment' => "Jusqu'à：:now \ntemps de la seed： :seed_time Hour(s) non atteint(s) le critère：:seed_time_minimum Hour(s) \nratio：:share_ratio non atteint l'exigence：:ignore_when_ratio_reach",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) inatteint!',
    'unreached_message_content' => 'Le torrent :torrent_name(ID: :torrent_id) que vous avez téléchargé sur :completed_at: n\'a pas été atteint ! Veuillez noter que l\'accumulation d\'un certain nombre de H&R votre compte sera désactivée.',

    'unreached_disable_comment' => 'La quantité H&R a atteint la limite supérieure et le compte a été désactivé par le système',
    'unreached_disable_message_content' => 'Votre compte a été désactivé car le nombre cumulé de H&R a été atteint la limite système: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'dépenser :bonus annulé',
    'remove_confirm_msg' => 'Eliminez une H&R en déduisant le bonus :bonus, OK?',
];
