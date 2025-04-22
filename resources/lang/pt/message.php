<?php

return [

    'index' => [
        'page_title' => 'Lista de mensagens',
    ],
    'show' => [
        'page_title' => 'Detalhes da mensagem',
    ],
    'field_value_change_message_body' => ':field é alterado de :old para :new por :operator. Reason：:reason.',
    'field_value_change_message_subject' => ':field alterado',

    'download_disable' => [
        'subject' => 'Permissão de download cancelada',
        'body' => 'Seus privilégios de download foram revogados, possivelmente devido a baixas taxas de compartilhamento ou comportamento errado. Por: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Permissão de download cancelada',
        'body' => 'Sua permissão de download foi cancelada devido ao excesso de velocidade de upload, por favor o arquivo se você é um usuário da semente.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Permissão de download cancelada',
        'body' => 'Sua permissão de download foi cancelada devido ao anúncio de torrent pago muitas vezes, por favor, certifique-se de ter bônus suficiente.' ,
    ],
    'download_enable' => [
        'subject' => 'Permissão de download restaurada',
        'body' => 'Seus privilégios de download restaurados, agora você pode baixar torrents. Por: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Convite temporário :change_type',
        'body' => 'O seu concurso temporário tem :change_type :count por :operator, razão: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Receber medalha de presente',
        'body' => "Usuário :username comprou medalha [:medal_name] por um custo de :cost_bonus e deu para você. A medalha vale :preço, a taxa é :gift_fee_total(fator: :gift_fee_factor), você terá esta medalha até: :expire_at e o fator de adição da medalha é: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Alerta de login Offsite :site_name',
        'body' => <<<BODY
Você se conectou em::this_login_time, IP::this_ip, location::this_location.<br/>
Última vez de login::last_login_time, IP::last_ip, location::last_location.<br/>
Se não é a sua própria operação, a senha da conta pode ter sido vazada, por favor, altere-a a a tempo!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Lembrete de compra torrent bem sucedido',
        'body' => 'Você gastou :bonus para comprar com sucesso o torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Alterada a hora de término do exame :exam_name',
        'body' => 'O horário final do seu exame em andamento :exam_name mudou de :old_end_time para :new_end_time. administrador: :operator, motivo: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Você recebeu uma TPM.",
    'mail_sender' => "Remetente	",
    'mail_subject' => "Assunto	",
    'mail_date' => "Data		",
    'mail_use_following_url' => "Você pode clicar&nbsp;",
    'mail_use_following_url_1' => "&nbsp;to view the message (you may have to login).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "A Equipe %s.",
    'mail_received_pm_from' => "Você recebeu uma MP de ",
    'mail_here' => "AQUI",
    'msg_system' => "SISTEMA",
    'msg_original_message_from' => "Mensagem original de ",
];
