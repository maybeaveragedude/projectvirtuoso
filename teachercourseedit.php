<?php
  include_once 'teacherheader.php';
  invalidUserAcess();
  require_once 'includes/dbh.inc.php';
  require_once 'includes/functions.inc.php';

  headlesstaillessretrieveSubjects($conn);

?>
<script src="assets/js/external/jquery/jquery.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>

<main class="page lanidng-page">
    <section class="editor" style="margin-top: 93px;background: rgba(212,255,162,0.31);">
        <div class="row" style="width: 1300px;margin: auto;">
            <div class="col" style="width: 1300px;margin: auto;">
                <h1 style="margin: auto;">Course Tinkering</h1>
                <div class="row">
                    <div class="col"><small><strong>Create </strong>&amp;&nbsp;<strong>Edit</strong> Course!</small></div>
                </div>
            </div>
        </div>
    </section>
    <section class="editor">
        <div class="col">
            <form id="courseeditForm"style="padding-top: 40px;padding-bottom: 40px;" method="post" action="includes/coursenew.inc.php">
                <div class="row" style="padding-right: 80px;padding-left: 80px;">
                    <div class="col-xxl-8" style="height: 311px;padding: 0px;margin: 0px 0px;border-right-width: 1px;border-left-width: 1px;margin-bottom: 14px;padding-right: 0px;">
                      <label class="form-label middlelabel biggerlabel" style="font-size: 36px;" >Course Name</label>
                      <input id="hiddenEditBoolean" type="hidden" name="hiddenEditBoolean" value =0>

                      <?php
                      //placing existing course name

                      if(isset($_GET['editcourse'])){
                        $tempExistingCourseID = $_GET['editcourse'];
                         //if its new course mode


                        //TO BE CARRIED IN TO INC.PHP
                        echo <<<GFG
                          <input id="hiddenExistingCourseID" type="hidden" name="hiddenExistingCourseID" value ={$tempExistingCourseID}>
                          <script>
                              document.getElementById("hiddenEditBoolean").value = 1;
                              console.log(document.getElementById("hiddenEditBoolean").value);
                          </script>

                        GFG;

                              $counthere=0;
                              foreach ($_SESSION["singleTeacherCourse"][$counthere] as $display) {
                                $tempCourseId = $display['course_id'];
                                $tempname = $display['course_name'];
                                $tempdesc = $display['course_desc'];
                                $tempTFID = $display['t_fid'];

                                if($tempCourseId == $tempExistingCourseID){
                                  echo <<<GFG
                                    <input name="coursename" class="form-control" value="{$tempname}" type="text" required=""style="width: 560px;">

                                  GFG;
                                }
                                $counthere +=1;
                              }
                      } else {
                        echo <<<GFG
                          <input name="coursename" class="form-control" type="text" required=""style="width: 560px;">

                        GFG;

                      }
                        ?>
                      <!-- <input name="coursename" class="form-control" type="text" required=""style="width: 560px;"> -->
                      <label class="form-label middlelabel biggerlabel">Description</label>

                      <?php
                      //placing existing course description
                      if(isset($_GET['editcourse'])){ //if its new course mode
                        $tempExistingCourseID = $_GET['editcourse'];

                              $counthere=0;
                              foreach ($_SESSION["singleTeacherCourse"][$counthere] as $display) {
                                $tempCourseId = $display['course_id'];
                                $tempname = $display['course_name'];
                                $tempdesc = $display['course_desc'];
                                $tempTFID = $display['t_fid'];

                                if($tempCourseId == $tempExistingCourseID){
                                  echo <<<GFG
                                    <textarea name="coursedesc" class="form-control" required="" style="height: 140px;width: 716px;">{$tempdesc}</textarea>

                                  GFG;
                                }
                                $counthere +=1;
                              }
                      } else {
                        echo <<<GFG
                          <textarea name="coursedesc" class="form-control"required="" style="height: 140px;width: 716px;"></textarea>

                        GFG;

                      }

                       ?>

                      <!-- <textarea name="coursedesc" class="form-control"required="" style="height: 140px;width: 716px;"></textarea> -->
                    </div>
                    <div class="col-xxl-4" style="margin-bottom: 14px;padding: 16px;padding-top: 16px;background: #effff2;padding-right: 24px;padding-left: 24px;border-top-right-radius: 100px;border-bottom-left-radius: 100px;border-top-left-radius: 16px;border-bottom-right-radius: 16px;">
                        <h3>Basic Guidelines</h3>
                        <ul>
                            <li style="padding-top: 4px;padding-bottom: 4px;">Make sure course name clearly depicts the <strong>final learning goal</strong>.<br></li>
                            <li style="padding-top: 4px;padding-bottom: 4px;">Provide <strong>clear description</strong> to support the purpose of this course</li>
                            <li style="padding-top: 4px;padding-bottom: 4px;"><strong>Mix and Match</strong> the subtopics created by the VIRTUOSO Teach Community!</li>
                            <li style="padding-top: 4px;padding-bottom: 4px;">Arrange the subtopics in custom order.</li>
                            <li style="padding-top: 4px;padding-bottom: 4px;">Submit your course so we can validate it and <strong>publish </strong>it for the learners!</li>
                        </ul>
                    </div>
                    <div class="col-xxl-10 mx-auto" style="border-top-width: 1px;border-top-style: solid;margin: 16px;margin-top: 16px;margin-bottom: 16px;"></div>
                </div>
                <div></div>
                <div class="row justify-content-center">
                    <div id ="existingSubtopicsList" class="col-xxl-5" style="padding: 0px 40px;padding-top: 16px;border-left-width: 1px;margin-top: 14px; width: 500px;">
                        <h2>Subtopic Repository &nbsp;&nbsp;&nbsp;&nbsp;>>></h2>
                        <ul class="list-unstyled" style="margin-top: 24px;padding-top: 16px;padding-right: 36px;padding-left: 36px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                            <!-- <li class="listObjects">Item 1</li>
                            <li class="listObjects">Item 2</li>
                            <li class="listObjects">Item 3</li>
                            <li class="listObjects">Item 4</li> -->
                            <?php

                            $num=0;

                            //SUBJECT PART
                              foreach ($_SESSION["teachersubjectsCombined"][$num] as $display) {
                                $tempSubId = $display['sbjt_id'];
                                $tempname = $display['sbjt_name'];
                                $tempdesc = $display['sbjt_desc'];
                                $tempTFID = $display['t_fid'];
                                // $tempTID = $_SESSION["teacherid"];
                                echo <<<GFG
                                    <div class="singleSubjectRow" id="singleSubjectRow{$num}">
                                      <a class="btn btn-primary listgroupdropMain subjectList" style="font-size: 20px; margin-left:-12px; margin-top: 10px; margin-bottom: 8px;" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapse-{$num}" href="#collapseSub-{$num}" role="button"><strong>{$tempname}</strong></a>
                                        <div class="collapse" id="collapseSub-{$num}">

                               GFG;
                                  //TOPIC PART
                                  $topicnum = 0;
                                  foreach ($_SESSION["teachertopicsCombined"][$topicnum] as $topicDisplay){
                                    $tempTopicname = $topicDisplay['topic_name'];
                                    $tempTopicdesc = $topicDisplay['topic_desc'];
                                    $tempSubFId = $topicDisplay['sbjt_fid'];
                                    $tempTopicId = $topicDisplay['topic_id'];
                                    if ($tempSubFId == $tempSubId){
                                        echo <<<GFG
                                            <div class="singleTopicRow" id="singleTopicRow{$topicnum}">
                                              <h6 class="TopicList" style="padding-top: 0px; padding-bottom: 2px;margin-left: 14px; margin-top: 0px; margin-bottom: 6px;">{$tempTopicname}</h6>
                                                <div class="" id="collapseTopic-{$topicnum}">
                                                <ul class="list-unstyled subtopicRepo connectedSortable" style="min-height: 30px ;background-color: rgba(60,255,0,4%) ;">

                                        GFG;


                                        // SUBTOPIC PART
                                        $subtopicnum = 0; //for id
                                        foreach ($_SESSION["teachersubtopicsCombined"][$subtopicnum] as $subtopicDisplay){
                                          $tempSubtopicname = $subtopicDisplay['sub_name'];
                                          $tempSubtopicdesc = $subtopicDisplay['sub_desc'];
                                          $tempTopicFId = $subtopicDisplay['topic_fid'];
                                          $tempSubtopicId = $subtopicDisplay['sub_id'];
                                          $tempSubtopicTeacherId = $subtopicDisplay['t_fid'];
                                          if ($tempTopicId == $tempTopicFId){
                                              echo <<<GFG
                                                      <div id="subID_{$tempSubtopicId}">
                                                        <li id="{$tempSubtopicId}" class="teacheridIs_{$tempSubtopicTeacherId} listObjects " style="margin-left: 26px; width: 300px;" ><i>{$tempSubtopicname}</i></li>
                                                      </div>
                                              GFG;
                                          }
                                          $subtopicnum +=1;

                                        }
                                        if(isset($_GET['editcourse'])){
                                        $inner = 0; //for id
                                        foreach ($_SESSION["singleTeacherCourseSubtopics"][$inner] as $subtopicDisplay){
                                          $tempSubtopicname = $subtopicDisplay['sub_name'];
                                          $tempSubtopicdesc = $subtopicDisplay['sub_desc'];
                                          $tempTopicFId = $subtopicDisplay['topic_fid'];
                                          $tempSubtopicId = $subtopicDisplay['sub_id'];
                                          $tempSubtopicTeacherId = $subtopicDisplay['t_fid'];

                                          if ($tempTopicId == $tempTopicFId){
                                            // echo '<pre>'; print_r($subtopicDisplay); echo '</pre>';

                                              echo <<<GFG
                                                      <div id="subID_{$tempSubtopicId}">

                                                        <script>
                                                              document.getElementById('{$tempSubtopicId}').style.display = "none";
                                                        </script>

                                                      </div>
                                              GFG;
                                          }
                                          $inner +=1;
                                        }
                                      }


                                        echo <<<GFG

                                                        </ul>
                                                    </div>
                                                </div>

                                        GFG;
                                    }
                                    $topicnum +=1;
                                  }

                               echo <<<GFG

                                        </div>
                                    </div>
                                    <div class="singleSubjectRowLine" style="margin: 0px auto 0px 24px; width: 140px; text-align: center !important; align: center;"></div>
                                GFG;
                                $num += 1;
                              }
                            // }

                             ?>
                        </ul>
                    </div>
                    <div id ="courseSubtopicsList" class="col-xxl-6 clearStateList" style="border-left-width: 1px;border-left-style: solid;padding: 0px 40px;margin: 0px 0px;height: auto;padding-top: 16px;margin-top: 14px;">
                        <h2>Course Contents</h2>
                        <ul class="list-unstyled sortable newCourseList connectedSortable" style="min-height: 500px;margin-top: 24px;padding-top: 16px;padding-right: 40px;padding-left: 40px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                          <?php


                          $tempExistCourseListCount=0;

                          //COURSE DISPLAY SUBTOPIC PART
                          if(isset($_GET['editcourse'])){
                              foreach ($_SESSION["singleTeacherCourse"][$tempExistCourseListCount] as $display) {
                                $tempCourseId = $display['course_id'];
                                $tempname = $display['course_name'];
                                $tempdesc = $display['course_desc'];
                                $tempTFID = $display['t_fid'];
                                if ($tempCourseId == $tempExistingCourseID){

                                  //DISPLAY ORDERED SUBTOPICS
                                  $subsnum = 0;
                                  foreach ($_SESSION["singleTeacherCourseSubtopics"] as $coursesubsDisp){
                                    $tempinnercourse = $coursesubsDisp[$subsnum]['course_fid'];
                                    $tempSubname = $coursesubsDisp[$subsnum];
                                    // $tempSubdesc = $coursesubsDisp['sub_desc'];
                                    // $tempSubFId = $coursesubsDisp['sbjt_fid'];
                                    // $tempTopicId = $coursesubsDisp['topic_id'];

                                    $innercount = 0;
                                    foreach ($coursesubsDisp as $count) {

                                      $tempSubname = $count['sub_name'];
                                      $tempExistSubtopicID = $count['sub_id'];

                                            if($tempCourseId == $tempinnercourse){
                                            echo <<<GFG

                                                <li id="{$tempExistSubtopicID}" class="teacheridIs_{$tempSubtopicTeacherId} listObjects " style="margin-left: 26px; width: 300px;" ><i>{$tempSubname}</i></li>

                                            GFG;

                                            $innercount += 1;
                                            // $subsnum +=1;

                                            }
                                    }

                                        // echo <<<GFG
                                        //
                                        //     <li id="{$tempExistSubtopicID}" class="teacheridIs_{$tempSubtopicTeacherId} listObjects " style="margin-left: 26px; width: 300px;" ><i>{$tempSubname}</i></li>
                                        //
                                        // GFG;


                                  }
                                $num += 1;
                              }
                            }
                          }

                           ?>

                        </ul>
                        <button class="btn btn-primary myhover" id="submitcourse" style="margin-top: 24px; float: right; border-radius: 7px;background: #1eb53a;" onclick="showid()">Send In!</button>

                        <?php
                        if(isset($_GET['editcourse'])){
                          echo <<<GFG

                            <a id="courseEditCancel" class="simpleTextCancel" type="button" href="teacherhome.php">Cancel</a>

                          GFG;
                        } else {
                          echo <<<GFG

                            <a id="resetLists" class="simpleTextCancel" type="button">Reset</a>

                          GFG;
                        }
                         ?>
                        <!-- <a id="resetLists" class="simpleTextCancel" type="button">Reset</a> -->
                        <input id="hiddenIDlist" type="hidden" name="hiddenIDlist" value =0>



                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
    <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
