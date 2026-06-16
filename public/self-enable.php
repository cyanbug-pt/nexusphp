<?php
require_once("../include/bittorrent.php");
dbconn();
loggedinorreturn();
parked();
\Nexus\Nexus::css('#ban-info td {border: none}', 'header', false);

$title = nexus_trans('self-enable.title');
stdhead($title);
begin_main_frame();
begin_frame($title, true,10,"100%","center");
$unit = \App\Models\Setting::getSelfEnableBonus();
if ($unit <= 0) {
    printf('<h3>%s</h3>', nexus_trans('self-enable.feature_disabled'));
} elseif ($CURUSER['enabled'] == 'yes') {
    printf('<h3>%s</h3>', nexus_trans('self-enable.enable_status_normal'));
} else {
    $latestBanLog = \App\Models\UserBanLog::query()
        ->where('uid', $CURUSER['id'])
        ->orderBy('id', 'desc')
        ->first();
    if (!$latestBanLog) {
        printf('<h3>%s</h3>', nexus_trans('self-enable.no_ban_info'));
    } else {
        $elapsedDay = ceil((time() - $latestBanLog->created_at->getTimestamp()) / 86400);
        $total = $unit * $elapsedDay;
        $isUserBonusEnough = $CURUSER['seedbonus'] >= $total;
        $userBonusNotEnoughTip = nexus_trans('self-enable.bonus_not_enough', ['bonus' => $CURUSER['seedbonus']]);
        if (!empty($_POST['submit'])) {
            if (!$isUserBonusEnough) {
                stdmsg('Error', $userBonusNotEnoughTip);
            } else {
                $userRep = new \App\Repositories\UserRepository();
                $bonusRep = new \App\Repositories\BonusRepository();
                $operator = \App\Models\User::query()->find($CURUSER['id']);
                $bonusRep->consumeUserBonus($CURUSER['id'], $total, \App\Models\BonusLogs::BUSINESS_TYPE_SELF_ENABLE, $title);
                $userRep->enableUser($operator, $CURUSER['id'], $title);
                nexus_redirect('index.php');
            }
        } else {
            printf('<h3>%s</h3>', nexus_trans('self-enable.latest_ban_info'));
            printf('<table id="ban-info" border="1" cellpadding="5" cellspacing="0"><tbody>');
            printf('<tr><th>UID：</th><td>%s</td></tr>', $latestBanLog->uid);
            printf('<tr><th>Username：</th><td>%s</td></tr>',  $latestBanLog->username);
            printf('<tr><th>Reason：</th><td>%s</td></tr>', $latestBanLog->reason);
            printf('<tr><th>CreatedAt：</th><td>%s</td></tr>', $latestBanLog->created_at);
            printf('</tbody></table>');
            printf('<p>%s</p>', nexus_trans('self-enable.deduct_bonus_per_day', ['unit' => number_format($unit)]));
            printf('<p>%s</p>', nexus_trans('self-enable.deduct_bonus_total', ['days' => number_format($elapsedDay), 'total' => number_format($total)]));
            if ($isUserBonusEnough) {
                printf('<p>%s</p>', nexus_trans('self-enable.enable_desc'));
                printf('<form method="post"><input type="hidden" name="submit" value="1"><input type="submit" value="%s"></form>', nexus_trans('self-enable.enable_button'));
            } else {
                printf('<p>%s</p>', $userBonusNotEnoughTip);
            }
        }
    }
}
end_frame();
end_main_frame();
stdfoot();
?>
