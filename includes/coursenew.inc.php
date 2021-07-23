<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
invalidIncludesUserAcess();


if (isset($_GET['delete'])){

  $courseExistingID = $_GET['delete'];
  $conn->autocommit(FALSE);

  $sql = $conn->prepare("DELETE FROM course WHERE course_id = ?");

  $sql->bind_param("s", $courseExistingID);
  $sql->execute();

  // $sql1 = $conn->prepare("DELETE FROM course_subtopics WHERE course_fid = ?");
  //
  // $sql1->bind_param("s", $courseExistingID);
  // $sql1->execute();
  $conn->autocommit(true);

  echo <<<GFG
      <script>
        alert("Course successfully deleted!");
        window.location.href='../teacherhome.php';
      </script>

  GFG;

}


$courseName = $_POST['coursename'];
$courseDesc = $_POST['coursedesc'];
$courseEditBoolean = $_POST['hiddenEditBoolean'];


$teacherID = $_SESSION['teacherid'];


$courseSubtID = $_POST['hiddenIDlist'];
$arr = explode(',', $courseSubtID);




if ($courseEditBoolean == 0){
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

  retrieveTeacherCourse($conn, $teacherID);
  echo <<<GFG
      <script>
        alert("{$courseName} successfully added!");
        window.location.href='../teacherhome.php';
      </script>

  GFG;

} else {
  $courseExistingID = $_POST['hiddenExistingCourseID'];
  $conn->autocommit(FALSE);

  $sql = $conn->prepare("UPDATE course SET course_name= ? ,course_desc= ? WHERE course_id = ?");

  $sql->bind_param("sss", $courseName, $courseDesc , $courseExistingID);
  $sql->execute();

  $sql1 = $conn->prepare("DELETE FROM course_subtopics WHERE course_fid = ?");

  $sql1->bind_param("s", $courseExistingID);
  $sql1->execute();
  $conn->autocommit(true);

  $conn->autocommit(FALSE);
  $i =1;
  foreach ($arr as $value){
    $tempcoursesubid = $value;
    // echo '<pre>'; print_r($value); echo '</pre>';
    // echo "<script>alert({$value});</script>";

    $sql2 = $conn->prepare("INSERT INTO course_subtopics (course_fid, sub_fid, display_order) VALUES (?, ?, ?)");

    $sql2->bind_param("sss", $courseExistingID, $tempcoursesubid, $i);
    $sql2->execute();
    $i += 1;
    $conn->autocommit(true);

  }

  retrieveTeacherCourse($conn, $teacherID);
  echo <<<GFG
      <script>
        alert("{$courseName} successfully updated!");
        window.location.href='../teacherhome.php';
      </script>

  GFG;

}


// retrieveTeacherCourse($conn, $teacherID);
echo <<<GFG
    <script>
      alert("The rat rigged the server! Please try again later.");
      window.location.href='../teacherhome.php';
    </script>

GFG;
// header("location: ../teacherhome.php?create=newcourse");
