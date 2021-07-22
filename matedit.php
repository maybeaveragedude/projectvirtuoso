<?php
include_once 'teacherheader.php';
invalidUserAcess();

if(isset($_GET['subtopic'])){
  $preselectSubtopic = $_GET['subtopic'];
}

 ?>
 <script src="assets/js/external/jquery/jquery.js"></script>
 <script src="assets/js/jquery-ui.js"></script>
 <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>

    <main class="page lanidng-page">
      <!-- FOR HIDDEN GUIDELINE -->
        <div id="overlay" class="overlay">
            <div id="guidelinebox" class="guidelinebox">
                <h1 style="height: 12px; margin-bottom: -14px;"><strong>Basic Guidelines</strong></h1>
                <ul style="font-size: 20px;">
                    <li style="">Select <i>Subject > Topic > Subtopic </i> for your <strong>material entry</strong>.</li>
                    <li style="">Provide <strong>clear name & contents</strong>to provide clarity to the leaerners.</li>
                    <li style=""><strong>Upload</strong> an image or a video to increase the depth of the material.</li>
                    <li style="">Drag and Drop you desired quiz types into the <strong>Quiz Wizard</strong>.</li>
                    <li style="">Put a suitable title for your <strong>question</strong>!</li>
                    <li style="">Provide the <strong>exact number </strong>of possible answers based on the quiz type.</li>
                    <li style="">Choose the <strong>options</strong> that has the correct answer.</li>
                </ul>
            </div>
        </div>
        <section class="editor" style="margin-top: 93px; background: rgba(203,162,255,0.31);">
            <div class="row" style="width: 1300px;margin: auto;">
                <div class="col" style="width: 1300px;margin: auto;">
                    <h1 style="margin: auto;">Materializing Materials</h1>
                    <div class="row">
                        <div class="col"><small><strong>Create </strong>&amp;&nbsp;<strong>Edit</strong>&nbsp;materials for your subtopics!</small></div>
                    </div>
                </div>
                <div class="col d-xxl-flex justify-content-xxl-end align-items-xxl-center"><a class="d-xxl-flex justify-content-xxl-end" style="font-size: 40px;font-family: Lato, sans-serif;font-style: italic;" onclick="on()">Guideline</a></div>
            </div>
        </section>
        <section class="d-xxl-flex justify-content-xxl-center mateditor" style="margin: auto;">
            <div class="col-xxl-12 text-start d-xxl-flex justify-content-xxl-center" style="max-width: 3000px;text-align: left;">
                <form id="teachereditorform" method="post"action="includes/newmat.inc.php" enctype="multipart/form-data" style = "padding-top: 40px;padding-bottom: 40px; min-height: inherit; width: inherit;margin: 0px;">
                    <div class="row" style="padding-right: 40px;padding-left: 40px;height: auto;padding-bottom: 40px;">
                        <div id="subtopicselection" class="col-xxl-3">
                          <?php
                          if(isset($_GET['subtopic'])){ //edit mode
                            $tempExistingSubtopicID = $_GET['subtopic'];
                            //replacing buttons with perma title

                            echo <<<GFG

                              <div class="dropdown">
                              <h4 class="" style="margin: 8px 0px; padding: 6px 16px;">Subject</h4>
                                  <div class="dropdown-menu" id="dropmenuboxSubj" >

                            GFG;

                          } else {

                            echo <<<GFG
                              <div class="dropdown"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuSubj" aria-expanded="false" data-bs-toggle="dropdown" type="button">Subjects</button>
                                  <div class="dropdown-menu" id="dropmenuboxSubj" >

                            GFG;

                              $num = 0;
                              foreach ($_SESSION["teachersubjectsCombined"][$num] as $display) {
                                $tempname = $display['sbjt_name'];
                                $tempdesc = $display['sbjt_desc'];
                                $tempSubId = $display['sbjt_id'];
                                echo <<<GFG
                                  <input type='button' class='dropdown-item' id='subject{$num}' onclick="setSubjectDisplay('{$tempname}', '{$tempdesc}', {$tempSubId})" value = '{$tempname}'>

                                GFG;
                                $num += 1;

                            }
                          }
                          // echo "<input type='button' class='dropdown-item' id='menuNewsubject' onclick=\"newSubj()\" value = ' ➕ New Subject'>";


                           ?>
                         </div>
                     </div>
                     <?php
                     if(isset($_GET['subtopic'])){
                       $tempExistingSubtopicID = $_GET['subtopic'];

                       echo <<<GFG

                         <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" required="" readonly="">
                         <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" required="" readonly=""></textarea>

                       GFG;

                     }else{
                       echo <<<GFG

                         <input class="form-control sidetitles" type="text" id="subjectname" name="subjectname" placeholder="Subject Title" required="" readonly="">
                         <textarea class="form-control sidetitles" id="subjectdesc" name="subjectdesc" placeholder="Description" required="" readonly=""></textarea>

                       GFG;

                     }
                      ?>
                      <?php
                      if(isset($_GET['subtopic'])){
                        $tempExistingSubtopicID = $_GET['subtopic'];

                        echo <<<GFG
                            <input id="hiddenExistingSubtopicID" type="hidden" name="hiddenExistingSubtopicID" value ={$tempExistingSubtopicID}>
                        GFG;


                        echo <<<GFG
                          <div class="dropdown">
                          <h4 class="" style="margin: 8px 0px; padding: 6px 16px;">Topic</h4>
                              <div class="dropdown-menu" id="dropmenuboxSubj" >

                        GFG;

                      } else {

                        echo <<<GFG
                          <div class="dropdown" style="border-top-width: 0px;"><button class="btn btn-primary dropdown-toggle listgroupdropMain sidetitlesMain" id="dropmenuTopic" aria-expanded="false" data-bs-toggle="dropdown" type="button">Topics</button>
                            <div class="dropdown-menu" id="dropmenuboxTopics">

                        GFG;



                      $num = 0;
                      foreach ($_SESSION["teachertopicsCombined"][$num] as $display) {
                        $tempname = $display['topic_name'];
                        $tempdesc = $display['topic_desc'];
                        $tempSubFId = $display['sbjt_fid'];
                        $tempTopicId = $display['topic_id'];
                        echo <<<GFG
                          <input type='button' class='dropdown-item dropdownTopics subjectFIDis{$tempSubFId}' id='topic{$num}' style='display:none;' onclick="setTopicDisplay('{$tempname}', '{$tempdesc}', '{$tempTopicId}')" value = '{$tempname}'>
                        GFG;

                        $num += 1;
                      }
                    }
                      echo "<input type='hidden' class='dropdown-item dropdownNewTopic' id='menuNewtopic' style='display:none;' onclick=\"newTopic()\" value = ' ➕ New Topic'>";

                       ?>
                    </div>
                  </div>
                          <input class="form-control sidetitles" type="text" required="" readonly="" id="topicname" name="topicname" placeholder="Topic Title">
                          <textarea class="form-control sidetitles" required="" readonly="" id="topicdesc" name="topicdesc" placeholder="Description"></textarea>
                          <input type='button' class='dropdown-item' disabled = "" style="text-decoration:underline" value = 'Existing Subtopics'>
                          <input id = "miniSelect" type='button' class='dropdown-item' style="padding-bottom: 8px; font-size: 14px; font-style:italic;" disabled = "" value = 'Select a subject and a topic first'>
                          <div id = "rowForExistingSubtopics">

                                  <?php


                                  $num = 0;
                                  foreach ($_SESSION["teachersubtopicsCombined"][$num] as $display) {
                                    $tempname = $display['sub_name'];
                                    $tempdesc = $display['sub_desc'];
                                    $tempSubtopicId = $display['sub_id'];
                                    $tempTopicFId = $display['topic_fid'];
                                    echo <<<GFG
                                      <input type='button' class='blankbutton dropdown-item dropdownSubtopics topicFIDis{$tempTopicFId}' id='subtopic{$tempSubtopicId}' onclick='highlightSubtopic(`$tempSubtopicId`, `$tempname`)' style='display:none; margin-left: 6px;'  value = '{$tempname}'>
                                    GFG;

                                    $num += 1;


                                  }


                                   ?>
                                 </div>

                        </div>
                        <div class="col-xxl-9 offset-xxl-2" style="padding: 0px 20px;margin: 0px 0px;border-right-width: 1px;border-left-width: 1px;margin-bottom: 14px;padding-right: 0px;">
                          <label class="form-label middlelabel biggerlabel" style="font-size: 36px;">Material Name</label>
                          <input class="form-control" required="" id="materialTitle" name="materialTitle" type="text" style="width: 560px;">
                          <label class="form-label middlelabel biggerlabel">Contents</label>
                          <textarea class="form-control" required="" id="materialContent" name="materialContent" style="height: 315px;width: 100%;"></textarea>
                        </div>
                    </div>
                    <div class="row" style="width: 1200px;margin: auto;border-top-width: 1px;border-top-style: solid;"></div>
                    <div></div>
                    <div class="row">

                        <div class="col d-xxl-flex align-items-xxl-center" style="text-align: center;min-height: 100px;max-height: 700px;">
                            <div class="text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center" style="margin: auto; max-height: 700px;width: 1200px;">

                                <label id="materialUpload" for="hiddenFileinput" class="text-center d-xxl-flex align-items-xxl-center" style=" justify-content: center; width: 700px;min-width: 100px;font-size: 24px; padding: 30px">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-plus" style="font-size: 50px;margin: 0px 12px;">
                                      <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
                                  </svg>Upload an Image or Video file</label>

                                <div>
                                  <img id="imagepreviewpane" style="padding: 20px 40px; display: none; float: right;" src="assets/img/1x1-00000000.png" alt="Placeholder">
                                </div>
                                <div>
                                  <video id="videopreviewpane" style="padding: 20px 40px; display: none; float: right;" width="580" height="360" controls>
                                    <source src="" type="video">
                                  </video>
                                </div>

                            </div>
                            <input id="hiddenFileinput" name="hiddenFileinput" type="file" onchange="uploadPreview(this)"style="margin: -160px;visibility: hidden;"></input>

                        </div>

                    </div>
                    <div class="row" style="width: 1200px;margin: auto;border-top-width: 1px;border-top-style: solid;"></div>
                    <div class="row justify-content-center" style="padding-top: 40px;">
                        <div class="col-xxl-4" style="padding: 0px 40px;padding-top: 16px;border-right-style: solid; border-right-width: 1px;margin-top: 14px;">
                            <h2>Quiz Types</h2>
                            <ul class="list-unstyled sortable quizrepo connectedSortable" style="margin-top: 24px;padding-top: 24px;padding-right: 40px;padding-left: 40px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                                <li title="four" class="matlistObjects">
                                  <div style="border-width: 1px;border-style: solid;padding: 12px;">
                                        <h5 style="margin-top: 0px;">Four-Opts</h5>
                                        <textarea class="form-control "  id="questiontitle" name="questiontitle" placeholder="Question"></textarea>
                                        <div class="row">
                                            <div class="col" style="padding: 12px;">
                                                <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="fourOpt" id="formCheck-" >
                                                  <label class="form-check-label helloRadio" for="formCheck-">Option 1</label>
                                                  <input class="questionChoice form-control" name="fourOptText"  type="text">
                                                </div>
                                                <!-- <input class="form-control" name="fourOptText" required="" type="text"> -->
                                            </div>
                                            <div class="col" style="padding: 12px;">
                                                <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="fourOpt" id="formCheck-">
                                                  <label class="form-check-label helloRadio" for="formCheck-">Option 2</label>
                                                  <input class="questionChoice form-control" name="fourOptText"  type="text">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col" style="padding: 12px;">
                                                <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="fourOpt" id="formCheck-">
                                                  <label class="form-check-label helloRadio" for="formCheck-">Option 3</label>
                                                  <input class="questionChoice form-control" name="fourOptText" type="text">

                                                </div>
                                            </div>
                                            <div class="col" style="padding: 12px;">
                                                <div class="form-check">
                                                  <input class="form-check-input" type="radio" name="fourOpt" id="formCheck-">
                                                  <label class="form-check-label helloRadio" for="formCheck-">Option 4</label>
                                                  <input class="questionChoice form-control" name="fourOptText" type="text">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </li>
                                <li title="two" class="matlistObjects">
                                  <div style="border-width: 1px;border-style: solid;padding: 12px;">
                                          <h5 style="margin-top: 0px;">True-False</h5>
                                          <textarea class="form-control " id="questiontitle" name="questiontitle" placeholder="Question"></textarea>
                                          <div class="row">
                                              <div class="col" style="padding: 12px;">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="twoOpt" id="formCheck-">
                                                    <label class="form-check-label helloRadio" for="formCheck-">Option 1</label>
                                                    <input class="questionChoice form-control" name="twoOptText" type="text">

                                                  </div>
                                              </div>
                                              <div class="col" style="padding: 12px;">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="twoOpt" id="formCheck-">
                                                    <label class="form-check-label helloRadio" for="formCheck-">Option 2</label>
                                                    <input class="questionChoice form-control" name="twoOptText" type="text" >

                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                </li>
                                <!-- <li class="matlistObjects"></li>
                                <li class="matlistObjects"></li> -->
                            </ul>
                            <ul class="list-unstyled sortable trashcan connectedSortable" style="vertical-align: middle; height: 400px;margin-top: 24px;padding-top: 16px;padding-right: 40px;padding-left: 40px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                              <div style="padding:160px 0px; text-align: center;"><h4>Dispose Here!</h4></div>

                            </ul>
                        </div>
                        <div class="col-xxl-7" style="padding: 0px 40px;margin: 0px 0px;min-height: 900px;padding-top: 16px;margin-top: 14px;">

                            <h2>Quiz Wizard</h2>

                            <ul id="newquizlist" class="list-unstyled sortable newquizlist canBeTrashed connectedSortable" style="min-height: 400px; margin-top: 24px;padding-top: 24px;padding-right: 40px;padding-left: 40px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                                <!-- <li class="matlistObjects">Item 1</li>
                                <li class="matlistObjects">Item 2</li>
                                <li class="matlistObjects">Item 3</li>
                                <li class="matlistObjects">Item 4</li> -->
                            </ul>
                            <div id="specialTrashCan" style="display:none;">
                              <ul class="list-unstyled sortable trashcan connectedSortable" style="vertical-align: middle; height: 200px;margin-top: 24px;padding-top: 16px;padding-right: 40px;padding-left: 40px;border-width: 1px;border-style: solid;padding-bottom: 16px;">
                                <div style="padding:80px 0px; text-align: center;"><h4>Dispose Here!</h4></div>

                              </ul>
                            </div>
                            <input type="submit" class="btn btn-primary myhover" id="submitMat" name="submitMat" onclick="return showid()"style="margin-top: 24px; float: right; border-radius: 7px;background: #1eb53a;"></input>
                            <a id="resetLists" class="simpleTextCancel" type="button">Reset</a>


                        </div>

                    </div>
                    <input id="hiddenSubjectID" type="hidden" name="hiddenSubjectID" value ="">
                    <input id="hiddenTopicID" type="hidden" name="hiddenTopicID" value ="">
                    <input id="hiddenSubtopicID" type="hidden" name="hiddenSubtopicID" value ="">
                    <input id="hiddenLazySubjectName" type="hidden" name="hiddenLazySubjectName" value ="">
                    <input id="hiddenNewlistTypes" type="hidden" name="hiddenNewlistTypes" value ="">
                    <input id="hiddenNewlistQuestionArray" type="hidden" name="hiddenNewlistQuestionArray" value ="">
                    <input id="hiddenNewlistTitles" type="hidden" name="hiddenNewlistTitles" value ="">
                    <input id="hiddenTotalCount" type="hidden" name="hiddenTotalCount" value =0>



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

    <script type="text/javascript">
    var checkstats ='';
    var questions = '';
    // var testarray[] = '';

    // var titles = '';
    var ids = '';
    var c = 0;
    var lc = 0;
    var tc = 0;
    var qc = 0;
    var tempI = 1;
    var existQuizI = 0;
    var newItem = Object();
        $( function() {

          $(".newquizlist").sortable({
              // scroll: true,
              // scrollSensitivity: 400 ,

              placeholder: "biggerlistPlaceholder",
              cursor: "grabbing",
              connectWith: ".connectedSortable",
              start:function(){
                $('#specialTrashCan').css("display", "block");
              },
              stop:function(){
                $('#specialTrashCan').css("display", "none");
              },
              receive: function (event, ui) {

                    //TITLE: each will be given

                    $(newItem).find("textarea").each(function () {
                      $(this).attr("name", $(this).attr("name") + (qc+1));
                      $(this).attr("required", "");
                      existQuizI += 1;
                      qc += 1;
                    });


                        //OPTIONS: each will be gievn a specific label, id and name

                        $(newItem).find("label").each(function () {
                            $(this).attr("for", $(this).attr("for") + lc);
                            lc +=1;

                        });

                        $(newItem).find("input:radio").each(function () {
                          $(this).attr("name", $(this).attr("name") + c);
                          $(this).attr("required", "");

                        });


                        $(newItem).find("input:radio").each(function () {
                            $(this).attr("id", $(this).attr("id") + c);
                            $(this).addClass(`radForQ${qc}`);

                            c +=1;
                        });

                        $(newItem).find("input:text").each(function () {
                            $(this).attr("name", $(this).attr("name") + tc);
                            $(this).addClass(`textForQ${qc}`);
                            $(this).attr("required", "");

                            tc +=1;
                        });
                        console.log(qc);



                    //alert($(newItem).html());
                },
                beforeStop: function (event, ui) {
                    newItem = ui.item;
                }

            }).disableSelection();

          $(".quizrepo li").draggable({
              scroll: true,
              scrollSensitivity: 50,
              scrollSpeed: 50,
              connectToSortable: ".newquizlist",
              helper: "clone",


            }).disableSelection();

          $(".newquizlist").droppable({
              // accept: ".matlistObjects",
              classes:{
                "ui-droppable-active": "ui-state-active",
                "ui-droppable-hover": "ui-state-active"
              },

          });

          $(".trashcan").droppable({
              accept: ".canBeTrashed li",
              classes:{
                "ui-droppable-active": "trashcanDrop",
                "ui-droppable-hover": "trashcanDropStrong"
              },
              drop: function(event, ui){
                ui.draggable.remove();
                $('#specialTrashCan').css("display", "none");
                // qc = qc -1;
                existQuizI -= 1;
              }
          });



              $('#resetLists').click(function(){
                location.reload();
              });

              $('#submitMat').click(function(){

                // $(".matlistObjects textarea").each(function(){
                //   id=$(this).attr("name");
                //   tempI += 1;
                //
                // $(".newquizlist li").each(function(){
                //   id=$(this).attr("title");
                //   tempI += 1;



                // $("#hiddenNewlist").val("");
                id ="";
                ids ="";
                titles = [];
                tempI = 0;
                $(".newquizlist .matlistObjects textarea").each(function(){
                  tempidcheck = $(this).attr("name");
                  id = tempidcheck.slice(13,14);
                  tempI += 1;

                  // alert(id);
                  var innerc = 0;
                  if(ids=='' && tempidcheck !== "questiontitle"){
                    ids = id;
                    $(".newquizlist .matlistObjects textarea").each(function(){
                      title= $(this).val();
                      if (title == "") {
                        alert("Check for any empty quiz question fields.")
                      }
                      // if(titles==''){
                      //   titles = title;
                      // }else{
                      //   titles = titles + ', ' + title;
                      // }
                      titles.push(title);
                    });
                    // $(".form-check .questionChoice").each(function(){
                    //   question= $(this).val();
                    //   alert(questions);
                    //   if(questions==''){
                    //     questions = question;
                    //   }else{
                    //     questions = questions + ', ' + question;
                    //   }
                    // });

                  }else{
                    ids = ids+','+id;
                  }

                })
                // biggerarray =[];
                mainarray = [];
                // console.log("THIS IS " + ids.split(",").length);

                // arr = explode(',',ids);
                // console.log(arr);
                emptyfieldscount = 0;

                $(".newquizlist .matlistObjects textarea").each(function(){
                  tempidcheck = $(this).attr("name");
                  id = tempidcheck.slice(13,14);
                  console.log(id);
                  // questiontitle

                // }

                // for (i=0; i< ids.split(",").length; i++){


                  // id ="";
                  // ids ="";
                  // tempI = 0;

                  //GET EVERY TEXT VALUES OF EACH Qs
                  subarray = [];



                  var thiselement = document.getElementsByClassName(`textForQ${id}`);
                  var thisrad = document.getElementsByClassName(`radForQ${id}`);


                  for (thisI=0; thisI<thiselement.length; thisI++){
                    tempvalue = thiselement[thisI].value;
                    if (tempvalue == ""){
                      emptyfieldscount += 1;
                    }
                    if (thisrad[thisI].checked == true){
                      // subarray.push("true");
                      tempvalue = thiselement[thisI].value;


                      var tempobj = {"bool" : "1",
                                      "option" : tempvalue}
                      subarray.push(tempobj);



                    } else {
                      // subarray.push("false");
                      tempvalue = thiselement[thisI].value;
                      var tempobj = {"bool" : "0",
                                      "option" : tempvalue}
                      subarray.push(tempobj);

                    }

                    // anotherarray=thisvalue[i];
                  }
                  if (emptyfieldscount !== 0) {
                    alert(`Empty field: ${emptyfieldscount}\nPlease don't leave the options field empty, input "nil" or similar phrase for intended empty fields`)
                  }
                  mainarray.push(subarray);
                  // biggerarray.push(mainarray);

                // }


              })
                console.table(mainarray);
                mainarray = JSON.stringify(mainarray);
                console.log(mainarray);
                titles = JSON.stringify(titles);


                $("#hiddenNewlistTypes").val(ids); //Question number
                $("#hiddenNewlistTitles").val(titles);
                $("#hiddenNewlistQuestionArray").val(mainarray);


                // alert(ids);
                // alert(titles);
                console.log(ids);
                console.log(titles);
              });

              // $('#materialUpload').click(function(){
              //   $('#hiddenFileinput').trigger('click');
              // });


        } );



    </script>


    <script>
    var subtopicChosen ="";
    function showid(){
      console.log(document.getElementById("hiddenNewlistTypes"));

      console.log(document.getElementById("hiddenNewlistTitles"));

      console.log(document.getElementById("hiddenNewlistQuestionArray"));
      // document.getElementById("hiddenNewlistTypes").value

      if ( existQuizI == 0){
        var thisprompt = confirm("Are you sure you want to proceed with 0 quiz question?");
        if (thisprompt == true){
          return true;
          // window.location.href='../teacherhome.php';

        } else {
          return false;

        }
      } else if (subtopicChosen == ""){
        alert("Please choose an existing subtopic before proceeding.");
        // if (thisprompt == true){
        //   return true;
        // } else {
        //   return false;
        // }

      } else if (document.getElementById("hiddenFileinput").files.length == 0){
        var thisprompt = confirm("Are you sure you want to proceed with no supporting image or video?");
        if (thisprompt == true){
          return true;
          // window.location.href='../teacherhome.php';

        } else {
          return false;

        }
      }
      // console.log(document.getElementById("aValidIDforTWO"));
    }



    var subtopicEle = document.getElementsByClassName("dropdownSubtopics");

    function highlightSubtopic(subtopicID, lazyname){
      subtopicChosen = lazyname;
      document.getElementById("hiddenSubtopicID").value = subtopicID;
      document.getElementById("hiddenLazySubjectName").value = lazyname;
      console.log(document.getElementById("hiddenLazySubjectName").value);
      console.log("Subt ID is " + document.getElementById("hiddenSubtopicID").value);

      for (var i = 0; i <= subtopicEle.length; i++) {
        subtopicEle[i].classList.remove("highlightThis");
        var tempID = subtopicEle[i].id;
        // console.log("subtopic"+subtopicID);

        if (tempID === "subtopic"+subtopicID){
          // console.log(subtopicEle[i].id);
          subtopicEle[i].classList.toggle("highlightThis");
        }

      }

    }

    function uploadPreview(matupload){
        var imgext = ['jpg', 'jpeg', 'png', 'gif'];
        var vidext = ['wmv', 'avi', 'mov', 'mp4', 'flv'];
        var userupload = $("input[type=file]").get(0).files[0];
        // var temp = `"${userupload}"`;
        //
        // return temp.split('.').pop();
        // console.log(matupload);
        if (matupload.files && matupload.files[0]) {
            var extension = matupload.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                isImageSuccess = imgext.indexOf(extension) > -1,  //is extension in acceptable types
                isVideoSuccess = vidext.indexOf(extension) > -1;

                if(isImageSuccess){
                    var reader = new FileReader();

                    reader.onload = function(){
                        $("#imagepreviewpane").css("display", "block");
                        $("#imagepreviewpane").attr("src", reader.result);
                        $("#videopreviewpane").css("display", "none");
                        $("#videopreviewpane").attr("src", "");
                        $("#materialUpload").text("Change File ↻ ");
                    }
                    reader.readAsDataURL(userupload);

                } else if (isVideoSuccess) {
                    var reader = new FileReader();

                    reader.onload = function(){
                        $("#videopreviewpane").css("display", "block");
                        $("#videopreviewpane").attr("src", reader.result);
                        $("#imagepreviewpane").css("display", "none");
                        $("#imagepreviewpane").attr("src", "");
                    }
                    reader.readAsDataURL(userupload);

                } else {
                  alert(`Uploaded file type is not supported!\n\nSupported image file types: ${imgext}\nSupported video file types: ${vidext}`);
                }
            //
            // if (isSuccess) { //yes
            //     var reader = new FileReader();
            //     reader.onload = function (e) {
            //         alert('image has read completely!');
            //     }
            //
            //     reader.readAsDataURL(input.files[0]);
            // }
            // else { //no
            //     //warning
            // }
        }



    }

    function systemSetTopicDisplay(displayTopic, displayDesc, topicID, subtopicId){
      // console.log(displayTopic);
      // console.log(displayDesc);
      document.getElementById("topicname").value = displayTopic;
      document.getElementById("topicdesc").value = displayDesc;
      document.getElementById("topicname").readOnly = true;
      document.getElementById("topicdesc").readOnly = true;

      subcount = 0;
      topiccount = 0;
      document.getElementById("hiddenTotalCount").value = 3; //for CASE SELECTION IN PHP
      console.log("count is " + document.getElementById("hiddenTotalCount").value);

      getExistingTopicID(topicID);
      console.log(document.getElementById("getExistingSubID").value);
      // var element = document.getElementById("dropmenuTopic");
      // element.setAttribute('aria-expanded', 'false');
      // element.classList.toggle("show");
      // var element2 = document.getElementById("dropmenuboxTopics");
      // element2.classList.toggle("show");

      document.getElementById("rowForExistingSubtopics").style.display = "block";
      document.getElementById("miniSelect").style.display = "none";



      //
      //
      var elementfid = document.getElementsByClassName("dropdownSubtopics"); //making the subtopics to be dependant on the parent topics
      // console.log(elementfid[0].className);
      for (var i = 0; i <= elementfid.length; i++) {
        // console.log(elementfid[i].className);
        if (elementfid[i].classList.contains(`topicFIDis${topicID}`) == true){
          // console.log(elementfid[i].classList.contains(`subjectFIDis${subjectID}`));
          elementfid[i].style.display = "block";
          if (elementfid[i].id == subtopicId){
            elementfid[i].classList.add("highlightThis");
          }

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
    <script src="assets/js/editor.js"></script>
</body>

</html>

<?php
if(isset($_GET['subtopic'])){
  $tempExistingSubtopicID = $_GET['subtopic'];

  $num = 0;
  foreach ($_SESSION["teachersubjectsCombined"][$num] as $subdisplay) {
    $tempSubname = $subdisplay['sbjt_name'];
    $tempSubdesc = $subdisplay['sbjt_desc'];
    $tempSubId = $subdisplay['sbjt_id'];

    $num += 1;

    $topicnum = 0;
    foreach ($_SESSION["teachertopicsCombined"][$topicnum] as $topicdisplay) {
      $tempTopicname = $topicdisplay['topic_name'];
      $tempTopicdesc = $topicdisplay['topic_desc'];
      $tempSubFId = $topicdisplay['sbjt_fid'];
      $tempTopicId = $topicdisplay['topic_id'];

      $topicnum += 1;

      $subtnum = 0;
      foreach ($_SESSION["teachersubtopicsCombined"][$subtnum] as $subtopicdisplay) {
        $tempSubtopicname = $subtopicdisplay['sub_name'];
        $tempSubtopicdesc = $subtopicdisplay['sub_desc'];
        $tempSubtopicId = $subtopicdisplay['sub_id'];
        $tempTopicFId = $subtopicdisplay['topic_fid'];

        if (($tempExistingSubtopicID == $tempSubtopicId) && ($tempTopicId == $tempTopicFId) && ($tempSubFId == $tempSubId)){
          echo <<<GFG
              <script>
              highlightSubtopic("{$tempExistingSubtopicID}", "{$tempSubtopicname}");


              </script>

          GFG;
          echo <<<GFG
          <script>
                systemSetSubjectDisplay("{$tempSubname}","{$tempSubdesc}","{$tempSubId}");
                systemSetTopicDisplay("{$tempTopicname}","{$tempTopicdesc}","{$tempTopicId}","subtopic{$tempSubtopicId}");
                console.log("this is"+subtopicChosen);
                
          </script>

          GFG;
        }

        $subtnum += 1;

      }
    }
  }


}
 ?>
