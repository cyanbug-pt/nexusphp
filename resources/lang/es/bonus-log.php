<?php

return [
    'business_types' => [
        \App\Models\BonusLogs::BUSINESS_TYPE_CANCEL_HIT_AND_RUN => 'Cancelar H&R',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_MEDAL => 'Comprar medalla',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_ATTENDANCE_CARD => 'Comprar tarjeta de asistencia',
        \App\Models\BonusLogs::BUSINESS_TYPE_STICKY_PROMOTION => 'Promoción adherida',
        \App\Models\BonusLogs::BUSINESS_TYPE_POST_REWARD => 'Recompensa postal',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_UPLOAD => 'Intercambio subido',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_INVITE => 'Comprar invitación',
        \App\Models\BonusLogs::BUSINESS_TYPE_CUSTOM_TITLE => 'Título personalizado',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_VIP => 'Comprar VIP',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_SOMEONE => 'Regalo a alguien',
        \App\Models\BonusLogs::BUSINESS_TYPE_NO_AD => 'Cancelar anuncio',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_TO_LOW_SHARE_RATIO => 'Ratio de regalo a bajo porcentaje',
        \App\Models\BonusLogs::BUSINESS_TYPE_LUCKY_DRAW => 'Dibujar la suerte',
        \App\Models\BonusLogs::BUSINESS_TYPE_EXCHANGE_DOWNLOAD => 'Intercambio descargado',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TEMPORARY_INVITE => 'Comprar invitación temporal',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_RAINBOW_ID => 'Comprar ID arco lluvia',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_CHANGE_USERNAME_CARD => 'Comprar cambio de nombre de usuario',
        \App\Models\BonusLogs::BUSINESS_TYPE_GIFT_MEDAL => 'Medalla de regalo',
        \App\Models\BonusLogs::BUSINESS_TYPE_BUY_TORRENT => 'Comprar torrent',

        \App\Models\BonusLogs::BUSINESS_TYPE_ROLE_WORK_SALARY => 'Salario de trabajo del rol',
        \App\Models\BonusLogs::BUSINESS_TYPE_TORRENT_BE_DOWNLOADED => 'Torrent descargado',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_REWARD => 'Recibir recompensa',
        \App\Models\BonusLogs::BUSINESS_TYPE_RECEIVE_GIFT => 'Recibir regalo',
        \App\Models\BonusLogs::BUSINESS_TYPE_UPLOAD_TORRENT => 'Subir torrent',
    ],
    'fields' => [
        'business_type' => 'Tipo de negocio',
        'old_total_value' => 'Valor de pre-operación',
        'value' => 'Valor de operación',
        'new_total_value' => 'Valor Post-trade',
    ],
];
