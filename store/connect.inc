<?
	$host = "localhost";
	$user = "edupol_man";
	$pass = "12345678";
	$db = "edupol_man";
	$conn=mysql_pconnect($host,$user,$pass);
	mysql_select_db($db);
	mysql_query("set NAMES tis620");
?>
	