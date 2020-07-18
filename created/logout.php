<?php 
session_start();

include_once('../includes/dbcon.php');

$sid = $_COOKIE["user_id"];
$sname = $_COOKIE["user_name"];
$srole = $_COOKIE["user_role"];
$sbatch = $_COOKIE["user_batch"];

$sql = "update students set loggedin='false',page='' where sid='$sid'";
$conn->query($sql);

setcookie('user_id', $sid, time() - 3600,'/');
setcookie('user_name', $sname, time() - 3600,'/');
setcookie('user_role', $srole, time() - 3600,'/');
setcookie('user_batch', $sbatch, time() - 3600,'/');

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
$sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Logged Out Successfull','$timestamp')";
$conn->query($sql);



header("Location: ../"); 

 ?>