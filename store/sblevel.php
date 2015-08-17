<?php	session_start();
	define('WEB_PATH', '//'. $_SERVER["SERVER_NAME"].'/examsystem/');

?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>เพิ่มชื่อหลักสูตร</title>
		<script src="js/jquery.min.js"></script>	
		<script src="<?php echo WEB_PATH;?>js/url.helper.js"></script>
		<script src="<?php echo WEB_PATH;?>js/main.js"></script>	
<script>	
	function conf(n)
	{ 	if(confirm("   ต้องการลบชื่อหลักสูตร : ["+n+"] ใช่หรือไม่   ")==true)		{ return true; } 
		return false;	
	}

</script>	
		
	</head>
	<body background="images/bg.png">
<?php	include("connect.inc");
	//ตารางหลัก sblevel
	$sblname="";
	$msg="";
	$subm="บันทึกข้อมูล";
	if(isset($_POST['subm']))
	{	$sblid=trim($_POST['sblid']);	
		$sblname=trim($_POST['sblname']);
		$subm=trim($_POST['subm']);
		$hsblname=trim($_POST['hsblname']);
		if($subm=="บันทึกข้อมูล")
		{	$db=mysql_query("select * from exam_level where name='$sblname'");
			$row=@mysql_num_rows($db); if($row==null){ $row=0; }
			if($row>0)
			{	$rs=mysql_fetch_array($db);	
				$sblid=$rs['sblid'];	
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sblname มีบันทึกไว้แล้วที่รหัส : $sblid";
			} else
			{	mysql_query("insert into exam_level (id,name) values ('$sblid','$sblname')");
			}
		} else	if($subm=="แก้ไขข้อมูล")//แก้ไขข้อมูล
		{	
			$db=mysql_query("select * from exam_level where name='$sblname' and name<>'$hsblname'");
			$row=mysql_numrows($db);
			if($row>0)
			{	$rs=mysql_fetch_array($db);
				$sblid=$rs['sblid'];	
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sblname มีบันทึกไว้แล้วที่รหัส : $sblid";
			} else
			{	
				$id=trim($_GET['editsblid']);	
				$sql = "update exam_level set name='$sblname' where id='$id'";
				mysql_query($sql);
			}
		}	
		$sblname="";
		$subm="บันทึกข้อมูล";
	}
	if(isset($_GET['delsblid']))
	{	$sblid=$_GET['delsblid'];
		mysql_query("delete from exam_level where id='$sblid'");
	}
	$db=mysql_query("select * from exam_level order by id desc");
	$row=@mysql_num_rows($db); if($row==null){ $row=0; };
	if($row>0)
	{	mysql_data_seek($db,0);
		$rs=mysql_fetch_array($db);
		$sblid=$rs['sblid']+1;
		mysql_data_seek($db,0);
	} else { 	$sblid=1;  }	
	if(isset($_GET['editsblid']))			//กรณีแก้ไข ค่า sblid รับมาจากปุ่มกด
	{	$sblid=trim($_GET['editsblid']);
		$sblname=trim($_GET['editsblname']);
		$hsblname=$sblname;			//ซ่อนค่าเพื่อตรวจสอบซ้ำ
		$subm="แก้ไขข้อมูล";
	}	
?>
<div align="center">
<form name="sblfrm" method="POST">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="5" bgcolor="#F2CEB3">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="550" bgcolor="#F2CEB3" valign="bottom">
					<input type=button onClick="window.location='index.php'" value="ออกข้อสอบ" name="B4" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold"><span lang="en-us">&nbsp;
				</span>
				<input type=button onClick="window.location='subgrp.php'" value="ปรับปรุงชื่อกุล่มวิชา" name="B2" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold"><span lang="en-us">&nbsp;&nbsp;</span><input type=button onClick="window.location='subject.php'" value="ปรับปรุงชื่อวิชา" name="B5" style="font-family: Tahoma; font-size: 16px; color: #FF0000; font-weight: bold"><span lang="en-us">
				</span>
					</td>
					<td align="center" width="10" bgcolor="#F2CEB3">&nbsp;</td>
					<td align="center" width="120" valign="bottom" bgcolor="#F2CEB3"><p align="right"><font style="font-size: 18px;font-weight: 700 ;"> ผู้ใช้งานระบบ : </font></span></td>
					<td align="center" width="225" valign="bottom" bgcolor="#F2CEB3"><p align="left"><b><span style="font-size: 18px;font-weight: 700 ;color:#003366" lang="en-us"> <? echo $_SESSION['vvname']; ?></span></b></td>
					<!-- <td align="center" width="65" bgcolor="#D2B8AE"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td> -->

					<td align="center" width="65" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><!-- <img border="0" src="../<?php echo $_SESSION['vvphoto']; ?>" width="64" height="80"> --></td>
				</tr>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td align="center" colspan="5">
