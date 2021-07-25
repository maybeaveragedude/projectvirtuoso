<?php
session_start();
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$adminapproveid = $_SESSION["adminid"];

if (isset($_POST["act"])){

	$tID = $_POST["tId"];
	
	// echo '<pre>'; print_r($tID); echo '</pre>';
	// echo '<pre>'; print_r($adminapproveid); echo '</pre>';
	changeStatusActive($conn, $tID, $adminapproveid);
	header("Refresh:2; url=../adminhome.php");

}
if (isset($_POST["deact"])){

	$tID = $_POST["tId"];

	// echo '<pre>'; print_r($tID); echo '</pre>';
	// echo '<pre>'; print_r($adminapproveid); echo '</pre>';
	changeStatusInactive($conn, $tID, $adminapproveid);
	header("Refresh:2; url=../adminhome.php");
}
?>