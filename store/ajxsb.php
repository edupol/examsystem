<? session_start();
	header("Content-type: text/xml;  charset=TIS-620"); 				//แก้ปัญหาภาษาไทยใน AJAX
	include("connect.inc");
	$sbgid=trim($_GET['zsbgid']);
	$i=1;
	$sbdb=mysql_query("select * from sbj where sbgid='$sbgid'");
//	$txt="getData('ajxsb.php?zsbgid='+this.value,'xxxxx')";
	echo "<select name='sbid' size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option>_เลือกชื่อวิชา หากไม่มีกรุณาปรับปรุงชื่อวิชา</option>";
	while($sbrs=mysql_fetch_array($sbdb))
	{	$osbid=trim($sbrs['sbid']);
		$osbname=trim($sbrs['sbname']);
		echo "<option value='".$osbid."'>".$i." - ".$osbname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
