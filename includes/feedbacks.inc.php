<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["studentfeedback"])){
  //echo "It works";

  $learnerID = $_SESSION['learnerid'];
  $courseID = $_POST['hiddenCourseID'];
  $message = $_POST["studentMsg"];

  $conn->autocommit(FALSE);

  $sql = $conn->prepare("INSERT INTO learner_course_feedbacks (learner_fid, course_fid, message) VALUES (?, ?, ?)");

  $sql->bind_param("sss", $learnerID, $courseID, $message);
  $sql->execute();

  $conn->autocommit(true);

  echo <<<GFG
      <script>
        alert("Feedback Sent!");
        window.location.href='../learnerhome.php';
      </script>

  GFG;


} else if(isset($_GET['remove'])) {


          if (isset($_GET['teacher'])){

            $courseId = $_GET['remove'];
            $teacherID = $_SESSION['teacherid'];

            $conn->autocommit(FALSE);

            $sql = $conn->prepare("DELETE FROM teacher_course_feedbacks WHERE submit_teacher_fid = ? AND course_fid = ?");

            $sql->bind_param("ss", $teacherID, $courseId);
            $sql->execute();
            $conn->autocommit(true);

            echo <<<GFG
                <script>
                  alert("Feedback Deleted!");
                  window.location.href='../teacherhome.php';
                </script>

            GFG;

          } else if (isset($_GET['learner'])){

              $courseId = $_GET['remove'];
              $teacherID = $_SESSION['teacherid'];
              $learnerID = $_GET['learner'];
              $message = $_GET['msg'];


              $conn->autocommit(FALSE);

              $sql = $conn->prepare("DELETE FROM teacher_learner_feedbacks WHERE submit_teacher_fid = ? AND receive_learner_fid = ? AND course_fid = ? AND message = ?");

              $sql->bind_param("ssss", $teacherID, $learnerID, $courseId, $message);
              $sql->execute();
              $conn->autocommit(true);

              echo <<<GFG
                  <script>
                    alert("Feedback Reply Deleted!");
                    window.location.href='../teacherhome.php';
                  </script>

              GFG;



          } else {

            $courseId = $_GET['remove'];
            $learnerID = $_SESSION['learnerid'];

            $conn->autocommit(FALSE);

            $sql = $conn->prepare("DELETE FROM learner_course_feedbacks WHERE learner_fid = ? AND course_fid = ?");

            $sql->bind_param("ss", $learnerID, $courseId);
            $sql->execute();
            $conn->autocommit(true);

            echo <<<GFG
                <script>
                  alert("Feedback Deleted!");
                  window.location.href='../learnerhome.php';
                </script>

            GFG;
          }

} else if (isset($_POST['teacherCoursefeedback'])){

    $teacherID = $_SESSION['teacherid'];
    $courseID = $_POST['hiddenCourseID'];
    $message = $_POST["teacherMsg"];

    $conn->autocommit(FALSE);

    $sql = $conn->prepare("INSERT INTO teacher_course_feedbacks (submit_teacher_fid, course_fid, message) VALUES (?, ?, ?)");

    $sql->bind_param("sss", $teacherID, $courseID, $message);
    $sql->execute();

    $conn->autocommit(true);

    echo <<<GFG
        <script>
          alert("Feedback Sent!");
          window.location.href='../teacherhome.php';
        </script>

    GFG;

} else if (isset($_POST['teacherLearnerFeedback'])){

    $teacherID = $_SESSION['teacherid'];
    $courseID = $_POST['hiddenCourseID'];
    $learnerID = $_POST['hiddenLearnerID'];
    $message = $_POST["teacherMsg"];

    $conn->autocommit(FALSE);

    $sql = $conn->prepare("INSERT INTO teacher_learner_feedbacks (submit_teacher_fid, receive_learner_fid, course_fid, message) VALUES (?, ?, ?, ?)");

    $sql->bind_param("ssss", $teacherID, $learnerID, $courseID, $message);
    $sql->execute();

    $conn->autocommit(true);

    echo <<<GFG
        <script>
          alert("Feedback Reply Sent!");
          window.location.href='../teacherhome.php';
        </script>

    GFG;

}
else {
  invalidIncludesUserAcess();
  exit();
}
