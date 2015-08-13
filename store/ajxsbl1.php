<?php	header("Content-type: text/xml;  charset=utf-8"); 				//แก้ปัญหาภาษาไทยใน AJAX
	include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$db=mysql_query("select * from exam_group where exam_level_id='$sblid'");
	echo "<select name='sbgid' size='1' style='font-family: Tahoma; font-size: 16; color: #000'>";
	echo "<option>เลือกชื่อกลุ่มวิชา หากไม่มีกรุณาปรับปรุงชื่อกลุ่มวิชา</option>";
	while($rs=mysql_fetch_array($db))
	{	$sbgid=trim($rs['id']);
		$sbgname=trim($rs['name']);
		echo "<option value='".$sbgid."'>".$i." - ".$sbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
