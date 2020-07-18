<?php 
	include_once('../includes/dbcon.php');
	$id = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));
	
	$sql = "DELETE FROM admin_members WHERE adminid='$id'";
	$conn->query($sql);
	
	header("Location: adminaccount.php");

 ?>