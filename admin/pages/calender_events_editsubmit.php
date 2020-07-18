<?php 
include_once('../includes/dbcon.php');

if(!empty($_POST['eventdetails'])){
	$eventdetails = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['eventdetails']))));
	$eventid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['eventid']))));
	// echo $details."<br>";

	$details = $eventdetails;
    $details = str_replace("rn","/n",$details);
    $details = str_replace(" ","_",$details);
    // echo $details."<br>";

	$eventdate = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['eventdate']))));
	$date = substr($eventdate, -2);
	$month = substr($eventdate, 5,2);
	$year = substr($eventdate, 0,4);

	if($month=="01" || $month=="02" || $month=="03"|| $month=="04" || $month=="05"|| $month=="06" || $month=="07"|| $month=="08" || $month=="09"){
		$month = substr($month, 1,1);
	}

	$sql = "UPDATE calender_events SET details='$details' , fulldate='$eventdate',date='$date',month='$month',year='$year' where eventid='$eventid' ";
	$conn->query($sql);
}else{
	echo "No Fields Are Entered!!!";
	exit();
}
?>


<script type="text/javascript">
	window.location.href = 'calender_events.php';
</script>