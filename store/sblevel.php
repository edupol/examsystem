<?	session_start();
	if(!$_SESSION['vvstatus'][7]){ echo "<script>window.location='../index.php'</script>";  exit();}
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>����������ѡ�ٵ�</title>
<script>	
	function conf(n)
	{ 	if(confirm("   ��ͧ���ź������ѡ�ٵ� : ["+n+"] ���������   ")==true)		{ return true; } 
		return false;	
	}
	function chk()
	{	if(document.sblfrm.sblname.value==""){ alert('�ô��͡������㹪�ͧ������ѡ�ٵ� :'); return false;} else { return true; }
	}
</script>	
		
	</head>
	<body background="images/bg.png">
<?	include("connect.inc");
	//���ҧ��ѡ sblevel
	$sblname="";
	$msg="";
	$subm="�ѹ�֡������";
	if(isset($_POST['subm']))
	{	$sblid=trim($_POST['sblid']);	
		$sblname=trim($_POST['sblname']);
		$subm=trim($_POST['subm']);
		$hsblname=trim($_POST['hsblname']);
		if($subm=="�ѹ�֡������")
		{	$db=mysql_query("select * from sblevel where sblname='$sblname'");
			$row=@mysql_num_rows($db); if($row==null){ $row=0; }
			if($row>0)
			{	$rs=mysql_fetch_array($db);	
				$sblid=$rs['sblid'];	
				$msg="���ѹ�֡������ ���ͧ�ҡ $sblname �պѹ�֡������Ƿ������ : $sblid";
			} else
			{	mysql_query("insert into sblevel (sblid,sblname) values ('$sblid','$sblname')");
			}
		} else	//��䢢�����
		{	$db=mysql_query("select * from sblevel where sblname='$sblname' and sblname<>'$hsblname'");
			$row=mysql_numrows($db);
			if($row>0)
			{	$rs=mysql_fetch_array($db);
				$sblid=$rs['sblid'];	
				$msg="���ѹ�֡������ ���ͧ�ҡ $sblname �պѹ�֡������Ƿ������ : $sblid";
			} else
			{	mysql_query("update sblevel set sblname='$sblname' where sblid='$sblid'");
			}
		}	
		$sblname="";
		$subm="�ѹ�֡������";
	}
	if(isset($_GET['delsblid']))
	{	$sblid=$_GET['delsblid'];
		mysql_query("delete from sblevel where sblid='$sblid'");
	}
	$db=mysql_query("select * from sblevel order by sblid desc");
	$row=@mysql_num_rows($db); if($row==null){ $row=0; };
	if($row>0)
	{	mysql_data_seek($db,0);
		$rs=mysql_fetch_array($db);
		$sblid=$rs['sblid']+1;
		mysql_data_seek($db,0);
	} else { 	$sblid=1;  }	
	if(isset($_GET['editsblid']))			//�ó���� ��� sblid �Ѻ�Ҩҡ������
	{	$sblid=trim($_GET['editsblid']);
		$sblname=trim($_GET['editsblname']);
		$hsblname=$sblname;			//��͹������͵�Ǩ�ͺ���
		$subm="��䢢�����";
	}	
?>
<div align="center">
<form name="sblfrm" method="POST" action="sblevel.php">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="5" bgcolor="#F2CEB3">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="622" bgcolor="#F2CEB3" valign="bottom">
					<input type=button onClick="window.location='index.php'" value="�͡����ͺ" name="B4" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"><span lang="en-us">&nbsp;
				</span>
				<input type=button onClick="window.location='subgrp.php'" value="��Ѻ��ا���͡�����Ԫ�" name="B2" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"><span lang="en-us">&nbsp;&nbsp;</span><input type=button onClick="window.location='subject.php'" value="��Ѻ��ا�����Ԫ�" name="B5" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"><span lang="en-us">
				</span>
					</td>
					<td align="center" width="16" bgcolor="#F2CEB3">&nbsp;</td>
					<td align="center" width="101" valign="bottom" bgcolor="#F2CEB3">
					<p align="right"><b><font style="font-size: 11pt">
					�����ҹ�к� </font><span lang="en-us">
					<font style="font-size: 11pt">:</font></span></b></td>
					<td align="center" width="220" valign="bottom" bgcolor="#F2CEB3">
					<p align="left">
					<span style="font-size: 10pt; font-weight: 700" lang="en-us">
					<? echo $_SESSION['vvname']; ?></span></td>
					<td align="center" width="65" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="5">
