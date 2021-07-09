<?php
//this is error handling message for users
  if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput"){
      echo "<p>Fill in all fields!<p>";
    }
    elseif ($_GET["error"] == "invalidname") {
      echo "<p>No special characters allowed in names!<p>";
    }
    elseif ($_GET["error"] == "invalidusername") {
      echo "<p>Only alphanumerics characters allowed in username!<p>";
    }
    elseif ($_GET["error"] == "passwordsdontmatch") {
      echo "<p>Repeated password does not match!<p>";
    }
    elseif ($_GET["error"] == "usernametaken") {
      echo "<p>Username is taken!<p>";
    }
    elseif ($_GET["error"] == "stmtfailed") {
      echo "<p>Something wrong occured! Please try again later.<p>";
    }
    elseif ($_GET["error"] == "none") {
      echo "<p>Account created successfully!<p>";
      header("Refresh:2; url=learnerhome.html");
    }
  }
?>
