<?php	session_start();
   define('WEB_PATH', '//'. $_SERVER["SERVER_NAME"].'/examsystem/');
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>เพิ่มรายชื่อวิชา</title>
		<script src="js/jquery.min.js"></script>
		<script src="<?php echo WEB_PATH;?>js/url.helper.js"></script>
		<script src="<?php echo WEB_PATH;?>js/main.js"></script>
<script language = "javascript">
	var XMLHttpRequestObject = false;
	if (window.XMLHttpRequest) 
	{	XMLHttpRequestObject = new XMLHttpRequest();
	} else if (window.ActiveXObject) 
	{	XMLHttpRequestObject = new
	    ActiveXObject("Microsoft.XMLHTTP");
	}
	function getData(dataSource, divID)
	{	if(XMLHttpRequestObject) 
		{	var obj = document.getElementById(divID);
	        XMLHttpRequestObject.open("GET", dataSource);
	
	        XMLHttpRequestObject.onreadystatechange = function()
	        {	if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) 
				{	var str = 	XMLHttpRequestObject.responseText;
					obj.innerHTML = 	str;
	            }
	         }
	         XMLHttpRequestObject.send(null);
	       }
	  }	
	function conf(n)
	{ 	if(confirm("  ข้อสอบที่บันทึกไว้ในวิชา : "+n+" จะถูกลบทั้งหมด โปรดยืนยันการลบ  ")==true)		{ return true; } 
		return false;	
	}
	function chk()
	{	
    	if($('select[name=sblid]').val()=="0"){ alert("โปรดเลือกชื่อหลักสูตร"); return false; }
		if($('select[name=sbgid]').val()=="0"){ alert("โปรดเลือกชื่อกลุ่มวิชา"); return false; }
		if($('select[name=sbname]').val()==""){ alert("โปรดระบุวิชา"); return false; }
		return true;	
	}
</script>			
	</head>
	<body background="images/bg.png">
<?php	include("connect.inc");
	//ตารางหลัก sbj
	$sbname="";
	$msg="";
	$subm="บันทึกข้อมูล";
	if(isset($_POST['subm']))
	{	$sbid=trim($_POST['sbid']);
		$sbname=trim($_POST['sbname']);
		$sbgid=trim($_POST['sbgid']);			//ส่งค่าไปแสดงตัวเลือก
		$sblid=trim($_POST['sblid']);				//ส่งค่าไปแสดงตัวเลือก
		$hsbname=trim($_POST['hsbname']);
		$hsbgid=trim($_POST['hsbgid']);     
		$subm=trim($_POST['subm']);
		if($subm=="บันทึกข้อมูล")
		{	$db=mysql_query("select * from exam_subject where name='$sbname' and exam_group_id='$sbgid'");
			$row=@mysql_num_rows($db); if($row==null){ $row=0; }
			if($row>0)
			{	$rs=mysql_fetch_array($db);	
				$sbid=$rs['id'];
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sbname มีบันทึกไว้แล้วที่รหัส : $sbid";
			} else
			{	
				$db=mysql_query("select max(id) as id from exam_subject");
				$rs=mysql_fetch_array($db);	
				$sbid= intval($rs['id'])+1;
				$exam_code = 'sb-'.str_pad($sbid, 3, "0", STR_PAD_LEFT);
				$sql = "insert into exam_subject (name,exam_group_id,exam_code) values ('$sbname','$sbgid','$exam_code')";
				mysql_query($sql) or die("ตาย".mysql_error());
			}
		} else	//แก้ไขข้อมูล
		{	$db=mysql_query("select * from exam_subject where name='$sbname' and name<>'$hsbname' and exam_code<>'$sbid'");
			$row=mysql_numrows($db);
			if($row>0)
			{	$rs=mysql_fetch_array($db);
				$sbid=$rs['id'];	
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sbname มีบันทึกไว้แล้วที่รหัส : $sbid";
			} else
			{	
				$sbid=trim($_GET['editsbid']);
				$sql = "update exam_subject set name='$sbname',exam_group_id='$sbgid' where id='$sbid'";
				mysql_query($sql);
				echo "<script>window.location='subject.php'</script>";	
			}
		}	
		$sbname="";
		$subm="บันทึกข้อมูล";
	}
	if(isset($_GET['delsbid']))
	{	$sbid=$_GET['delsbid'];
		mysql_query("delete from exam_subject where id='$sbid'");
	}
	$sql = "select a.id,a.name as subject_name,b.id as group_id,b.name as group_name,c.id as level_id,c.name as level_name from exam_subject a join exam_group b on a.exam_group_id=b.id join exam_level c on b.exam_level_id=c.id  order by a.id desc";
	$db=mysql_query($sql);

    $row=@mysql_num_rows($db); if($row==null){ $row=0; };
	
	if($row>0)
	{	
		mysql_data_seek($db,0);
		$rs=mysql_fetch_array($db);
		$sbid=substr(trim($rs['sbid']),2)+1;
		if($sbid<10){ $sbid="sb00".trim($sbid); } 
		if($sbid>9 and $sbid<100){ $sbid="sb0".trim($sbid);}
		if($sbid>99){	$sbid="sb".trim($sbid);}
		mysql_data_seek($db,0);

		
	} else { 	$sbid="sb001";  }	
	if(isset($_GET['editsbid']))			//กรณีแก้ไข ค่า sbid รับมาจากปุ่มกด
	{	$sbid=trim($_GET['editsbid']);
		$sbname=trim($_GET['editsbname']);
		$sbgid=trim($_GET['editsbgid']);
		$sblid=trim($_GET['editsblid']);
		$subm="  แก้ไขข้อมูล  ";
	}	
