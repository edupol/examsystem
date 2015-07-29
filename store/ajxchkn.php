<?	session_start();	
	header("Content-type: text/xml;  charset=TIS-620"); 				//แก้ปัญหาภาษาไทยใน AJAX
	include("connect.inc");
	$sbid=trim($_SESSION['vvsbid']);
	$i=1;
	//$ndb=mysql_query("select distinct a.apid13,a.apdate,c.rname,b.fname,b.lname from $sbid a join people b on a.apid13=b.id13 join rank on b.rid=c.rid");
	$ndb=mysql_query("select * from $sbid a join people b on a.apid13=b.id13 join rank c on b.rid=c.rid group by a.apid13");
	echo "<select size='1' style='font-family: Tahoma; font-size: 13; color: #4B3D34'>";
	echo "<option style='font-family: Tahoma; font-size: 13; color: #003366'>__รายชื่อผู้ที่ออกข้อสอบวิชานี้__</option>";
	while($nrs=mysql_fetch_array($ndb))
	{	$name=trim($nrs['rname']).trim($nrs['fname'])." ".trim($nrs['lname']);	
		echo "<option>".$name."</option>";
		$i++;
	}
	echo "<option style='font-family: Tahoma; font-size: 13; color: #003366'>__รายชื่อผู้ที่แก้ไขข้อสอบวิชานี้__</option>";
	$ndb=mysql_query("select * from $sbid a join people b on a.edid13=b.id13 join rank c on b.rid=c.rid group by a.edid13");
	while($nrs=mysql_fetch_array($ndb))
	{	$name=trim($nrs['rname']).trim($nrs['fname'])." ".trim($nrs['lname']);		
		if(trim($nrs['edid13'])<>null)
		{	echo "<option>".$name."</option>";
		}
		$i++;
	}	
	echo '</select><font color="#0000FF">';
?>
									
