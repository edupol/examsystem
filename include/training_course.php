<?php 
	require_once('Repository/TrainingCourse.php');
	$savedata['name'] 		= $_POST['name'];
	$savedata['short_name'] = $_POST['short_name'];
	TrainingCourse::getInstance()->saveOrUpdate($savedata,'course');
?>