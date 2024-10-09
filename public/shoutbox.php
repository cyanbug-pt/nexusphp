<?php
require_once("../include/bittorrent.php");
dbconn();
require_once(get_langfile_path());
if (isset($_GET['del']))
{
	if (is_valid_id($_GET['del']))
	{
		if(user_can('sbmanage'))
		{
			sql_query("DELETE FROM shoutbox WHERE id=".mysql_real_escape_string($_GET['del']));
		}
	}
}
$where=$_GET["type"] ?? '';
$refresh = ($CURUSER['sbrefresh'] ? $CURUSER['sbrefresh'] : 120)
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="<?php echo $refresh?>; url=<?php echo get_protocol_prefix() . $BASEURL?>/shoutbox.php?type=<?php echo htmlspecialchars($where)?>">
<link rel="stylesheet" href="<?php echo get_font_css_uri()?>" type="text/css">
<link rel="stylesheet" href="<?php echo get_css_uri()."theme.css"?>" type="text/css">
<link rel="stylesheet" href="styles/curtain_imageresizer.css" type="text/css">
<link rel="stylesheet" href="styles/nexus.css" type="text/css">
<script src="js/curtain_imageresizer.js" type="text/javascript"></script><style type="text/css">body {overflow-y:scroll; overflow-x: hidden}</style>
<?php
print(get_style_addicode());
$startcountdown = "startcountdown(".$CURUSER['sbrefresh'].")";
?>
<script type="text/javascript">
//<![CDATA[
var t;
function startcountdown(time)
{
parent.document.getElementById('countdown').innerHTML=time;
time=time-1;
t=setTimeout("startcountdown("+time+")",1000);
}
function countdown(time)
{
	if (time <= 0){
	parent.document.getElementById("hbtext").disabled=false;
	parent.document.getElementById("hbsubmit").disabled=false;
	parent.document.getElementById("hbsubmit").value=parent.document.getElementById("sbword").innerHTML;
	}
	else {
	parent.document.getElementById("hbsubmit").value=time;
	time=time-1;
	setTimeout("countdown("+time+")", 1000);
	}
}
function hbquota(){
parent.document.getElementById("hbtext").disabled=true;
parent.document.getElementById("hbsubmit").disabled=true;
var time=10;
countdown(time);
//]]>
}
</script>
</head>
<body class='inframe' <?php if (isset($_GET["type"]) && $_GET["type"] != "helpbox"){?> onload="<?php echo $startcountdown?>" <?php } else {?> onload="hbquota()" <?php } ?>>
<?php
if(isset($_GET["sent"]) && $_GET["sent"]=="yes"){
if(!isset($_GET["shbox_text"]) || !$_GET['shbox_text'])
{
	$userid=intval($CURUSER["id"] ?? 0);
}
else
{
	if($_GET["type"]=="helpbox")
	{
		if ($showhelpbox_main != 'yes'){
			write_log("Someone is hacking shoutbox. - IP : ".getip(),'mod');
			die($lang_shoutbox['text_helpbox_disabled']);
		}
		$userid=0;
		$type='hb';
	}
	elseif ($_GET["type"] == 'shoutbox')
	{
		$userid=intval($CURUSER["id"] ?? 0);
		if (!$userid){
			write_log("Someone is hacking shoutbox. - IP : ".getip(),'mod');
			die($lang_shoutbox['text_no_permission_to_shoutbox']);
		}
		if (!empty($_GET["toguest"]))
			$type ='hb';
		else $type = 'sb';
	}
	$date=sqlesc(time());
	$text=trim($_GET["shbox_text"]);

	sql_query("INSERT INTO shoutbox (userid, date, text, type) VALUES (" . sqlesc($userid) . ", $date, " . sqlesc($text) . ", ".sqlesc($type).")") or sqlerr(__FILE__, __LINE__);

	if(mb_substr($text,0,3)==='青虫娘'){
		// 获取当前用户的username和passkey
		$userInfo = \App\Models\User::query()->findOrFail($userid, ['username', 'passkey','class','vip_until']);
		// 截取用户输入的指令
		$instruction = trim(mb_substr($text,4));
		// 默认回答
		$message = null;
		// 根据指令查询答复
		$chat_res = sql_query("SELECT * FROM cyanbug_chat WHERE `trigger` LIKE ".sqlesc("%".$instruction."%")." ORDER BY weight") or sqlerr(__FILE__, __LINE__);
		$chat_row = mysql_fetch_assoc($chat_res);
		if(!$chat_row){
			$chat_res = sql_query("SELECT * FROM cyanbug_chat WHERE INSTR(".sqlesc($instruction).",`trigger`) ORDER BY weight") or sqlerr(__FILE__, __LINE__);
			$chat_row = mysql_fetch_assoc($chat_res);
		}
		// 如果能查到就进入判断流程，查不到就直接回复默认值
		if($chat_row){
			$message = $chat_row['answer'];
			// 如果含有奖励，进入奖励流程判断
			if(boolval($chat_row['reward'])){
				$chat_id = $chat_row['id'];
				$reward_type = $chat_row['reward_type'];
				# 奖励间隔：天
				$reward_interval = intval($chat_row['reward_interval']);
				// 上次奖励时间，根据这个查询是否在间隔期内
				$reward_time = strtotime(date("Y-m-d"));
				$last_reward_time = $reward_time-($reward_interval*24*60*60);
				// 查询奖励
				$reward_res = sql_query("SELECT * FROM cyanbug_reward WHERE userid = ".$userid." and chatid = ".sqlesc($chat_id)." AND reward_date > ".$last_reward_time) or sqlerr(__FILE__, __LINE__);
				$reward_row = mysql_fetch_assoc($reward_res);
				// 判断是否在间隔期间内
				if($reward_row){
					$message = $chat_row['reward_warning'];
				}else{
					$reward_amount = $chat_row['reward_amount'];
					$get_reward = 0;
					switch($reward_type){
						case '1':
							// VIP
							if($userInfo->class > 10){
								$message = '不要闹, 你的等级已经超过了VIP';
								break;
							}
							if($userInfo->class == 10){
								if($userInfo->vip_until == NULL){
									$message = '不要闹, 你的等级已经是永久VIP';
									break;
								}
								if($userInfo->vip_until != NULL){
									$message = '不要闹, 你的VIP还没有到期';
									break;
								}
							}
							$vip_unit = date('Y-m-d',strtotime("+$reward_amount day"));
							sql_query("UPDATE users SET class=10, vip_added = 'yes',vip_until='$vip_unit', leechwarn = 'no', leechwarnuntil = null WHERE class<=10 and id = ".sqlesc($userid)) or sqlerr(__FILE__, __LINE__);
							$get_reward = 1;
							break;
						case '2':
							// 彩虹ID
							$userRep = new \App\Repositories\UserRepository();
							$metas = $userRep->listMetas($userid, \App\Models\UserMeta::META_KEY_PERSONALIZED_USERNAME);
							if ($metas->isNotEmpty()) {
								// 当前是彩虹ID
								$metas = $metas['PERSONALIZED_USERNAME'][0];
								if($metas['deadline']==NULL){
									$message = '不要闹, 你已经是永久彩虹ID';
								}else{
									$message = '不要闹, 你的彩虹ID还没有到期';
								}
							} else {
								// 当前不是彩虹ID
								$format_date = sqlesc(date("Y-m-d H:i:s"));
								$deadline = date('Y-m-d',strtotime("+$reward_amount day"));
								sql_query("DELETE FROM user_metas WHERE uid=".sqlesc($userid)." AND meta_key='PERSONALIZED_USERNAME'") or sqlerr(__FILE__, __LINE__);
								sql_query("INSERT INTO user_metas (`uid`,meta_key,`status`,deadline,created_at,updated_at) VALUES (".sqlesc($userid).",'PERSONALIZED_USERNAME',0,'$deadline',".$format_date.",".$format_date.")") or sqlerr(__FILE__, __LINE__);
								$get_reward = 1;
							}
							break;
						case '3':
							sql_query("UPDATE users SET seedbonus=seedbonus+".$reward_amount." WHERE id = ".sqlesc($userid)) or sqlerr(__FILE__, __LINE__);
							$get_reward = 1;
							break;
						case '4':
							sql_query("UPDATE users SET uploaded=uploaded+".$reward_amount." WHERE id = ".sqlesc($userid)) or sqlerr(__FILE__, __LINE__);
							$get_reward = 1;
							break;
						case '5':
							sql_query("UPDATE users SET downloaded=downloaded+".$reward_amount." WHERE id = ".sqlesc($userid)) or sqlerr(__FILE__, __LINE__);
							$get_reward = 1;
							break;
					}
					if($get_reward==1){
						// 保存奖励记录
						sql_query("INSERT INTO cyanbug_reward (userid, chatid, reward_date, reward_amount) VALUES (" . sqlesc($userid) . ", " . sqlesc($chat_id) . ", " . sqlesc($reward_time) . ", ".sqlesc($reward_amount).")") or sqlerr(__FILE__, __LINE__);
					}
					// 清空用户的缓存
					clear_user_cache($userid, $userInfo->passkey);
				}
			}
			$message = format_chat_answer($userid, $message);
		}
		if($message==null){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, "http://127.0.0.1:23000/chat");
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array('q' => $instruction)));
			$response = curl_exec($curl);
			if(curl_errno($curl)){
						$message = '你说的什么我听不懂啊';
			}else{
				$responseData = json_decode($response, true);
				$message = $responseData['a'];
			}
		}
		// 为回复的内容加上绿色字体
		$message = '[color=green]@'.$userInfo->username.' '.$message.'[/color]';
		// 默认的用户ID为99，要和下面设定用户名颜色的一致
		sql_query("INSERT INTO shoutbox (userid, date, text, type) VALUES (" . sqlesc(99) . ", $date, " . sqlesc($message) . ", ".sqlesc($type).")") or sqlerr(__FILE__, __LINE__);
	}

	print "<script type=\"text/javascript\">parent.document.forms['shbox'].shbox_text.value='';</script>";
}
}

