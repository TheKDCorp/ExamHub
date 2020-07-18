<?php 
session_start();
if((isset($_SESSION['name'])) && (!empty($_SESSION['name']))){
	header("Location: pages/index.php");
	exit();
}else{

}
?>

<?php 
include_once('includes/dbcon.php');

if((isset($_POST['username'])) && (isset($_POST['password'])) && (!empty($_POST['username'])) && (!empty($_POST['password']))){

	$username = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['username']))));
	$password = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['password']))));



$sql = "select * from admin_members where username='$username' and password='$password' limit 1";
$result = $conn->query($sql);

if($result->num_rows > 0){
	session_start();
	$row=$result->fetch_assoc();

	$_SESSION["a_name"] = $row['username'];
	$_SESSION["a_role"] = $row['post'];

	header("Location: pages/indexnew.php");	
}else{
	echo "User name Or Password is Incorrect!!!";

	header("Location: index.php");
		exit();
}

}else{

	echo "Enter Valid Username or Password!!!";
		header("Location: index.php");
		exit();

}
 ?>
