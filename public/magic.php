<?php
require "../include/bittorrent.php";
dbconn();
loggedinorreturn();

if (isset($_GET['id'])) stderr("Party is over!", "This trick doesn't work anymore. You need to click the button!");

$userid = $CURUSER["id"];
$torrentid = (int) $_POST["id"];
$value = (int) abs($_POST['value']);
if (!in_array($value, \App\Models\Setting::getBonusRewardOptions())) {
    stderr('Error', 'Invalid value.');
}
if($value <= 0) stderr('Error', 'Value must be positive.');
if($value > $CURUSER['seedbonus']) stderr('Error','You do not have such bonus!');
$tsql = sql_query("SELECT owner FROM torrents WHERE id = $torrentid") or sqlerr(__FILE__,__LINE__);
$arr = mysql_fetch_assoc($tsql);
if (!$arr) stderr("Error", "Invalid torrent id!");

$torrentowner = $arr['owner'];
if($torrentowner == $userid) stderr('Error', 'You are giving magic to yourself.');
$tsql = sql_query("SELECT COUNT(*) FROM magic WHERE torrentid=$torrentid and userid=$userid") or sqlerr(__FILE__,__LINE__);
$trows = mysql_fetch_assoc($tsql);
$t_ab = $trows[0];
if ($t_ab != 0) stderr("Error", "You already gave the magic value!");
$torrentOwnerInfo = \App\Models\User::query()->find($torrentowner, \App\Models\User::$commonFields);
if (!$torrentOwnerInfo) {
    stderr('Error', 'Invalid torrent owner!');
}
if (isset($userid) && isset($torrentid)&& isset($value)) {
    sql_query("INSERT INTO magic (torrentid, userid,value) VALUES ($torrentid, $userid, $value)") or sqlerr(__FILE__,__LINE__);
    KPS("-",$value,$CURUSER['id']);//selete
    \App\Models\BonusLogs::add($CURUSER['id'], $CURUSER['seedbonus'], $value, $CURUSER['seedbonus'] - $value, "", \App\Models\BonusLogs::BUSINESS_TYPE_REWARD_TORRENT);
    KPS("+",$value,$torrentowner);//add to the owner
    \App\Models\BonusLogs::add($torrentOwnerInfo['id'], $torrentOwnerInfo['seedbonus'], $value, $torrentOwnerInfo['seedbonus'] + $value, "", \App\Models\BonusLogs::BUSINESS_TYPE_TORRENT_BE_REWARD);
}
