<?php	session_start();	
	header("Content-type: text/xml;  charset=utf-8"); 				//��ѭ��������� AJAX
	include("connect.inc");
	$sbgid=trim($_GET['zsbgid']);
	$i=1;
	$db=mysql_query("select * from exam_subject where exam_group_id='$sbgid'");
	echo "<select name='id' size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option>���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا��ª����Ԫ�</option>";
	while($rs=mysql_fetch_array($db))
	{	$sbid=trim($rs['exam_code']);
		$sbname=trim($rs['name']);
		echo "<option value='".$sbid."'>".$i." - ".$sbname."</option>";
		$i++;
	}
	echo '</select><font color="#0000FF">';
	echo '<input name="subm"type=submit value="�͡����ͺ" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></font>';
?>
									
