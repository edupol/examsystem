<?php	session_start();	
	header("Content-type: text/xml;  charset=TIS-620"); 				//��ѭ��������� AJAX
	include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$db=mysql_query("select * from exam_group where exam_level_id='$sblid'");
	echo "<select name='id' size='1' style='font-family: Tahoma; font-size: 16; color: #000'>";
	echo "<option>���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا��ª����Ԫ�</option>";
	while($rs=mysql_fetch_array($db))
	{	$sbgid=trim($rs['id']);
		$sbgname=trim($rs['name']);
		echo "<option value='".$sbgid."'>".$i." - ".$sbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
	echo '<input name="subm"type=submit value="�͡����ͺ" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></font>';
?>
									
