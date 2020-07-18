<?php 
	include_once('../includes/dbcon.php');
	$id = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['eventid']))));

	
	$sql = "DELETE FROM calender_events WHERE eventid='$id'";
	$conn->query($sql);

	header("Location: calender_events.php");


 ?>