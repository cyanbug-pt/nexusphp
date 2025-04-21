<?php

return [
    'actions' => [
        'install' => 'Asenna',
        'delete' => 'Poista',
        'update' => 'Päivitä',
    ],
    'labels' => [
        'display_name' => 'Nimi',
        'package_name' => 'Paketin nimi',
        'remote_url' => 'Versiovaraston osoite',
        'installed_version' => 'Asennettu versio',
        'status' => 'Tila',
        'updated_at' => 'Viimeisin toiminto osoitteessa',
    ],
    'status' => [
        \App\Models\Plugin::STATUS_NORMAL => 'Normaali',
        \App\Models\Plugin::STATUS_NOT_INSTALLED => 'Ei asennettu',

        \App\Models\Plugin::STATUS_PRE_INSTALL => 'Valmis asentamaan',
        \App\Models\Plugin::STATUS_INSTALLING => 'Asennetaan',
        \App\Models\Plugin::STATUS_INSTALL_FAILED => 'Asennus epäonnistui',

        \App\Models\Plugin::STATUS_PRE_UPDATE => 'Valmis päivittämään',
        \App\Models\Plugin::STATUS_UPDATING => 'Päivitetään',
        \App\Models\Plugin::STATUS_UPDATE_FAILED => 'Päivityksen epäonnistuminen',

        \App\Models\Plugin::STATUS_PRE_DELETE => 'Valmis poistamaan',
        \App\Models\Plugin::STATUS_DELETING => 'Poistaminen',
        \App\Models\Plugin::STATUS_DELETE_FAILED => 'Poista epäonnistuminen',
    ],
];
