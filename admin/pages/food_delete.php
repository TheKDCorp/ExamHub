<?php 
	include_once('../includes/dbcon.php');
	$id = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['fid']))));

	
	$sql = "DELETE FROM food WHERE fid='$id'";
	$conn->query($sql);

	header("Location: food_entry.php");


 ?>