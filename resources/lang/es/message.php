<?php

return [

    'index' => [
        'page_title' => 'Lista de mensajes',
    ],
    'show' => [
        'page_title' => 'Detalle del mensaje',
    ],
    'field_value_change_message_body' => ':field cambia de :old a :new por :operator. Razon：:reason.',
    'field_value_change_message_subject' => ':field cambiado',

    'download_disable' => [
        'subject' => 'Permiso de descarga cancelado',
        'body' => 'Tus privilegios de descarga se han revocado, posiblemente debido a bajos índices de intercambio o mala conducta. Por: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Permiso de descarga cancelado',
        'body' => 'Su permiso de descarga ha sido cancelado debido a una velocidad excesiva de carga, por favor archive si usted es un usuario de la caja de semillas.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Permiso de descarga cancelado',
        'body' => 'Tu permiso de descarga ha sido cancelado debido a que has anunciado que pagas el torrent demasiadas veces, por favor asegúrate de tener suficiente bono.' ,
    ],
    'download_enable' => [
        'subject' => 'Permiso de descarga restaurado',
        'body' => 'Tus privilegios de descarga han sido restaurados, ahora puedes descargar torrents. Por: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Invitación temporal :change_type',
        'body' => 'Tu conteo temporal de invitaciones tenía :change_type :count por :operator, reason: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Recibir medalla de regalo',
        'body' => "El usuario :username compró una medalla [:medal_name] a un costo de :cost_bonus y te la entregó. La medalla vale :price, la comisión es :gift_fee_total(factor: :gift_fee_factor), tendrás esta medalla hasta: :expire_at, y el factor de adición de la medalla es: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Alerta de inicio de sesión de :site_name',
        'body' => <<<BODY
You logged in at::this_login_time, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
If it is not your own operation, the account password may have been leaked, please change it in time!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Recordatorio de compra de torrent exitoso',
        'body' => 'Ha gastado :bonus bonus para comprar correctamente el torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Tiempo de finalización del examen :exam_name cambiado',
        'body' => 'La hora de finalización de su examen :exam_name en progreso ha cambiado de :old_end_time a :new_end_time. admin: :operator, reason: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Has recibido un PM.",
    'mail_sender' => "Remitente	",
    'mail_subject' => "Mañana	",
    'mail_date' => "Fecha		",
    'mail_use_following_url' => "Puedes hacer clic en&nbsp;",
    'mail_use_following_url_1' => "&nbsp;para ver el mensaje (puede que tengas que iniciar sesión).",
    'mail_yours' => "<br />tuyos,",
    'mail_the_site_team' => "El equipo %s.",
    'mail_received_pm_from' => "Has recibido un PM de ",
    'mail_here' => "AQUÍ",
    'msg_system' => "Sistema",
    'msg_original_message_from' => "Mensaje original de ",
];
