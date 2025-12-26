<?php

return [
    'label' => 'Экзамен',
    'name' => 'Имя экзамена',
    'index' => 'Индекс экзамена',
    'time_range' => 'Время экзамена',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Загрузка увеличения',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Среднее время семян',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Загрузить инкремент',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Бонусный прирост',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Увеличение очков семенного материала',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Повышение загрузки торрентов',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Класс пользователя',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Регистрировать промежуток',
        \App\Models\Exam::FILTER_USER_DONATE => 'Пожертвовано',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Диапазон дней регистрации',
    ],
    'require_value' => 'Требовать',
    'current_value' => 'Текущее',
    'result' => 'Результат',

    'result_pass_for_exam' => 'Пройдено!',
    'result_pass_for_task' => 'Завершено!',
    'result_not_pass_for_exam' => '<span style="color: red">не пройден!</span>',
    'result_not_pass_for_task' => '<span style="color: red">не завершено!</span>',
    'checkout_pass_message_subject_for_exam' => 'Экзамен пройден!',
    'checkout_pass_message_content_for_exam' => 'Поздравляем! Вы сдали экзамен: :exam_name вовремя (:begin ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Экзамен не сдан и аккаунт забанен!',
    'checkout_not_pass_message_content_for_exam' => 'Вы не сдали экзамен: :exam_name вовремя (:begin ~ :end), и ваша учетная запись была забанена!',

    'checkout_pass_message_subject_for_task' => 'Задача выполнена!',
    'checkout_pass_message_content_for_task' => 'Поздравляем! Вы выполнили задачу: :exam_name вовремя (:begin ~ :end), получили бонус: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Задача не завершена!',
    'checkout_not_pass_message_content_for_task' => 'Вы не выполнили задачу: :exam_name вовремя (:begin ~ :end), удерживайте бонус: :fail_deduct_bonus.',

    'ban_log_reason' => 'Не закончено задание: :exam_name в time(:begin ~ :end)',
    'ban_user_modcomment' => 'Из-за незавершённого экзамена: :exam_name(:begin ~ :end), бан системой.',
    'admin' => [
        'list' => [
            'page_title' => 'Список экзаменов'
        ]
    ],
    'recurring' => 'повторяющийся',
    'recurring_daily' => 'один раз в день',
    'recurring_weekly' => 'раз в неделю',
    'recurring_monthly' => 'раз в месяц',
    'recurring_help' => 'Если задано периодически, время начала экзамена - время начала текущего цикла, и время окончания - это время окончания текущего цикла, все естественные дни/недели/месяцы, как указано здесь. Если тип проверяется, в конце каждого цикла, если пользователь все еще удовлетворяет критериям отбора, пользователь будет автоматически назначен экзамен на следующий цикл.' ,

    'time_condition_invalid' => 'Параметр времени не имеет смысла, есть и только один из трех пунктов: время начала + время окончания / длительность / повторение',

    'type_exam' => 'Экзамен',
    'type_task' => 'Задача',
    'type' => 'Тип',
    'type_help' => 'Экзамен является обычным экзаменом, и его неудача приведет к блокировке аккаунта. Задания могут быть назначены для награждения бонуса или вычета бонуса в зависимости от того, выполняются ли они или нет',

    'fail_deduct_bonus' => 'Вычесть бонус за неудачу',
    'success_reward_bonus' => 'Бонус вознаграждения за завершение',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Вы уверены, что хотите получить?' ,
    'claim_by_yourself_only' => 'Утвердить только вас!' ,
    'not_match_target_user' => 'Вы не соответствуете целевому пользователю!' ,
    'has_other_on_the_way' => 'Происходит другой :type_text!' ,
    'claimed_already' => 'Уже занято',
    'not_between_begin_end_time' => 'Не от времени начала до конца',
    'reach_max_user_count' => 'Количество заявленных пользователей достигло максимума',
    'claimed_user_count' => 'Получено',
    'max_user_count' => 'Максимальное количество пользователей (0 означает безлимитно)',
    'background_color' => 'Цвет фона панели информации',
];
