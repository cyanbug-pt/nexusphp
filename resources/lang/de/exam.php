<?php

return [
    'label' => 'Prüfung',
    'name' => 'Prüfungsname',
    'index' => 'Prüfungsindex',
    'time_range' => 'Prüfungszeit',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Hochladen',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Seed Zeitdurchschnitt',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Download Inkrement',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonuserhöhung',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Seed Punkte erhöhen',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Torrent-Upload hochladen',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Benutzerklasse',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Zeitspanne registrieren',
        \App\Models\Exam::FILTER_USER_DONATE => 'Gespendet',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Zeitraum der Registrierung',
    ],
    'require_value' => 'Benötigt',
    'current_value' => 'Aktuell',
    'result' => 'Ergebnis',

    'result_pass_for_exam' => 'Passeiert!',
    'result_pass_for_task' => 'Abgeschlossen!',
    'result_not_pass_for_exam' => '<span style="color: red">Nicht überfüllt!</span>',
    'result_not_pass_for_task' => '<span style="color: red">nicht abgeschlossen!</span>',
    'checkout_pass_message_subject_for_exam' => 'Prüfung bestanden!',
    'checkout_pass_message_content_for_exam' => 'Herzlichen Glückwunsch! Sie haben die Prüfung bestanden: :exam_name in der Zeit (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Prüfung nicht bestanden, und Konto ist gesperrt!',
    'checkout_not_pass_message_content_for_exam' => 'Sie haben die Prüfung nicht bestanden: :exam_name in der Zeit (:start ~ :end) und Ihr Konto wurde gesperrt!',

    'checkout_pass_message_subject_for_task' => 'Aufgabe abgeschlossen!',
    'checkout_pass_message_content_for_task' => 'Glückwunsch! Du hast die Aufgabe erledigt: :exam_name in der Zeit (:begin ~ :end), bekam Bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Aufgabe nicht abgeschlossen!',
    'checkout_not_pass_message_content_for_task' => 'Sie dit dit nicht abgeschlossen die Aufgabe: :exam_name rechtzeitig (:begin ~ :end), deduct bonus: :fail_deduct_bonus.',

    'ban_log_reason' => 'Prüfung nicht abgeschlossen: :exam_name in der Zeit (:start ~ :end)',
    'ban_user_modcomment' => 'Aufgrund der nicht vollständigen Prüfung: :exam_name(:start ~ :end), ban by System.',
    'admin' => [
        'list' => [
            'page_title' => 'Prüfungsliste'
        ]
    ],
    'recurring' => 'wiederkehrend',
    'recurring_daily' => 'einmal pro Tag',
    'recurring_weekly' => 'einmal pro Woche',
    'recurring_monthly' => 'einmal im Monat',
    'recurring_help' => 'Wenn als periodisch angegeben, ist die Startzeit der Prüfung die Startzeit des aktuellen Zyklus, und die Endzeit ist die Endzeit des aktuellen Zyklus, die alle natürlichen Tage/Wochen/Monate, wie hier beschrieben. Ist der Typ Prüfung, am Ende jedes Zyklus, wenn der Benutzer noch die Prüfkriterien erfüllt dem Benutzer wird automatisch eine Prüfung für den nächsten Zyklus zugewiesen.' ,

    'time_condition_invalid' => 'Der Zeit-Parameter macht keinen Sinn, es gibt und nur eine von drei Elementen: Startzeit + Endzeit / Dauer / wiederkehrend',

    'type_exam' => 'Prüfung',
    'type_task' => 'Aufgabe',
    'type' => 'Typ',
    'type_help' => 'Prüfungen sind regelmäßige Prüfungen und wenn sie nicht durchgeführt werden, wird dies zu einem Kontoverbot führen. Aufgaben können auf Prämien-Bonus oder Bonus eingestellt werden, je nachdem, ob diese erledigt sind oder nicht',

    'fail_deduct_bonus' => 'Bonus wegen Fehlschlag abziehen',
    'success_reward_bonus' => 'Belohnungsbonus für Fertigstellung',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Sind Sie sicher, dass Sie behaupten wollen?' ,
    'claim_by_yourself_only' => 'Nur von dir selbst beanspruchen!' ,
    'not_match_target_user' => 'Du bist kein passender Zielbenutzer!' ,
    'has_other_on_the_way' => 'Es ist ein weiterer :type_text im Gange!' ,
    'claimed_already' => 'Bereits abgeholt',
    'not_between_begin_end_time' => 'Nicht zwischen Start- und Endzeit',
    'reach_max_user_count' => 'Die Anzahl der beanspruchten Benutzer hat ihr Maximum erreicht',
    'claimed_user_count' => 'Beansprucht',
    'max_user_count' => 'Max beanspruchte Benutzeranzahl (0 bedeutet unbegrenzt)',
    'background_color' => 'Hintergrundfarbe des Infofensters',
];
