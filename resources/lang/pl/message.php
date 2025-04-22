<?php

return [

    'index' => [
        'page_title' => 'Lista wiadomości',
    ],
    'show' => [
        'page_title' => 'Szczegóły wiadomości',
    ],
    'field_value_change_message_body' => ':field został zmieniony z :old na :new przez :operator. Powód：:Reason.',
    'field_value_change_message_subject' => 'Zmieniono :field',

    'download_disable' => [
        'subject' => 'Uprawnienie do pobierania anulowane',
        'body' => 'Twoje uprawnienia do pobierania zostały cofnięte, prawdopodobnie ze względu na niskie wskaźniki udostępniania lub niewłaściwe zachowanie. przez: :operator',
    ],
    'download_disable_upload_over_speed' => [
        'subject' => 'Uprawnienie do pobierania anulowane',
        'body' => 'Twoje uprawnienie do pobierania zostało anulowane z powodu nadmiernej prędkości wysyłania, proszę plik jeśli jesteś użytkownikiem skrzynki seedów.' ,
    ],
    'download_disable_announce_paid_torrent_too_many_times' => [
        'subject' => 'Uprawnienie do pobierania anulowane',
        'body' => 'Twoje zezwolenie na pobieranie zostało anulowane z powodu zbyt wielu ogłoszeń o płatnym torrencie, upewnij się, że masz wystarczająco dużo bonusu.' ,
    ],
    'download_enable' => [
        'subject' => 'Uprawnienia pobierania przywrócone',
        'body' => 'Twoje uprawnienia do pobierania przywrócone, możesz teraz pobrać torrenty. przez: :operator',
    ],
    'temporary_invite_change' => [
        'subject' => 'Tymczasowe zaproszenie :change_type',
        'body' => 'Twoja tymczasowa liczba zaproszeń miała :change_type :count przez :operator, powód: :Reason.',
    ],
    'receive_medal' => [
        'subject' => 'Odbierz medal prezentowy',
        'body' => "Użytkownik :username kupił medal [:medal_name] kosztem :cost_bonus i przekazał go Tobie. Wartość medalu wynosi :cena, opłata wynosi :gift_fee_total(factor: :gift_fee_factor), a wartość medalu wynosi :bonus_addition_factor.",
    ],
    'login_notify' => [
        'subject' => 'Powiadomienie o logowaniu do :site_name',
        'body' => <<<BODY
Zalogowałeś się na adres::this_login_time, IP::this_ip, lokalizacja::this_location.<br/>
Czas ostatniego logowania::last_login_time, IP:last_ip, lokalizacja::last_location.<br/>
Jeśli nie jest to twoja własna operacja, hasło do konta mogło zostać wyciekowe, zmień je na czas!
BODY,
    ],
    'buy_torrent_success' => [
        'subject' => 'Pomyślne przypomnienie o zakupie torrentów',
        'body' => 'Wydałeś bonus :bonus, aby kupić torrent:[url=:url]:torrent_name[/url]',
    ],
    'exam_user_end_time_updated' => [
        'subject' => 'Zmieniono czas zakończenia egzaminu :exam_name',
        'body' => 'Czas zakończenia egzaminu :exam_name zmienił się z :old_end_time na :new_end_time. admin: :operator, powód: :Reason.',
    ],

    'mail_dear' => "Dear ",
    'mail_you_received_a_pm' => "Otrzymałeś PM.",
    'mail_sender' => "Nadawca	",
    'mail_subject' => "Temat	",
    'mail_date' => "Data		",
    'mail_use_following_url' => "Możesz kliknąć&nbsp;",
    'mail_use_following_url_1' => "&nbsp;wyświetlić wiadomość (być może będziesz musiał się zalogować).",
    'mail_yours' => "<br />Nasz,",
    'mail_the_site_team' => "Drużyna %s.",
    'mail_received_pm_from' => "Otrzymałeś wiadomość prywatną od ",
    'mail_here' => "HERA",
    'msg_system' => "System",
    'msg_original_message_from' => "Oryginalna wiadomość od ",
];
