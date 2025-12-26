<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Пользователь',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Администратор',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Не прослушано',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Разрешено',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Отказано',
    ],
    'status_change_message' => [
        'subject' => 'Статус записи SeedBox изменен',
        'body' => 'Статус вашей записи SeedBox с ID :id был изменен :operator с :old_status на :new_status. Причина: :reason',
    ],
    'is_seed_box_yes' => 'Этот IP является SeedBox',
    'is_seed_box_no' => 'Этот IP не SeedBox',
];
