<?php

return [

    'index' => [
        'page_title' => 'Список сообщений',
    ],
    'show' => [
        'page_title' => 'Детали сообщения',
    ],
    'field_value_change_message_body' => ':field изменено с :old на :new от :operator. Причина：:reason.',
    'field_value_change_message_subject' => ':field изменено',

    'download_disable' => [
        'subject' => 'Разрешение на загрузку отменено',
        'body' => 'Ваши привилегии на загрузку аннулированы, возможно, из-за низкого уровня общего доступа или неправильного поведения. О: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Разрешение на загрузку отменено',
        'body' => 'Ваше разрешение на загрузку было отменено из-за чрезмерной скорости загрузки, пожалуйста, загрузите файл, если вы являетесь пользователем коробки seed.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Разрешение на загрузку отменено',
        'body' => 'Ваше разрешение на загрузку было отменено из-за объявления торрента слишком много раз, пожалуйста, убедитесь, что у вас достаточно бонусов.' ,
    ],
    'download_enable' => [
        'subject' => 'Загруженные права восстановлены',
        'body' => 'Ваши привилегии загрузки восстановлены, теперь вы можете загружать торренты. За :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Временное приглашение :change_type',
        'body' => 'Количество временных приглашений было :change_type :count от :operator, причина: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Получить подарочную медаль',
        'body' => "Пользователь :username приобрел медаль [:medal_name] за счет :cost_bonus и дал ей вам. Медаль стоит :price, комиссия :gift_fee_total_factor: :gift_fee_factor), у вас будет эта медаль до: :expire_at, а бонусный множитель: :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Предупреждение о входе в систему :site_name',
        'body' => <<<BODY
Вы вошли в систему в::this_login_time, IP::this_ip, location::this_location.<br/>
Последнее время::last_login_time, IP:last_ip, location::last_location.<br/>
Если это не ваша операция, возможно пароль учетной записи был утечен, пожалуйста, измените его вовремя!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Напоминание о покупке торрентов',
        'body' => 'Вы потратили :bonus бонус, чтобы успешно купить торрент:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Время окончания экзамена :exam_name изменено',
        'body' => 'Время окончания вашего вступительного экзамена :exam_name изменилось с :old_end_time на :new_end_time. admin: :operator, reason: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Вы получили ПМ.",
    'mail_sender' => "Отправитель	",
    'mail_subject' => "Тема	",
    'mail_date' => "Дата		",
    'mail_use_following_url' => "Вы можете нажать&nbsp;",
    'mail_use_following_url_1' => "&nbsp;для просмотра сообщения (возможно вам придется войти).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "Команда %s",
    'mail_received_pm_from' => "Вы получили сообщение от ",
    'mail_here' => "ЗДЕСЬ",
    'msg_system' => "Система",
    'msg_original_message_from' => "Оригинальное сообщение от ",
];
