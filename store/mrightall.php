<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>�к���ѧ����ͺ</title>
	</head>
	<body background="images/sq.gif">
<?php
	include("connect.inc");			
	
?>	 
</font>
<div align="center">
<form method="POST" action="index.php">
			<input type=hidden name=epid value="<?php echo $epid; ?>">
			<input type=hidden name=epname value="<?php echo $epname; ?>">
			<input type=hidden name=epfull value="<?php echo $epfull; ?>">
			<table border="0" width="1024" background="images/laithai.jpg" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="5" bgcolor="#E7D7D0"><font color="#4B3D34">
					<span style="font-size: 22pt; font-weight: 700">
					�к���ѧ����ͺ</span></font></td>
				</tr>
				<tr>
					<td align="center" width="211" bgcolor="#E7D7D0" valign="bottom">
					<p align="left"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="�͡����ͺ" onclick="window.location='../index.php'" style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left"></span></font></span></font></td>
					<td align="center" width="212" bgcolor="#E7D7D0">&nbsp;</td>
					<td align="center" width="226" valign="bottom" bgcolor="#E7D7D0">
					<p align="right"><b><font style="font-size: 11pt">
					�����ҹ�к� </font><span lang="en-us">
					<font style="font-size: 11pt">:</font></span></b></td>
					<td align="center" width="310" valign="bottom" bgcolor="#E7D7D0">
					<p align="left">
					<span style="font-size: 10pt; font-weight: 700" lang="en-us">
					<?php echo $_SESSION['vvname']; ?></span></td>
					<td align="center" width="65" bgcolor="#E7D7D0">
					<img border="0" src="../<?php echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td>
				</tr>
				<tr>
					<td align="center" colspan="5">
					
					
					
					
					</td>
				</tr>
				<tr>
					<td align="center" colspan="5">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" colspan="5"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">�Ѳ���� 
					�����ӹ�¡�� 6 �ͧ�ѧ�Ѻ����ӹ�¡�� �ͧ�ѭ�ҡ���֡��</span></font></td>
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
<?php
	mysql_close($conn);
?>
</font></span>
</body>
</html>