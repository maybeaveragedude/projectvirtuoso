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
                                <?php
                                    if (isset($_GET["coursestatusupdate"])){
                                        if($_GET["coursestatusupdate"] == "approved"){
                                            echo "<script>alert('Course has been approved!');</script>";
                                        } elseif ($_GET["coursestatusupdate"] == "revoked"){
                                            echo "<script>alert('Course has been revoked!');</script>";
                                        } elseif ($_GET["coursestatusupdate"] == "error"){
                                            echo "<script>alert('Something went wrong! Please try again later.');</script>";
                                        }
                                    } elseif (isset($_GET["tstatus"])){
                                        if($_GET["tstatus"] == "activated"){
                                            echo "<script>alert('Selected teacher account has been activated!');</script>";
                                        } elseif ($_GET["tstatus"] == "deactivated"){
                                            echo "<script>alert('Selected teacher account has been deactivated!');</script>";
                                        }
                                    }
                                ?>
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
            <!-- <div class="links"><a href="#">Contact us</a></div> -->
            <!-- <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div> -->
        </div>
    </footer>


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
