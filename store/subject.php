<?php	session_start();
//if(!$_SESSION['vvstatus'][7]){ echo "<script>window.location='../index.php'</script>";  exit();}
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>������ª����Ԫ�</title>
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
	{ 	if(confirm("  ����ͺ���ѹ�֡�����Ԫ� : "+n+" �ж١ź������ �ô�׹�ѹ���ź  ")==true)		{ return true; } 
		return false;	
	}
	function chk()
	{	if(document.sbfrm.sblid.value==""){ alert("�ô���͡������ѡ�ٵ�"); return false; }
		if(document.sbfrm.sbgid.value==""){ alert("�ô���͡���͡�����Ԫ�"); return false; }
		if(document.sbfrm.sbname.value==""){ alert('�ô��͡������㹪�ͧ�����Ԫ� :'); return false;}
		return true;	
	}
</script>			
	</head>
	<body background="images/bg.png">
<?php	include("connect.inc");
	//���ҧ��ѡ sbj
	$sbname="";
	$msg="";
	$subm="�ѹ�֡������";
	if(isset($_POST['subm']))
	{	$sbid=trim($_POST['sbid']);
		$sbname=trim($_POST['sbname']);
		$sbgid=trim($_POST['sbgid']);			//�觤����ʴ�������͡
		$sblid=trim($_POST['sblid']);				//�觤����ʴ�������͡
		$hsbname=trim($_POST['hsbname']);
		$hsbgid=trim($_POST['hsbgid']);     
		$subm=trim($_POST['subm']);
		if($subm=="�ѹ�֡������")
		{	$db=mysql_query("select * from exam_subject where name='$sbname' and exam_group_id='$sbgid'");
			$row=@mysql_num_rows($db); if($row==null){ $row=0; }
			if($row>0)
			{	$rs=mysql_fetch_array($db);	
				$sbid=$rs['sbid'];
				$msg="���ѹ�֡������ ���ͧ�ҡ $sbname �պѹ�֡������Ƿ������ : $sbid";
			} else
			{	mysql_query("insert into exam_subject (exam_code,name,exam_group_id) values ('$sbid','$sbname','$sbgid')") or die("���".mysql_error());
				mysql_query("DROP TABLE IF EXISTS `$sbid`");
				mysql_query("CREATE TABLE IF NOT EXISTS `$sbid` (
  				`sbno` int(4) NOT NULL auto_increment,
  `apid13` varchar(13) NOT NULL,
  `apdate` date NOT NULL,
  `edid13` varchar(13) NOT NULL,
  `eddate` date NOT NULL,
  `qtn` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  PRIMARY KEY  (`sbno`)
) ENGINE=MyISAM  DEFAULT CHARSET=tis620 AUTO_INCREMENT=1") or die("���".mysql_error());
			}
		} else	//��䢢�����
		{	$db=mysql_query("select * from exam_subject where name='$sbname' and name<>'$hsbname' and exam_code<>'$sbid'");
			$row=mysql_numrows($db);
			if($row>0)
			{	$rs=mysql_fetch_array($db);
				$sbid=$rs['sbid'];	
				$msg="���ѹ�֡������ ���ͧ�ҡ $sbname �պѹ�֡������Ƿ������ : $sbid";
			} else
			{	mysql_query("update exam_subject set name='$sbname',exam_group_id='$sbgid' where exam_code='$sbid'");
			}
		}	
		$sbname="";
		$subm="�ѹ�֡������";
	}
	if(isset($_GET['delsbid']))
	{	$sbid=$_GET['delsbid'];
		mysql_query("delete from exam_subject where exam_code='$sbid'");
		mysql_query("DROP TABLE IF EXISTS `$sbid`");
	}
	$db=mysql_query("select * from exam_subject a join exam_group b on a.exam_group_id=b.id join exam_level c on b.exam_level_id=c.id  where b.exam_level_id = 4 order by a.exam_code asc");
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
	if(isset($_GET['editsbid']))			//�ó���� ��� sbid �Ѻ�Ҩҡ������
	{	$sbid=trim($_GET['editsbid']);
		$sbname=trim($_GET['editsbname']);
		$sbgid=trim($_GET['editsbgid']);
		$sblid=trim($_GET['editsblid']);
		$subm="��䢢�����";
	}	
