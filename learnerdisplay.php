<?php
  include_once 'header.php';


  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';
  require_once 'includes/display.functions.inc.php';


  retrieveGlobalCourse($conn);
  // retrieveTeacherMaterials($conn);
  retrieveGlobalMaterials($conn);
  // invalidUserAcess();

  if (isset($_GET['subtopic'])){
    $viewSubtopicID = $_GET['subtopic'];
    // $temparr[] ="";

  }
   else if (isset($_GET['course'])){
    $viewCourseID = $_GET['course'];
    // $temparr[] ="";
  }
  else {
    echo <<<GFG
        <script>
          alert("The rat rigged the server! Please try again later.");
          window.location.href='teacherhome.php';
        </script>

    GFG;
  }



?>


<main class="page" >
  <?php
  if (isset($_GET['course'])){


          echo <<<GFG
          <div id="sidebarRightFloat">

          GFG;


            $num=0;

            //COURSE PART
            foreach ($_SESSION["GlobalCourse"][$num] as $display) {
              // echo '<pre>'; print_r($display); echo '</pre>';

              $tempCourseId = $display['course_id'];
              $tempname = $display['course_name'];
              $tempdesc = $display['course_desc'];
              $tempTFID = $display['t_fid'];
              // $tempTID = $_SESSION["teacherid"];

                      if ($viewCourseID == $tempCourseId){
                      echo <<<GFG

                          <h3 style="margin: auto; padding-top: 16px;padding-bottom: 12px;">Course:</h3>

                          <h1 style="padding-right: 12px; margin: auto;"><strong>{$tempname}</strong></h1>
                          <div style="padding-bottom: 12px; padding-top: 12px" class="row">
                              <div class="col">

                                <small>{$tempdesc}</small>

                              </div>
                          </div>

                     GFG;
                     }

            $num += 1;
           }

         echo <<<GFG

         </div>

         GFG;





       }




   ?>

  <div id="sidebar">
    <!-- <section class="editor" style="background: rgba(212,255,162,0.31);  padding: 16px 4px;">
        <div class="row" style="margin: auto;">
            <div class="col" style="margin: auto; "> -->

              <?php
              echo <<<GFG
              <section class="editor" style="background: rgba(212,255,162,0.31);  padding: 0px 10px;overflow: hidden;">
                  <div class="row" style="margin: auto;">
                      <div class="col" style="margin: auto; ">




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

              if (isset($_GET['course'])){

                echo <<<GFG

                <div class="gotTransition" >
                <a style="display: none;"></a>

                      <h3  style="margin: auto; padding-top: 14px;padding-bottom: 12px; ">Subtopic:</h3>
                      <h1 id="subnameContainer" style="padding-right: 12px; margin: auto;"><strong></strong></h1>
                      <div style="padding-bottom: 12px; padding-top: 12px" class="row">
                          <div class="col">
                            <p id="descContainer"></p>
                          </div>
                      </div>

                </div>


                GFG;

                $num=0;

                foreach ($_SESSION["GlobalCourseSubtopics"] as $coursesubsDisp) {
                  // echo '<pre>'; print_r($display); echo '</pre>';

                  $tempinnercourse = $coursesubsDisp[$num]['course_fid'];
                  // echo '<pre>'; print_r($display); echo '</pre>';

                  if($viewCourseID == $tempinnercourse){
                    // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                    $innercount = 0;
                    foreach ($coursesubsDisp as $count) {
                      $temparr[] = $count['sub_fid'];
                      $tempSubname = $count['sub_name'];
                      $tempDesc = $count['sub_desc'];

                      // <div class="gotTransition" id="wrapperdiv{$count['sub_fid']}">
                      // <a id="hrefSUBIDFor{$count['sub_fid']}" href="#wrapperdiv{$count['sub_fid']}" style="display: none;"></a>
                      //
                      //       <h3  style="margin: auto; padding-top: 14px;padding-bottom: 12px; ">Subtopic:</h3>
                      //       <h1 id="subname{$count['sub_fid']}" style="padding-right: 12px; margin: auto;"><strong>{$tempSubname}</strong></h1>
                      //       <div style="padding-bottom: 12px; padding-top: 12px" class="row">
                      //           <div class="col">
                      //             <small id="descContainer">{$tempDesc}</small>
                      //           </div>
                      //       </div>
                      //
                      //
                      //
                      // </div>


                      echo <<<GFG

                      <script>
                        var tempDesc{$count['sub_fid']} = "{$tempDesc}";
                        var tempSubNameDisplay{$count['sub_fid']} = "<strong>{$tempSubname}</strong>";

                        console.log(tempDesc{$count['sub_fid']});
                      </script>

                      GFG;




                      $innercount += 1;
                    }
                    $num +=1;

                    }


                }

              }

              else {

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

                            <h1 style="padding-right: 12px; margin: auto;"><strong>{$tempSubtopicname}</strong></h1>
                            <div style="padding-bottom: 12px; padding-top: 12px" class="row">
                                <div class="col">
                                  <small>{$tempSubtopicdesc}</small>

                            GFG;

                          }

                  $subtopicnum +=1;
              }
          }
              ?>


            </div>
        </div>
    </section>

              <?php

              if (isset($_GET['course'])){


                $subsnum=0;



                foreach ($_SESSION["GlobalCourseSubtopics"] as $coursesubsDisp) {

                  $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];

                  // $tempTopSubname = $coursesubsDisp[$subsnum];
                  // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                  // $tempinnerarr[] = $tempinnerSub;
                  foreach ($coursesubsDisp as $value){
                    $tempinnerSub= $value['sub_fid'];




                  if($viewCourseID == $tempinnercourse){
                    // echo '<pre>'; print_r($tempinnerSub); echo '</pre>';


                    // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';


                    $matidnum = 0; //for id
                    foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                      $tempMatSubId = $matIDDisplay['sub_fid'];
                      $tempMatFId = $matIDDisplay['mat_fid'];
                      $tempQuizFId = $matIDDisplay['quiz_fid'];
                      // echo '<pre>'; print_r($matIDDisplay); echo '</pre>';



                      if ($tempinnerSub == $tempMatSubId) {
                            $matnum = 0; //for id
                            foreach ($_SESSION["GlobalMaterial"][$matnum] as $matDisplay){
                              // echo '<pre>'; print_r($matDisplay); echo '</pre>';

                                $tempMatTitle = $matDisplay['mat_name'];
                                $tempMatContents = $matDisplay['mat_contents'];
                                // $tempMatVisualFile = $matDisplay['mat_file_upload_fid'];
                                // $imageSrc = getImage($conn, $tempMatVisualFile);

                                $tempMatID = $matDisplay['mat_id'];


                                if ($tempMatFId == $tempMatID ){
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
                            $matidnum += 1;
                        }
                      }

                  }
                }
                  // $subsnum += 1;



                }
              } else {

              $matidnum = 0; //for id
              foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                $tempMatSubId = $matIDDisplay['sub_fid'];
                $tempMatFId = $matIDDisplay['mat_fid'];
                $tempQuizFId = $matIDDisplay['quiz_fid'];


                if ($viewSubtopicID == $tempMatSubId) {

                      $matnum = 0; //for id
                      foreach ($_SESSION["GlobalMaterial"][$matnum] as $matDisplay){
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
                      // echo '<pre>'; print_r($temparr); echo '</pre>';

                  }
                }
              }

               ?>

  </div>
  <div class ="mainWithSidebar">


    <?php

                    $matExist = 0;
                    if (isset($_GET['course'])){
                    foreach ($_SESSION["GlobalCourseSubtopics"] as $coursesubsDisp) {

                          $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];

                          // $tempTopSubname = $coursesubsDisp[$subsnum];
                          // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                          // $tempinnerarr[] = $tempinnerSub;
                          foreach ($coursesubsDisp as $value){
                            $tempinnerSub= $value['sub_fid'];




                          if($viewCourseID == $tempinnercourse){
                            $innerOrderedSubArr[] = $tempinnerSub;
                            // echo '<pre>'; print_r($innerOrderedSubArr); echo '</pre>';
                          }
                        }
                      }
                    }

                      // $matidnum = 0; //for id
                      // foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                      //   $tempMatSubId = $matIDDisplay['sub_fid'];
                      //   $tempMatFId = $matIDDisplay['mat_fid'];
                      //   $tempQuizFId = $matIDDisplay['quiz_fid'];

                        if (isset($_GET['course'])){
                          $subsnum=0;

                          foreach ($innerOrderedSubArr as $tempCourseSubID)  {

                            $viewSubtopicID = $tempCourseSubID;

                                  $matidnum = 0; //for id
                                  foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                                    $tempMatSubId = $matIDDisplay['sub_fid'];
                                    $tempMatFId = $matIDDisplay['mat_fid'];
                                    $tempQuizFId = $matIDDisplay['quiz_fid'];
                                  getMaterial($conn, $viewSubtopicID, $tempMatSubId, $tempMatFId, $matExist, $tempQuizFId);
                                  }
                          }

                        } else {
                                  foreach ($_SESSION["teacherQuiz"][$matidnum] as $matIDDisplay){
                                    $tempMatSubId = $matIDDisplay['sub_fid'];
                                    $tempMatFId = $matIDDisplay['mat_fid'];
                                    $tempQuizFId = $matIDDisplay['quiz_fid'];
                                  getMaterial($conn, $viewSubtopicID, $tempMatSubId, $tempMatFId, $matExist, $tempQuizFId);
                                  }

                          $matidnum +=1;
                        }
                      // }



     ?>

    <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>

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
