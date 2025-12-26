<?php

return [
    'label' => 'Examen',
    'name' => 'Nombre del examen',
    'index' => 'Índice de examen',
    'time_range' => 'Tiempo del examen',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Incremento de subida',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Tiempo promedio de semilla',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Incremento de descarga',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Incremento de bonus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Incremento de puntos de semilla',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Subir incremento de torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Clase de usuario',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrar rango de tiempo',
        \App\Models\Exam::FILTER_USER_DONATE => 'Donado',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Rango de días de registro',
    ],
    'require_value' => 'Requiere',
    'current_value' => 'Actual',
    'result' => 'Resultado',

    'result_pass_for_exam' => '¡Pasado!',
    'result_pass_for_task' => '¡Completado!',
    'result_not_pass_for_exam' => '¡<span style="color: red">no aprobado!</span>',
    'result_not_pass_for_task' => '<span style="color: red">no completado!</span>',
    'checkout_pass_message_subject_for_exam' => '¡Examen aprobado!',
    'checkout_pass_message_content_for_exam' => '¡Enhorabuena! Ha aprobado el examen: :exam_name a tiempo (:begin ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => '¡El examen no pasa, y la cuenta está prohibida!',
    'checkout_not_pass_message_content_for_exam' => 'No ha aprobado el examen: :exam_name a tiempo (:begin ~ :end), ¡y su cuenta ha sido prohibida!',

    'checkout_pass_message_subject_for_task' => '¡Tarea completada!',
    'checkout_pass_message_content_for_task' => '¡Enhorabuena! Usted ha completado la tarea: :exam_name a tiempo (:begin ~ :end), obtuvo un bono: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => '¡Tarea no completada!',
    'checkout_not_pass_message_content_for_task' => 'Usted no completa la tarea: :exam_name a tiempo (:begin ~ :end), bonificación deducir: :fail_deduct_bonus.',

    'ban_log_reason' => 'Examen no completado: :exam_name a tiempo (:begin ~ :end)',
    'ban_user_modcomment' => 'Debido a no completar el examen: :exam_name(:begin ~ :end), ban por sistema.',
    'admin' => [
        'list' => [
            'page_title' => 'Lista de exámenes'
        ]
    ],
    'recurring' => 'recurrente',
    'recurring_daily' => 'una vez al día',
    'recurring_weekly' => 'una vez por semana',
    'recurring_monthly' => 'una vez al mes',
    'recurring_help' => 'Si se especifica como período, la hora de inicio del examen es la hora de inicio del ciclo actual, y la hora final es la hora final del ciclo actual, que son todos los días naturales/semanas/meses como se indica aquí. Si el tipo es un examen, al final de cada ciclo, si el usuario sigue cumpliendo con los criterios de selección al usuario se le asignará automáticamente un examen para el siguiente ciclo.' ,

    'time_condition_invalid' => 'El parámetro de tiempo no tiene sentido, hay y sólo uno de los tres elementos: hora de inicio + hora de finalización / duración / repetición',

    'type_exam' => 'Examen',
    'type_task' => 'Tarea',
    'type' => 'Tipo',
    'type_help' => 'El examen es regular y si no lo hacen, se prohibirán las cuentas. Las tareas pueden establecerse para recompensar bonificaciones o deducir bonos, dependiendo de si se completan o no',

    'fail_deduct_bonus' => 'Deducir bonificación por fallo',
    'success_reward_bonus' => 'Bono de recompensa para completar',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => '¿Seguro que quieres reclamar?' ,
    'claim_by_yourself_only' => '¡Reclama solo por ti mismo!' ,
    'not_match_target_user' => '¡No eres un usuario objetivo coincidente!' ,
    'has_other_on_the_way' => '¡Hay otro :type_text en progreso!' ,
    'claimed_already' => 'Ya reclamado',
    'not_between_begin_end_time' => 'No entre hora de inicio y fin',
    'reach_max_user_count' => 'El número de usuarios reclamados ha alcanzado su máximo',
    'claimed_user_count' => 'Reclamado',
    'max_user_count' => 'Número máximo de usuarios de reclamación (0 significa ilimitado)',
    'background_color' => 'Color de fondo del cuadro de información',
];
