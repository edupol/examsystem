<?php	session_start();
	define('WEB_PATH', '//'. $_SERVER["SERVER_NAME"].'/examsystem/');
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>เพิ่มหมวด/กลุ่มวิชา</title>
		<script src="js/jquery.min.js"></script>	
		<script src="<?php echo WEB_PATH;?>js/url.helper.js"></script>
		<script src="<?php echo WEB_PATH;?>js/main.js"></script>	
<script>	
	function conf(n)
	{ 	if(confirm("   ต้องการลบข้อมูลรหัส : ["+n+"] ใช่หรือไม่   ")==true)		{ return true; } 
		return false;	
	}
	function chk()
	{	
	    if($('select[name=sblid]').val()=="0"){ alert("โปรดเลือกชื่อหลักสูตร"); return false; }
		return true;
	}
</script>	
		
	</head>
	<body background="images/bg.png">
<?php	include("connect.inc");
	//ตารางหลัก sbgrb
	$sbgname="";
	$sblid="";
	$msg="";
	$subm="บันทึกข้อมูล";
	if(isset($_POST['subm']))
	{	$sbgid=trim($_POST['sbgid']);	
		$sbgname=trim($_POST['sbgname']);
		$sblid=trim($_POST['sblid']);
		$subm=trim($_POST['subm']);
		$hsbgid=trim($_POST['hsbgid']);
		if($subm=="บันทึกข้อมูล")
		{	$db=mysql_query("select * from exam_group where name='$sbgname' and id='$sblid'");
			$row=@mysql_num_rows($db); if($row==null){ $row=0; }
			if($row>0)
			{	$rs=mysql_fetch_array($db);	
				$sbgid=$rs['sbgid'];	
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sbgname มีบันทึกไว้แล้วที่รหัส : $sbgid";
			} else
			{	
				$sql = "insert into exam_group (id,name,exam_level_id) values ('$sbgid','$sbgname','$sblid')";
				mysql_query($sql);

			}
		} else	if($subm = 'แก้ไขข้อมูล' )//แก้ไขข้อมูล
		{	

			$db=mysql_query("select * from exam_group where name='$sbgname' and exam_level_id='$sblid' and id <>'$sbgid'");
			$row=mysql_numrows($db);
			if($row>0)
			{		
				$sbgid=$_GET['editsbgid'];
				$sbgname = $_GET['editsbgname'];
				$sblid  = $_GET['editsblid'];
				$msg="ไม่บันทึกข้อมูล เนื่องจาก $sbgname มีบันทึกไว้แล้วที่รหัส : $sbgid";
				echo "<script>
							if(confirm('$msg')){
								window.location = 'subgrp.php?editsbgid=$sbgid&editsbgname=$sbgname&editsblid=$sblid'
							}else{
								window.location = 'subgrp.php';
							}
				  			</script>";
			} else
			{	
				$sbgid = $_GET['editsbgid'];
				$sql = "update exam_group set name='$sbgname',exam_level_id='$sblid' where id='$sbgid'";
				mysql_query($sql);
				echo "<script>window.location = 'subgrp.php';</script>";
			}
		}	
		$sbgname="";
		$subm="บันทึกข้อมูล";
	}
	if(isset($_GET['delsbgid']))
	{	$sbgid=$_GET['delsbgid'];
		mysql_query("delete from exam_group where id='$sbgid'");
	}
	$db=mysql_query("select a.id,a.name as group_name,a.exam_level_id,b.name as level_name from exam_group a join exam_level b on a.exam_level_id=b.id order by a.id desc");
	$row=@mysql_num_rows($db); if($row==null){ $row=0; };
	if($row>0)
	{	mysql_data_seek($db,0);
		$rs=mysql_fetch_array($db);
		$sbgid=$rs['sbgid']+1;
		mysql_data_seek($db,0);
	} else { 	$sbgid=1;  }	
	if(isset($_GET['editsbgid']))			//กรณีแก้ไข ค่า sbgid รับมาจากปุ่มกด
	{	$sbgid=trim($_GET['editsbgid']);
		$sbgname=trim($_GET['editsbgname']);
		$sblid=trim($_GET['editsblid']);
		$hsbgid=$sbgid;					//ซ่อนค่าเพื่อตรวจสอบซ้ำ
		$subm="แก้ไขข้อมูล";
	}	
?>
<div align="center">
<form name="sbgfrm" method="POST" >
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#F2CEB3">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="550" bgcolor="#F2CEB3" valign="bottom">
					<table border="0" width="97%" id="table1" cellspacing="3" cellpadding="0">
						<tr>
							<td width="110">
							  	<input type=button onClick="window.location='index.php'" value="   ออกข้อสอบ   " name="B4" style="font-family: Tahoma; font-size: 16; color: #FF0000; font-weight: bold">
							</td>
							<td width="110">
							  	<input type=button onClick="window.location='sblevel.php'" value="   ปรับปรุงชื่อหลักสูตร   " name="B3" style="font-family: Tahoma; font-size: 16; color: #FF0000; font-weight: bold">
							</td>
							<td>
								<input type=button onClick="window.location='subject.php'" value="ปรับปรุงชื่อวิชา" name="B2" style="font-family: Tahoma; font-size: 16; color: #FF0000; font-weight: bold">
							</td>
						</tr>
					</table>
					</td>
					<td align="center" width="120" valign="bottom" bgcolor="#F2CEB3"><p align="right"><font style="font-size: 18px;font-weight: 700 ;"> ผู้ใช้งานระบบ : </font></span></td>
					<td align="center" width="225" valign="bottom" bgcolor="#F2CEB3"><p align="left"><b><span style="font-size: 18px;font-weight: 700 ;color:#003366" lang="en-us"> <?php echo $_SESSION['vvname']; ?></span></b></td>

					<td align="center" width="5" bgcolor="#F2CEB3"></td>
				</tr>
				<tr>
					<td align="center" colspan="4">
