<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>ระบบคลังข้อสอบ</title>
<script language = "javascript">
	var XMLHttpRequestObject = false;
	if (window.XMLHttpRequest) 
	{	XMLHttpRequestObject = new XMLHttpRequest();
	} else 
	if (window.ActiveXObject) 
	{	XMLHttpRequestObject = new
	     ActiveXObject("Microsoft.XMLHTTP");
	}
	function getData(dataSource,objID)
	{	if(XMLHttpRequestObject) 
		{	var obj = document.getElementById(objID);
	          XMLHttpRequestObject.open("GET", dataSource);
	          XMLHttpRequestObject.onreadystatechange = function()
	          {	if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) 
	              	{	obj.innerHTML = XMLHttpRequestObject.responseText;
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
	{	if(document.sbjfrm.ans1.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 1    '); return false;} 
		if(document.sbjfrm.ans2.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 2    '); return false;} 
		if(document.sbjfrm.ans3.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 3    '); return false;} 
		if(document.sbjfrm.ans4.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 4    '); return false;} 
		if(document.sbjfrm.qtn.value==""){ alert('     โปรดกรอกข้อมูลในช่องคำถาม     '); return false;} 
		return true;
	}
</script>
	</head>
	<body background="images/sq.gif">
<?
	include("connect.inc");	
	$apid13=$_SESSION['vvid13'];				$edid13=$_SESSION['vvid13'];	$apdate=date('Y-m-j');			$eddate=date('Y-m-j');
	$rd1="0";										$rd2="0";							$rd3="0";							$rd4="0";
	$sbid="";										$sbgid="";
	if(isset($_POST['subm']))
	{	$subm=trim($_POST['subm']);			$qtn=trim($_POST['qtn']);		$ans1=trim($_POST['ans1']);	$ans2=trim($_POST['ans2']);			
		$ans3=trim($_POST['ans3']);			$ans4=trim($_POST['ans4']);	$sbid=trim($_POST['sbid']);
		$sbno=trim($_POST['sbno']);			//บันทึกเลขข้อ key
		$sbgid=trim($_POST['sbgid']);			//เก็บค่าเดิมเพื่อแสดง ไม่ต้องเลือกใหม่
		$rd=trim($_POST['rd']);			
		switch ($rd)
		{	case 1: $rd1="1"; break;				case 2: $rd2="1"; break;			case 3: $rd3="1"; break;			case 4: $rd4="1"; break;
		}	//ให้ข้อถูกขึ้นต้นด้วย 1 ข้อผิดขึ้นต้นด้วย 0
		$ans1=$rd1.$ans1;						$ans2=$rd2.$ans2;				$ans3=$rd3.$ans3;				$ans4=$rd4.$ans4;
		mysql_query("insert into $sbid (apid13,apdate,qtn,ans1,ans2,ans3,ans4) values ('$apid13','$apdate','$qtn','$ans1','$ans2','$ans3','$ans4')") or die("".mysql_error());
	}		
?>	 
<div align="center">
<form method="POST" action="index.php" name="sbjfrm" onsubmit="return chk()">
			<input type=hidden name=epid value="<? echo $epid; ?>">
			<input type=hidden name=epname value="<? echo $epname; ?>">
			<input type=hidden name=epfull value="<? echo $epfull; ?>">
			<table border="0" width="1024" background="images/laithai.jpg" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.gif" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="404" bgcolor="#D2B8AE" valign="bottom"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="submit" value="&lt;&lt; Back " name="subm0" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">&nbsp;&nbsp; </span></font></span>
							<input type="button" value="เพิ่มรายชื่อวิชา" onclick="window.location='subject.php'" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></font></td>
					<td align="center" width="248" valign="bottom" bgcolor="#D2B8AE">
					<p align="right"><b><font style="font-size: 11pt">
					ผู้ใช้งานระบบ </font><span lang="en-us">
					<font style="font-size: 11pt">:</font></span></b></td>
					<td align="center" width="307" valign="bottom" bgcolor="#D2B8AE">
					<p align="left">
					<span style="font-size: 10pt; font-weight: 700" lang="en-us">
					<? $_SESSION['vvname']; ?></span></td>
					<td align="center" width="65" bgcolor="#D2B8AE">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="4" height="26">
					<table border="0" width="100%" cellspacing="1" cellpadding="3" bgcolor="#EDE2DE">
						<tr>
							<td width="120"><b>
							<p align="right"><span style="font-size: 10pt"><span lang="en-us">&nbsp;<font color="#003366">
								</font></span><font color="#003366">วิชาที่ออกข้อสอบ :</font></span></td>
							<td width="248"><p align="left">
									<select id="sbgid" onchange="getData('sbj.php?zsbgid='+sbgid.value+'&zsbid=<? echo $sbid; ?>','tdsbid')" name="sbgid" size="1" style="font-family: Tahoma; font-size: 12; color: #4B3D34">
									<option>เลือกกลุ่มวิชา หากไม่มีกรุณาเพิ่มรายชื่อใหม่</option>
									<? $sbgdb=mysql_query("select * from sbgrb");
										while($sbgrs=mysql_fetch_array($sbgdb))
										{	$ssbgid=trim($sbgrs['sbgid']);
											$ssbgname=trim($sbgrs['sbgname']);
									?>
									<option value="<? echo $ssbgid; ?>" <? if($ssbgid==$sbgid){ echo "selected";} ?>><? echo $ssbgname; ?></option>
									<? }  ?>
								</select>
							</td>
							<td width="609" id="tdsbid"><p align="left"></td>
							<td>&nbsp;</td>
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
							<font style="font-size: 10pt" color="#003366">ข้อสอบออกไว้แล้ว </font> <span lang="en-us">
							<font style="font-size: 10pt" color="#003366">:</font><span style="font-size: 10pt">
							</span> </span></b>
							</td>
							<td width="59">
							<p align="center"><span lang="en-us">
							<font color="#FF0000" style="font-size: 10pt">
							<span style="font-weight: 700">xx</span></font></span></td>
							<td width="39"><font color="#003366"><b><span style="font-size: 10pt">
							ข้อ</span></b></font></td>
							<td width="401">&nbsp;</td>
							<td>
								<p align="right"><font color="#0000FF">
							<input type="button" value="รายชื่อผู้ออกและแก้ไขวิชานี้" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></font></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
	<table border="0" width="100%" cellpadding="2" bgcolor="#EDE2DE" cellspacing="1">
		<tr>
			<td width="82" align="right" bgcolor="#D2B8AE" colspan="2">
			<p align="center"><font color="#003366" style="font-size: 9pt"><b>
			คำถาม<br>
			เฉลย<span lang="en-us">/</span>คำตอบ</b></font></td>
			<td width="931" bgcolor="#D2B8AE">
			<input type="text" name="qtn" size="184" style="font-family: Tahoma; font-size: 12; color: #000066"></td>		
		</tr>
		<tr>
			<td width="47" align="right" bgcolor="#D2B8AE">
			<input type="radio" value="1" name="rd"></td>
			<td width="31" align="right" bgcolor="#D2B8AE">
			<font color="#003366" style="font-size: 10pt"><b>1</b></font></td>
			<td width="911" bgcolor="#D2B8AE">
			<input type="text" name="ans1" size="184" style="font-family: Tahoma; font-size: 12; color: #000066"></td>		
		</tr>
		<tr>
			<td width="47" align="right" bgcolor="#D2B8AE">
			<input type="radio" value="2" name="rd"></td>
			<td width="31" align="right" bgcolor="#D2B8AE">
			<font color="#003366" style="font-size: 10pt"><b>2</b></font></td>
			<td width="911" bgcolor="#D2B8AE">
			<input type="text" name="ans2" size="184" style="font-family: Tahoma; font-size: 12; color: #000066"></td>		
		</tr>
		<tr>
			<td width="47" align="right" bgcolor="#D2B8AE">
			<input type="radio" value="3" name="rd"></td>
			<td width="31" align="right" bgcolor="#D2B8AE">
			<font color="#003366" style="font-size: 10pt"><b>3</b></font></td>
			<td width="911" bgcolor="#D2B8AE">
			<input type="text" name="ans3" size="184" style="font-family: Tahoma; font-size: 12; color: #000066"></td>		
		</tr>
		<tr>
			<td width="47" align="right" bgcolor="#D2B8AE">
			<input type="radio" value="4" name="rd"></td>
			<td width="31" align="right" bgcolor="#D2B8AE">
			<font color="#003366" style="font-size: 10pt"><b>4</b></font></td>
			<td width="911" bgcolor="#D2B8AE">
			<input type="text" name="ans4" size="184" style="font-family: Tahoma; font-size: 12; color: #000066"></td>		
		</tr>
		<tr>
			<td width="1013" align="right" colspan="3">
			<p align="center"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" value="บันทึกข้อสอบ" name="subm" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold"></span></font></span></font></td>
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
<table cellpadding="3" border="0" width="100%" height="49" bgcolor="#EDE2DE" cellspacing="1" background="images/laithai.jpg">	
	<tr>
		<td align="center" width="2%" bgcolor="#4B3D34" height="24">
			<font color="#FFFFFF"><b><span style="font-size: 10pt">ข้อ<span lang="en-us">/</span>เฉลย</span></b><span lang="en-us"></span></span></font><span lang="en-us"><b><span lang="en-us"></a></span></span></font></b></td>
		</span>
		<td align="center" bgcolor="#4B3D34" height="24" colspan="3">
			<font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF">
<span lang="en-us">  
			<font color="#FFFFFF"><font face="Tahoma" style="font-size: 12pt; font-weight: 700"> 
			คำถาม/คำตอบ </font>
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
		<td align="center" bgcolor="#4B3D34" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			ลบ</span></b></font></td>
		<td align="center" bgcolor="#4B3D34" height="24">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			แก้</span></b></font></td>
		<td align="center" bgcolor="#4B3D34" height="24" colspan="2">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 10pt">
			ไปข้อ</span></b></font></td>
	</tr>
	<tr>
		<td align="center" width="2%" bgcolor="#D2B8AE">
		<font color="#FF0000">
		<span style="font-size: 10pt; font-weight: 700" lang="en-us">xx</span></font></td>
		<td align="left" bgcolor="#D2B8AE" colspan="7">
		<span style="font-size: 9pt" lang="en-us">xx</span></td>
	</tr>
	<tr>
		<td align="center" width="2%" bgcolor="#D2B8AE">
		<p align="right"><input type="radio" name="srd1"></td>
		<td align="left" bgcolor="#D2B8AE" width="2%">
		<p align="right"><span style="font-size: 9pt; font-weight: 700">1</span></td>
		<td align="left" bgcolor="#D2B8AE" width="907">
		<span style="font-size: 9pt" lang="en-us">xx</span></td>
		<td align="left" bgcolor="#D2B8AE" width="2%" rowspan="4" colspan="2">
	<span lang="en-us">  
	<font face="AngsanaUPC" style="font-size: 20pt; font-weight: 700" color="#0000FF">
			<a href="index.php?delpid=<? echo $rs['pid']; ?>">
			<img border="0" src="../pc/images/b_drop.png" width="16" height="16" alt="คลิกเพื่อลบข้อมูลนี้"></a></font></span></td>
		<td align="left" bgcolor="#D2B8AE" width="2%" rowspan="4" colspan="2">
	<span lang="en-us">  
			<font face="AngsanaUPC" style="font-size: 20pt; font-weight: 700" color="#0000FF">
			<a href="index.php?editpid=<? echo $rs['pid']; ?>&editpname=<? echo $rs['pname'];?>&editpfull=<? echo $rs['pfull']; ?>&editp_eng=<? echo $rs['p_eng'] ?>">
			<img border="0" src="../pc/images/b_edit.png" width="16" height="16" alt="คลิกเพื่อแก้ไขข้อมูลนี้"></a></font></span></td>
		<td align="left" bgcolor="#D2B8AE" width="3%" rowspan="4">
			<span lang="en-us">
			<select>
				<option>1</option>
				<option>2</option>
			</select>
			</span>
			</td>
	</tr>
	<tr>
		<td align="center" width="2%" bgcolor="#D2B8AE">
		<p align="right"><input type="radio" name="srd2"></td>
		<td align="left" bgcolor="#D2B8AE" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">2</span></td>
		<td align="left" bgcolor="#D2B8AE" width="907">
		<span style="font-size: 9pt" lang="en-us">xx</span></td>
		</tr>
	<tr>
		<td align="center" width="2%" bgcolor="#D2B8AE">
		<p align="right"><input type="radio" name="srd3"></td>
		<td align="left" bgcolor="#D2B8AE" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">3</span></td>
		<td align="left" bgcolor="#D2B8AE" width="907">
		<span style="font-size: 9pt" lang="en-us">xx</span></td>
		</tr>
	<tr>
		<td align="center" width="2%" bgcolor="#D2B8AE">
		<p align="right"><input type="radio" name="srd4"></td>
		<td align="left" bgcolor="#D2B8AE" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 9pt">4</span></td>
		<td align="left" bgcolor="#D2B8AE" width="907">
		<span style="font-size: 9pt" lang="en-us">xx</span></td>
		</tr>
</table>
</font></span></td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E"><span style="font-size: 12pt; font-weight: 700">
						พัฒนาโดย ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font>
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