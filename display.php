<?php
  include_once 'teacherheader.php';

  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  // headlesstaillessretrieveSubjects($conn);
  retrieveTeacherMaterials($conn);
  invalidUserAcess();

  if (isset($_GET['subtopic'])){
    $viewSubtopicID = $_GET['subtopic'];
  } else {
    echo <<<GFG
        <script>
          alert("The rat rigged the server! Please try again later.");
          window.location.href='teacherhome.php';
        </script>

    GFG;
  }



?>

<main class="page" >
  <div id="sidebar">
    <section class="editor" style="background: rgba(212,255,162,0.31);  padding: 16px 4px;">
        <div class="row" style="margin: auto;">
            <div class="col" style="margin: auto; ">

              <?php
              echo <<<GFG
              <script>

              function isInViewport(thiselement) {
                  const rect = thiselement.getBoundingClientRect();
                  return (
                      rect.top >= 0 &&
                      rect.left >= 0 &&
                      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                      rect.right <= (window.innerWidth || document.documentElement.clientWidth)

                  );
              }


              </script>
              GFG;

              $subtopicnum = 0; //for id
              foreach ($_SESSION["teachersubtopicsCombined"][$subtopicnum] as $subtopicDisplay){
                $tempSubtopicname = $subtopicDisplay['sub_name'];
                $tempSubtopicdesc = $subtopicDisplay['sub_desc'];
                $tempTopicFId = $subtopicDisplay['topic_fid'];
                $tempSubtopicId = $subtopicDisplay['sub_id'];
                $tempSubtopicTeacherId = $subtopicDisplay['t_fid'];

                if ($tempSubtopicId == $viewSubtopicID) {

                  echo <<<GFG
                  <h3 style="margin: auto; padding-top: 16px;padding-bottom: 12px;">Subtopic:</h3>

                  <h1 style="margin: auto;"><strong>{$tempSubtopicname}</strong></h1>
                  <div style="padding-bottom: 12px; padding-top: 12px" class="row">
                      <div class="col">
                        <small>{$tempSubtopicdesc}</small>


                  GFG;

                }

                $subtopicnum +=1;
              }
              ?>


            </div>
        </div>
    </section>

              <?php

              $matidnum = 0; //for id
              foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                $tempMatSubId = $matIDDisplay['sub_fid'];
                $tempMatFId = $matIDDisplay['mat_fid'];
                $tempQuizFId = $matIDDisplay['quiz_fid'];


                if ($viewSubtopicID == $tempMatSubId) {
                      $matnum = 0; //for id
                      foreach ($_SESSION["teacherMaterial"][$matnum] as $matDisplay){
                          $tempMatTitle = $matDisplay['mat_name'];
                          $tempMatContents = $matDisplay['mat_contents'];
                          // $tempMatVisualFile = $matDisplay['mat_file_upload_fid'];
                          // $imageSrc = getImage($conn, $tempMatVisualFile);

                          $tempMatID = $matDisplay['mat_id'];


                          if ($tempMatFId == $tempMatID){
                            $matnum +=1;
                              echo <<<GFG
                                  <a  href="#section{$tempMatTitle}">
                                      <span>
                                        <h4 id="side{$tempMatTitle}" class="matsections">{$tempMatTitle}</h4>
                                      </span>
                                  </a>


                              GFG;

                          }
                      }
                  }
                }

               ?>
                <!-- <h1 style="margin: auto;">Study Cultivation</h1> -->
                <!-- <div class="row">
                    <div class="col">
                      <small><strong>Create </strong>&amp;&nbsp;<strong>Edit</strong> Subjects, Topics and Subtopics!&nbsp;</small> -->




  </div>
  <div class ="mainWithSidebar">

    <!-- <section class="editor">
        <div class="col">

        </div>
    </section> -->

    <?php

                    $matExist = 0;

                  // if ($tempTopicId == $tempTopicFId){
                      // echo <<<GFG
                      //     <div id="mat{$tempSubtopicId}" style="display: none;">
                      //       <a class="btn btn-primary listgroupdropMain MatSubtopicList teacheridIs_{$tempSubtopicTeacherId}" style="margin-left: 0px; margin-top: 6px; margin-bottom: 6px; background-color:white; color:black;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subtopicnum}" href="#collapseMatSubtopic-{$subtopicnum}" role ="button">{$tempSubtopicname}</a>
                      //       <input type="button" class="simpleTextEdit" onclick="redirectView({$tempSubtopicId})"name="View" value="View" style="margin: 4px 0px; color:green;"></input>
                      //
                      //
                      //         <div class="collapse" id="collapseMatSubtopic-{$subtopicnum}">
                      //
                      // GFG;

                      $matidnum = 0; //for id
                      foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                        $tempMatSubId = $matIDDisplay['sub_fid'];
                        $tempMatFId = $matIDDisplay['mat_fid'];
                        $tempQuizFId = $matIDDisplay['quiz_fid'];


                        if ($viewSubtopicID == $tempMatSubId) {
                              $matnum = 0; //for id
                              foreach ($_SESSION["teacherMaterial"][$matnum] as $matDisplay){
                                  $tempMatTitle = $matDisplay['mat_name'];
                                  $tempMatContents = $matDisplay['mat_contents'];
                                  $tempMatVisualFile = $matDisplay['mat_file_upload_fid'];
                                  $imageSrc = getImage($conn, $tempMatVisualFile);

                                  $tempMatID = $matDisplay['mat_id'];


                                  if ($tempMatFId == $tempMatID){
                                    $matExist += 1;

                                      echo <<<GFG

                                      <section class="editor" id="section{$tempMatTitle}" style="padding-bottom: 0px; padding-top: 75px">

                                          <div class="col maindisplay" >
                                            <h2 style="padding: 16px 0px">{$tempMatTitle}</h2>
                                            <pre id="innersection{$tempMatTitle}" style="white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempMatContents}</pre>
                                            <div  class=" justify-content-xxl-center align-items-xxl-center" style="padding: 56px 0px; margin: auto; justify-contents:middle; text-align: center; min-height: 200px;">
                                              <img id="anothersection{$tempMatTitle}" src="{$imageSrc}" style="width: 400; height: auto; object-fit:cover;" alt=""/>
                                            </div>
                                          </div>
                                      </section>

                                      <script>

                                      var maindocElement{$matExist} = document.getElementById('innersection{$tempMatTitle}');
                                      var anotherdocElement{$matExist} = document.getElementById('anothersection{$tempMatTitle}');

                                      var repeat{$matExist} = document.getElementById('side{$tempMatTitle}');


                                      // console.log(maindocElement{$matExist});

                                      document.addEventListener('scroll', function () {



                                          if (isInViewport(maindocElement{$matExist}) || isInViewport(anotherdocElement{$matExist})){
                                            console.log(maindocElement{$matExist}.id);
                                            repeat{$matExist}.classList.add("atThisSection");
                                          } else {
                                            repeat{$matExist}.classList.remove("atThisSection");
                                          }

                                      }, {
                                          passive: true
                                      });

                                      </script>

                                      GFG;

                                      $quizI = 0;
                                      $quizCount = 0;
                                      foreach ($_SESSION["quizRepo"][$quizI] as $quizDisplay){
                                          $tempQuizQuestion = $quizDisplay['quiz_question'];
                                          $tempQuizID = $quizDisplay['quiz_id'];
                                          $tempQuizDisplayOrder = $quizDisplay['display_order'];

                                          if ($tempQuizFId == $tempQuizID){
                                            $quizCount += 1;


                                            echo <<<GFG

                                                  <section class="editor" style="padding-bottom: 0px; padding-top: 75px">

                                                      <div class="col maindisplay quizSection">
                                                      <h4 style="padding: 16px 0px">{$tempMatTitle}: Question {$quizCount}</h4>

                                                      <pre id="innerinnersection{$tempQuizID}" style="white-space: pre-wrap; font-family: var(--bs-font-sans-serif); font-size: 16px;">{$tempQuizQuestion}</pre>


                                                    <script>
                                                          var secondocElement{$tempQuizID} = document.getElementById('innerinnersection{$tempQuizID}');

                                                          var sideBarMatSections{$tempQuizID} = document.getElementById('side{$tempMatTitle}');

                                                          document.addEventListener('scroll', function () {



                                                            if (isInViewport(secondocElement{$tempQuizID})){
                                                                    sideBarMatSections{$tempQuizID}.classList.add("atThisSection");
                                                            } else {
                                                                    // sideBarMatSections{$tempQuizID}.classList.remove("atThisSection");
                                                            }

                                                            }, {
                                                                  passive: true
                                                          });


                                                        </script>

                                            GFG;

                                            $questionI = 0;
                                            $quizQuestionCount = 0;
                                            foreach ($_SESSION["quizQuestionChoices"][$questionI] as $quizQuestionDisplay){
                                                $tempQuestionLabel = $quizQuestionDisplay['choice'];
                                                $tempQuestionBool = $quizQuestionDisplay['true_false'];
                                                $tempQuestionQuizFID = $quizQuestionDisplay['quiz_fid'];

                                                if ($tempQuizID == $tempQuestionQuizFID){
                                                  $quizQuestionCount += 1;


                                                  echo <<<GFG

                                                      <div class="col" style="padding: 12px;">
                                                          <div  class="form-check">
                                                            <input class="form-check-input" type="radio" name="quiz{$tempQuizID}" id = "quiz{$tempQuizID}choice{$quizQuestionCount}">
                                                            <label class="form-check-label helloRadio" for="quiz{$tempQuizID}choice{$quizQuestionCount}">$tempQuestionLabel</label>
                                                          </div>
                                                      </div>


                                                  GFG;

                                                }
                                                $questionI += 1;
                                              }

                                              echo <<<GFG
                                                        </div>
                                                    </section>

                                              GFG;
                                          }
                                          $quizI += 1;
                                        }

                                    }
                                    $matnum +=1;

                            }
                          }
                          $matidnum +=1;

                      }

     ?>

    <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
    <!-- <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer> -->
    </div>


</main>






<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
<!-- <script src="assets/js/overlay.js"></script> -->
<script src="assets/js/pickavatar.js"></script>
<script src="assets/js/preventclick.js"></script>
<script src="assets/js/Sidebar-Menu.js"></script>
<!-- <script src="assets/js/tabs.js"></script> -->
<script src="assets/js/theme.js"></script>
</body>

</html>
