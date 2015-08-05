<?php	session_start();	
	header("Content-type: text/xml;  charset=utf-8"); 				//แก้ปัญหาภาษาไทยใน AJAX
	include("connect.inc");
	$sbid=trim($_SESSION['vvsbid']);
	$i=1;
	//$ndb=mysql_query("select distinct a.apid13,a.apdate,c.rname,b.fname,b.lname from $sbid a join people b on a.apid13=b.id13 join rank on b.rid=c.rid");
	$ndb=mysql_query("select * from exam_code a join user b on a.instrutor_id=b.identity join rank c on b.rank_id=c.rank_id group by a.instrutor_id");
	echo "<select size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option style='font-family: Tahoma; font-size: 13; color: #003366'>__รายชื่อผู้ที่ออกข้อสอบวิชานี้__</option>";
	while($nrs=mysql_fetch_array($ndb))
	{	$name=trim($nrs['rank_id']).trim($nrs['first_name'])." ".trim($nrs['last_name']);	
		echo "<option>".$name."</option>";
		$i++;
	}
	echo "<option style='font-family: Tahoma; font-size: 13; color: #003366'>__รายชื่อผู้ที่แก้ไขข้อสอบวิชานี้__</option>";
	$ndb=mysql_query("select * from $sbid a join user b on a.instrutor_edit_id=b.identity join rank c on b.rank_id=c.rank_id group by a.instrutor_edit_id");
	while($nrs=mysql_fetch_array($ndb))
	{	$name=trim($nrs['rank_id']).trim($nrs['first_name'])." ".trim($nrs['last_name']);		
		if(trim($nrs['instrutor_edit_id'])<>null)
		{	echo "<option>".$name."</option>";
		}
		$i++;
	}	
	echo '</select><font color="#0000FF">';
?>
									