<div align="center">
<form name="sbgfrm" method="POST" action="subgrp.php" onSubmit="return chk();">
	<table border="0" width="850" cellspacing="1" cellpadding="2" height="100">
		<tr>
			<td colspan="4" bgcolor="#FF6600">
			<p align="center"><font color="#FFFFFF"><span style="font-size: 15pt; font-weight: 700">ปรับปรุงชื่อกลุ่มวิชา</span></font></td>
		</tr>
		<tr>
			<td width="115" bgcolor="#FFCC99">
			<p align="right">
			<span style="font-size: 14pt; font-weight: 700">ชื่อหลักสูตร<span lang="en-us"> 
			:</span></span></td>
			<td width="319" bgcolor="#FFCC99">
				<select name="sblid" size="1" tabindex="1">
					<option>เลือกชื่อหลักสูตร หากไม่มีกรุณาปรับปรุงชื่อหลักสูตร</option>
				<?php	$sbldb=mysql_query("select * from exam_level");
					while($sblrs=mysql_fetch_array($sbldb)){	$osblid=trim($sblrs['id']);	$osblname=trim($sblrs['name']);	
				?>
					<option value="<?php echo $osblid; ?>" <?php if($osblid==$sblid){ echo "selected"; } ?>><?php echo $osblname; ?></option>
				<?php }  ?>	
			  </select>
		  </td>
	  </tr>
		<tr>
			<td width="151" align="right" bgcolor="#FFCC99">
			<span style="font-size: 14pt; font-weight: 700">ชื่อกลุ่มวิชา :</span></td>
			<td width="591" bgcolor="#FFCC99" colspan="3">
			<input type=hidden name="hsbgid" value="<?php echo $hsbgid; ?>">
			 <input type="text" name="sbgname" value="<?php echo $sbgname; ?>" size="102" style="font-family: Tahoma; font-size: 12; color: #4B3D34; " tabindex="2"></td>
		</tr>
		<tr>
			<td width="735" colspan="4">
			
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">
				<input type="submit" value="<?php echo $subm; ?>" name="subm" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></td>
						<td width="6">&nbsp;</td>
					</tr>
				</table>
			
			</td>
		</tr>
	</table>
</form>
</div>

<div align="center">
	<table border="0" width="850" height="71" cellspacing="1" cellpadding="2">
		<tr>
			<td align="center" colspan="5">
			<font color="#0000FF"><span style="font-size: 14pt" lang="en-us"><?php echo $msg; ?></span></font></td>
		</tr>
		<tr>
			<td width="98" align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 14pt; font-weight: 700">รหัส</span></font></td>
			<td align="center" width="345" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 14pt; font-weight: 700">ชื่อกลุ่มวิชา</span></font></td>
			<td align="center" width="344" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 14pt; font-weight: 700">ชื่อหลักสูตร</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF" style="font-size: 14pt">
			<span style="font-weight: 700">แก้ไข</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 14pt; font-weight: 700">ลบ</span></font></td>
		</tr>
<?php	for($i=0;$i<$row;$i++)
	{	$rs=mysql_fetch_array($db);		
		$ssbgid=trim($rs['id']);	$ssbgname=trim($rs['group_name']);	
											$ssblid=trim($rs['exam_level_id']);		$ssblname=trim($rs['level_name']);
		if(($i%2)==0){
?>		
		<tr>
			<td width="98" bgcolor="#FFCC99">
			<p align="center"><span style="font-size: 14pt" lang="en-us"><?php echo $ssbgid; ?></span></td>
			<td width="345" bgcolor="#FFCC99">
			<span style="font-size: 14pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="344" bgcolor="#FFCC99">
			<span style="font-size: 14pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<p align="center">
			<a href="subgrp.php?editsbgid=<?php echo $ssbgid; ?>&editsbgname=<?php echo $ssbgname; ?>&editsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<a href="subgrp.php?delsbgid=<?php echo $ssbgid; ?>">
			<img border="0" src="images/b_drop.png" width="16" height="16" onClick="return conf('<?php echo $ssbgid; ?>')"></a></td>
		</tr>
<?php } else {  ?>		
		<tr>
			<td width="98" bgcolor="#FF9966" height="22">
			<p align="center"><span style="font-size: 14pt" lang="en-us"><?php echo $ssbgid; ?></span></td>
			<td width="345" bgcolor="#FF9966" height="22">
			<span style="font-size: 14pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="344" bgcolor="#FF9966" height="22">
			<span style="font-size: 14pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="subgrp.php?editsbgid=<?php echo $ssbgid; ?>&editsbgname=<?php echo $ssbgname; ?>&editsblid=<?php echo $ssblid; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="subgrp.php?delsbgid=<?php echo $ssbgid; ?>">
			<img border="0" src="images/b_drop.png"  onclick="return conf('<?php echo $ssbgid; ?>')"  width="16" height="16"></a></td>
		</tr>
<?php	} }
?>
	</table>

</div>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E">
					<span style="font-size: 14pt; font-weight: 700">พัฒนาโดย 
					ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font></td>
				</tr>
			</table>
<?php
	mysql_close($conn);
?>
</body>
</html>