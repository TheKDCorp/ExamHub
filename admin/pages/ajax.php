<?php 
include_once("../includes/dbcon.php");

if(!empty($_POST['namexyz'])){
	$name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['namexyz'])))); 

	$sql = "select * from questionpaper where name='$name'";
	$result = $conn->query($sql);
	if($result->num_rows >0){
		$row = $result->fetch_assoc();
		echo $row['qpid'];
	}
}


if(!empty($_POST['name2'])){
	$name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['name2'])))); 

	$sql = "select * from questionpaper where name='$name'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc();
		echo $row['noofparts'];
	}
}

 ?>