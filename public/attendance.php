<?php
require '../include/bittorrent.php';
dbconn();
require get_langfile_path();
loggedinorreturn();
parked();
$lang = get_langfolder_cookie();
$localesMap = [
    'en' => 'en-us',
    'chs' => 'zh-cn',
    'cht' => 'zh-tw',
];
$localeJs = $localesMap[$lang] ?? 'en-us';

\Nexus\Nexus::css('vendor/fullcalendar-5.10.2/main.min.css', 'header', true);
\Nexus\Nexus::js('vendor/fullcalendar-5.10.2/main.min.js', 'footer', true);
\Nexus\Nexus::js("vendor/fullcalendar-5.10.2/locales/{$localeJs}.js", 'footer', true);

$rep = new \App\Repositories\AttendanceRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($iv == "yes") {
        check_code($_POST['imagehash'] ?? null, $_POST['imagestring'] ?? null, 'attendance.php');
    }
    $attendance = $rep->attend($CURUSER['id']);
    if (!$attendance->is_updated) {
        stderr($lang_attendance['sorry'], $lang_attendance['already_attended']);
    }
} else {
    $attendance = $rep->getAttendance($CURUSER['id']);
    if (!$attendance) {
        $attendance = new \App\Models\Attendance([
            'uid' => $CURUSER['id'],
            'points' => 0,
            'days' => 0,
            'total_days' => 0,
        ]);
        $attendance->added = null;
    }
}

$today = \Carbon\Carbon::today();
$tomorrow = \Carbon\Carbon::tomorrow();
$end = $today->clone()->endOfMonth();
$start = $today->clone()->subMonth(2);

$hasAttendedToday = $attendance->added && $attendance->added->isSameDay($today);
stdhead($lang_attendance['title']);
begin_main_frame();

if ($hasAttendedToday) {
    $todayDate = $today->format('Y-m-d');
    $baseQuery = \App\Models\AttendanceLog::query()->where('date', $todayDate);
    $todayCounts = $baseQuery->count();
    $myLog = (clone $baseQuery)->where('uid', $CURUSER['id'])->first(['id']);
    $myRanking = 0;
    if ($myLog) {
        $myRanking = (clone $baseQuery)->where('id', '<=', $myLog->id)->count();
    }

    $count = $attendance->total_days;
    $cdays = $attendance->days;
    $points = $attendance->points;

    $headerLeft = sprintf($lang_attendance['attend_info'] . $lang_attendance['retroactive_description'], $count, $cdays, $points, $CURUSER['attendance_card']);
    $headerRight = nexus_trans('attendance.ranking', ['ranking' => $myRanking, 'counts' => $todayCounts]);

    begin_frame($lang_attendance['success']);
    printf('<p>%s<span style="float:right">%s</span></p>', $headerLeft, $headerRight);
    end_frame();

    $logs = \App\Models\AttendanceLog::query()
        ->where('uid', $CURUSER['id'])
        ->where('date', '>=', $start->format('Y-m-d'))
        ->get()
        ->keyBy('date');
    $interval = new \DateInterval('P1D');
    $period = new \DatePeriod($start, $interval, $end);

    $interval = \Carbon\CarbonInterval::make($interval);
    $period = \Carbon\CarbonPeriod::make($period);
    $events = [];
    foreach ($period as $value) {
        if ($value->gte($tomorrow)) {
            continue;
        }
        $checkDate = $value->format('Y-m-d');
        $eventBase = ['start' => $checkDate, 'end' => $checkDate];
        if ($logs->has($checkDate)) {
            $logValue = $logs->get($checkDate);
            $events[] = array_merge($eventBase, ['display' => 'background']);
            if ($logValue->points > 0) {
                $events[] = array_merge($eventBase, ['title' => $logValue->points]);
            }
            if ($logValue->is_retroactive) {
                $events[] = array_merge($eventBase, ['title' => $lang_attendance['retroactive_event_text'], 'display' => 'list-item']);
            }
        } elseif ($value->lte($today) && $value->diffInDays($today, true) <= \App\Models\Attendance::MAX_RETROACTIVE_DAYS) {
            $events[] = array_merge($eventBase, ['groupId' => 'to_do', 'display' => 'list-item']);
        }
    }

    $eventStr = json_encode($events);
    $validRangeStr = json_encode(['start' => $start->format('Y-m-d'), 'end' => $end->clone()->addDays(1)->format('Y-m-d')]);

    $js = <<<EOP
let events = JSON.parse('$eventStr')
let validRange = JSON.parse('$validRangeStr')
let confirmText = "{$lang_attendance['retroactive_confirm_tip']}"
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: '$localeJs',
      events: events,
      validRange: validRange,
      eventClick: function(info) {
        console.log(info.event);
        if (info.event.groupId == 'to_do') {
            retroactive(info.event.startStr)
        }
      }
    });
    calendar.render();
});

function retroactive(dateStr) {
    if (!window.confirm(confirmText + dateStr + ' ?')) {
        console.log("cancel")
        return
    }
    jQuery.post('ajax.php', {params: {date: dateStr}, action: 'attendanceRetroactive'}, function (response) {
        console.log(response);
        if (response.ret != 0) {
            alert(response.msg)
        } else {
            location.reload();
        }
    }, 'json')
}
EOP;

    \Nexus\Nexus::js($js, 'footer', false);

    echo '<div style="display: flex;justify-content: center;padding: 20px 0"><div id="calendar" style="width: 60%"></div></div>';
    echo '<ul>';
    printf('<li>'.$lang_attendance['initial'].'</li>', $attendance_initial_bonus);
    printf('<li>'.$lang_attendance['steps'].'</li>', $attendance_step_bonus, $attendance_max_bonus);
    echo '<li><ol>';
    foreach($attendance_continuous_bonus as $day => $value){
        printf('<li>'.$lang_attendance['continuous'].'</li>', $day, $value);
    }
    echo '</ol></li>';
    echo '</ul>';
} else {
    $buttonLabel = $lang_attendance['attend_button'] ?? 'Check in';
    begin_frame($lang_attendance['title']);
    echo '<table width="100%" border="1" cellspacing="0" cellpadding="10"><tbody>';
    echo '<tr><td class="text">';
    echo '<div style="margin-top: 20px; text-align: center;">';
    echo '<form method="post" action="attendance.php" style="display: inline-block;">';
    echo '<table border="0" cellpadding="5">';
    show_image_code();
    echo '<tr><td class="toolbox" colspan="2" align="center"><input type="submit" value="' . htmlspecialchars($buttonLabel, ENT_QUOTES, 'UTF-8') . '" class="btn" /></td></tr>';
    echo '</table>';
    echo '</form>';
    echo '</div>';
    echo '</td></tr>';
    echo '</tbody></table>';
    end_frame();
}
end_main_frame();
stdfoot();
