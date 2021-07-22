<?php
session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$teacherid = $_SESSION["teacherid"];

if (isset($_GET['deletemat'])){
  $deleteMatID = $_GET['deletemat'];


  deleteNewMat($conn, $deleteMatID); //delete Material

  retrieveTeacherMaterials($conn);

  echo <<<GFG
      <script>
        alert("Material and related quiz successfully deleted!");
        window.location.href='../teacherhome.php';
      </script>

  GFG;

} else



if (isset($_POST["submitMat"])){

  $subjectID = $_POST["hiddenSubjectID"];
  $topicID = $_POST["hiddenTopicID"];
  $subtopicID = $_POST["hiddenSubtopicID"];
  $lazysubtopicName = $_POST["hiddenLazySubjectName"];

  $questionType = $_POST["hiddenNewlistTypes"]; //QUESION TMP ID
  $ARRquestionType = explode(',', $questionType);

  $questionTitle = $_POST["hiddenNewlistTitles"]; //QUIZ_QUESTION, DISPLAY_ORDER
  $ARRquestionTitle = json_decode($questionTitle, true);

  $questionArray = $_POST["hiddenNewlistQuestionArray"]; //CHOICE_ID, CHOICE, TRUE_FALSE, QUIZ_FID
  $ARRquestionType = json_decode($questionArray, true);


  $matTitle = $_POST["materialTitle"];
  $matContent = $_POST["materialContent"];

  $last_mat_up_id= ""; //GET THE FILE UPLOAD ID

  //for file uploads
  $targetDir = "../uploads/";
  $fileName = basename($_FILES["hiddenFileinput"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//file uploads
  if (!empty($_FILES["hiddenFileinput"]["name"])){

      // Allow certain file formats
      $allowTypes = array('jpg','png','jpeg','gif', 'wmv', 'avi', 'mov', 'mp4', 'flv');
      if(in_array($fileType, $allowTypes)){
          // Upload file to server
          if(move_uploaded_file($_FILES["hiddenFileinput"]["tmp_name"], $targetFilePath)){
              // Insert image file name into database
              $insert = $conn->query("INSERT into uploads (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
              if($insert){
                  $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                  $last_mat_up_id = $conn->insert_id; //TO GET THE UPLOAD ID
                  echo "<script>alert('$statusMsg');</script>";
              }else{
                  $statusMsg = "File upload failed, please try again.";
                  echo <<<GFG
                    <script>
                        alert('$statusMsg');
                        window.location.href='../matedit.php?error';
                    </script>
                  GFG;
                  // echo "<script>alert('$statusMsg');</script>";
                  // header("location: ../teachsignupbuffer.php?error");
                  exit();
              }
          }else{
              $statusMsg = "Sorry, there was an error uploading your file.";
              echo <<<GFG
                <script>
                    alert('$statusMsg');
                    window.location.href='../matedit.php?error';
                </script>
              GFG;
              // echo "<script>alert('$statusMsg');</script>";
              // header("location: ../teachsignupbuffer.php?error");
              exit();
          }
      }else{
          $statusMsg = 'Sorry, your uploaded file is not supported';
          echo <<<GFG
            <script>
                alert('$statusMsg');
                window.location.href='../matedit.php?error';
            </script>
          GFG;
          // echo "<script>alert('$statusMsg');</script>";
          // header("location: ../teachsignupbuffer.php?error");
          exit();
      }
  }
// for ($i=0; $i<$ARRquestionType.length; $i++){
//   $tempQid = 0;
//   $tempQdesc = "";
//   foreach ($ARRquestionType as $key) {
//     // code...
//   }
//
// }


//get the inserted Material ID
  $mat_fid =createNewMat($conn, $matTitle, $last_mat_up_id, $matContent, $teacherid);

  $i = 1;
  echo '<pre>'; print_r($ARRquestionType); echo '</pre>';


// $test = 0;
//   foreach ($ARRquestionType[$test] as $display) {
//
//     echo '<pre>'; print_r($display['bool']); echo '</pre>';
//     // echo "break\n";
//
//     // $innerPeace = 0;
//     // foreach ($display as $inner){
//     //   echo '<pre>'; print_r($inner); echo '</pre>';
//     //   // echo "break\n";
//     //
//     // //   $innerPeace += 1;
//     // }
//     // $true_false = $display['bool'];
//     // $choice = $display['option'];
//
//     // createQuizChoices($conn, $choice, $true_false, $quiz_fid);
//     // $test += 1;
//   }



  $quiz_fid="";
  $test =0;
      // echo '<pre>'; print_r("Question is ".$ARRquestionTitle); echo '</pre>';

  //Loop through the number of question groups,
  //loop through the options and insert into DB
  foreach ($ARRquestionTitle as $key) {
    $quiz_fid = createNewQuiz($conn, $key, $i);


    echo '<pre>'; print_r("Question is ".$key); echo '</pre>';

    foreach ($ARRquestionType[$test] as $display) {

      echo '<pre>'; print_r($display['option']); echo '</pre>';
      echo '<pre>'; print_r($display['bool']); echo '</pre>';

      $choice = $display['option'];
      $true_false = $display['bool'];


      //loop through the options and insert into DB
      createQuizChoices($conn, $choice, $true_false, $quiz_fid);
    }
    echo 'Break';

    $test += 1;

    $i += 1;
  }

//group everything in subtopic_materials table
  groupInSubtopics_Materials($conn, $quiz_fid, $subtopicID, $mat_fid);
  retrieveTeacherMaterials($conn);

  echo <<<GFG
      <script>
        alert("New material and quiz successfully added into {$lazysubtopicName}");
        window.location.href='../teacherhome.php';
      </script>

  GFG;

  exit();

  // createQuizChoices($conn, $choice, $true_false, $quiz_fid);

  // createNewQuiz($conn, $questionTitle, $display_order);



}
else {
  loggedInInvalidIncludesUserAcess();
  exit();
}
