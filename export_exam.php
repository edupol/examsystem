<?php
require_once('Repository/Exam.php');
require_once('libs/Membership.php');
require_once('Repository/ExamStore.php');

$user_id 		= $_POST['user_id'];
$exam_id 		= $_POST['exam_id'];

$exam = Exam::getInstance();
$results = $exam->getExistingExam($exam_id);	

$index = 1;
$html = '';

if(isset($results) && $results != null){//validate null

	$all_questions = ExamStore::getInstance()->processExam($results);	
	$exam_code = '';

	if(isset($all_questions)){
		$exam_code  = str_pad($exam_id, 6, "0", STR_PAD_LEFT);
	}else{
		exit();
	}
	$header = "<b>ยศ ชื่อ - ชื่อสกุล (ตัวบรรจง)</b>........................................................<b>ตำแหน่ง</b>.....................................................รหัสข้อสอบ $exam_code <br>
		<b>หน่วยสอบ</b>..........................................................................<b>ลายมือชื่อ</b>.....................................................................";
	$header .= " <div style=\"margin-left:50px\"><img src=\"http://edupol.org/edu_P/systemedu/examsystem/img/instruction.png\" width=\"477\" height=\"151\"/></div><br/>";
	$header .= "<b>เลือกคำตอบที่ถูกต้องที่สุดเพียงข้อเดียว</b>";


	$footer = "<br/><div style=\"margin-left:255px;\">--------------------------------------</div>";
	$footer .= "<b><div style=\"margin-left:270px;\">กองอำนวยการออกข้อสอบ</div>";
	$footer .= "<div style=\"margin-left:230px;\">พล.ต.ต.</div>";
	$footer .= "<div style=\"margin-left:270px;\">( จักรกฤษศณ์  สิงห์ศิลารักษ์ )</div>";
	$footer .= "<div style=\"margin-left:220px;\">ประธานอนุกรรมการอำนวยการออกข้อสอบ</div></b>";

	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=ชุดปัญหาข้อสอบ.doc");
	header("Pragma: no-cache"); 

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
	echo "<body>";
	echo "<span style=\"font-size:21px;\">".$header."</span><br/>";

	$html = "";
	$index = 1;

	foreach($all_questions as $key => $question){
		
		$q 		= "<b>ข้อ ".$index ."</b> ". $question['qtn'];

		$ans1   = $question['ans1'];
		$ans2   = $question['ans2'];
		$ans3   = $question['ans3'];
		$ans4   = $question['ans4'];
					
		$html .= "$q <br/> 1. $ans1<br/>2. $ans2<br/>3. $ans3<br/>4. $ans4<br/><br/>";
		$index++;
	}

	echo stripslashes( $html );
	//echo $footer;
	echo "</body>";
	echo "</html>";

}else{
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
		$text = 'ขออภัยไม่พบข้อมูลข้อสอบในระบบฐานข้อมูล';
		Membership::getInstance()->sms($text);
		Membership::getInstance()->redirect('list_of_exams.php');	
}//end loop of validate

?>