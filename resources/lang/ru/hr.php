<?php

return [
    'status_' . \App\Models\HitAndRun::STATUS_INSPECTING => 'Инспекция',
    'status_' . \App\Models\HitAndRun::STATUS_REACHED => 'Достигнуто',
    'status_' . \App\Models\HitAndRun::STATUS_UNREACHED => 'Недостигнуто',
    'status_' . \App\Models\HitAndRun::STATUS_PARDONED => 'Отклонено',

    'mode_' . \App\Models\HitAndRun::MODE_DISABLED => 'Отключено',
    'mode_' . \App\Models\HitAndRun::MODE_MANUAL => 'Ручной',
    'mode_' . \App\Models\HitAndRun::MODE_GLOBAL => 'Глобально',

    'reached_by_seed_time_comment' => 'До：:now,seed время: :seed_time Час(ы) достигнут :seed_time_minimum час(ов)',
    'reached_by_share_ratio_comment' => "До：:now \nвремя: :seed_time Час(ов) Недостигнуто(и) :seed_time_minimum час(ов) \nОтношение: :share_ratio достиг стандартного：:ignore_when_ratio_reach",
    'reached_by_special_user_class_comment' => "Ваш класс пользователя: :user_class_text или пожертвованный пользователь, игнорируйте этот H&R",
    'reached_message_subject' => 'H&R(ID: :hit_and_run_id) достигнут!',
    'reached_message_content' => 'Поздравляем! Торрент: :torrent_name(ID: :torrent_id), который вы скачиваете на сайте: :completed_at имеет соответствие требованию.',

    'unreached_comment' => "До：:now \nвремя семян： :seed_time Час(ы) Недостигнуто условие：:seed_time_minimum Hour(s) \nкоэффициент доли：:share_ratio не достиг требования：:ignore_when_ratio_reach тоже",
    'unreached_message_subject' => 'H&R(ID: :hit_and_run_id) недоступно!',
    'unreached_message_content' => 'Торрент :torrent_name(ID: :torrent_id), который вы скачали на :completed_at: , не достигнут! Пожалуйста, обратите внимание, что накопление определенного количества H&R будет отключено.',

    'unreached_disable_comment' => '&Количество HR достигло верхнего предела и аккаунт был отключен системой',
    'unreached_disable_message_content' => 'Ваша учетная запись была отключена, так как общее число H&R достигло системного предела: :ban_user_when_counts_reach',

    'bonus_cancel_comment' => 'потратить :bonus отменено',
    'remove_confirm_msg' => 'Устранение H&R, вычитав :bonus bonus, OK?',
];
