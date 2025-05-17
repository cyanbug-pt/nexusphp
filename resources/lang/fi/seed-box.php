<?php

return [
    'type_text' => [
        \App\Models\SeedBoxRecord::TYPE_USER => 'Käyttäjä',
        \App\Models\SeedBoxRecord::TYPE_ADMIN => 'Ylläpitäjä',
    ],
    'status_text' => [
        \App\Models\SeedBoxRecord::STATUS_UNAUDITED => 'Tarkastamaton',
        \App\Models\SeedBoxRecord::STATUS_ALLOWED => 'Sallittu',
        \App\Models\SeedBoxRecord::STATUS_DENIED => 'Estetty',
    ],
    'status_change_message' => [
        'subject' => 'SeedBox-tietueen tila muuttunut',
        'body' => 'SeedBox-tietueen tila tunnisteella :id muuttui :operator paikasta :old_status muotoon :new_status. Syy: :reason',
    ],
    'is_seed_box_yes' => 'Tämä IP on SeedBox',
    'is_seed_box_no' => 'Tämä IP-osoite ei ole SeedBox',
];
