<?php

return [

    'index' => [
        'page_title' => 'Liste des messages',
    ],
    'show' => [
        'page_title' => 'Détail du message',
    ],
    'field_value_change_message_body' => ':field est passé de :old à :new par :operator. Raison：:reason.',
    'field_value_change_message_subject' => ':field modifié',

    'download_disable' => [
        'subject' => 'Autorisation de téléchargement annulée',
        'body' => 'Vos privilèges de téléchargement ont été révoqués, peut-être en raison de faibles taux de partage ou de mauvais comportement. Par: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Autorisation de téléchargement annulée',
        'body' => 'Votre autorisation de téléchargement a été annulée en raison de la vitesse de téléchargement excessive, veuillez créer un fichier si vous êtes un utilisateur de la boite de graine.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Autorisation de téléchargement annulée',
        'body' => 'Votre autorisation de téléchargement a été annulée en raison de l\'annonce de torrent payé trop de fois, assurez-vous que vous avez suffisamment de bonus.' ,
    ],
    'download_enable' => [
        'subject' => 'Autorisation de téléchargement restaurée',
        'body' => 'Vos privilèges de téléchargement ont été restaurés, vous pouvez maintenant télécharger des torrents. Par: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Invitation temporaire :change_type',
        'body' => 'Votre nombre d\'invitations temporaires a eu :change_type :count par :operator, raison: :reason.',
    ],
    'receive_medal' => [
        'subject' => 'Recevoir une médaille cadeau',
        'body' => "L'utilisateur :username a acheté une médaille [:medal_name] au coût de :cost_bonus et vous l'a donnée. La médaille vaut :price, les frais sont :gift_fee_total(facteur: :gift_fee_factor), vous aurez cette médaille jusqu'à: :expire_at, et le bonus de la médaille est :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Alerte de connexion de :site_name hors site',
        'body' => <<<BODY
You logged in at::this_login_time, IP::this_ip, location::this_location.<br/>
Last login time::last_login_time, IP::last_ip, location::last_location.<br/>
If it is not your own operation, the account password may have been leaked, please change it in time!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Rappel d\'achat de torrent réussi',
        'body' => 'Vous avez dépensé :bonus pour acheter avec succès le torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'L\'examen :exam_name date de fin a été modifié',
        'body' => 'L\'heure de fin de votre examen en cours :exam_name a changé de :old_end_time à :new_end_time. admin: :operator, reason: :reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Vous avez reçu une MM.",
    'mail_sender' => "Expéditeur	",
    'mail_subject' => "Sujet	",
    'mail_date' => "Date		",
    'mail_use_following_url' => "Vous pouvez cliquer sur&nbsp;",
    'mail_use_following_url_1' => "&nbsp;to view the message (you may have to login).",
    'mail_yours' => "<br />Yours,",
    'mail_the_site_team' => "L’équipe %s.",
    'mail_received_pm_from' => "Vous avez reçu un MP de ",
    'mail_here' => "ICI",
    'msg_system' => "Système",
    'msg_original_message_from' => "Message original de ",
];