?>
<div align="center">
<form name="sbfrm" method="POST" action="subject.php" onSubmit="return chk()">
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
						<td align=center height="30" width="227"><font size="3" color="#0000FF"><span style="font-size: 11pt" lang="en-us">
			<input type="button" value="�к����ʹ�� ��.�. " onClick="window.location='../index.php'" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold; float:left"></span></font></td>
						<td height="30">
<input type=button onClick="window.location='index.php'" value="        �͡����ͺ         " name="B2" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"></td>
					</tr>
					<tr>
						<td width="227">
						<p align="center">
						<input type=button onClick="window.location='subgrp.php'" value="  ��Ѻ��ا���͡�����Ԫ�   " name="B3" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold; float:left"></td>
						<td>
						<p align="left">
						<input type=button onClick="window.location='sblevel.php'" value="  ��Ѻ��ا������ѡ�ٵ�  " name="B4" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"></td>
					</tr>
				</table>
					</td>
					<td align="center" width="114" valign="bottom" bgcolor="#F2CEB3">
					<p align="right"><b><font style="font-size: 11pt">
					�����ҹ�к� </font><span lang="en-us">
					<font style="font-size: 11pt">:</font></span></b></td>
					<td align="center" width="275" valign="bottom" bgcolor="#F2CEB3">
					<p align="left">
					<span style="font-size: 10pt; font-weight: 700" lang="en-us">
					<? echo $_SESSION['vvname']; ?></span></td>
					<td align="center" width="65" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="4">

