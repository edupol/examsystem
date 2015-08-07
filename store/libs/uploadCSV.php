<?php date_default_timezone_set('Asia/Bangkok');
//upload Btn click and post back
if(isset($_POST['uploadFile'])){ 

	//Manage CVS File
	$fileCSV=iconv( 'TIS-620', 'UTF-8', trim($_FILES['fileCSV']['name']) );
	$dir="uploadFile/";
	echo exec("cd..");
	
	if(!file_exists($dir)){
	  echo "Cannot found $dir<br>";
	  echo "Created $dir ...<br>"; 
      mkdir($dir,0777); 
    } 
	
	$fullNameFile	=	"$dir"."$fileCSV";
	$pdo 			= 	PDOAdpter::getInstance();
	$examID 		= 	$_SESSION['vvsbid'];
	
	//check csv
	if($fileCSV!=""){

	   if(!file_exists($fullNameFile)){
	   	  @move_uploaded_file($_FILES['fileCSV']['tmp_name'],$fullNameFile); 
		  $readFileCSV = fopen($fullNameFile, "r");
		  $keepday = date("Y-m-d H:i:s");
		  //echo "Date $keepday";
	      if($readFileCSV === FALSE){
	         die("Error opening File : "."$fileCSV"); 	
	      }
	      $date = new DateTime("now");
          while (($objArr = fgetcsv($readFileCSV, 100000, ",")) !== FALSE) {		  
					
            //echo "SQL : $strSQL";
			//$strSQL .="(`sbno` ,`apid13` ,`apdate` ,`edid13` ,`eddate` ,`qtn` ,`ans1` ,`ans2` ,`ans3` ,`ans4`) ";
			//$data['apid13'] = $apid13;
			//$data['apdate'] = date('Y-m-d');

			$data['exam_subject_id'] = $_SESSION['vvsbid'];
			$data['qtn'] 	= $objArr[1];//iconv( 'UTF-8', 'TIS-620', $objArr[1]);
			$data['ans1'] 	= (($objArr[6] == "1")?"1":"0").$objArr[2];//'01'.substr(trim($objArr[2]),2);//iconv( 'UTF-8', 'TIS-620', $objArr[2]);
			$data['ans2'] 	= (($objArr[6] == "2")?"1":"0").$objArr[3];//'02'.substr(trim($objArr[3]),2);//iconv( 'UTF-8', 'TIS-620', $objArr[3]);
			$data['ans3'] 	= (($objArr[6] == "3")?"1":"0").$objArr[4];//'03'.substr(trim($objArr[4]),2);//iconv( 'UTF-8', 'TIS-620', $objArr[4]);															
			$data['ans4'] 	= (($objArr[6] == "4")?"1":"0").$objArr[5];//'04'.substr(trim($objArr[5]),2);//iconv( 'UTF-8', 'TIS-620', $objArr[5]);
			$data['answer'] = $objArr[6];
			$data['created_at'] = $date->format('Y-m-d H:i:s'); 
			$data['instructor_id'] = 456;//$_SESSION['vvid13'];

			//save row to database			
			$pdo->insert($data,'questions');
    	  }
    	  fclose($readFileCSV); 		  
		}  else { 
			echo "File already exists : $fileCSV <br>";
		}
	}else{
		echo "Cannot Open File $fileCSV"; 
	}		
	
    $sql     = "SELECT * FROM questions where exam_subject_id = " . $_SESSION['vvsbid'];
	$exams = $pdo->select($sql,null,false);

	if(isset($exams)){
		foreach($exams as $key => $val ){
			$exams[$key]['qtn'] = iconv("UTF-8","TIS-620",$val['qtn']);
			$exams[$key]['ans1'] = substr(trim( iconv("UTF-8","TIS-620",$val['ans1']) ),2);
			$exams[$key]['ans2'] = substr(trim( iconv("UTF-8","TIS-620",$val['ans2']) ),2);
			$exams[$key]['ans3'] = substr(trim( iconv("UTF-8","TIS-620",$val['ans3']) ),2);
			$exams[$key]['ans4'] = substr(trim( iconv("UTF-8","TIS-620",$val['ans4']) ),2);				
		}
	}
}

?>