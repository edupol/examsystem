<?php
	require_once('Repository/Exam.php');
	require_once('libs/Membership.php');
	require_once('Repository/ExamStore.php');

	$user_id 		= $_POST['user_id'];
	$exam_id 		= $_POST['exam_id'];

	$exam = Exam::getInstance();
	$questions = $exam->getExistingExam($exam_id);	

	$index = 1;
	$html = '';
	$tempData = array();

	if(isset($questions) && $questions != null){//validate null


		foreach($questions as $question){
			$tempData[$index]['question_id'] = $question['question_id'];
			$tempData[$index]['answer']      = $question['answer'];
			$index++;
		}
				
		
	
		$content = "<tr><td>ข้อสอบข้อที่</td><td>หมายเลขข้อสอบจากคลังข้อสอบ</td><td>เฉลย</td></tr>";
		$flag = false;
		$index = 1;
	
		foreach($tempData as $answer){
			$content .= "<tr><td>$index</td><td>".$answer['question_id']."</td> <td>".$answer['answer']."</td></tr>";
			$index++;
		}

		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=เฉลยปัญหาข้อสอบ.xls");
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		
		echo "<html>";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		echo "<body>";
		echo "<table>";
		echo $content;
		echo "</table>";
		echo "</body>";
		echo "</html>";

	}else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		$text = 'ขออภัยไม่พบข้อมูลข้อสอบในระบบฐานข้อมูล';
		Membership::getInstance()->sms($text);
		Membership::getInstance()->redirect('list_of_exams.php');	
	}//end loop of validate
?>