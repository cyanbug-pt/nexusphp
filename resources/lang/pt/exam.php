<?php

return [
    'label' => 'Prova',
    'name' => 'Nome da prova',
    'index' => 'Índice de prova',
    'time_range' => 'Tempo da prova',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Incremento de upload',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Média de tempo semente',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Incremento de download',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Incremento de bônus',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Incremento de pontos de semente',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Carregar incremento de torrent',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Classe de usuário',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Registrar intervalo de tempo',
        \App\Models\Exam::FILTER_USER_DONATE => 'Doado',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Intervalo de dias de registro',
    ],
    'require_value' => 'Obrigatório',
    'current_value' => 'Atual',
    'result' => 'Resultado',

    'result_pass_for_exam' => 'Aprovado!',
    'result_pass_for_task' => 'Concluído!',
    'result_not_pass_for_exam' => '<span style="color: red">Not Passed!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Not Completed!</span>',
    'checkout_pass_message_subject_for_exam' => 'Prova passada!',
    'checkout_pass_message_content_for_exam' => 'Parabéns! Você passou na prova: :exam_name no tempo (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'O exame não passou e a conta foi banida!',
    'checkout_not_pass_message_content_for_exam' => 'Você não passou na prova: :exam_name no tempo (:start ~ :end), e sua conta foi banida!',

    'checkout_pass_message_subject_for_task' => 'Tarefa concluída!',
    'checkout_pass_message_content_for_task' => 'Parabéns! Você completou a tarefa: :exam_name no tempo (:start ~ :end), obteve bônus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Tarefa não concluída!',
    'checkout_not_pass_message_content_for_task' => 'Você não completou a tarefa: :exam_name a tempo (:start ~ :end), deduza o bônus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Teste não completo: :exam_name no tempo(:start ~ :end)',
    'ban_user_modcomment' => 'Devido a não concluir a prova: :exam_name(:start ~ :end), banimento pelo sistema.',
    'admin' => [
        'list' => [
            'page_title' => 'Lista de Exames'
        ]
    ],
    'recurring' => 'recorrente',
    'recurring_daily' => 'uma vez por dia',
    'recurring_weekly' => 'uma vez por semana',
    'recurring_monthly' => 'uma vez por mês',
    'recurring_help' => 'Se especificado como periódico, a hora de início do exame é o horário de início do ciclo atual, e o horário de término é o período de fim do ciclo atual, que são todos dias / semanas/meses, como aqui foi dito. Se o tipo é exame, no final de cada ciclo, se o usuário ainda atende aos critérios de screening ao usuário será atribuído automaticamente um exame para o próximo ciclo.' ,

    'time_condition_invalid' => 'O parâmetro hora não faz sentido, existem e apenas um dos três itens: hora inicial + hora final / duração / recorrente',

    'type_exam' => 'Prova',
    'type_task' => 'Tarefas',
    'type' => 'tipo',
    'type_help' => 'Os exames são exames regulares e se eles falharem resultará em banimento da conta. As tarefas podem ser definidas para receber ou deduzir o bônus dependendo se eles são completados ou não',

    'fail_deduct_bonus' => 'Deduzir bônus pela falha',
    'success_reward_bonus' => 'Bônus de recompensa por completar',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Certeza que deseja reivindicar?' ,
    'claim_by_yourself_only' => 'Reivindique apenas você mesmo!' ,
    'not_match_target_user' => 'Você não é um usuário de destino correspondente!' ,
    'has_other_on_the_way' => 'Há um outro :type_text em progresso!' ,
    'claimed_already' => 'Já coletados',
    'not_between_begin_end_time' => 'Não entre o horário de início e fim',
    'reach_max_user_count' => 'O número de usuários reivindicados atingiu o máximo',
    'claimed_user_count' => 'Reivindicado',
    'max_user_count' => 'Número máximo de usuários de reivindicação (0 significa ilimitado)',
    'background_color' => 'Cor de fundo da caixa de informações',
];