?>
<div align="center">
<form name="sbfrm" method="POST" onSubmit="return chk()">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="570" bgcolor="#F2CEB3" valign="bottom">
				<font color="#0000FF">
				<font size="3">
			<span style="font-size: 9pt">
			<span style="font-size: 11pt">&nbsp;</span></span></font></font><table border="0" width="92%" id="table1" cellspacing="3" cellpadding="0">
					<tr>
						<td><input type=button onClick="window.location='index.php'" value="        ออกข้อสอบ         " name="B2" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold"></td>
						<td><input type=button onClick="window.location='subgrp.php'" value="  ปรับปรุงชื่อกลุ่มวิชา   " name="B3" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold; float:left"></td>
						<td><input type=button onClick="window.location='sblevel.php'" value="  ปรับปรุงชื่อหลักสูตร  " name="B4" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold"></td>
					</tr>
				</table>
					</td>
					<td align="center" width="120" valign="bottom" bgcolor="#F2CEB3"><p align="right"><font style="font-size: 18px;font-weight: 700 ;"> ผู้ใช้งานระบบ : </font></span></td>
					<td align="center" width="225" valign="bottom" bgcolor="#F2CEB3"><p align="left"><b><span style="font-size: 18px;font-weight: 700 ;color:#003366" lang="en-us"> <? echo $_SESSION['vvname']; ?></span></b></td>

					<td align="center" width="5" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><!-- <img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"> --></td>
				</tr>
				<tr>
					<td align="center" colspan="4">

<div align="center">
	<table border="0" width="896" cellspacing="1" cellpadding="2" height="100" bgcolor="#F2CEB3">
		<tr>
			<td colspan="4" bgcolor="#FF6600">
			<p align="center"><font color="#FFFFFF"><span style="font-size: 15pt; font-weight: 700">ปรับปรุงชื่อวิชา</span></font></td>
		</tr>
		<tr>
			<td width="90" align="right" bgcolor="#FFCC99">
			<span style="font-size: 12pt; font-weight: 700">หลักสูตร
			<span lang="en-us">:</span></span></td>
			<td width="340" bgcolor="#FFCC99">
				<select name="sblid" onChange="getData('ajxsbl.php?zsblid='+this.value,'tbsbgid')" style="font-family: Tahoma; font-size: 16px; color: #4B3D34" size="1" tabindex="1">
					<option value="0">เลือกชื่อหลักสูตร หากไม่มีกรุณาปรับปรุงชื่อหลักสูตร</option>
				<?php	$sbldb=mysql_query("select * from exam_level ");
					while($sblrs=mysql_fetch_array($sbldb)){	$osblid=trim($sblrs['id']);	$osblname=trim($sblrs['name']);	
				?>
					<option value="<? echo $osblid; ?>" <?php if($osblid==$sblid){ echo "selected"; } ?>><?php echo $osblname; ?></option>
				<?php }  ?>	
				</select></td>
		</tr>
		<tr>
			<td width="98" bgcolor="#FFCC99">
			<p align="right">
			<span style="font-size: 12pt; font-weight: 700">กลุ่มวิชา :</span></td>
			<td width="348" bgcolor="#FFCC99" id="tbsbgid">
				<select name='sbgid'  size="1" style="font-family: Tahoma; font-size: 16px; color: #4B3D34" tabindex="2">
				<option value="0">เลือกชื่อกลุ่มวิชา หากไม่มีกรุณาปรับปรุงรายชื่อกลุ่มวิชา</option>
			<?php		$sbgdb=mysql_query("select * from exam_group where exam_level_id='$sblid'");
					while($sbgrs=mysql_fetch_array($sbgdb)){	$osbgid=trim($sbgrs['id']);	$osbgname=trim($sbgrs['name']);		?>
				<option value="<?php echo $osbgid; ?>" <?php if($osbgid==$sbgid){ echo "selected"; } ?>><?php echo $osbgname; ?></option>";
			<?php  $i++;	}	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="98" bgcolor="#FFCC99">
			<p align="right">
			<span style="font-size: 12pt; font-weight: 700">ชื่อวิชา :</span></td>
			<td width="348" bgcolor="#FFCC99">
			<input type="text" name="sbname" value="<? echo $sbname; ?>" size="48" style="font-family: Tahoma; font-size: 16px; color: #4B3D34; font-weight: bold" tabindex="3"></td>
		</tr>		

		<tr bgcolor="#FFCC99">
			<td width="890" colspan="4">
			
				<table border="0" width="103%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">
				<input type="submit" value="<? echo $subm; ?>" name="subm" style="font-family: Tahoma; font-size: 18px; color: #FF0000; font-weight: bold" tabindex="4"></td>
					</tr>
				</table>
			
			</td>
		</tr>
	</table>
