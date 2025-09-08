<?php
require "../include/bittorrent.php";
dbconn();
loggedinorreturn();

$userid = $CURUSER["id"];
$torrentid = (int) $_POST["id"];
$value = (int) abs($_POST['value']);
if (!in_array($value, \App\Models\Setting::getBonusRewardOptions())) {
    exit(json_encode(fail("Invalid value.", $_POST)));
}

if($value > $CURUSER['seedbonus']) exit(json_encode(fail('You do not have such bonus!', $_POST)));
$tsql = sql_query("SELECT owner FROM torrents WHERE id = $torrentid") or sqlerr(__FILE__,__LINE__);
$arr = mysql_fetch_assoc($tsql);
if (!$arr) exit(json_encode(fail("Invalid torrent id!", $_POST)));

$torrentowner = $arr['owner'];
if($torrentowner == $userid) exit(json_encode(fail('You are giving magic to yourself.', $_POST)));
$tsql = sql_query("SELECT COUNT(*) FROM magic WHERE torrentid=$torrentid and userid=$userid") or sqlerr(__FILE__,__LINE__);
$trows = mysql_fetch_assoc($tsql);
$t_ab = $trows[0];
if ($t_ab != 0) exit(json_encode(fail("You already gave the magic value!", $_POST)));
$todayStr = now()->startOfDay();
$todayCount = \App\Models\Reward::query()
    ->where('userid', $userid)
    ->where('created_at', ">=", $todayStr)
    ->count();
$timesLimit = \App\Models\Setting::getBonusRewardTimesLimit();
if ($timesLimit > 0 && $todayCount >= $timesLimit) exit(json_encode(fail("You already reach times limit!", $_POST)));
$torrentOwnerInfo = \App\Models\User::query()->find($torrentowner, \App\Models\User::$commonFields);
if (!$torrentOwnerInfo) {
    exit(json_encode(fail("Invalid torrent owner!", $_POST)));
}
if (isset($userid) && isset($torrentid)&& isset($value)) {
    sql_query("INSERT INTO magic (torrentid, userid,value) VALUES ($torrentid, $userid, $value)") or sqlerr(__FILE__,__LINE__);
    KPS("-",$value,$CURUSER['id']);//selete
    \App\Models\BonusLogs::add($CURUSER['id'], $CURUSER['seedbonus'], $value, $CURUSER['seedbonus'] - $value, "", \App\Models\BonusLogs::BUSINESS_TYPE_REWARD_TORRENT);
    KPS("+",$value,$torrentowner);//add to the owner
    \App\Models\BonusLogs::add($torrentOwnerInfo['id'], $torrentOwnerInfo['seedbonus'], $value, $torrentOwnerInfo['seedbonus'] + $value, "", \App\Models\BonusLogs::BUSINESS_TYPE_TORRENT_BE_REWARD);
}
