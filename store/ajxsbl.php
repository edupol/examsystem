<?	session_start();	
	header("Content-type: text/xml;  charset=TIS-620"); 				//��ѭ��������� AJAX
	include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$sbgdb=mysql_query("select * from sbgrb where sblid='$sblid'");
	$txt="getData('ajxsb.php?zsbgid='+this.value,'tdsbid')";
	echo "<select name='sbgid' onchange=".$txt." size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option>_���͡���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا���͡�����Ԫ�</option>";
	while($sbgrs=mysql_fetch_array($sbgdb))
	{	$osbgid=trim($sbgrs['sbgid']);
		$osbgname=trim($sbgrs['sbgname']);
		echo "<option value='".$osbgid."'>".$i." - ".$osbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
