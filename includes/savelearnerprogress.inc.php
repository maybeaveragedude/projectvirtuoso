<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
invalidIncludesUserAcess();

        $tempmatProg = $_GET['matProg'];
        // $matProg =json_decode($tempmatProg, true);

        $tempquizProg = $_GET['quizProg'];
        // $quizProg =json_decode($tempquizProg, true);

        $viewCourseID = $_GET['courseID'];

        $tempPercentage= $_GET['percentage'];

        $tempQuizPercentage= $_GET['savequiz'];



        $conn->autocommit(FALSE);
        // $sql1 = $conn->prepare("DELETE FROM subtopic WHERE sub_id = ?");
        $sql1 = $conn->prepare("UPDATE learners_course SET material_progress = ?, quiz_progress = ?, total_progress = ?, quiz_scores = ? WHERE l_fid = ? AND course_fid = ?");
        if ($conn -> connect_error){
          "<script>alert('Problem connecting to database, please try again later.');</script>";
        }

        // $sql2 = $conn->prepare("INSERT INTO subtopic (sub_id, sub_name, sub_desc, t_fid, topic_fid) VALUES (?, ?, ?, ?, ?)");


        // $sql1->bind_param("s", $existingSuptopicId);
        $sql1->bind_param("ssssss", $tempmatProg, $tempquizProg, $tempPercentage, $tempQuizPercentage, $_SESSION['learnerid'], $viewCourseID);

        $sql1->execute();

        // $sql2->bind_param("sssss", $existingSubtopicId, $subtopicName, $subtopicDesc, $teacherid, $topicID);
        // $sql2->execute();

        $conn->autocommit(true);
        // headlesstaillessretrieveSubjects($conn);
        echo <<<GFG
        <script>
              alert("Progress Saved!")
              window.location.href='../learnerhome.php';
        </script>

        GFG;



?>
