<?php
if(!session_id())
session_start();
?>



<?php

	if(!isset($_GET["value"])) $ID = "E910400";
	else $ID = $_GET["value"]; 
	

	
	$_SESSION['discuss_courseID'] = $ID;
	
	
	$newURL = "discuss.php";
	header('Location: '.$newURL);
?>