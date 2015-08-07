<?php
  	// Report simple running errors
  	error_reporting(E_ERROR | E_PARSE);
	$host = "localhost";
	$user = "edupol_exam";
	$pass = "12345678";
	$db = "edupol_exam";
	$conn=mysql_pconnect($host,$user,$pass);
	mysql_set_charset('utf8',$conn);
	mysql_select_db($db);

?>
	