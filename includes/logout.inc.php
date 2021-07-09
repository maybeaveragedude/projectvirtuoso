<?php

session_start();
session_unset();
session_destroy();



echo '<script>alert("Logged out successfully! Click OK to go back to home page...")</script>';
header("Refresh:0; url= ../index.php");
exit();
