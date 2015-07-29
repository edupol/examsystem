<?php 
	session_start();
	if(!$_SESSION['vvstatus'][7]){ echo "<script>window.location='../index.php'</script>";  exit();}
	 include_once("libs/getExamInf.php");
	 require_once("../examsystem/libs/PDOAdapter.php");
?>

<html>
	<head>
		<meta http-equiv="Content-Language" content="th">
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
		<title>นำเข้าข้อสอบ</title>
        <script src="js/util.js"   type="text/javascript" ></script>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
	</head>
	<body background="images/bg.png">
<?php 
	 include_once("libs/uploadCSV.php");
?>
<div align="center">

			<input type=hidden name=sbno value="<? echo $sbno; ?>">
			<table border="0" width="1024" background="images/5.png" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" colspan="4" bgcolor="#E7D7D0">
					<img border="0" src="images/head.jpg" width="1024" height="120"></td>
				</tr>
				<tr>
					<td align="left" width="611" bgcolor="#F2CEB3" valign="bottom"><font color="#0000FF">
			<span style="font-size: 11pt" lang="en-us"><font size="3">
			<span style="font-size: 9pt">
			<input type="button" value="ระบบสารสนเทศ บช.ศ. " onClick="window.location='../index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">
			<input type="button" value="เลือกหลักสูตร  กลุ่มวิชา  ชื่อวิชา" onClick="window.location='index.php'" 
			style="font-family: Tahoma; font-size: 15; color: #FF0000; font-weight: bold; float:left">
			&nbsp;&nbsp; </span></font></span>
							</font></td>
					<td align="center" width="106" valign="bottom" bgcolor="#F2CEB3">
					<p align="right"><font style="font-size: 11pt">
					ผู้ใช้งานระบบ :</font></td>
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
						<tr>
							<td width="5" bgcolor="#FF9966">&nbsp;</td>
							<td bgcolor="#FF9966"><span style="font-size: 12pt; font-weight: 500" lang="en-us">
							
							<? echo "ออกข้อสอบหลักสูตร : <font color='#FF0000'>".$sblname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; กลุ่มวิชา : <font color=	'#FF0000'>".$sbgname."
							</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิชา : <font color='#FF0000'>".$sbname."</font> -".$sbid; ?>
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
							<font style="font-size: 10pt" color="#003366">ข้อสอบออกไว้แล้ว </font> <span lang="en-us">
							<font style="font-size: 10pt" color="#003366">:</font><span style="font-size: 10pt">
							</span> </span></b>
							</td>
							<td width="59">
							<p align="center"><span lang="en-us">
							<font color="#FF0000" style="font-size: 13pt">
							<span style="font-weight: 700"><?  echo $sbjrow; ?></span></font></span></td>
							<td width="105"><font color="#003366"><b><span style="font-size: 10pt">
							ข้อ</span></b></font></td>
							<td width="369" id="tcname" align=right></td>
							<td></td>
						</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td align="center" colspan="4">
                        <!--Exam upload instruction-->
                        <table width="100%" class="table-style1">    
                               <tr>
                                   <td height="30" width="100%">
                                       <span style="font-family: Tahoma; font-size: 13pt; color: #000000;font-weight: bold; " class="pad-l1">ขั้นตอนการอัพโหลด</span>
                                   </td>
                               </tr>
                               <tr height="30">
                                   <td class="pad-l1">
                                       <span style="font-family: Tahoma; font-size: 9pt; color: #000000;font-weight: bold; ">1. จัด Format ไฟล์ใน Excel ดังนี้</span>
                                   </td>
                               </tr>
                               <tr>
                                   <td width="100%">
                                       <table width="100%">
                                           <tr>
                                               <td width="8%" valign="top" class="pad-l1">     
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column A :</span>                  
                                               </td>
                                               <td width="23%"  valign="top"><span class="text-1">วิชา</span></td>
                                               <td width="8%" valign="top">            
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column B :</span>           
                                               </td>
                                               <td width="23%" valign="top"> 
                                                   <span class="text-1">คำถาม</span>                      
                                               </td>
                                               <td width="8%" valign="top">         
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column C :</span>              
                                               </td>
                                               <td width="23%" valign="top"> 
                                                  <span class="text-1">ใส่ คำตอบที่ 1</span><span style="font-family: Tahoma; font-size: 9pt; color: #003300;font-weight: bold; "></span>                     
                                               </td>
                                           </tr>   
                                           
                                           <tr>
                                               <td width="8%" valign="top" class="pad-l1">     
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column D :</span>                  
                                               </td>
                                               <td width="23%"  valign="top">    
                                                   <span class="text-1">ใส่ คำตอบที่ 2</span></td>
                                               <td width="8%" valign="top">            
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column E :</span>           
                                               </td>
                                               <td width="23%" valign="top"> 
                                               <span class="text-1">ใส่ คำตอบที่ 3</span></td>
                                               <td width="8%" valign="top">         
                                                   <span style="padding-right:2px;font-family: Tahoma; font-size: 9pt; color: #FF0000;font-weight: bold; ">Column F :</span>              
                                               </td>
                                               <td width="23%" valign="top"> 
                                                  <span class="text-1">ใส่ คำตอบที่ 4</span></td>
                                           </tr>
                                       </table>
                               </tr>
                               <tr height="30">
                                   <td colspan="3" class="pad-l1">
                                       <span style="font-family: Tahoma; font-size: 9pt; color: #000000;font-weight: bold; ">2. Save ไฟล์ แล้วเลือก Save as type เป็นแบบ CVS (Comma delimited) (*.cvs) </span>
                                   </td>
                               </tr>
                               <tr height="20">
                                   <td colspan="3">
                                       <span class="pad-l1" style="font-family: Tahoma; font-size: 9pt; color: #000000;font-weight: bold; ">3. เปิดไฟล์ CVS แล้วเลือก Save as โดยปรับ Encoding เป็น UTF-8</span>
                                   </td>
                               </tr>
                           </table>
						<!---End Exam Instruction-->
                    </td>
				</tr>
				
                <tr>
					<td align="center" colspan="4">&nbsp;
                    	<!---Exam CSV uploader-->
                        <form action="uploadExam.php" method="post" enctype="multipart/form-data" name="form1">
                            <table width="100%">
                                <tr>
                                     <td align="right" width="35%">                     
                                         <span style="padding-right:10px;font-family: Tahoma; font-size: 11pt; color: #0000FF;font-weight: bold; ">เลือกไฟล์ CVS :</span>                    
                                     </td>
                                     <td>
                                         <input  type="file" name="fileCSV" id="fileCSV" size="60">                  
                                     </td>
                                </tr>
                                <tr>
                                    <td height="25" colspan="2"></td>
                                </tr>
                                <tr >        
                                    <td height="20" colspan="2" >
                                        <p align="center">
                                          	<input type=submit  id="uploadFile"  name="uploadFile" value="Upload" style="font-family: Tahoma; font-size: 13; color: #000000; font-weight: bold; float:center" ></span>		
                                           	<input type=reset  tabindex=15 name="clear" value="Clear" style="font-family: Tahoma; font-size: 13; color: #000000; font-weight: bold; float:center"></span>	   
                                         </p>               		  	 
                                    </td>                                            
                                </tr>
                            </table>      
                        </form>                             
                        <!----End Exam Uploader-->
                    </td>
				</tr>

				<tr>
					<td align="center" colspan="4">
                         <!---CSV Upload Table-->                    
                        <table width="100%">
                            <tr bgcolor="#514139">
                                <td width="5%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">รหัส</span></td>
                                <td width="20%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">คำถาม</span></td>    
                                <td width="15%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">คำตอบที่ 1</span></td>    
                                <td width="15%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">คำตอบที่ 2</span></td>    
                                <td width="15%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">คำตอบที่ 3</span></td>    
                                <td width="15%" align="center" bgcolor="#FF6600" >
                                    <span style="font-family: Tahoma; font-size: 9pt; color: #FFFFFF;font-weight: bold; ">คำตอบที่ 4</span></td>          
                            </tr>
                            
                            <? for($i=0;$i<count($exams);$i++){		
							 	 	  $rowStyle = ($i%2==0) ?  '#CFC2BA' : '#F0E2D9' ;
                            ?> 
                                   
                               <tr>             		    
                              <!-- รหัส -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['sbno'];  ?></span></td>
                              <!-- หลักสูตร -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['qtn'];  ?></span></td>
                               <!-- รหัส 13 หลัก -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['ans1'];  ?></span></td>
                               <!-- ยศ -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['ans2'];  ?></span></td>
                               <!-- ชื่อ -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['ans3'];  ?></span></td>
                               <!-- นามสกุล -->
                                  <td align="center" bgcolor="<?=$rowStyle;?>" height="7"><span style="font-size: 9pt" style="word-break:break-all;"><? echo $exams[$i]['ans4'];  ?></span></td>
                              </tr>    
                          
                          <?php } ?>

                        </table>
                         <!---End CSV Upload Table-->
                    </td>
				</tr>

				<tr>
					<td align="center" colspan="4">&nbsp;
                    </td>
				</tr>
                                
			  <tr>
					<td align="center" colspan="4">
					
                	</td>
				</tr>
				<tr>
					<td align="center" colspan="4"><font color="#9F777E">
					<span style="font-size: 12pt; font-weight: 700">
						พัฒนาโดย ฝ่ายอำนวยการ 6 กองบังคับการอำนวยการ กองบัญชาการศึกษา</span></font>
					</td>
				</tr>
			</table>

</div>
<?
	mysql_close($conn);
?>
</body>
</html>