<div align="center">
<form name="sblfrm" method="POST" action="sblevel.php" onSubmit="return chk();">
	<table border="0" width="660" cellspacing="1" cellpadding="2" height="100">
		<tr>
			<td colspan="2" bgcolor="#FF6600">
			<p align="center"><font color="#FFFFFF"><span style="font-size: 15pt; font-weight: 700">ปรับปรุงชื่อหลักสูตร</span></font></td>
		</tr>
<!-- 		<tr>
			<td width="151" align="right" bgcolor="#FFCC99">
			<span style="font-size: 16pt; font-weight: 700">รหัสหลักสูตร : </span>
			</td>
			<td width="339" bgcolor="#FFCC99">
		  <input type="text" name="sblid" value="<? echo $sblid; ?>" readonly size="14" style="font-family: Tahoma; font-size: 12; color: #4B3D34; ">  </td>
		</tr> -->
		<tr>
			<td width="151" align="right" bgcolor="#FFCC99">
			<span style="font-size: 16pt; font-weight: 700">ชื่อหลักสูตร :</span></td>
			<td width="339" bgcolor="#FFCC99">
			<input type=hidden name="hsblname" value="<?php echo $hsblname; ?>">
			<input type="text" name="sblname" value="<?php echo $sblname; ?>" size="58" style="font-family: Tahoma; font-size: 12; color: #4B3D34; " tabindex="1"></td>
		</tr>
		<tr>
			<td width="493" colspan="2">
			
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;
				</td>
						<td width="498">
						<p align="center">
				<input type="submit" value="<? echo $subm; ?>" name="subm" style="font-family: Tahoma; font-size: 18; color: #FF0000; font-weight: bold" tabindex="2"></td>
					</tr>
				</table>
			
			</td>
		</tr>
	</table>
</form>
</div>

<div align="center">
	<table border="0" width="660" height="71" cellspacing="1" cellpadding="2">
		<tr>
			<td align="center" colspan="4">
			<font color="#0000FF"><span style="font-size: 16pt" lang="en-us"><? echo $msg; ?></span></font></td>
		</tr>
		<tr>
			<td width="73" align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 16pt; font-weight: 700">รหัส</span></font></td>
			<td align="center" width="520" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 16pt; font-weight: 700">ชื่อหลักสูตร</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF" style="font-size: 16pt">
			<span style="font-weight: 700">แก้</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 16pt; font-weight: 700">ลบ</span></font></td>
		</tr>
<?php	for($i=0;$i<$row;$i++)
	{	$rs=mysql_fetch_array($db);		$ssblid=trim($rs['id']);	$ssblname=trim($rs['name']);
		if(($i%2)==0){
?>		
		<tr>
			<td width="73" bgcolor="#FFCC99">
			<p align="center"><span style="font-size: 16pt" lang="en-us"><?php echo $ssblid; ?></span></td>
			<td width="520" bgcolor="#FFCC99">
			<span style="font-size: 16pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<p align="center">
			<a href="sblevel.php?editsblid=<?php echo $ssblid; ?>&editsblname=<?php echo $ssblname; ?>">
		  <img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<a href="sblevel.php?delsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_drop.png" width="16" height="16" onClick="return conf('<?php echo $ssblid; ?>')"></a></td>
	  </tr>
<?php } else {  ?>		
		<tr>
			<td width="73" bgcolor="#FF9966" height="22">
			<p align="center"><span style="font-size: 16pt" lang="en-us"><?php echo $ssblid; ?></span></td>
			<td width="520" bgcolor="#FF9966" height="22">
			<span style="font-size: 16pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="sblevel.php?editsblid=<?php echo $ssblid; ?>&editsblname=<? echo $ssblname; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="sblevel.php?delsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_drop.png"  onclick="return conf('<?php echo $ssblid; ?>')"  width="16" height="16"></a></td>
		</tr>
<?php	} }
?>
	</table>

</div>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5"><font color="#9F777E">
					<span style="font-size: 16pt; font-weight: 700">พัฒนาโดย 
					ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font></td>
				</tr>
			</table>
<?php
	mysql_close($conn);
?>
</body>
</html>