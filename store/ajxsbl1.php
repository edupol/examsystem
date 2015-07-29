<?	header("Content-type: text/xml;  charset=TIS-620"); 				//แก้ปัญหาภาษาไทยใน AJAX
	include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$db=mysql_query("select * from sbgrb where sblid='$sblid'");
	echo "<select name='sbgid' size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option>_เลือกชื่อกลุ่มวิชา หากไม่มีกรุณาปรับปรุงชื่อกลุ่มวิชา</option>";
	while($rs=mysql_fetch_array($db))
	{	$sbgid=trim($rs['sbgid']);
		$sbgname=trim($rs['sbgname']);
		echo "<option value='".$sbgid."'>".$i." - ".$sbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
