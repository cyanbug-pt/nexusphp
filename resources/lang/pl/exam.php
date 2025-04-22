<?php

return [
    'label' => 'Egzamin',
    'name' => 'Nazwa egzaminu',
    'index' => 'Indeks egzaminów',
    'time_range' => 'Czas egzaminu',
    'index_text_' . \App\Models\Exam::INDEX_UPLOADED => 'Przyrost wysyłania',
    'index_text_' . \App\Models\Exam::INDEX_SEED_TIME_AVERAGE => 'Średni czas nasion',
    'index_text_' . \App\Models\Exam::INDEX_DOWNLOADED => 'Pobierz przyrost',
    'index_text_' . \App\Models\Exam::INDEX_SEED_BONUS => 'Bonus przyrostu',
    'index_text_' . \App\Models\Exam::INDEX_SEED_POINTS => 'Przyrost punktów seeda',
    'index_text_' . \App\Models\Exam::INDEX_UPLOAD_TORRENT_COUNT => 'Prześlij przyrost torrenta',
    'filters' => [
        \App\Models\Exam::FILTER_USER_CLASS => 'Klasa użytkownika',
        \App\Models\Exam::FILTER_USER_REGISTER_TIME_RANGE => 'Zarejestruj zakres czasu',
        \App\Models\Exam::FILTER_USER_DONATE => 'Darowizna',
        \App\Models\Exam::FILTER_USER_REGISTER_DAYS_RANGE => 'Zakres dni rejestracji',
    ],
    'require_value' => 'Wymagaj',
    'current_value' => 'Bieżący',
    'result' => 'Wynik',

    'result_pass_for_exam' => 'Udało się!',
    'result_pass_for_task' => 'Ukończone!',
    'result_not_pass_for_exam' => '<span style="color: red">Nie zostało przyjęte!</span>',
    'result_not_pass_for_task' => '<span style="color: red">Nie Ukończono!</span>',
    'checkout_pass_message_subject_for_exam' => 'Egzamin minął!',
    'checkout_pass_message_content_for_exam' => 'Gratulacje! zaliczyłeś egzamin: :exam_name w czasie (:start ~ :end)',
    'checkout_not_pass_message_subject_for_exam' => 'Egzamin nie pasuje, a konto jest zbanowane!',
    'checkout_not_pass_message_content_for_exam' => 'Nie zdałeś egzaminu: :exam_name w czasie (:start ~ :end), a Twoje konto zostało zbanowane!',

    'checkout_pass_message_subject_for_task' => 'Zadanie zakończone!',
    'checkout_pass_message_content_for_task' => 'Gratulacje! Wykonałeś zadanie: :exam_name w czasie (:start ~ :end), otrzymałeś bonus: :success_reward_bonus',
    'checkout_not_pass_message_subject_for_task' => 'Zadanie nie ukończone!',
    'checkout_not_pass_message_content_for_task' => 'Nie ukończyłeś zadania: :exam_name w czasie (:start ~ :end), odliczenie premii: :fail_deduct_bonus.',

    'ban_log_reason' => 'Nieukończony egzamin: :exam_name w czasie (:start ~ :end)',
    'ban_user_modcomment' => 'Z powodu niepełnego egzaminu: :exam_name(:start ~ :end), zbanuj przez system.',
    'admin' => [
        'list' => [
            'page_title' => 'Lista egzaminów'
        ]
    ],
    'recurring' => 'cykliczny',
    'recurring_daily' => 'raz dziennie',
    'recurring_weekly' => 'raz w tygodniu',
    'recurring_monthly' => 'raz w miesiącu',
    'recurring_help' => 'Jeżeli jest określony jako okresowy, czas rozpoczęcia egzaminu to czas rozpoczęcia bieżącego cyklu, a czas zakończenia to czas zakończenia aktualnego cyklu, czyli wszystkie dni naturalne/tygodnie/miesiące, jak podano tutaj. Jeżeli typ jest egzaminowany, pod koniec każdego cyklu, jeśli użytkownik nadal spełnia kryteria przesiewowe, użytkownik zostanie automatycznie przypisany egzamin na następny cykl.' ,

    'time_condition_invalid' => 'Parametr czasu nie ma sensu, istnieje i tylko jedna z trzech pozycji: czas rozpoczęcia + czas zakończenia / czas trwania / cykliczny',

    'type_exam' => 'Egzamin',
    'type_task' => 'Zadanie',
    'type' => 'Typ',
    'type_help' => 'Egzamin jest regularnym egzaminem, a jego nieprzestrzeganie spowoduje zablokowanie konta. Zadania można ustawić jako premię lub odliczenie premii w zależności od tego, czy zostały ukończone, czy nie',

    'fail_deduct_bonus' => 'Odbierz bonus za awarię',
    'success_reward_bonus' => 'Bonus za ukończenie',

    'action_claim_task' => 'Claim',
    'confirm_to_claim' => 'Na pewno chcesz odebrać?' ,
    'claim_by_yourself_only' => 'Odbierz tylko przez siebie!' ,
    'not_match_target_user' => 'Nie jesteś pasującym użytkownikiem docelowym!' ,
    'has_other_on_the_way' => 'Jest inny :type_text w toku!' ,
    'claimed_already' => 'Już odebrane',
    'not_between_begin_end_time' => 'Nie pomiędzy początkiem i zakończeniem',
    'reach_max_user_count' => 'Liczba domniemanych użytkowników osiągnęła maksymalną liczbę',
    'claimed_user_count' => 'Domniemana',
    'max_user_count' => 'Maksymalna liczba użytkowników włości (0 oznacza nieograniczony)',
    'background_color' => 'Kolor tła pola informacyjnego',
];
