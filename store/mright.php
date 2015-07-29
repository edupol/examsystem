<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>ระบบคลังข้อสอบ</title>
	</head>
	<body background="images/sq.gif">
<?
	include("connect.inc");			
	
?>	 
</font>
<div align="center">
<form method="POST" action="index.php">
			<input type=hidden name=epid value="<? echo $epid; ?>">
			<input type=hidden name=epname value="<? echo $epname; ?>">
			<input type=hidden name=epfull value="<? echo $epfull; ?>">
			<table border="0" width="1024" background="images/laithai.jpg" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="5" bgcolor="#E7D7D0"><font color="#4B3D34">
					<span style="font-size: 22pt; font-weight: 700">
					ระบบคลังข้อสอบ</span></font></td>
				</tr>
				<tr>
					<td align="center" width="211" bgcolor="#E7D7D0" valign="bottom">
					<p align="left"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="ออกข้อสอบ" onclick="window.location='../index.php'" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left"></span></font></span></font></td>
					<td align="center" width="212" bgcolor="#E7D7D0">&nbsp;</td>
					<td align="center" width="226" valign="bottom" bgcolor="#E7D7D0">
					<p align="right"><b><font style="font-size: 11pt">
					ผู้ใช้งานระบบ </font><span lang="en-us">
					<font style="font-size: 11pt">:</font></span></b></td>
					<td align="center" width="310" valign="bottom" bgcolor="#E7D7D0">
					<p align="left">
					<span style="font-size: 10pt; font-weight: 700" lang="en-us">
					<? echo $_SESSION['vvname']; ?></span></td>
					<td align="center" width="65" bgcolor="#E7D7D0">
					<img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="5">
					
					
					
					
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5">
					<table border="0" width="100%" cellspacing="1" cellpadding="0">
						<tr>
							<td width="307">&nbsp;</td>
							<td width="89">&nbsp;</td>
							<td width="29">
							<p align="right">
							<span style="font-size: 11pt; font-weight: 700">ชื่อ</span></td>
							<td>
							<input type="text" name="T1" size="27" style="font-family: Tahoma; font-size: 13; color: #280000"></td>
							<td width="72">
							<p align="right">
							<span style="font-size: 11pt; font-weight: 700">
							นามสกุล</span></td>
							<td width="190">
							<p align="left">
							<input type="text" name="T2" size="26" style="font-family: Tahoma; font-size: 13; color: #280000"></td>
							<td width="128"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="     ค้นหา     " onclick="window.location='../index.php'" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left"></span></font></span></font></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5">
					<table border="0" width="100%" cellspacing="1" cellpadding="3">
						<tr>
							<td bgcolor="#4B3D34" align="center" width="71">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">
							ลำดับ</span></font></td>
							<td bgcolor="#4B3D34" align="center">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">ยศ</span></font></td>
							<td bgcolor="#4B3D34" align="center">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">ชื่อ</span></font></td>
							<td bgcolor="#4B3D34" align="center" width="200">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">
							นามสกุล</span></font></td>
							<td bgcolor="#4B3D34" align="center" width="297">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">
							ตำแหน่ง</span></font></td>
							<td bgcolor="#4B3D34" align="center" width="87">
							<font color="#FFFFFF">
							<span style="font-size: 12pt; font-weight: 700">
							ให้สิทธิ</span></font></td>
							<td bgcolor="#4B3D34" align="center" width="63">
							<font color="#FFFFFF" style="font-size: 11pt">
							<span style="font-weight: 700">ภาพถ่าย</span></font></td>
						</tr>
						<tr>
							<td bgcolor="#FFD9B3" width="71" align="center" height="21">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" height="21">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" height="21">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" width="200" height="21">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" width="297" height="21">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" width="87" height="21" align="center">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#FFD9B3" width="63" height="21" align="center">
							<img border="0" src="../man/pimages/1.jpg" width="50" height="60"></td>
						</tr>
						<tr>
							<td bgcolor="#E7D7D0" width="71" align="center">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0" width="200">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0" width="297">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0" width="87" align="center">
							<span style="font-size: 12pt" lang="en-us">xx</span></td>
							<td bgcolor="#E7D7D0" width="63" align="center">
							<img border="0" src="../man/pimages/1.jpg" width="50" height="60"></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">พัฒนาโดย 
					ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font></td>
				</tr>
			</table>
</form>
</font>
</span>
<font face="Tahoma" style="font-size: 15pt; font-weight: 700" color="#FF0000">
<p align="center"><span lang="en-us"><? echo $msg;    ?></span></p>
</font>
<span lang="en-us">  
	<font face="AngsanaUPC" style="font-size: 20pt; font-weight: 700" color="#0000FF">
</div>
<?
	mysql_close($conn);
?>
</font></span>
</body>
</html>