</div>
</form>
<div align="center">
	<table border="0" width="896" height="63" cellspacing="1" cellpadding="2">
		<tr>
			<td align="center" colspan="6">
			<font color="#0000FF">
			<span style="font-size: 12pt; font-weight: 700" lang="en-us"><? echo $msg; ?></span></font></td>
		</tr>
		<tr>
			<td width="78" align="center" bgcolor="#FF6600">
				<font color="#FFFFFF">
				<span style="font-size: 14pt; font-weight: 700">รหัส</span></font>
			</td>
			<td align="center" width="380" bgcolor="#FF6600">
				<font color="#FFFFFF">
				<span style="font-size: 14pt; font-weight: 700">ชื่อวิชา</span></font>
			</td>
			<td align="center" width="280" bgcolor="#FF6600">
				<font color="#FFFFFF">
				<span style="font-size: 14pt; font-weight: 700">ชื่อกลุ่มวิชา</span></font>
			</td>
			<td align="center" width="280" bgcolor="#FF6600">
				<font color="#FFFFFF">
				<span style="font-size: 14pt; font-weight: 700">หลักสูตร</span></font>
			</td>
			<td align="center" width="135" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">จำนวนข้อสอบ</span></font></td>			
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF" style="font-size: 11pt">
			<span style="font-weight: 700">แก้</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">ลบ</span></font></td>
		</tr>
<?php for($i=0;$i<$row;$i++)
	{	$rs=mysql_fetch_array($db);				//บางค่าไม่แสดงหน้าจอแต่ต้องส่งค่ากลับเพื่อแก้ไข
		$ssbid=trim($rs['id']);					$ssbname=trim($rs['subject_name']);		$ssbgid=trim($rs['group_id']);		
		$ssbgname=trim($rs['group_name']);		$ssblid=trim($rs['level_id']);				$ssblname=trim($rs['level_name']);	

		$sql  = "select count(*) as num from questions where exam_subject_id=".$ssbid ;	
		$num_test  = mysql_query($sql);
		$result_test = mysql_fetch_assoc($num_test); 

		if(($i%2)==0){
?>		
		<tr>
			<td width="78" bgcolor="#FFCC99">
			<p align="center"><span style="font-size: 14pt" lang="en-us"><?php echo $ssbid; ?></span></td>
			<td width="380" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbname; ?></span></td>
			<td width="280" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="280" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="75" align="center" bgcolor="#FFCC99"><span style="font-size: 14pt" lang="en-us"><?php echo $result_test["num"]; ?></span></td>
			<td width="19" bgcolor="#FFCC99" align="center">
			<p align="center">
			<a href="subject.php?editsbid=<?php echo $ssbid; ?>&editsbname=<?php echo $ssbname; ?>&editsbgid=<?php echo $ssbgid; ?>&editsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="20" bgcolor="#FFCC99" align="center">
			<a href="subject.php?delsbid=<?php echo $ssbid; ?>">
			<img border="0" src="images/b_drop.png" width="16" height="16" onClick="return conf('<?php echo $ssbname; ?>')"></a></td>
		</tr>
	<?php } else {  ?>	
		<tr>
			<td width="78" bgcolor="#FF9966">
			<p align="center"><span style="font-size: 14pt" lang="en-us"><?php echo $ssbid; ?></span></td>
			<td width="380" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbname; ?></span></td>
			<td width="280" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="280" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="75" align="center" bgcolor="#FF9966"><span style="font-size: 14pt" lang="en-us"><?php echo $result_test["num"]; ?></span></td>
			<td width="19" bgcolor="#FF9966" align="center">
			<p align="center">
			<a href="subject.php?editsbid=<?php echo $ssbid; ?>&editsbname=<?php echo $ssbname; ?>&editsbgid=<?php echo $ssbgid; ?>&editsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="20" bgcolor="#FF9966" align="center">
			<p align="center">
			<a href="subject.php?delsbid=<?php echo $ssbid; ?>">
			<img border="0" src="images/b_drop.png" width="16" height="16"  onclick="return conf('<?php echo $ssbname; ?>')"></a></td>
		</tr>
	<?php } } ?>	
	</table>
</div>
					
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">พัฒนาโดย 
					ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font></td>
				</tr>
			</table>
</div>
<?php
	mysql_close($conn);
?>
</body>
</html>