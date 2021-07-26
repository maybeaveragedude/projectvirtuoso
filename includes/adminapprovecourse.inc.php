<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$adminapproveid = $_SESSION["adminid"];

if (isset($_POST["approve"])){

	$courseID = $_POST["courseID"];
	
	approveCourse($conn, $courseID, $adminapproveid);
	getCourseSubtopics($conn, $courseID, $adminapproveid);
	// echo '<pre>'; print_r($courseID); echo '</pre>';
	// echo '<pre>'; print_r($adminapproveid); echo '</pre>';
	// echo '<pre>'; print_r($_SESSION["approveCourseSubtopicID"]); echo '</pre>';
	$subID = $_SESSION["approveCourseSubtopicID"];
	foreach ($subID as $value){
		foreach ($value as $subtopicID){
			approveCourseSubtopics($conn, $subtopicID, $adminapproveid);
		}
	}
	header("Refresh:2; url=../adminhome.php?courseapprove=successful");

} else {
	header("Refresh:2; url=../adminhome.php?courseapprove=error");
}
?>