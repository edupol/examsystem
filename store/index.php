<?	session_start();
	//if(!$_SESSION['vvstatus'][7]){ echo "<script> alert('��ҹ������Ѻ͹حҵ�����ҹ�к���� �ô�Դ��ͼ������к�'); 
	//window.location='../index.php';</script>";  exit();}
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>�к���ѧ����ͺ</title>
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
	function chk()
	{	if(document.idxfrm.sblid.value==""){ alert("�ô���͡������ѡ�ٵ�"); return false; }
		if(document.idxfrm.sbgid.value==""){ alert("�ô���͡���͡�����Ԫ�"); return false; }
		if(document.idxfrm.sbid.value==""){ alert('�ô���͡�����Ԫ� :'); return false;}
		return true;	
	}
</script>
	</head>
	<body background="images/bg.png">
<?
	include("connect.inc");	
	if(isset($_POST['subm']) || isset($_POST['upload']))
	{	$_SESSION['vvsbid']=trim($_POST['sbid']);
		$sbid=trim($_POST['sbid']);
		$_SESSION['vvsbgid']=trim($_POST['sbgid']);
		$_SESSION['vvsblid']=trim($_POST['sblid']);
		$rs=mysql_fetch_array(mysql_query("select * 
		from sbj a join sbgrb b on a.sbgid=b.sbgid join sblevel c on b.sblid=c.sblid where a.sbid='$sbid'"));
		$_SESSION['vvsbname']=trim($rs['sbname']);
		$_SESSION['vvsbgname']=trim($rs['sbgname']);	
		$_SESSION['vvsblname']=trim($rs['sblname']);
	    if(isset($_POST['upload'])){
			echo "<script>window.location='uploadExam.php'</script>";	
		}else{
			echo "<script>window.location='index1.php'</script>";	
		}
	}
	$sbid=$_SESSION['vvsbid'];			//�ó���ѧ�͡�ͺ��Ѻ������¹������͡
	$sbgid=$_SESSION['vvsbgid'];
	$sblid=$_SESSION['vvsblid'];	
?>	 
<div align="center">
<form method="POST" action="index.php" name="idxfrm" onSubmit="return chk()">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
			  <tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
			  <tr>
					<td align="left" width="632" bgcolor="#F2CEB3" valign="bottom"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="�к����ʹ�� ��.�. " onClick="window.location='../index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">&nbsp;&nbsp; 
			</span></font></span>
							</font></td>
					<td align="center" width="102" valign="bottom" bgcolor="#F2CEB3">
					<p align="right"><font style="font-size: 11pt">
					�����ҹ�к� :</font></span></td>
					<td align="center" width="225" valign="bottom" bgcolor="#F2CEB3">
					<p align="left"><b><span style="font-size: 11pt; font-weight: 700 color:#003366" lang="en-us">
					<? echo $_SESSION['vvname']; ?></span></b></td>
					<td align="center" width="65" bgcolor="#D2B8AE">
			<img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="4" height="26">
					<table border="0" width="100%" cellspacing="1" cellpadding="3" bgcolor="#F2CEB3">
						<tr>
							<td width="7%" height="40" valign="bottom">
							<p align="right">
							<font color="#003366" style="font-size: 10pt"><b>
							��ѡ�ٵ�</b></font><b><span style="font-size: 10pt">
							<font color="#003366"> :</font></span></td>
							<td width="40%" height="40" valign="bottom">
							<select name="sblid" onChange="getData('ajxsbl.php?zsblid='+this.value,'tbsbgid')" 
							style="font-family: Tahoma; font-size: 13; color: #4B3D34" size="1" tabindex="1">
					<option >���͡������ѡ�ٵ� �ҡ����ա�سһ�Ѻ��ا������ѡ�ٵ�</option>
				<?	$sbldb=mysql_query("select * from sblevel");
					while($sblrs=mysql_fetch_array($sbldb)){	$osblid=trim($sblrs['sblid']);	$osblname=trim($sblrs['sblname']);	
				?>
					<option value="<? echo $osblid; ?>" <? if($osblid==$sblid){ echo "selected"; } ?>><? echo $osblname; ?></option>
				<? }  ?>	
				</select></td>
							<td height="40" colspan="3">
							<table border="0" width="100%" cellspacing="3" cellpadding="0">
								<tr>
									<td valign="bottom">
									<p align="right"><font color="#0000FF">
                            <input name="upload" type="submit" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold;float:right;"   value="�ѿ��Ŵ����ͺ">
							<input type="button" value="��Ѻ��ا������ѡ�ٵ�" onClick="window.location='sblevel.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">&nbsp;
							<input type="button" value="��Ѻ��ا���͡�����Ԫ�" onClick="window.location='subgrp.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">&nbsp;
							<input type="button" value="��Ѻ��ا�����Ԫ�" onClick="window.location='subject.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">
                            
                            </font>
                            </td>
								</tr>
							</table>
							</td>
						</tr>
						<tr>
							<td width="10%"><b>
							<p align="right">
							<font color="#003366" style="font-size: 10pt">������Ԫ�</font><span style="font-size: 10pt"> <font color="#003366"> :</font></span></td>
							<td width="25%" id="tbsbgid" ><p align="left">
								<select name='sbgid' onChange="getData('ajxsb.php?zsbgid='+this.value,'tdsbid')"  
								size="1" style="font-family: Tahoma; font-size: 13; color: #4B3D34" tabindex="2">
									<option>_���͡���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا���͡�����Ԫ�</option>
								<?		$sbgdb=mysql_query("select * from sbgrb where sblid='$sblid'");
										while($sbgrs=mysql_fetch_array($sbgdb)){	$osbgid=trim($sbgrs['sbgid']);	
										$osbgname=trim($sbgrs['sbgname']);		?>
											<option value="<? echo $osbgid; ?>" <? if($osbgid==$sbgid)
											{ echo "selected"; } ?>><? echo $osbgname; ?></option>";
								<?  $i++;	}	?>
								</select></td>
							<td width="5%">
								<p align="right"><b>
								<span style="font-size: 10pt">
								<font color="#003366"> 
								�Ԫ� :</font></span></td>
					  </td>
							<td width="17%" id="tdsbid" >
								<select name='sbid' size="1" style="font-family: Tahoma; font-size: 13; color: #4B3D34" tabindex="3">
									<option>���͡�����Ԫ� �ҡ����ա�سһ�Ѻ��ا�����Ԫ�</option>
								<?		$sbdb=mysql_query("select * from sbj where sbgid='$sbgid'");
										while($sbrs=mysql_fetch_array($sbdb)){	$osbid=trim($sbrs['sbid']);	
										$osbname=trim($sbrs['sbname']);		?>
											<option value="<? echo $osbid; ?>" <? if($osbid==$sbid)
											{ echo "selected"; } ?>><? echo $osbname; ?></option>";
								<?  $i++;	}	?>
								</select></td>
							<td width="37%">
							<p align="right"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
             
			<input name="subm" type=submit  value="�͡����ͺ" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:right" 
			tabindex="4"></span></font></span></font></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
					<font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF">
<table cellpadding="3" border="0" width="100%" height="49" bgcolor="#F2CEB3" cellspacing="1" 
background="images/laithai.jpg">	
	<tr>
		<td align="center" width="2%" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF"><b><span style="font-size: 12pt">���<span lang="en-us">/</span>���</span></b>
			<span lang="en-us"></span></span></font><span lang="en-us"><b><span lang="en-us"></a></span>
			</span></font></b></td>
		</span>
		<td align="center" bgcolor="#FF6600" height="24">
			<font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF">
<span lang="en-us">  
			<font color="#FFFFFF"><font face="Tahoma" style="font-size: 12pt; font-weight: 700"> 
			�Ӷ��/�ӵͺ </font>
<font style="font-size: 12pt">
			</a>
		</font></b>
		</font>
		<b><font style="font-size: 12pt">
		</span>
		</font>
		</font></b>
		</span>
	</font>
		</td>
<span lang="en-us">  
		<td align="center" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt">
			ź</span></b></font></td>
		<td align="center" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt">
			��</span></b></font></td>
		<td align="center" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt">
			仢��</span></b></font></td>
	</tr>
	</table>
</font></span></td>
				</tr>
				<tr>
					<td align="center" colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E"><span style="font-size: 12pt; font-weight: 700">
						�Ѳ���� �����ӹ�¡�� 6 �ͧ�ѧ�Ѻ����ӹ�¡�� �ͧ�ѭ�ҡ���֡��</span></font>
					</td>
				</tr>
			</table>
</form>
</div>
<?
	mysql_close($conn);
?>
</body>
</html>