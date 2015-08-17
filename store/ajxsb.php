<?php session_start();
	header("Content-type: text/xml;  charset=utf-8"); 		
	require_once 'libs/PDOAdapter.php'; 
	include("connect.inc");
	$sbgid=trim($_GET['zsbgid']);
	$i=1;
	$sql="select * from exam_subject where exam_group_id='$sbgid'";
	$sbrs = PDOAdpter::getInstance()->select($sql,null,false);	
//	$txt="getData('ajxsb.php?zsbgid='+this.value,'xxxxx')";
	echo "<select name='osbid' size='1' style='font-family; Tahoma; font-size: 16; width: 290px; color: #000'>";
	echo "<option value='0'>เลือกชื่อวิชา หากไม่มีกรุณาปรับปรุงชื่อวิชา</option>";
	foreach($sbrs as $key =>$sbrs)
	{	$osbid=trim($sbrs['exam_code']);
		$osbname=trim($sbrs['name']);
		echo "<option value='".$osbid."'>".$i." - ".$osbname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