$limit = ($CURUSER['sbnum'] ? $CURUSER['sbnum'] : 70);
if ($where == "helpbox" && $showhelpbox_main == 'yes') {
    //request helpbox, not require login
    $sql = "SELECT * FROM shoutbox WHERE type='hb' ORDER BY date DESC, id DESC LIMIT ".$limit;
} elseif ($where == "shoutbox" && $CURUSER && ($CURUSER['hidehb'] == 'yes' || $showhelpbox_main != 'yes')) {
    //request shoutbox, exclude helpbox content, require login
    $sql = "SELECT * FROM shoutbox WHERE type='sb' ORDER BY date DESC, id DESC LIMIT ".$limit;
} elseif ($CURUSER) {
    $sql = "SELECT * FROM shoutbox ORDER BY date DESC, id DESC LIMIT ".$limit;
} else {
    die("<h1>".$lang_shoutbox['std_access_denied']."</h1>"."<p>".$lang_shoutbox['std_access_denied_note']."</p></body></html>");
}
$res = sql_query($sql) or sqlerr(__FILE__, __LINE__);
if (mysql_num_rows($res) == 0)
print("\n");
else
{
	print("<table border='0' cellspacing='0' cellpadding='2' width='100%' align='left'>\n");

	while ($arr = mysql_fetch_assoc($res))
	{
        $del = '';
		if (user_can('sbmanage')) {
			$del .= "[<a href=\"shoutbox.php?del=".$arr['id']."\">".$lang_shoutbox['text_del']."</a>]";
		}
		if ($arr["userid"]) {
			$username = get_username($arr["userid"],false,true,true,true,false,false,"",true);
			if (isset($arr["type"]) && isset($_GET['type']) && $_GET["type"] != 'helpbox' && $arr["type"] == 'hb')
				$username .= $lang_shoutbox['text_to_guest'];
			}
		else $username = $lang_shoutbox['text_guest'];
		if (isset($CURUSER) && $CURUSER['timetype'] != 'timealive')
			$time = (new DateTime())->setTimestamp($arr["date"])->format('m.d H:i');
		else $time = get_elapsed_time($arr["date"]).$lang_shoutbox['text_ago'];
		print("<tr><td class=\"shoutrow\"><span class='date'>[".$time."]</span> ".
$del ." ". $username." " . format_comment($arr["text"],true,false,true,true,600,false,false)."
</td></tr>\n");
	}
	print("</table>");
}
?>
</body>
</html>
