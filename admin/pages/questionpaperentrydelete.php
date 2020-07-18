<?php 
include_once('../includes/dbcon.php');

if(!empty($_GET['qpid'])){
	$qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));
	$sql="DELETE FROM questionpaper where qpid='$qpid'";
	$conn->query($sql);
	header("Location: questionpaperentry.php");
}else{
	header("Location: questionpaperentry.php");
}
 ?>