<div align="center">
<form name="sblfrm" method="POST" action="sblevel.php" onSubmit="return chk();">
	<table border="0" width="499" cellspacing="1" cellpadding="2" height="100">
		<tr>
			<td colspan="2" bgcolor="#FF6600">
			<p align="center"><font color="#FFFFFF"><span style="font-size: 15pt; font-weight: 700">��Ѻ��ا������ѡ�ٵ�</span></font></td>
		</tr>
		<tr>
			<td width="151" align="right" bgcolor="#FFCC99">
			<span style="font-size: 12pt; font-weight: 700">������ѡ�ٵ� : </span>
			</td>
			<td width="339" bgcolor="#FFCC99">
		  <input type="text" name="sblid" value="<? echo $sblid; ?>" readonly size="14" style="font-family: Tahoma; font-size: 12; color: #4B3D34; ">  </td>
		</tr>
		<tr>
			<td width="151" align="right" bgcolor="#FFCC99">
			<span style="font-size: 12pt; font-weight: 700">������ѡ�ٵ� :</span></td>
			<td width="339" bgcolor="#FFCC99">
			<input type=hidden name="hsblname" value="<? echo $hsblname; ?>">
			<input type="text" name="sblname" value="<? echo $sblname; ?>" size="58" style="font-family: Tahoma; font-size: 12; color: #4B3D34; " tabindex="1"></td>
		</tr>
		<tr>
			<td width="493" colspan="2">
			
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>&nbsp;
				</td>
						<td width="498">
						<p align="center">
				<input type="submit" value="<? echo $subm; ?>" name="subm" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold" tabindex="2"></td>
					</tr>
				</table>
			
			</td>
		</tr>
	</table>
</form>
</div>

<div align="center">
	<table border="0" width="656" height="71" cellspacing="1" cellpadding="2">
		<tr>
			<td align="center" colspan="4">
			<font color="#0000FF"><span style="font-size: 12pt" lang="en-us"><? echo $msg; ?></span></font></td>
		</tr>
		<tr>
			<td width="73" align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 12pt; font-weight: 700">����</span></font></td>
			<td align="center" width="520" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 12pt; font-weight: 700">������ѡ�ٵ�</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF" style="font-size: 12pt">
			<span style="font-weight: 700">��</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 12pt; font-weight: 700">ź</span></font></td>
		</tr>
<?	for($i=0;$i<$row;$i++)
	{	$rs=mysql_fetch_array($db);		$ssblid=trim($rs['sblid']);	$ssblname=trim($rs['sblname']);
		if(($i%2)==0){
?>		
		<tr>
			<td width="73" bgcolor="#FFCC99">
			<p align="center"><span style="font-size: 11pt" lang="en-us"><? echo $ssblid; ?></span></td>
			<td width="520" bgcolor="#FFCC99">
			<span style="font-size: 11pt" lang="en-us"><? echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<p align="center">
			<a href="sblevel.php?editsblid=<? echo $ssblid; ?>&editsblname=<? echo $ssblname; ?>">
		  <img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FFCC99" align="center">
			<a href="sblevel.php?delsblid=<? echo $ssblid; ?>">
			<img border="0" src="images/b_drop.png" width="16" height="16" onClick="return conf('<? echo $ssblid; ?>')"></a></td>
	  </tr>
<? } else {  ?>		
		<tr>
			<td width="73" bgcolor="#FF9966" height="22">
			<p align="center"><span style="font-size: 11pt" lang="en-us"><? echo $ssblid; ?></span></td>
			<td width="520" bgcolor="#FF9966" height="22">
			<span style="font-size: 11pt" lang="en-us"><? echo $ssblname; ?></span></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="sblevel.php?editsblid=<? echo $ssblid; ?>&editsblname=<? echo $ssblname; ?>">
			<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
			<td width="21" bgcolor="#FF9966" align="center" height="22">
			<a href="sblevel.php?delsblid=<? echo $ssblid; ?>">
			<img border="0" src="images/b_drop.png"  onclick="return conf('<? echo $ssblid; ?>')"  width="16" height="16"></a></td>
		</tr>
<?	} }
?>
	</table>

</div>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">�Ѳ���� 
					�����ӹ�¡�� 6 �ͧ�ѧ�Ѻ����ӹ�¡�� �ͧ�ѭ�ҡ���֡��</span></font></td>
				</tr>
			</table>
<?
	mysql_close($conn);
?>
</body>
</html>