<?php

return [
    'label' => 'Examen',
    'name' => 'Nom de l\'examen',
    'index' => 'Index des examens',
    'time_range' => 'Heure de l\'examen',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Incrémentation du téléchargement',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Moyenne du temps de la graine',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Incrémentation de téléchargement',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Incrément de bonus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Incrément de points de graine',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Incrémentation du torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Classe utilisateur',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Inscrire une plage de temps',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donné',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Plage de jours d\'inscription',
    ],
    'require_value' => 'Exiger',
    'current_value' => 'Actuel',
    'result' => 'Résultat',

    'result_pass_for_exam' => 'Passé !',
    'result_pass_for_task' => 'Terminé !',
    'result_not_pass_for_exam' => '<span style="color: red">Pas passé !</span>',
    'result_not_pass_for_task' => '<span style="color: red">Non terminé !</span>',
    'checkout_pass_message_subject_for_exam' => 'Examen réussi !',
    'checkout_pass_message_content_for_exam' => 'Félicitations ! Vous avez réussi l\'examen : :exam_name à temps (:begin ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'L\'examen n\'est pas réussi, et le compte est banni !',
    'checkout_not_pass_message_content_for_exam' => 'Vous n\'avez pas réussi l\'examen : :exam_name à temps (:begin ~ :end), et votre compte a été banni !',

    'checkout_pass_message_subject_for_task' => 'Tâche terminée !',
    'checkout_pass_message_content_for_task' => 'Félicitations ! Vous avez terminé la tâche : :exam_name à temps(:begin ~ :end), bonus obtenu :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Tâche non terminée !',
    'checkout_not_pass_message_content_for_task' => 'Vous n\'avez pas terminé la tâche: :exam_name dans le temps (:begin ~ :end), déduire le bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Examen incomplet: :exam_name dans le temps(:begin ~ :end)',
    'ban_user_modcomment' => 'En raison d\'un examen non terminé : :exam_name(:begin ~ :end), bannissement par système.',
    'admin' => [
        'list' => [
            'page_title' => 'Liste des examens'
        ]
    ],
    'recurring' => 'récurrents',
    'recurring_daily' => 'une fois par jour',
    'recurring_weekly' => 'une fois par semaine',
    'recurring_monthly' => 'une fois par mois',
    'recurring_help' => 'Si spécifié en tant que périodique, l\'heure de début de l\'examen est l\'heure de début du cycle courant, et l\'heure de fin est l\'heure de fin du cycle courant, qui sont tous des jours/semaines/mois naturels comme indiqué ici. Si le type est l\'examen, à la fin de chaque cycle, si l\'utilisateur répond toujours aux critères de dépistage. l\'utilisateur sera automatiquement assigné à un examen pour le prochain cycle.' ,

    'time_condition_invalid' => 'Le paramètre heure n\'a pas de sens, il y a et seulement un des trois éléments: heure de début + heure de fin / durée / récurrence',

    'type_exam' => 'Examen',
    'type_task' => 'Tâche',
    'type' => 'Type de texte',
    'type_help' => 'Les examens sont des examens réguliers et en cas d\'échec, ils entraîneront une interdiction de compte. Les tâches peuvent être configurées pour récompenser le bonus ou déduire le bonus selon qu\'elles sont complétées ou non',

    'fail_deduct_bonus' => 'Déduire le bonus en cas d\'échec',
    'success_reward_bonus' => 'Bonus de récompense pour avoir terminé',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Êtes-vous sûr de vouloir revendiquer ?' ,
    'claim_by_yourself_only' => 'Ne revendiquez que par vous-même!' ,
    'not_match_target_user' => 'Vous n\'êtes pas un utilisateur cible correspondant !' ,
    'has_other_on_the_way' => 'Il y a un autre :type_text en cours !' ,
    'claimed_already' => 'Déjà réclamé',
    'not_between_begin_end_time' => 'Pas entre le début et la fin',
    'reach_max_user_count' => 'Le nombre d\'utilisateurs revendiqués a atteint son maximum',
    'claimed_user_count' => 'Réclamé',
    'max_user_count' => 'Nombre maximum d\'utilisateurs réclamés (0 signifie illimité)',
    'background_color' => 'Couleur d\'arrière-plan de la boîte d\'information',
];
