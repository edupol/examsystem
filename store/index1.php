<?	session_start();
	if(!$_SESSION['vvstatus'][7]){ echo "<script>window.location='../index.php'</script>";  exit();}
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>�͡����ͺ</title>
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
	{ 	if(confirm("  ����ͺ���ѹ�֡�����Ԫ� : "+n+" �ж١ź������ �ô�׹�ѹ���ź  ")==true)		
		{ return true; } 
		return false;	
	}
	function chk()
	{	if(document.sbjfrm.ans1.value==""){ alert('     �ô��͡������㹪�ͧ�ӵͺ 1    '); return false;} 
		if(document.sbjfrm.ans2.value==""){ alert('     �ô��͡������㹪�ͧ�ӵͺ 2    '); return false;} 
		if(document.sbjfrm.ans3.value==""){ alert('     �ô��͡������㹪�ͧ�ӵͺ 3    '); return false;} 
		if(document.sbjfrm.ans4.value==""){ alert('     �ô��͡������㹪�ͧ�ӵͺ 4    '); return false;} 
		if(document.sbjfrm.qtn.value==""){ alert('     �ô��͡������㹪�ͧ�Ӷ��     '); return false;} 
		return true;
	}
</script>
	</head>
	<body background="images/bg.png">
<?
	include("connect.inc");	//���ҧ�红����Ū������ǡѺ sbid
	$apid13=$_SESSION['vvid13'];				$edid13=$_SESSION['vvid13'];	
	$apdate=date('Y-m-j');						$eddate=date('Y-m-j');
	$rd1="01";									$rd2="02";						
	$rd3="03";									$rd4="04";
	$sbid=trim($_SESSION['vvsbid']);			$sbgid=trim($_SESSION['vvsbgid']);									
	$sblid=trim($_SESSION['vvsblid']);			$sbname=trim($_SESSION['vvsbname']);	
	$sbgname=trim($_SESSION['vvsbgname']);						
	$sblname=trim($_SESSION['vvsblname']);
	$subm="        �ѹ�֡����ͺ        ";
	if(isset($_POST['subm']))
	{	$subm=trim($_POST['subm']);			
		$qtn=trim($_POST['qtn']);		
		$ans1=trim($_POST['ans1']);	
		$ans2=trim($_POST['ans2']);			
		$ans3=trim($_POST['ans3']);			
		$ans4=trim($_POST['ans4']);	
		$rd=trim($_POST['rd']);					//�Ţ˹�Ҥӵͺ 0=��ͼԴ  1=��Ͷ١ ��Ƿ���ͧ 1=�  2=� 3=�  4=�
		switch ($rd){	case 1: $rd1="11"; break;	
						case 2: $rd2="12"; break;	
						case 3: $rd3="13"; break;	
						case 4: $rd4="14"; break;  
					 }	
		$ans1=$rd1.$ans1;			
		$ans2=$rd2.$ans2;			
		$ans3=$rd3.$ans3;			
		$ans4=$rd4.$ans4;
		if(trim($subm)=="�ѹ�֡����ͺ")
		{	mysql_query("insert into $sbid (apid13,apdate,qtn,ans1,ans2,ans3,ans4) values 
			('$apid13','$apdate','$qtn','$ans1','$ans2','$ans3','$ans4')") or die("".mysql_error());
		}
		 else	//��䢢���ͺ
		{	mysql_query("update $sbid set qtn='$qtn',ans1='$ans1',ans2='$ans2',ans3='$ans3',
			ans4='$ans4',edid13='$edid13',eddate='$eddate' where sbno='$sbno'");	
			$subm="        �ѹ�֡����ͺ        ";
		}
		$qtn="";										
		$ans1="";							
		$ans2="";										
		$ans3="";							
		$ans4="";
		$rd1="01";									
		$rd2="02";						
		$rd3="03";						
		$rd4="04";
	}
	if(isset($_GET['delsbno']))
	{	$sbno=trim($_GET['delsbno']);
		mysql_query("delete from $sbid where sbno='$sbno'");
	}	
	$sbjdb=mysql_query("select * from $sbid order by sbno desc");
	$sbjrow=@mysql_num_rows($sbjdb); if($sbjrow==null){ $sbjrow=0; }
	if(isset($_GET['editsbno']))		//�������ش���е�ͧ����觤�� sbno ���᷹���ҧ����
	{	$sbno=trim($_GET['editsbno']);
		$edrs=mysql_fetch_array(mysql_query("select * from $sbid where sbno='$sbno'"));
		$qtn=trim($edrs['qtn']);
		$ans1=substr(trim($edrs['ans1']),2);		
		$ans2=substr(trim($edrs['ans2']),2);		
		$ans3=substr(trim($edrs['ans3']),2);		
		$ans4=substr(trim($edrs['ans4']),2);
		$erd1=substr(trim($edrs['ans1']),0,1);		
		$erd2=substr(trim($edrs['ans2']),0,1);		
		$erd3=substr(trim($edrs['ans3']),0,1);		
		$erd4=substr(trim($edrs['ans4']),0,1);
		$echk1="";									
		$echk2="";									
		$echk3="";							
		$echk4="";
		if($erd1=="1"){$echk1="CHECKED"; }		
		if($erd2=="1"){$echk2="CHECKED"; }		
		if($erd3=="1"){$echk3="CHECKED"; }		
		if($erd4=="1"){$echk4="CHECKED"; }
		$subm="        ��䢢���ͺ        ";
	}
?>	 
<div align="center">
<form method="POST" action="index1.php" name="sbjfrm" onSubmit="return chk()">
			<input type=hidden name=sbno value="<? echo $sbno; ?>">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.jpg" width="1162" height="136"></td>
				</tr>
				<tr>
					<td align="left" width="611" bgcolor="#F2CEB3" valign="bottom"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="�к����ʹ�� ��.�. " onClick="window.location='../index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">
			<input type="button" value="���͡��ѡ�ٵ�  ������Ԫ�  �����Ԫ�" onClick="window.location='index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">
			&nbsp;&nbsp; </span></font></span>
							</font></td>
					<td align="center" width="106" valign="bottom" bgcolor="#F2CEB3">
					<p align="right"><font style="font-size: 11pt">
					�����ҹ�к� :</font></td>
					<td align="center" width="242" valign="bottom" bgcolor="#F2CEB3">
					<p align="left"><b>
					<span style="font-size: 11pt; font-weight: 700 color:#003366" lang="en-us">
					<? echo $_SESSION['vvname']; ?></span></b></td>
					<td align="center" width="65" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" 
			width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="4" height="26">
					<table border="0" width="100%" cellspacing="1" cellpadding="3" bgcolor="#EDE2DE">
						<tr bgcolor="#FF9966">
							<td width="5">&nbsp;</td>
							<td><span style="font-size: 12pt; font-weight: 500" lang="en-us">
							
							<? echo "�͡����ͺ��ѡ�ٵ� : <font color='#FF0000'>".$sblname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ������Ԫ� : <font color=	'#FF0000'>".$sbgname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Ԫ� : <font color='#FF0000'>".$sbname."</font> -".$sbid; ?>
							</span>
							</td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
					<table border="0" width="100%" cellspacing="1" cellpadding="3">
						<tr>
							<td width="121">
							<p align="right"><b>
							<font style="font-size: 10pt" color="#003366">����ͺ�͡������� </font> <span lang="en-us">
							<font style="font-size: 10pt" color="#003366">:</font><span style="font-size: 10pt">
							</span> </span></b>
							</td>
							<td width="59">
							<p align="center"><span lang="en-us">
							<font color="#FF0000" style="font-size: 13pt">
							<span style="font-weight: 700"><?  echo $sbjrow; ?></span></font></span></td>
							<td width="105"><font color="#003366"><b><span style="font-size: 10pt">
							���</span></b></font></td>
							<td width="369" id="tcname" align=right></td>
							<td><p align="right"><font color="#0000FF">
							<input type="button" value="��Ǩ�ͺ��ª��ͼ���͡�������Ԫҹ��" onClick="getData('ajxchkn.php','tcname')" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"></font></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
	<table border="0" width="100%" cellpadding="2" bgcolor="#EDE2DE" cellspacing="1">
		<tr bgcolor="#FF9966">
			<td width="82" align="right" colspan="2">
			<p align="center"><font color="#003366" style="font-size: 9pt"><b>
			�Ӷ��<br>
			���<span lang="en-us">/</span>�ӵͺ</b></font></td>
			<td width="931">
			<textarea rows="2" name="qtn" cols="151"><? echo $qtn; ?></textarea></td>		
		</tr>
		<tr bgcolor="#FF9966">
			<td width="47" align="right">
			<input type="radio" value="1" name="rd" <? echo $echk1; ?> tabindex="6"></td>
			<td width="31" align="right">
			<font color="#003366" style="font-size: 10pt"><b>1</b></font></td>
			<td width="911">
			<input type="text" name="ans1" value="<? echo $ans1; ?>" size="181" 
			style="font-family: Tahoma; font-size: 12; color: #000066" tabindex="2"></td>		
		</tr>
		<tr bgcolor="#FF9966">
			<td width="47" align="right">
			<input type="radio" value="2" name="rd" <? echo $echk2; ?> tabindex="7"></td>
			<td width="31" align="right">
			<font color="#003366" style="font-size: 10pt"><b>2</b></font></td>
			<td width="911">
			<input type="text" name="ans2" value="<? echo $ans2; ?>" size="181" 
			style="font-family: Tahoma; font-size: 12; color: #000066" tabindex="3"></td>		
		</tr>
		<tr bgcolor="#FF9966">
			<td width="47" align="right">
			<input type="radio" value="3" name="rd" <? echo $echk3; ?> tabindex="8"></td>
			<td width="31" align="right">
			<font color="#003366" style="font-size: 10pt"><b>3</b></font></td>
			<td width="911">
			<input type="text" name="ans3" size="181" style="font-family: Tahoma; font-size: 12; color: #000066" 
			tabindex="4" value="<? echo $ans3; ?>"></td>		
		</tr>
		<tr bgcolor="#FF9966">
			<td width="47" align="right">
			<input type="radio" value="4" name="rd" <? echo $echk4; ?> tabindex="9"></td>
			<td width="31" align="right">
			<font color="#003366" style="font-size: 10pt"><b>4</b></font></td>
			<td width="911">
			<input type="text" name="ans4" size="181" style="font-family: Tahoma; font-size: 12; color: #000066" 
			tabindex="5" value="<? echo $ans4; ?>"></td>		
		</tr>
		<tr bgcolor="#FF9966">
			<td width="1013" colspan="3" align="right">
			<p align="center"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="<? echo $subm; ?>" name="subm" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold" 
			tabindex="10"></span></font></span></font></td>
			</tr>
	</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">&nbsp;</td>
				</tr>
				<tr bgcolor="#FFCC99">
					<td colspan="4" align="center">
					<font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF">
<table cellpadding="3" border="0" width="100%" height="49" bgcolor="#EDE2DE" 
cellspacing="1" background="images/5.png">	
	<tr>
		<td align="center" width="2%" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF"><b><span style="font-size: 10pt">���<span lang="en-us">/</span>���</span></b>
			<span lang="en-us"></span></span></font><span lang="en-us"><b><span lang="en-us"></a>
			</span></span></font></b></td>
		</span>
		<td align="center" bgcolor="#FF6600" height="24" colspan="3">
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
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			ź</span></b></font></td>
		<td align="center" bgcolor="#FF6600" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			��</span></b></font></td>
		<td align="center" bgcolor="#FF6600" height="24" colspan="2">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			仢��</span></b></font></td>
	</tr>
<?	for($i=0;$i<$sbjrow;$i++)
	{	$rs=mysql_fetch_array($sbjdb);
		$sbno=trim($rs['sbno']);					
		$qtn=trim($rs['qtn']);		
		$ans1=substr(trim($rs['ans1']),2);		
		$ans2=substr(trim($rs['ans2']),2);		
		$ans3=substr(trim($rs['ans3']),2);		
		$ans4=substr(trim($rs['ans4']),2);
		$schk1="";
		$schk2="";
		$schk3="";
		$schk4="";
		$srd1=substr(trim($rs['ans1']),0,1);		if($srd1=="1"){ $schk1="CHECKED";}
		$srd2=substr(trim($rs['ans2']),0,1);		if($srd2=="1"){ $schk2="CHECKED";}
		$srd3=substr(trim($rs['ans3']),0,1);		if($srd3=="1"){ $schk3="CHECKED";}
		$srd4=substr(trim($rs['ans4']),0,1);		if($srd4=="1"){ $schk4="CHECKED";}
?>	
	<tr bgcolor="#FF9966">
		<td align="center" width="2%"><a name="<? echo $sbno; ?>">
		<font color="#FF0000">	<span style="font-size: 10pt; font-weight: 700" lang="en-us">
		<? echo $sbjrow-$i; ?></span></font></a></td>
		<td align="left" colspan="7">
		<span style="font-size: 9pt" lang="en-us"><? echo $qtn; ?></span>
		</td>
	</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<? echo $i; ?>" <? echo $schk1; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-size: 9pt; font-weight: 700">1</span></td>
		<td align="left" width="907">
		<span style="font-size: 9pt" lang="en-us"><? echo $ans1; ?></span></td>
		<td align="left" width="2%" rowspan="4" colspan="2">
	<a href="index1.php?delsbno=<? echo $sbno; ?>">
	<img border="0" src="images/b_drop.png" width="16" height="16"></a></td>
		<td align="left" width="2%" rowspan="4" colspan="2">
	<a href="index1.php?editsbno=<? echo $sbno; ?>">
	<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
		<td align="left" width="3%" rowspan="4">
			<span lang="en-us">
			<select size="1"  onchange="if (this.selectedIndex > 0) document.location.href=this.value;">
				<?	for($k=0;$k<$sbjrow;$k+=5){	?>
				<option value="<? echo '#'.$k; ?>"><? echo $k; ?></option><? } ?>
			</select>
			</span>
			</td>
	</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<? echo $i; ?>" <? echo $schk2; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">2</span></td>
		<td align="left" width="907">
		<span style="font-size: 9pt" lang="en-us"><? echo $ans2; ?></span></td>
		</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<? echo $i; ?>" <? echo $schk3; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">3</span></td>
		<td align="left" width="907">
		<span style="font-size: 9pt" lang="en-us"><? echo $ans3; ?></span></td>
		</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<? echo $i; ?>" <? echo $schk4; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">4</span></td>
		<td align="left" width="907">
		<span style="font-size: 9pt" lang="en-us"><? echo $ans4; ?></span></td>
		</tr>
<? } ?>		
</table>
</font></span></td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">
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