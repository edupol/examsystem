<?php	header("Content-type: text/xml;  charset=utf-8"); 				//��ѭ��������� AJAX
	include("connect.inc");
	$sblid=trim($_GET['zsblid']);
	$i=1;
	$db=mysql_query("select * from exam_group where exam_level_id='$sblid'");
	echo "<select name='sbgid' size='1' style='font-family: Tahoma; font-size: 16; color: #000'>";
	echo "<option>���͡���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا���͡�����Ԫ�</option>";
	while($rs=mysql_fetch_array($db))
	{	$sbgid=trim($rs['id']);
		$sbgname=trim($rs['name']);
		echo "<option value='".$sbgid."'>".$i." - ".$sbgname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
?>
									
