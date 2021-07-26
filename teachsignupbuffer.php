<?php
  include_once 'teacherheader.php';
  invalidLearnerUserAcess();
  loggedInInvalidUserAcess();

?>

    <main class="page hire-me-page">
        <section class="d-xxl-flex justify-content-xxl-center" style="padding: 100px 0px;">
          <?php
          //this is error handling message for users
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput"){
                // echo "<p>Fill in all fields!<p>";
                echo "<script>alert('Fill in all fields!');</script>";
              }
              elseif ($_GET["error"] == "invalidname") {
                // echo "<p>No special characters allowed in names!<p>";
                echo "<script>alert('No special characters allowed in names!');</script>";
              }
              elseif ($_GET["error"] == "invalidusername") {
                // echo "<p>Only alphanumerics characters allowed in username!<p>";
                echo "<script>alert('Only alphanumerics characters allowed in username!');</script>";
              }
              elseif ($_GET["error"] == "passwordsdontmatch") {
                // echo "<p>Repeated password does not match!<p>";
                echo "<script>alert('Repeated password does not match!');</script>";
              }
              elseif ($_GET["error"] == "usernametaken") {
                // echo "<p>Username is taken!<p>";
                echo "<script>alert('Username is taken!');</script>";
              }
              elseif ($_GET["error"] == "stmtfailed") {
                // echo "<p>Something wrong occured! Please try again later.<p>";
                echo "<script>alert('Something wrong occured! Please try again later.');</script>";
              }
              elseif ($_GET["error"] == "none") {
                // echo "<p>Account created successfully!<p>";
                echo "<script>alert('Account created successfully!');</script>";
                header("Refresh:2; url=teacherhome.php");
              }
            }
          ?>
            <div class="row" style="width: 1284px;height: 500px;align-items: center;margin: 0px;">
                <div class="col-xxl-3 tab" style="margin: 0px;padding-top: 40px;padding-bottom: 5%;padding-left: 0px;padding-right: 0px;"><div class="tablinks" >Step 1: Create an teacher's account.</div>
<div class="tablinks" >Step 2: Claim your username.</div>
<div class="tablinks" >Step 3: Select subjects to be taught.</div>
<div class="tablinks" >Step 4: Education background.</div>
<div class="tablinks" >Step 5: Supporting education credibility.</div>
<div class="tablinks" >Step 6: Wait for the great news!</div></div>
                <div class="col-xxl-8 offset-xxl-0" style="padding: 0px;">
                    <form method="post" action="includes/teachsignup.inc.php" class="stepform" enctype="multipart/form-data" style="padding: 20px;" >
                        <div id="Step1" class="tabcontent">
                            <h1 class="display-5 text-start">Fill in your details promptly!</h1>
                            <label class="form-label" style="margin-top: 46px;">Full Name</label>
                            <input class="form-control dettxtbox" type="text" placeholder="As per on your personal identification card" name="fullname" pattern="[A-Za-z\s]+">
                            <label class="form-label middlelabel">Email</label>
                            <input class="form-control dettxtbox" type="text" id="email" placeholder="Insert unregistered email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <label class="form-label middlelabel">Repeat Email</label>
                            <input class="form-control dettxtbox" type="text" id="rptemail" placeholder="Repeat the email above" name="rptemail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        </div>
                        <div id="Step2" class="tabcontent">
                            <h1 class="display-5 text-start">Reserve your username!</h1>
                            <label class="form-label" style="margin-top: 46px;">Username</label>
                            <input class="form-control dettxtbox" type="text" id="username" placeholder="Pick an username that you like" name="username">
                            <label class="form-label middlelabel">Password</label>
                            <input class="form-control dettxtbox" type="password" id="pwd" placeholder="Choose a strong password " name="pwd">
                            <label class="form-label middlelabel">Repeat Password</label>
                            <input class="form-control dettxtbox" type="password" id="rptpwd" placeholder="Repeat the password" name="rptpwd">
                        </div>
                        <div id="Step3" class="tabcontent">
                            <h1 class="display-5 text-start">What subjects are you interested in teaching?</h1>
                            <fieldset class="step1fieldset" name="fieldstep1">
                                <legend></legend>
                                <div class="form-check checkwithlabel" style="margin-top: 30px;">
                                  <input class="form-check-input" type="checkbox" id="checkScience" name= "checklist[]" value="Science">
                                  <label class="form-check-label" for="checkScience">Sciences</label></div>
                                <div class="form-check checkwithlabel">
                                  <input class="form-check-input" type="checkbox" id="checkTech" name= "checklist[]" value="Technology">
                                  <label class="form-check-label" for="checkTech">Technology</label></div>
                                <div class="form-check checkwithlabel">
                                  <input class="form-check-input" type="checkbox" id="checkEngineer" name= "checklist[]" value="Engineering">
                                  <label class="form-check-label" for="checkEngineer">Engineering</label></div>
                                <div class="form-check checkwithlabel">
                                  <input class="form-check-input" type="checkbox" id="checkMaths" name= "checklist[]" value="Mathematics">
                                  <label class="form-check-label" for="checkMaths">Mathematics</label>
                                </div><input class="form-control" type="text" id="formstep1others" style="width: 50%;margin-top: 14px;" placeholder="Others" name="Otherunlistedsubjects">
                            </fieldset>
                        </div>
                        <div id="Step4" class="tabcontent">
                            <h1 class="display-5">Tell us about your education background!</h1>
                            <label class="form-label" style="margin-top: 26px;">Years of Experience</label>
                            <input class="form-control" type="number" style="width: 10%;" max="60" min="0" required="" name="years">
                            <label class="form-label" style="margin-top: 20px;">Brief Summary of Teaching / Education Experiences</label>
                            <textarea class="form-control" id="briefexptext" name= "briefexp" style="width: 80%;height: 160px;max-height: 165px;" placeholder="We really like to hear from you!" spellcheck="true" required=""></textarea>
                        </div>
                        <div id="Step5" class="tabcontent">
                            <h1 class="display-5" style="width: 768px;">Prove us your hard-earned credibility!&nbsp;</h1>
                            <label class="form-label" style="margin-top: 26px; display: block;">Submit us any proof/s in your education experience.</label>
                            <label for="myfile"></label>
                            <input type="file" id="filecred" name="file" multiple><br><br>
                            <label class="form-label">Or any URL to your Youtube channel or education sites!</label>
                            <input class="form-control" type="url" placeholder="Website URLs" style="width: 75%;" name="Websiteforreferences">
                        </div>
                        <div id="Step6" class="tabcontent">
                            <h1 class="display-5 text-start">Done!&nbsp;<br>Our team will contact you shortly!</h1>
                        </div><button class="btn btn-primary mybtn" id="completeform" name="completeform" type="submit" style="float: right;border-radius: 6px;display: inline;color: #000000;margin-top: -90px;">Submit</button>
                    </form><button id="nextBtn" class="mybtn" onclick="nextPrev(1)"><i class="fa fa-angle-right"></i></button><button id="prevBtn" class="mybtn" onclick="nextPrev(-1)"><i class="fa fa-angle-left"></i></button>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/smart-forms.min.js"></script>
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
