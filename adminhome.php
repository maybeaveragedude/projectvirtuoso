<?php
  include_once 'adminheader.php';
?>
<main class="page lanidng-page">
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-bottom: 50px;background: #ededed;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-3" id="avatar" onclick="on()">
                                <picture style="width: 128px;height: 128px;"><img id="profileavatar" src="assets/img/avatars/avatar.jpg" style="width: 128px;height: 128px;border-radius: 176px;"></picture>
                            </div>
                            <div class="col d-xxl-flex align-items-xxl-center">
                                <div>
                                    <h1 class="d-xxl-flex justify-content-xxl-start">
                                        <?php 
                                        if(isset($_SESSION["adminname"]) && !empty($_SESSION['adminname'])){
                                            echo $_SESSION["adminname"];    
                                        }else{
                                            echo "Dummy Admin";
                                        }  
                                        ?>
                                    </h1><small class="d-xxl-flex justify-content-xxl-start">Pick a nickname</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </section>
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-bottom: 50px;">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Teachers</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Courses</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Achievements</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="tab-1">
                                    <h1 class="text-start" style="padding: 16px 16px;border-bottom-width: 1px;border-bottom-style: solid;">Manage Teachers</h1>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include_once 'includes/adminmanageuser.inc.php';
                                                ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-group"></div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="tab-2">
                                    <h1 class="text-start" style="padding: 16px 16px;border-bottom-width: 1px;border-bottom-style: solid;">Materials</h1>
                                    <div class="accordion" role="tablist" id="accordion-1">
                                        <div class='accordion-item'>
                                            <h2 class='accordion-header' role='tab'><button class='accordion-button collapsed' data-bs-toggle='collapse' data-bs-target='#accordion-1 .item-1' aria-expanded='true' aria-controls='accordion-1 .item-1'>Course List</button></h2>
                                            <div class='accordion-collapse collapse item-1 text-start' role='tabpanel' data-bs-parent='#accordion-1'>
                                                <div class='accordion-body'>
                                                    <?php
                                                    include_once 'includes/adminmanagecourse.inc.php';

                                                    //TO DO
                                                    // include_once 'includes/adminapprovecourse.inc.php';
                                                    // include_once 'includes/adminviewsubject.inc.php';
                                                    ?>
                                                <div>
                                                    <button id="courseemptyNotice" class="" style="display: none; padding: 16px 4px; margin-left: 10px; margin-bottom: 12px; cursor: default; background: #FFFFFF; border: 0px;" role="button" >No active courses</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="portfolio-block skills" style="padding: 50px 75px;padding-top: 75px;"></section>
        <section class="portfolio-block block-intro" style="padding: 50px 75px;padding-top: 0px;"></section>
    </main>
    <section class="portfolio-block website gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-5 offset-lg-1 text">
                    <h3>Website Project</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget velit ultricies, feugiat est sed, efr nunc, vivamus vel accumsan dui. Quisque ac dolor cursus, volutpat nisl vel, porttitor eros.</p>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div class="portfolio-laptop-mockup">
                        <div class="screen">
                            <div class="screen-content" style="background-image:url(&quot;assets/img/tech/image6.png&quot;);"></div>
                        </div>
                        <div class="keyboard"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <div id="overlay" class="overlay">
        <div class="container text-start" id="avatarpanel" style="width: 700px;max-width: auto;padding-right: 36px;padding-left: 36px;padding-top: 20px;padding-bottom: 20px;background: #ffffff;justify-self: center;">
            <div class="row" style="margin: 0px;">
                <div class="col d-xxl-flex align-items-xxl-center">
                    <h1 class="align-items-xxl-center" style="text-align: left;vertical-align: middle;margin: 0;"><strong>Avatar</strong></h1>
                </div>
                <div class="col d-xxl-flex justify-content-xxl-end align-items-xxl-center" style="padding: 0px;text-align: right;"><a class="d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="xbutton" onclick="off()" style="width: 54px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-x d-xxl-flex justify-content-xxl-center align-items-xxl-center" style="color: rgb(0,0,0);font-size: 43px;width: 43px;text-align: center;">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                        </svg></a></div>
            </div>
            <div class="row" style="margin: 0px;">
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar1" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="text-center d-xxl-flex justify-content-xxl-center gridavatar" style="padding: 0px;justify-content: center;text-align: center;"><img class="rounded d-xxl-flex flex-fill justify-content-xxl-center" id="img1" src="assets/img/nature/image1.jpg" style="width: 128px;height: 128px;justify-self: center;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar2" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="justify-content-xxl-center gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid d-xxl-flex flex-fill justify-content-xxl-center" src="assets/img/nature/image2.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar3" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/nature/image3.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar4" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/tech/image6.png" style="width: 128px;height: 128px;"></picture>
                    </a></div>
            </div>
            <div class="row" style="margin: 0px;">
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar5" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/nature/image6.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar6" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/nature/image1.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar7" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/nature/image1.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar8" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/avatars/avatar.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
            </div>
            <div class="row" style="margin: 0px;">
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar9" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/star-sky.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar10" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/tech/image4.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar11" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/meeting.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
                <div class="col m-auto" style="padding: 12px;"><a class="stretched-link" id="avatar12" style="margin: 30px 0px;" onclick="reply_click(this.id)">
                        <picture class="gridavatar" style="padding: 30px 0px;"><img class="rounded img-fluid flex-fill" src="assets/img/nature/image1.jpg" style="width: 128px;height: 128px;"></picture>
                    </a></div>
            </div>
            <div class="row justify-content-end" style="margin: 0px;padding-top: 14px;width: 628px;">
                <div class="col-2 text-center align-self-start" style="padding: 14px 6px;"><a id="btnCancel" href="#" style="padding: 14px 6px;color: var(--bs-red);"><strong>Cancel</strong></a></div>
                <div class="col-auto d-xxl-flex align-items-xxl-center" style="padding: 0px;"><a class="text-center" id="btnConfirm" href="#" onclick="apply_image()"><strong>Confirm</strong></a></div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        // var jsTeacherID = '<?php echo $_SESSION["teacherid"]; ?>';
        window.onload = function(){
        // amplify.store("initialSubCount",length);
        onlyTeacherSpecificDisplay(jsTeacherID);
        }
        var emptyelement =document.getElementById("collapseCourse-0");

        if (typeof(emptyelement)!= 'undefined' && emptyelement != null){
            document.getElementById("courseemptyNotice").style.display = "none";
        }else{
            document.getElementById("courseemptyNotice").style.display = "block";
        }

    function styleSubjectRow(){
      var row = document.getElementsByClassName("singleSubjectRowLine");
      var togglerow = document.getElementsByClassName("singleSubjectRow");
      // console.log(row);
      for (var i=0; i< togglerow.length-1; i++){
        if (togglerow[i].style.display === "block"){
          row[i].classList.toggle("botBorder");
          document.getElementById("emptyNotice").style.display = "none";


        }
        else {
          document.getElementById("emptyNotice").style.display = "block";
        }

      }
    }

    function onlyTeacherSpecificDisplay(jsTeacherID){
      // var templength = amplify.store("initialSubCount");
      // console.log(row.length);
      var row = document.getElementsByClassName("singleSubjectRow");
      var length = row.length;
      var glosubtopiccount = 0;
      for (var i=0; i< length; i++){
        // console.log(row[i].childNodes);
        var row1 = row[i].children;
        var subtopiccount = 0;
        // console.log(length);


        for (var j=0; j< row1.length; j++){
          var row2 = row1[j].children;
          // console.log(row2);
          for (var k=0; k< row2.length; k++){
            var row3 = row2[k].children;
            for (var m=0; m< row3.length; m++){
              var row4 = row3[m].children;
              // console.log(row4);
              for (var p=0; p< row4.length; p++){
                var row5 = row4[p].children;

                if (row5[0].classList.contains(`teacheridIs_${jsTeacherID}`)== true){
                  // row[i].style.display = "block";
                  // console.log("row is "+ row4[p].id);
                  var tempeditID = row4[p].id;
                  createSubtopicEdit(tempeditID);

                  subtopiccount +=1;
                  glosubtopiccount +=1;

                }else {
                  // row[i].style.display = "none";
                  // console.log("none the i is "+i);
                }

                if (subtopiccount > 0){
                  row[i].style.display = "block";
                }
                else {
                  row[i].style.display = "none";
                }
                // console.log(subtopiccount);

                // console.log(row5[0].classList.contains(`teacheridIs_${jsTeacherID}`));
                // console.log(length);

                // for (var q=0; q< row5.length; q++){
                //   var row6 = row5[q].children;
                //   console.log(row6);
                // }
              }
            }
          }
        }

        // console.log(row1[i].childNode);
        // if row.children[i].classList.contains(`teacheridIs_${jsTeacherID}`){
        //   row[i].style.display = "block";
        // }else {
        //   row[i].style.display = "none";
        // }
      }
      styleSubjectRow();
      cultivateButton(glosubtopiccount);


    }
    function createSubtopicEdit(tempeditID){
      var subtopicID = document.getElementById(tempeditID).id;
      var edit = document.createElement("input");

      edit.setAttribute("id", `editfor${subtopicID}`);

      edit.setAttribute("type", "button");

      edit.setAttribute("onclick", `redirectEdit("${subtopicID}")`);

      edit.setAttribute("class", "simpleTextEdit");

      edit.setAttribute("name", "Edit");

      edit.setAttribute("value", "Edit");

      //append to form element that you want .
      document.getElementById(`${tempeditID}`).appendChild(edit);

      // if (document.getElementById("getExistingSubID") !== null){
      //   document.getElementById("getExistingSubID").value = subjectID;
      // }
      // console.log(document.getElementById(`${tempeditID}`).id);
      console.log(subtopicID);

    }
    function redirectEdit(subtopicID){ //to enable setting up form in editor
      window.location.href=`teacheredit.php?editsubtopics=${subtopicID}`;
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