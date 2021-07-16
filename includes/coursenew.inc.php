<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$courseName = $_POST['coursename'];
$courseDesc = $_POST['coursedesc'];
$teacherID = $_SESSION['teacherid'];

$courseSubtID = $_POST['hiddenIDlist'];
$arr = explode(',', $courseSubtID);



$conn->autocommit(FALSE);
$sql = $conn->prepare("INSERT INTO course (course_name, course_desc, t_fid) VALUES (?, ?, ?)");

$sql->bind_param("sss", $courseName, $courseDesc , $teacherID);
$sql->execute();

$tempGenCourseID = $conn->insert_id; //get the generated course ID


$i =1;
foreach ($arr as $value){
  $tempcoursesubid = $value;
  // echo '<pre>'; print_r($value); echo '</pre>';
  // echo "<script>alert({$value});</script>";

  $sql1 = $conn->prepare("INSERT INTO course_subtopics (course_fid, sub_fid, display_order) VALUES (?, ?, ?)");

  $sql1->bind_param("sss", $tempGenCourseID, $tempcoursesubid, $i);
  $sql1->execute();
  $i += 1;
  $conn->autocommit(true);

}
//
//
// for($i = 1; $i <=count($arr); $i++){
//   $tempcoursesubid = $arr[$i-1];
//
//   $conn->autocommit(FALSE);
//   $sql1 = $conn->prepare("INSERT INTO course_subtopics (course_fid, sub_id, display_order) VALUES (?, ?, ?)");
//   // $sql2 = $conn->prepare("INSERT INTO t_proposal (t_sub, t_years, t_brief, t_up_fid, t_url, t_fid) VALUES (?, ?, ?, ?, ?,?)");
//
//   $sql1->bind_param("sss", $tempGenCourseID, $tempcoursesubid, $i);
//   $sql1->execute();
//
//   // $last_teacher_id = $conn->insert_id; //teacher id is saved for referral in proposal
//   //
//   // $sql2->bind_param("ssssss", $subjectCombined, $years, $briefexp, $last_up_id, $weburl, $last_teacher_id);
//   // $sql2->execute();
//
//   $conn->autocommit(true);
//   // echo "<script>alert('Account created successfully!');</script>";
// }
retrieveTeacherCourse($conn, $teacherID);
// header("location: ../teacherhome.php?create=newcourse");
