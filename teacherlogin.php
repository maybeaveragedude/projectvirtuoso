<?php
  include_once 'teacherheader.php';
  invalidLearnerUserAcess();
  loggedInInvalidUserAcess();
?>

    <main class="page hire-me-page">
        <section class="portfolio-block hire-me" style="padding: 0px;">
            <div class="container-fluid">
                <div class="row mh-100vh" style="height: 720px;">
                    <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                        <div class="m-auto w-lg-75 w-xl-50">

                            <form method="post" action="includes/teacherlogin.inc.php">
                                <div class="form-group mb-3"><label class="form-label text-secondary">Email</label><input class="form-control" type="text" name="email" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                                <div class="form-group mb-3"><label class="form-label text-secondary">Password</label><input class="form-control" type="password" name="password" required=""></div>
                                <button class="btn btn-primary" type="submit" name="submit" style="border-radius: 7px;background: #1eb53a;">Log In</button>
                                <?php
                                //this is error handling message for users
                                  if (isset($_GET["error"])) {
                                    if ($_GET["error"] == "emptyinput") {
                                      echo "<p>Fill in empty fields!<p>";
                                    }
                                    elseif ($_GET["error"] == "wronglogin"){
                                      echo "<p>Incorrect login credentials.<p>";
                                    }
                                  }
                                ?>
                            </form>
                            <a href="teachsignupbuffer.php" type="link" style="font-size: 12px; padding-left: 50px;">Dont have an account? Register Now!</a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background: url(&quot;assets/img/pngtree-hand-drawn-minimalistic-blackboard-podium-teachers-day-background-daypodiumblackboarddeskclassroomsealvertical-versionh5-pageposterflat-image_53222.jpg&quot;) center center / cover;">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="page-footer">
        <div class="container">
            <!-- <div class="links"><a href="#">Contact us</a></div>
            <div class="social-icons"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-instagram-outline"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a></div> -->
        </div>
    </footer>
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
