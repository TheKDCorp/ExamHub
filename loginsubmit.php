<?php
if(isset($_COOKIE["user_name"])) {
	header("Location: pages/index.php");
	exit();
} else {
}
?>

<?php 
include_once('includes/dbcon.php');

if((isset($_POST['username'])) && (isset($_POST['password'])) && (!empty($_POST['username'])) && (!empty($_POST['password']))){

	$username = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['username']))));
	$password = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['password']))));

	$sql = "select * from students where username='$username' and password='$password' limit 1";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		session_start();
		$row=$result->fetch_assoc();
		if($row['active']=="yes"){
			setcookie("user_id", $row['sid'], time() + (86400),'/');
			setcookie("user_name", $row['name'], time() + (86400),'/');
			setcookie("user_role", $row['role'], time() + (86400),'/');
			setcookie("user_batch", $row['batch'], time() + (86400),'/');

			$sid = $row['sid'];

			$sql = "update students set loggedin='true',page='' where sid='$sid'";
			$conn->query($sql);

			date_default_timezone_set('Asia/Kolkata');
			$timestamp = date('Y/m/d h:i:s a', time());
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			  $IP = $_SERVER["HTTP_CLIENT_IP"];
			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			  $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
			  $IP = $_SERVER['REMOTE_ADDR'];
			}
			$mycomputername = gethostbyaddr($IP); 
			$sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Logged In Successfull','$timestamp')";
			$conn->query($sql);

			header("Location: pages/indexnew.php");	
		}else{
			$conn->query($sql);
			header("Location: index.php");
			exit();
		}
	}else{
		echo "User name Or Password is Incorrect!!!";
		date_default_timezone_set('Asia/Kolkata');
		$timestamp = date('Y/m/d h:i:s a', time());
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		  $IP = $_SERVER["HTTP_CLIENT_IP"];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		  $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
		  $IP = $_SERVER['REMOTE_ADDR'];
		}
		$mycomputername = gethostbyaddr($IP); 
		$sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Username/Password Incorrect','$timestamp')";
		$conn->query($sql);
		header("Location: index.php");
			exit();
	}

}else{
	echo "Enter Valid Username or Password!!!";
		date_default_timezone_set('Asia/Kolkata');
		$timestamp = date('Y/m/d h:i:s a', time());
	    $mymacaddress = GetMAC();
	    $IP = $_SERVER['REMOTE_ADDR'];        // Obtains the IP address
	    $mycomputername = gethostbyaddr($IP); 
		$sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$mymacaddress','$mycomputername','$sid','Error!!!','$timestamp')";
		$conn->query($sql);

		header("Location: index.php");
		exit();

}
 ?>
