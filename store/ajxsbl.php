<?php	session_start();	
	header("Content-type: text/xml;  charset=utf-8");
	require_once 'libs/PDOAdapter.php'; 				
	//include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$sql="select * from exam_group where exam_level_id='$sblid'";
	$sbgrs = PDOAdpter::getInstance()->select($sql,null,false);
	$txt="getData('ajxsb.php?zsbgid='+this.value,'tdsbid')";
	echo "<select name='osbgid' onchange=".$txt." size='1' style='font-family: Tahoma; font-size: 16; width: 367px; color: #000 '>";
	echo "<option value='0'>เลือกชื่อกลุ่มวิชา หากไม่มีกรุณาปรับปรุงชื่อกลุ่มวิชา</option>";
	foreach($sbgrs as $key => $sbgrs)
	{	$osbgid=trim($sbgrs['id']);
		$osbgname=trim($sbgrs['name']);
		echo "<option value='".$osbgid."'>".$i." - ".$osbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
