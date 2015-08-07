<?php	session_start();
	//if(!$_SESSION['vvstatus'][7]){ echo "<script> alert('ท่านไม่ได้รับอนุญาตให้ใช้งานระบบนี้ โปรดติดต่อผู้ดูแลระบบ'); 
	//window.location='../index.php';</script>";  exit();}
   require_once 'libs/PDOAdapter.php';

?>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ระบบคลังข้อสอบ</title>
<script src="js/jquery.min.js"></script>
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
	{	
    if($('select[name=sblid]').val()=="0"){ alert("โปรดเลือกชื่อหลักสูตร"); return false; }
		if($('select[name=osbgid]').val()=="0"){ alert("โปรดเลือกชื่อกลุ่มวิชา"); return false; }
		if($('select[name=osbid]').val()=="0"){ alert('โปรดเลือกชื่อวิชา :'); return false;}
		return true;	
	}
</script>
</head>
<body background="images/bg.png">
<?php
	include("connect.inc");	
  $_SESSION['vvname'] = 'ร.ต.ท.จรัสพงษ์ โชคชัยสิริ';
	if(isset($_POST['subm']) || isset($_POST['upload']))
	{	$_SESSION['vvsbid']=trim($_POST['osbid']);
		$sbid=trim($_POST['osbid']);
		$_SESSION['vvsbgid']=trim($_POST['osbgid']);
		$_SESSION['vvsblid']=trim($_POST['sblid']);

		$sql = "select a.name as osbname,b.name as sbgname,c.name as osblname
		from exam_subject a join exam_group b on a.exam_group_id=b.id join exam_level c on b.exam_level_id=c.id where a.exam_code='$sbid'";
    
    $rs = PDOAdpter::getInstance()->select($sql,null,false);

		$_SESSION['vvsbname']=trim($rs[0]['osbname']);
		$_SESSION['vvsbgname']=trim($rs[0]['sbgname']);	
		$_SESSION['vvsblname']=trim($rs[0]['osblname']);
//var_dump($_SESSION);
	    if(isset($_POST['upload'])){
			echo "<script>window.location='uploadExam.php'</script>";	
		}else{
			echo "<script>window.location='index1.php'</script>";	
		}
	}
	$sbid=$_SESSION['vvsbid'];			//กรณีหลังออกสอบกลับมาเปลี่ยนตัวเลือก
	$sbgid=$_SESSION['vvsbgid'];
	$sblid=$_SESSION['vvsblid'];	
?>
<div align="center">
  <form method="POST" action="index.php" name="idxfrm" onSubmit="return chk()">
    <table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" colspan="4" bgcolor="#E7D7D0"><img border="0" src="images/head.jpg" width="1024" height="120"></td>
      </tr>
      <tr>
        <td align="left" width="632" bgcolor="#F2CEB3" valign="bottom"><font color="#0000FF"> <span style="font-size: 11pt" lang="en-us"><font size="3"> <span style="font-size: 9pt">
