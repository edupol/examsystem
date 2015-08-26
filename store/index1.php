<?php	session_start();
    define('WEB_PATH', '//'. $_SERVER["SERVER_NAME"].'/examsystem/');
	date_default_timezone_set('Asia/Bangkok');
	//var_dump($_SESSION);
?>
<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ออกข้อสอบ</title>

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
	{ 	
		return  confirm("  ข้อสอบที่บันทึกไว้ในวิชานี้ ข้อที่ : "+n+" จะถูกลบ โปรดยืนยันการลบ  ");	
	}
	function chk()
	{	if($('input[name=ans1]').val()==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 1    '); return false;} 
		if($('input[name=ans2]').val()==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 2    '); return false;} 
		if($('input[name=ans3]').val()==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 3    '); return false;} 
		if($('input[name=ans4]').val()==""){ alert('     โปรดกรอกข้อมูลในช่องคำตอบ 4    '); return false;} 
		if($('input[name=qtn]').val()==""){ alert('     โปรดกรอกข้อมูลในช่องคำถาม     '); return false;} 
		return true;
	}

	$(document).ready(function(){

		$('.scroll-container').on('change',function(){
			var val = $(this).val(),
			 	container = $('#container');
			var scrollTo = $()
			container.scrollTop(
			    scrollTo.offset().top - container.offset().top + container.scrollTop()
			);
		});

		$('a.delete-row').on('click',function(e){
			e.preventDefault();
			e.stopPropagation();
			var ok  =  confirm("  ข้อสอบที่บันทึกไว้ในวิชานี้ ข้อที่ : "+$(this).attr('id')+" จะถูกลบ โปรดยืนยันการลบ  ");	
			if(ok){
				window.location = $(this).attr('href');
			}
		});
	});
</script>

	</head>
	<body background="images/bg.png">
<?php
	include("connect.inc");	//ตารางเก็บข้อมูลชื่อเดียวกับ sbid
	$date  = new DateTime("now");
	$apid13=$_SESSION['vvid13'];				$edid13=$_SESSION['vvid13'];	
	$apdate=$date->format('Y-m-d H:i:s');		$eddate=date('Y-m-j');
	$rd1="01";									$rd2="02";						
	$rd3="03";									$rd4="04";
	$sbid=trim($_SESSION['vvsbid']);			$sbgid=trim($_SESSION['vvsbgid']);									
	$sblid=trim($_SESSION['vvsblid']);			$sbname=trim($_SESSION['vvsbname']);	
	$sbgname=trim($_SESSION['vvsbgname']);		
	$sblname=trim($_SESSION['vvsblname']);
	$subm="        บันทึกข้อสอบ        ";

	if(isset($_POST['subm']))
	{	
		$subm=trim($_POST['subm']);			
		$qtn=trim($_POST['qtn']);		
		$ans1=trim($_POST['ans1']);	
		$ans2=trim($_POST['ans2']);			
		$ans3=trim($_POST['ans3']);			
		$ans4=trim($_POST['ans4']);	
		$rd=trim($_POST['rd']);					//เลขหน้าคำตอบ 0=ข้อผิด  1=ข้อถูก ตัวที่สอง 1=ก  2=ข 3=ค  4=ง
		switch ($rd){	case 1: $rd1="11"; break;	
						case 2: $rd2="12"; break;	
						case 3: $rd3="13"; break;	
						case 4: $rd4="14"; break;  
					 }	
		$ans1=$rd1.$ans1;			
		$ans2=$rd2.$ans2;			
		$ans3=$rd3.$ans3;			
		$ans4=$rd4.$ans4;
		if(trim($subm)=="บันทึกข้อสอบ")
		{	

			$sql = " select * from  exam_subject   
					 where exam_code = '$sbid' ";	
			$sbjdb=mysql_query($sql);
			$rs=mysql_fetch_array($sbjdb);
			$exam_subject_id = $rs['id'];
			mysql_query("insert into questions (exam_subject_id,instructor_id,created_at,qtn,ans1,ans2,ans3,ans4,answer) values 
			($exam_subject_id,'$apid13','$apdate','$qtn','$ans1','$ans2','$ans3','$ans4','$rd')") or die("".mysql_error());
		}
		 else	if(trim($subm)=="แก้ไขข้อสอบ")//แก้ไขข้อสอบ
		{	
			$sbno=trim($_POST['sbno']);
			$sql = "update questions set qtn='$qtn',ans1='$ans1',ans2='$ans2',ans3='$ans3',
			ans4='$ans4',instructor_edit_id='$apid13',created_at='$apdate' where id='$sbno'";
			mysql_query($sql);	
			$subm="        บันทึกข้อสอบ        ";
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
		$sql = "delete from questions where id='$sbno'";
		mysql_query($sql);
	}	

	$sql = "select a.*,b.name,b.exam_code from questions a join exam_subject as b on a.exam_subject_id = b.id  where b.exam_code = '$sbid' order by a.id desc";	

	$sbjdb  =mysql_query($sql);
	$sbjrow =@mysql_num_rows($sbjdb); if($sbjrow==null){ $sbjrow=0; }

	if(isset($_GET['editsbno']))		//ไว้ท้ายสุดเพราะต้องการส่งค่า sbno เก่าแทนสร้างใหม่
	{	$sbno=trim($_GET['editsbno']);
		$edrs=mysql_fetch_array(mysql_query("select * from questions where id='$sbno'"));
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
		if($erd1=="1"){$echk1="checked='checked'"; }		
		if($erd2=="1"){$echk2="checked='checked'"; }		
		if($erd3=="1"){$echk3="checked='checked'"; }		
		if($erd4=="1"){$echk4="checked='checked'"; }
		$subm="        แก้ไขข้อสอบ        ";
	}
?>	 
<div align="center">
<form method="POST" action="index1.php" name="sbjfrm" onSubmit="return chk()">
			<input type=hidden name=sbno value="<?php echo $sbno; ?>">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.jpg" width="1162" height="136"></td>
				</tr>
				<tr>
					<td align="left" width="612" bgcolor="#F2CEB3" valign="bottom"><font color="#0000FF">
			<span style="font-size: 14pt" lang="en-us"><font size="3">
			<span style="font-size: 14pt">
			<!-- <input type="button" value="ระบบสารสนเทศ บช.ศ. " onClick="window.location='../index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left"> -->
			<input type="button" value="เลือกหลักสูตร  กลุ่มวิชา  ชื่อวิชา" onClick="window.location='index.php'" 
			style="font-family: Tahoma; font-size: 18px; color: #FF0000; font-weight: bold; float: left">
			&nbsp;&nbsp; </span></font></span>
							</font></td>
   <td align="center" width="120" valign="bottom" bgcolor="#F2CEB3"><p align="right"><font style="font-size: 18px;font-weight: 700 ;"> ผู้ใช้งานระบบ : </font></span></td>
        <td align="center" width="225" valign="bottom" bgcolor="#F2CEB3"><p align="left"><b><span style="font-size: 18px;font-weight: 700 ;color:#003366" lang="en-us"> <?php echo $_SESSION['vvname']; ?></span></b></td>
        <!-- <td align="center" width="65" bgcolor="#D2B8AE"><img border="0" src="../<?php echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td> -->
     
					<td align="center" width="123" bgcolor="#F2CEB3">
			<a href="index.php?delpid=<?php echo $rs['pid']; ?>"><!-- <img border="0" src="../<?php echo $_SESSION['vvphoto']; ?>" 
			width="64" height="80"> --></td>
				</tr>
				<tr>
					<td align="center" colspan="4" height="26">
					<table border="0" width="100%" cellspacing="1" cellpadding="3" bgcolor="#EDE2DE">
						<tr bgcolor="#FF9966">
							<td width="6">&nbsp;</td>
							<td width="1141"><span style="font-size: 16pt; font-weight: 500" lang="en-us">
							
							<?php echo "ออกข้อสอบหลักสูตร : <font color='#FF0000'>".$sblname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; กลุ่มวิชา : <font color='#FF0000'>".$sbgname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิชา : <font color='#FF0000'>".$sbname."</font> - ".$sbid; ?>
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
							<td width="207">
							<p align="right"><b>
							<font style="font-size: 14pt" color="#003366">ข้อสอบออกไว้แล้ว </font> <span lang="en-us">
							<font style="font-size: 14pt" color="#003366">:</font><span style="font-size: 14pt">
							</span> </span></b>
						  </td>
							<td width="70">
							<p align="center"><span lang="en-us">
							<font color="#FF0000" style="font-size: 14pt">
						  <span style="font-weight: 700"><?php  echo $sbjrow; ?></span></font></span></td>
							<td width="33"><font color="#003366"><b><span style="font-size: 14pt">
							ข้อ</span></b></font></td>
							<td width="344" id="tcname" align=right></td>
							<td width="472"><p align="right"><font color="#0000FF">
							<!-- <input type="button" value="ตรวจสอบรายชื่อผู้ออกและแก้ไขวิชานี้" onClick="getData('ajxchkn.php','tcname')" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold"/> --></font></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
	<table border="0" width="1150" cellpadding="2" bgcolor="#EDE2DE" cellspacing="1">
		<tr bgcolor="#FF9966">
		  <td align="right" bgcolor="#FF9966"  style="width: 30px;">
			  <p align="center"><font color="#003366" style="font-size: 14pt;font-weight:bold" >
			  เฉลย</font>
		  </td>
		  <td align="right" bgcolor="#FF9966"  style="width: 60px;">
			  <p align="center"><font color="#003366" style="font-size: 14pt;font-weight:bold" >
			  คำถาม</font>
		  </td>		  
		  <td  bgcolor="#FF9966">
		  	<textarea rows="2" name="qtn" style="font-family: Tahoma; font-size: 22px; color: #000066;width: 1024px"><?php echo $qtn; ?></textarea>
		  </td>
		</tr>
		<tr>
		  <td align="right" bgcolor="#FF9966"><input type="radio" value="1" name="rd" <?php echo $echk1;?> ></td>
		  <td align="right" bgcolor="#FF9966"><font color="#003366" style="font-size: 14pt"><b>1</b></font></td>
		  <td bgcolor="#FF9966"><input type="text" name="ans1" value="<?php echo $ans1; ?>" size="184" style="font-family: Tahoma; font-size: 22px; color: #000066;width: 1024px"/></td>
		  </tr>
		<tr>
		  <td align="right" bgcolor="#FF9966"><input type="radio" value="2" name="rd" <?php echo $echk2;?>></td>
		  <td align="right" bgcolor="#FF9966"><font color="#003366" style="font-size: 14pt"><b>2</b></font></td>
		  <td bgcolor="#FF9966"><input type="text" name="ans2" size="184" value="<?php echo $ans2; ?>" style="font-family: Tahoma; font-size: 22px; color: #000066;width: 1024px"/></td>
		  </tr>
		<tr>
		  <td align="right" bgcolor="#FF9966"><input type="radio" value="3" name="rd" <?php echo $echk3;?>></td>
		  <td align="right" bgcolor="#FF9966"><font color="#003366" style="font-size: 14pt"><b>3</b></font></td>
		  <td bgcolor="#FF9966"><input type="text" name="ans3" size="184" value="<?php echo $ans3; ?>" style="font-family: Tahoma; font-size: 22px; color: #000066;width: 1024px"/></td>
		  </tr>
		<tr>
		  <td align="right" bgcolor="#FF9966"><input type="radio" value="4" name="rd" <?php echo $echk4;?>></td>
		  <td align="right" bgcolor="#FF9966"><font color="#003366" style="font-size: 14pt"><b>4</b></font></td>
		  <td bgcolor="#FF9966"><input type="text" name="ans4" size="184" value="<?php echo $ans4; ?>" style="font-family: Tahoma; font-size: 22px; color: #000066;width: 1024px"/></td>
		  </tr>
		<tr bgcolor="#FF9966">
		  <td align="right" colspan="3"><p align="center"><font color="#0000FF"> <span style="font-size: 14pt" lang="en-us"><font size="3"> <span style="font-size: 16pt"> &nbsp;&nbsp;&nbsp;&nbsp;
		    <input type="submit" value="<?php echo $subm;?>" name="subm" style="font-family: Tahoma; font-size: 18; color: #FF0000; font-weight: bold">
		    </span></font></span></font></td>
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
<table id="container" cellpadding="3" border="0" width="100%" height="49" bgcolor="#EDE2DE" 
cellspacing="1" background="images/5.png">	
	<tr>
		<td align="center" width="2%" bgcolor="#FF6600" height="24">
			<font color="#000"><b><span style="font-size: 14pt">ข้อ<span lang="en-us">/</span>เฉลย</span></b>
			<span lang="en-us"></span></span></font><span lang="en-us"><b><span lang="en-us"></a>
			</span></span></font></b>
		</td>
		</span>
		<td width="907" align="center" bgcolor="#FF6600" height="24" colspan="2">
			<span><font face="Tahoma"  face="Tahoma" style="font-size: 12pt; font-weight: 700"> 
			คำถาม/คำตอบ </font>
		</span>
	</font>
		</td>

<span lang="en-us">  
		<td align="center" width="2%" bgcolor="#FF6600" height="24"  colspan="2">
			<font color="#000" face="Tahoma" style="font-size: 20pt; font-weight: 700"><span style="font-size: 14pt">
			แก้ไข</span></font></td>
		<td align="center width="2%" " bgcolor="#FF6600" height="24" colspan="2" >
			<font color="#000" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 14pt">
			ลบ</span></b></font></td>

		<!-- <td align="center" bgcolor="#FF6600" height="24" colspan="2">
			<font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 14pt">
			ไปข้อ</span></b></font></td> -->
	</tr>
<?php	for($i=0;$i<$sbjrow;$i++)
	{	$rs=mysql_fetch_array($sbjdb);
		
		$sbno=trim($rs['id']);					
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
		<td align="center" width="2%"><a name="<?php echo $sbno; ?>">
		<font color="#FF0000">	<span style="font-size: 14pt; font-weight: 700" lang="en-us">
		<?php echo $sbjrow-$i; ?></span></font></a></td>
		<td align="left" colspan="7">
		<span style="font-size: 16pt" lang="en-us"><?php echo $qtn; ?></span>
		</td>
	</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<?php echo $i; ?>" <?php echo $schk1; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-size: 16pt; font-weight: 700">1</span></td>
		<td align="left" width="907">
		<span style="font-size: 16pt" lang="en-us"><?php echo $ans1; ?></span></td>

		<td align="center" width="2%" rowspan="4" colspan="2" >
	<a href="index1.php?editsbno=<?php echo $sbno; ?>">
	<img border="0" src="images/b_edit.png" width="16" height="16"></a></td>
		<td align="center" width="2%" rowspan="4" >
	<a href="index1.php?delsbno=<?php echo $sbno; ?>"  class="delete-row" id="<?php echo $sbjrow-$i;?>"> 
	<img border="0" src="images/b_drop.png" width="16" height="16"></a></td>

<!-- 		<td align="left" width="3%" rowspan="4">
			<span lang="en-us">
			<select size="1" class="scroll-container"  >
				<?php	for($k=0;$k<$sbjrow;$k+=5){	?>
				<option value="<?php echo '#'.$k; ?>"><?php echo $k; ?></option><?php } ?>
			</select>
			</span>
			</td> -->
	</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<?php echo $i; ?>" <?php echo $schk2; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 16pt">2</span></td>
		<td align="left" width="907">
		<span style="font-size: 16pt" lang="en-us"><?php echo $ans2; ?></span></td>
		</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<?php echo $i; ?>" <?php echo $schk3; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 16pt">3</span></td>
		<td align="left" width="907">
		<span style="font-size: 16pt" lang="en-us"><?php echo $ans3; ?></span></td>
		</tr>
	<tr bgcolor="#FFCC99">
		<td align="center" width="2%">
		<p align="right"><input type="radio" name="srd<?php echo $i; ?>" <?php echo $schk4; ?>></td>
		<td align="left" width="2%">
		<p align="right"><span style="font-weight: 700; font-size: 16pt">4</span></td>
		<td align="left" width="907">
		<span style="font-size: 16pt" lang="en-us"><?php echo $ans4; ?></span></td>
		</tr>
<?php } ?>		
</table>
</font></span></td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">
						พัฒนาโดย ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font>
					</td>
				</tr>
			</table>
</form>
</div>
<?php
	mysql_close($conn);
?>
</body>
</html>