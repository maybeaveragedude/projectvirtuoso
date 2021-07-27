<?php
  include_once 'header.php';

  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  // headlesstaillessretrieveSubjects($conn);
  if (isset($_SESSION['learnerid'])){
    retrieveLearnerCourse($conn);
  }

  retrieveGlobalCourse($conn);

  // invalidUserAcess();
?>

    <main class="page lanidng-page">
        <section class="editor" style="background: rgba(212,255,162,0.31);">
            <div class="row" style="width: 1300px;margin: auto;">
                <div class="col" style="width: 1300px;margin: auto;">
                    <h1 style="margin: auto;">Catalog Browsing</h1>
                    <div class="row">
                        <div class="col"><small><strong>Choose </strong>any <strong>Approved Course</strong> and start learning today.</small></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="editor">
            <div class="col">
                    <div class="row">
                        <div class="col-xxl-4" style="padding: 0px 0px;padding-top: 16px; width: 1300px;margin: auto;">
                            <div class="row" style="width: 1300px;margin: auto; box-shadow: 0px 2px 26px rgba(0,0,0,.1); padding: 24px 48px; border-radius: 16px;" >
                              <!-- <p>test</p> -->
                              <?php
                              $tempSUBBEDcourseID[] = "";


                              if (isset($_SESSION['learnerid'])){
                                  foreach ($_SESSION["learnerCourse"][0] as $subscribed){

                                    if (empty($subscribed)){
                                      $tempSUBBEDcourseID = "";
                                      // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                    } else {

                                      $tempSUBBEDcourseID[] = $subscribed['course_fid'];
                                      // echo '<pre>'; print_r($subscribed); echo '</pre>';


                                    }
                                  }
                            }



                              $num=0;

                              //COURSE PART
                                foreach ($_SESSION["GlobalCourse"][$num] as $display) {
                                  // echo '<pre>'; print_r($display); echo '</pre>';

                                  $tempCourseId = $display['course_id'];
                                  $tempname = $display['course_name'];
                                  $tempdesc = $display['course_desc'];
                                  $tempTFID = $display['t_fid'];
                                  $tempapproved = $display['course_status'];
                                  // $tempTID = $_SESSION["teacherid"];

                                  if ($tempapproved == 1){
                                  echo <<<GFG
                                      <div class="coursetitle" id="coursetitle{$tempCourseId}">
                                        <a class="btn btn-primary listgroupdropMain subjectList" style="font-size: 20px; margin: 14px 0px;"data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$num}" href="#collapseCourse-{$num}" role="button"><strong>{$tempname}</strong></a>
                                        <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:blue;" value="Preview" onclick="redirectViewCourse({$tempCourseId})"></input>


                                  GFG;


                                  if (isset($_SESSION['learnerid'])){
                                  // foreach ($tempSUBBEDcourseID as $key) {
                                    if (in_array($tempCourseId, $tempSUBBEDcourseID))
                                    // if ($key == $tempCourseId)
                                    // {
                                    //
                                    //   echo <<<GFG
                                    //         <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:green;" value="I WANT THIS" onclick="redirectLearnerSubscribe({$tempCourseId})"></input>
                                    //   GFG;
                                    //
                                    //
                                    // } else
                                    {

                                      echo <<<GFG

                                      <div style="float:right;margin-left:24px; display: inline-block; box-shadow: 0px 4px 26px rgba(0,60,0,.3); border-radius: 20px 20px 20px 20px; background-color: rgba(255,5,0,.3);">
                                            <span>
                                              <input class="simpleTextEdit" type="button"style="color: black;font-size: 18px; margin: 10px 0px !important; padding: 0px 24px; background-color:inherit;" value = "Opt out on course 😢" onclick="redirectRemoveSubscription({$tempCourseId})"></input>

                                            </span>
                                      </div>


                                      <div style="float:right;margin-left:24px; display: inline-block; box-shadow: 0px 4px 26px rgba(0,60,0,.3); border-radius: 20px 20px 20px 20px; background-color: rgba(222,200,0,.3);">
                                            <span>
                                              <p style="font-size: 18px; margin: 14px 0px !important; padding: 0px 60px;"> You are subscribed to this course!</p>

                                            </span>
                                      </div>



                                      GFG;
                                      // break;


                                    } else {
                                      echo <<<GFG
                                            <input class="simpleTextEdit" type="button" style="margin: 14px 0px; color:green;" value="I WANT THIS" onclick="redirectLearnerSubscribe({$tempCourseId})"></input>
                                      GFG;
                                      // break;
                                    }
                                  }


                                  // }


                                  echo <<<GFG

                                          <div class="collapse" id="collapseCourse-{$num}">

                                  GFG;
                                    //DISPLAY ORDERED SUBTOPICS
                                    $subsnum = 0;
                                    foreach ($_SESSION["GlobalCourseSubtopics"] as $coursesubsDisp){
                                      $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
                                      // $tempTopSubname = $coursesubsDisp[$subsnum];
                                      // $tempSubdesc = $coursesubsDisp[$subsnum]['sub_desc'];
                                      // $tempSubFId = $coursesubsDisp['sbjt_fid'];
                                      // $tempTopicId = $coursesubsDisp['topic_id'];
                                      // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                      if($tempCourseId == $tempinnercourse){
                                        // echo '<pre>'; print_r($coursesubsDisp); echo '</pre>';

                                        $innercount = 0;
                                        foreach ($coursesubsDisp as $count) {
                                          $tempSubname = $count['sub_name'];
                                          echo <<<GFG
                                              <div class="singleTopicRow" id="singleTopicRow{$subsnum}">
                                                <a class="btn btn-primary listgroupdropMain TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 24px; margin-top: 0px; margin-bottom: 12px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$subsnum}" href="#collapseTopic-{$subsnum}" role="button">{$tempSubname}</a>

                                          GFG;


                                          echo <<<GFG



                                                  </div>
                                          GFG;
                                          $innercount += 1;
                                        }
                                        $subsnum +=1;

                                        }

                                    }

                                 echo <<<GFG

                                          </div>
                                      </div>

                                  GFG;
                                  // <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
                                  $num += 1;
                                }
                                }


                               ?>

                            </div>
                        </div>
                    </div>
            </div>



        </section>
        <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
    </main>
    <!-- <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer> -->
    <script>
    function redirectViewCourse(tempCourseId){ //redirect to preview course
      window.location.href=`learnerdisplay.php?course=${tempCourseId}`;
    }
    function redirectLearnerSubscribe(tempCourseId){ //to allows learner to subscribe to the course
      window.location.href=`includes/subscribetocourse.inc.php?course=${tempCourseId}`;
    }
    function redirectRemoveSubscription(tempCourseId){ //to allows learner to subscribe to the course
      window.location.href=`includes/subscribetocourse.inc.php?delete=${tempCourseId}`;
    }
    </script>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/overlay.js"></script>
    <script src="assets/js/pickavatar.js"></script>
    <script src="assets/js/preventclick.js"></script>
    <script src="assets/js/Sidebar-Menu.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