</main>
<footer class="page-footer">
    <div class="container">
        <div class="links"><a href="#">Contact us</a></div>
        <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
    </div>
</footer>

    <script>
    var subcount = 0;
    var topiccount = 0;
    var totalcount = subcount + topiccount;

    window.onload = function(){
      console.log(document.getElementById("hiddenEditBoolean").value);


    }



    function setSubjectDisplay(displaySubject, displayDesc, subjectID){
        // console.log(displaySubject);
        document.getElementById("subjectname").value = displaySubject;
        document.getElementById("subjectdesc").value = displayDesc;
        document.getElementById("subjectname").readOnly = true;
        document.getElementById("subjectdesc").readOnly = true;
        document.getElementById("menuNewtopic").style.display = "block";

        subcount = 0;
        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);
        getExistingSubID(subjectID);

        var element = document.getElementById("dropmenuSubj"); //tweaking the behavior of dropdown menu
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");

        var element2 = document.getElementById("dropmenuboxSubj"); //tweaking the behavior of dropdown menu
        element2.classList.toggle("show");

        destroySubtopics();

        var elementfid = document.getElementsByClassName("dropdownTopics"); //making the topics to be dependant on the parent subjects
        // console.log(elementfid[0].className);
        for (var i = 0; i <= elementfid.length; i++) {
          // console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`subjectFIDis${subjectID}`) == true){
            // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
            elementfid[i].style.display = "block";
          }
          else{
            elementfid[i].style.display = "none";
            // console.log(elementfid[i].display);
            document.getElementById("topicname").value = "";
            document.getElementById("topicdesc").value = "";
            document.getElementById("topicname").readOnly = true;
            document.getElementById("topicdesc").readOnly = true;


          }
        }



      }
      function getExistingSubID (subjectID){
        var input = document.createElement("input");

        input.setAttribute("id", "getExistingSubID");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "getExistingSubID");

        input.setAttribute("value", subjectID);

        //append to form element that you want .
        document.getElementById("teachereditorform").appendChild(input);

        if (document.getElementById("getExistingSubID") !== null){
          document.getElementById("getExistingSubID").value = subjectID;
        }
        console.log(document.getElementById("getExistingSubID").value);


      }

      function newSubj(){
        document.getElementById("subjectname").value = "";
        document.getElementById("subjectdesc").value = "";
        document.getElementById("subjectname").readOnly = false;
        document.getElementById("subjectdesc").readOnly = false;
        document.getElementById("menuNewtopic").style.display = "block";
        destroySubtopics();

        var element = document.getElementById("dropmenuSubj");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxSubj");
        element2.classList.toggle("show");

        if (document.getElementById("getExistingSubID") !== null){
          document.getElementById("getExistingSubID").value = null;
        }
        console.log(document.getElementById("getExistingSubID"));
        subcount = 1;
        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);



        var elementfid = document.getElementsByClassName("dropdownTopics");
        // console.log(elementfid[0].className);
        // console.log("hello");
        for (var i = 0; i <= elementfid.length; i++) {

            elementfid[i].style.display = "none";
            document.getElementById("topicname").value = "";
            document.getElementById("topicdesc").value = "";
            document.getElementById("topicname").readOnly = true;
            document.getElementById("topicdesc").readOnly = true;

        }
        // var showNewTopic = document.getElementById("menuNewtopic");
        // showNewTopic.style.display = "block";
        // console.log(showNewTopic.style.display);
      }

      function setTopicDisplay(displayTopic, displayDesc, topicID){
        // console.log(displayTopic);
        // console.log(displayDesc);
        document.getElementById("topicname").value = displayTopic;
        document.getElementById("topicdesc").value = displayDesc;
        document.getElementById("topicname").readOnly = true;
        document.getElementById("topicdesc").readOnly = true;

        subcount = 0;
        topiccount = 0;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);

        getExistingTopicID(topicID);
        console.log(document.getElementById("getExistingSubID").value);
        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");

        document.getElementById("rowForExistingSubtopics").style.display = "block";
        document.getElementById("miniSelect").style.display = "none";


        var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
        // console.log(elementfid[0].className);
        for (var i = 0; i <= elementfid.length; i++) {
          // console.log(elementfid[i].className);
          if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
            // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
            elementfid[i].style.display = "block";
          }
          else{
            elementfid[i].style.display = "none";
            // console.log(elementfid[i].display);
            // document.getElementById("topicname").value = "";
            // document.getElementById("topicdesc").value = "";
            // document.getElementById("topicname").readOnly = true;
            // document.getElementById("topicdesc").readOnly = true;

          }
        }
      }

      function getExistingTopicID (topicID){
        var input = document.createElement("input");

        input.setAttribute("id", "getExistingTopicID");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "getExistingTopicID");

        input.setAttribute("value", topicID);

        //append to form element that you want .
        document.getElementById("teachereditorform").appendChild(input);

        if (document.getElementById("getExistingTopicID") !== null){
          document.getElementById("getExistingTopicID").value = topicID;
        }
        console.log(document.getElementById("getExistingTopicID"));


      }

      function newTopic(){
        document.getElementById("topicname").value = "";
        document.getElementById("topicdesc").value = "";
        document.getElementById("topicname").readOnly = false;
        document.getElementById("topicdesc").readOnly = false;

        destroySubtopics();

        topiccount = 1;
        document.getElementById("hiddenTotalCount").value = subcount+topiccount;
        console.log("count is " + document.getElementById("hiddenTotalCount").value);

        var element = document.getElementById("dropmenuTopic");
        element.setAttribute('aria-expanded', 'false');
        element.classList.toggle("show");
        var element2 = document.getElementById("dropmenuboxTopics");
        element2.classList.toggle("show");

        if (document.getElementById("getExistingTopicID") !== null){
          document.getElementById("getExistingTopicID").value = null;
        }
        console.log(document.getElementById("getExistingSubID").value);
        console.log(document.getElementById("getExistingTopicID"));



      }
      function destroySubtopics(){
        document.getElementById("rowForExistingSubtopics").style.display = "none";
        document.getElementById("miniSelect").style.display = "block";

      }

      function showid(){
        console.log(document.getElementById("hiddenIDlist"));

      }



    </script>

    <script type="text/javascript">
    var ids = '';
        $( function() {
          $(".subtopicRepo, .newCourseList").sortable({
              // scroll: true,
              placeholder: "listPlaceholder",
              cursor: "grabbing",
              connectWith: ".connectedSortable"

            }).disableSelection();

            $(".subtopicRepo, .newCourseList").sortable({
              // stop:function(){
              //     ids = '';
              //     $(".newCourseList li").each(function(){
              //       id=$(this).attr("id");
              //       // alert(id);
              //       if(ids==''){
              //         ids = id;
              //       }else{
              //         ids = ids+','+id;
              //       }
              //     })
              //     // alert(ids);
              //     $("#hiddenIDlist").val(ids);
              //   }
            });


          $(".newCourseList").droppable({
              // accept: ".listObjects",
              classes:{
                "ui-droppable-active": "ui-state-active",
                "ui-droppable-hover": "ui-state-hover"
            }
          });



              $('#resetLists').click(function(){
                location.reload();
              });

              $('#submitcourse').click(function(){
                $(".newCourseList li").each(function(){
                  id=$(this).attr("id");
                  // alert(id);
                  if(ids==''){
                    ids = id;
                  }else{
                    ids = ids+','+id;
                  }
                })
                $("#hiddenIDlist").val(ids);
                // alert($("#hiddenIDlist").val());
              });


        } );

        // $(document).ready(function() {
        //   $("#submitcourse").click(function(e){
        //     e.preventDefault();
        //       $.ajax({
        //       url: "includes/coursenew.inc.php",
        //       type: "post",
        //       data: "ids="+ids,
        //       success: function (data, textStatus) {
        //         if (data.redirect){
        //           window.location.href = data.redirect;
        //         }
        //           alert("ids="+ids);
        //         }
        //       });
        //       // location.reload();
        //       e.preventDefault();
        //
        //   });
        //
        // });
    </script>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- THIS SCRIPT IS DEPRECIATED, Changing with 1.12.1 -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/overlay.js"></script>
    <script src="assets/js/pickavatar.js"></script>
    <script src="assets/js/preventclick.js"></script>
    <script src="assets/js/Sidebar-Menu.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
