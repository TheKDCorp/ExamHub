<?php 
	include_once('../includes/dbcon.php');
	$id = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));
	
	$sql = "DELETE FROM studentbatchentry WHERE batchid='$id'";
	$conn->query($sql);
	
	header("Location: studentbatchdeleted.php");

 ?>