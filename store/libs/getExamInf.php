<?php
	include_once("connect.inc");	//ตารางเก็บข้อมูลชื่อเดียวกับ sbid
	$apid13=$_SESSION['vvid13'];				$edid13=$_SESSION['vvid13'];	
	$apdate=date('Y-m-j');						$eddate=date('Y-m-j');
	$rd1="01";									$rd2="02";						
	$rd3="03";									$rd4="04";
	$sbid=trim($_SESSION['vvsbid']);			$sbgid=trim($_SESSION['vvsbgid']);									
	$sblid=trim($_SESSION['vvsblid']);			$sbname=trim($_SESSION['vvsbname']);	
	$sbgname=trim($_SESSION['vvsbgname']);						
	$sblname=trim($_SESSION['vvsblname']);
	$subm="        บันทึกข้อสอบ        ";

	if(empty($sbid) || empty($sblid)|| empty($sbgid)){
		 echo "<script>window.location='index.php'</script>"; 
		 exit();
	}
	
	if(isset($_POST['subm']))
	{	$subm=trim($_POST['subm']);			
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
		{	mysql_query("insert into $sbid (apid13,apdate,qtn,ans1,ans2,ans3,ans4) values 
			('$apid13','$apdate','$qtn','$ans1','$ans2','$ans3','$ans4')") or die("".mysql_error());
		}
		 else	//แก้ไขข้อสอบ
		{	mysql_query("update $sbid set qtn='$qtn',ans1='$ans1',ans2='$ans2',ans3='$ans3',
			ans4='$ans4',edid13='$edid13',eddate='$eddate' where sbno='$sbno'");	
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
		mysql_query("delete from $sbid where sbno='$sbno'");
	}	
	$sbjdb=mysql_query("select * from $sbid order by sbno desc");
	$sbjrow=@mysql_num_rows($sbjdb); if($sbjrow==null){ $sbjrow=0; }
	if(isset($_GET['editsbno']))		//ไว้ท้ายสุดเพราะต้องการส่งค่า sbno เก่าแทนสร้างใหม่
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
		$subm="        แก้ไขข้อสอบ        ";
	}
?>	 