<!--           <input type="button" value="ระบบสารสนเทศ บช.ศ. " onClick="window.location='../index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left"> -->
          &nbsp;&nbsp; </span></font></span> </font></td>
        <td align="center" width="102" valign="bottom" bgcolor="#F2CEB3"><p align="right"><font style="font-size: 11pt"> ผู้ใช้งานระบบ :</font></span></td>
        <td align="center" width="225" valign="bottom" bgcolor="#F2CEB3"><p align="left"><b><span style="font-size: 11pt; font-weight: 700 color:#003366" lang="en-us"> <? echo $_SESSION['vvname']; ?></span></b></td>
        <!-- <td align="center" width="65" bgcolor="#D2B8AE"><img border="0" src="../<? echo $_SESSION['vvphoto']; ?>" width="64" height="80"></td> -->
      </tr>
      <tr>
          <td align="center" colspan="4" height="26">
        <table border="0" width="100%" cellspacing="1" cellpadding="3" bgcolor="#F2CEB3">
          <tr>
            <td width="7%" height="40" valign="bottom"><p align="right"> <font color="#003366" style="font-size: 20pt"><b> หลักสูตร</b></font><b><span style="font-size: 10pt"> <font color="#003366"> :</font></span></td>
            <td width="40%" height="40" valign="bottom"><select name="sblid" onChange="getData('ajxsbl.php?zsblid='+this.value,'tbsbgid')" 
							style="font-family: Tahoma; font-size: 13; color: #4B3D34" size="1" tabindex="1">
                <option value="0" >เลือกชื่อหลักสูตร หากไม่มีกรุณาปรับปรุงชื่อหลักสูตร</option>
                <?php	
                $sql = "select * from exam_level ";
                $exams = PDOAdpter::getInstance()->select($sql,null,false);
					foreach($exams as $key => $val){	
            $osblid=trim($val['id']);	
            $osblname=trim($val['name']);	
				?>
                <option value="<?php echo $osblid; ?>" <? if($osblid==$id){ echo "selected"; } ?>><?php echo $osblname; ?></option>
                <?php }  ?>
              </select></td>
            <td height="40" colspan="3"><table border="0" width="100%" cellspacing="3" cellpadding="0">
                <tr>
                  <td valign="bottom"><p align="right"><font color="#0000FF">
                      <!-- <input name="upload" type="submit" style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold;float:right;"   value="อัฟโหลดข้อสอบ"> -->
                      <input type="button" value="ปรับปรุงชื่อหลักสูตร" onClick="window.location='sblevel.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">
                      &nbsp;
                      <input type="button" value="ปรับปรุงชื่อกลุ่มวิชา" onClick="window.location='subgrp.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">
                      &nbsp;
                      <input type="button" value="ปรับปรุงชื่อวิชา" onClick="window.location='subject.php'" 
							style="font-family: Tahoma; font-size: 13; color: #FF0000; font-weight: bold">
                      </font> </td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td width="10%"><b>
              <p align="right"> <font color="#003366" style="font-size: 20pt">กลุ่มวิชา</font><span style="font-size: 10pt"> <font color="#003366"> :</font></span></td>
            <td width="25%" id="tbsbgid" ><p align="left">
                <select name='osbgid' onChange="getData('ajxsb.php?zsbgid='+this.value,'tdsbid')"  
								size="1" style="font-family: Tahoma; font-size: 13; color: #4B3D34" tabindex="2">
                  <option value="0">เลือกชื่อกลุ่มวิชา หากไม่มีกรุณาปรับปรุงชื่อกลุ่มวิชา</option>
                </select>
            </td>
            <td width="5%"><p align="right"><b> <span style="font-size: 10pt"> <font color="#003366"> วิชา :</font></span></td>
            </td>
          
          
            <td width="17%" id="tdsbid" ><select name='osbid' size="1" style="font-family: Tahoma; font-size: 13; color: #4B3D34" tabindex="3">
                <option value="0">เลือกชื่อวิชา หากไม่มีกรุณาปรับปรุงชื่อวิชา</option>
              </select></td>
            <td width="37%"><p align="right"><font color="#0000FF"> <span style="font-size: 11pt" lang="en-us"><font size="3"> <span style="font-size: 9pt">
                <input name="subm" type=submit  value="ออกข้อสอบ" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:right" 
			tabindex="4">
                </span></font></span></font></td>
          </tr>
        </table>
          </td>
      </tr>
      <tr>
        <td align="center" colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" colspan="4"><font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF">
          <table cellpadding="3" border="0" width="100%" height="49" bgcolor="#F2CEB3" cellspacing="1" 
background="images/laithai.jpg">
            <tr>
              <td align="center" width="2%" bgcolor="#FF6600" height="24"><font color="#FFFFFF"><b><span style="font-size: 12pt">ข้อ<span lang="en-us">/</span>เฉลย</span></b> <span lang="en-us"></span></span></font><span lang="en-us"><b><span lang="en-us"></a></span> </span></font></b></td>
                </span>
              <td align="center" bgcolor="#FF6600" height="24"><font face="Tahoma" style="font-size: 20pt; font-weight: 700" color="#0000FF"> <span lang="en-us"> <font color="#FFFFFF"><font face="Tahoma" style="font-size: 12pt; font-weight: 700"> คำถาม/คำตอบ </font> <font style="font-size: 12pt"> </a> </font></b> </font> <b><font style="font-size: 12pt"> </span> </font> </font></b> </span> </font></td>
                <span lang="en-us">
              <td align="center" bgcolor="#FF6600" height="24"><font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt"> ลบ</span></b></font></td>
              <td align="center" bgcolor="#FF6600" height="24"><font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt"> แก้</span></b></font></td>
              <td align="center" bgcolor="#FF6600" height="24"><font color="#FFFFFF" face="Tahoma" style="font-size: 20pt; font-weight: 700"><b><span style="font-size: 12pt"> ไปข้อ</span></b></font></td>
            </tr>
          </table>
          </font></span></td>
      </tr>
      <tr>
        <td align="center" colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" colspan="4"><font color="#9F777E"><span style="font-size: 12pt; font-weight: 700"> พัฒนาโดย ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font></td>
      </tr>
    </table>
  </form>
</div>
<?php
	mysql_close($conn);
?>
</body>
</html>