<div align="center">
	<table border="0" width="896" cellspacing="1" cellpadding="2" height="100" bgcolor="#F2CEB3">
		<tr>
			<td colspan="4" bgcolor="#FF6600">
			<p align="center"><font color="#FFFFFF"><span style="font-size: 15pt; font-weight: 700">��Ѻ��ا�����Ԫ�</span></font></td>
		</tr>
		<tr>
			<td width="90" align="right" bgcolor="#FFCC99">
			<span style="font-size: 12pt; font-weight: 700">��ѡ�ٵ�
			<span lang="en-us">:</span></span></td>
			<td width="340" bgcolor="#FFCC99">
				<select name="sblid" onChange="getData('ajxsbl.php?zsblid='+this.value,'tbsbgid')" style="font-family: Tahoma; font-size: 13; color: #4B3D34" size="1" tabindex="1">
					<option>���͡������ѡ�ٵ� �ҡ����ա�سһ�Ѻ��ا������ѡ�ٵ�</option>
				<?php	$sbldb=mysql_query("select * from exam_level ");
					while($sblrs=mysql_fetch_array($sbldb)){	$osblid=trim($sblrs['id']);	$osblname=trim($sblrs['name']);	
				?>
					<option value="<? echo $osblid; ?>" <?php if($osblid==$sblid){ echo "selected"; } ?>><?php echo $osblname; ?></option>
				<?php }  ?>	
				</select></td>
			<td width="98" bgcolor="#FFCC99">
			<p align="right">
			<span style="font-size: 12pt; font-weight: 700">������Ԫ� :</span></td>
			<td width="348" bgcolor="#FFCC99" id="tbsbgid">
				<select name='sbgid'  size="1" style="font-family: Tahoma; font-size: 13; color: #4B3D34" tabindex="2">
				<option>���͡���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا��ª��͡�����Ԫ�</option>
			<?php		$sbgdb=mysql_query("select * from exam_group where exam_level_id='$sblid'");
					while($sbgrs=mysql_fetch_array($sbgdb)){	$osbgid=trim($sbgrs['id']);	$osbgname=trim($sbgrs['name']);		?>
				<option value="<?php echo $osbgid; ?>" <?php if($osbgid==$sbgid){ echo "selected"; } ?>><?php echo $osbgname; ?></option>";
			<?php  $i++;	}	?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="90" align="right" bgcolor="#FFCC99">
			<span style="font-size: 12pt; font-weight: 700">�����Ԫ� : </span>
			</td>
			<td width="340" bgcolor="#FFCC99">
			<input type="text" name="sbid" value="<? echo $sbid; ?>"  size="18" style="font-family: Tahoma; font-size: 12; color: #4B3D34; font-weight: bold"><span lang="en-us">
			</span><span style="font-size: 10pt">(�к���駤���ѵ��ѵ�)</span></td>
			<td width="98" bgcolor="#FFCC99">
			<p align="right">
			<span style="font-size: 12pt; font-weight: 700">�����Ԫ� :</span></td>
			<td width="348" bgcolor="#FFCC99">
			<input type="text" name="sbname" value="<? echo $sbname; ?>" size="48" style="font-family: Tahoma; font-size: 12; color: #4B3D34; font-weight: bold" tabindex="3"></td>
		</tr>
		<tr bgcolor="#FFCC99">
			<td width="890" colspan="4">
			
				<table border="0" width="103%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
						<p align="center">
				<input type="submit" value="<? echo $subm; ?>" name="subm" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold" tabindex="4"></td>
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
			<span style="font-size: 11pt; font-weight: 700">����</span></font></td>
			<td align="center" width="239" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">�����Ԫ�</span></font></td>
			<td align="center" width="276" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">���͡�����Ԫ�</span></font></td>
			<td align="center" width="232" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">��ѡ�ٵ�</span></font></td>
			<td align="center" width="232" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">num</span></font></td>			
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF" style="font-size: 11pt">
			<span style="font-weight: 700">��</span></font></td>
			<td align="center" bgcolor="#FF6600">
			<font color="#FFFFFF">
			<span style="font-size: 11pt; font-weight: 700">ź</span></font></td>
		</tr>
<?php for($i=0;$i<$row;$i++)
	{	$rs=mysql_fetch_array($db);				//�ҧ�������ʴ�˹�Ҩ����ͧ�觤�ҡ�Ѻ�������
		$ssbid=trim($rs['sbid']);					$ssbname=trim($rs['sbname']);		$ssbgid=trim($rs['sbgid']);		
		$ssbgname=trim($rs['sbgname']);		$ssblid=trim($rs['sblid']);				$ssblname=trim($rs['sblname']);	

		$sql  = "select count(*) as num from ".$ssbid ;	
		$num_test  = mysql_query($sql);
		$result_test = mysql_fetch_assoc($num_test); 

		if(($i%2)==0){
?>		
		<tr>
			<td width="78" bgcolor="#FFCC99">
			<p align="center"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbid; ?></span></td>
			<td width="239" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbname; ?></span></td>
			<td width="276" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="232" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="232" bgcolor="#FFCC99"><span style="font-size: 11pt" lang="en-us"><?php echo $result_test["num"]; ?></span></td>
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
			<p align="center"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbid; ?></span></td>
			<td width="239" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbname; ?></span></td>
			<td width="276" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssbgname; ?></span></td>
			<td width="232" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $ssblname; ?></span></td>
			<td width="232" bgcolor="#FF9966"><span style="font-size: 11pt" lang="en-us"><?php echo $result_test["num"]; ?></span></td>
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
					<span style="font-size: 12pt; font-weight: 700">�Ѳ���� 
					�����ӹ�¡�� 6 �ͧ�ѧ�Ѻ����ӹ�¡�� �ͧ�ѭ�ҡ���֡��</span></font></td>
				</tr>
			</table>
</div>
<?php
	mysql_close($conn);
?>
</body>
</html>