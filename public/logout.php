<?php
require_once("../include/bittorrent.php");
dbconn();
logoutcookie();
//logoutsession();
//header("Location: ./");
nexus_redirect("/");
?>
