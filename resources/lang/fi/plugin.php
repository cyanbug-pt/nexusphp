<?php

return [
    'actions' => [
        'install' => 'asenna',
        'delete' => 'poista',
        'update' => 'päivitä',
        'install_or_update' => 'asenna/päivitä',
    ],
    'labels' => [
        'display_name' => 'nimi',
        'package_ name' => 'paketin_nimi',
        'remote_url' => 'repository_address',
        'installed_version' => 'installed_version',
        'latest_version' => 'latest_version',
        'status' => 'tila',
        'updated_at' => 'viimeiset_suoritettu toiminto',
        ' release_date' => 'päivitetty klo',
        'install_title' => 'Mene hakemistoon: :web_root, ja suorita seuraavat komennot asentaaksesi sen pääkäyttäjänä: ',
        'introduce' => 'Yksityiskohdat',
        'view_on_blog' => 'Näytä blogissa',
        ' config_plugin_address' => 'Määritä liitännäisen osoite',
        'download_specific_version' => 'Lataa laajennus. Viimeisin versio näytetään tässä, jos haluat asentaa toisen version (näytä blogista nähdäksesi kaikki versiot) korvaa sen itse',
        'execute_install' => 'Suorita asennus',
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
