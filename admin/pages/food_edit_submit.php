<?php 
include_once('../includes/dbcon.php');

if(!empty($_POST['fid'])){
	$fid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['fid']))));
	$breakfast = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['breakfast']))));
	$lunch = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['lunch']))));
	$refreshment = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['refreshment']))));
	$dinner = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['dinner']))));

	$breakfast = str_replace("rn","/n",$breakfast);
    $breakfast = str_replace(" ","_",$breakfast);

    $lunch = str_replace("rn","/n",$lunch);
    $lunch = str_replace(" ","_",$lunch);

    $refreshment = str_replace("rn","/n",$refreshment);
    $refreshment = str_replace(" ","_",$refreshment);

    $dinner = str_replace("rn","/n",$dinner);
    $dinner = str_replace(" ","_",$dinner);

	$breakfastdescription = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['breakfastdescription']))));
	$lunchdescription = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['lunchdescription']))));
	$refreshmentdescription = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['refreshmentdescription']))));
	$dinnerdescription = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['dinnerdescription']))));

    $breakfastdescription = str_replace("rn","/n",$breakfastdescription);
    $breakfastdescription = str_replace(" ","_",$breakfastdescription);

    $lunchdescription = str_replace("rn","/n",$lunchdescription);
    $lunchdescription = str_replace(" ","_",$lunchdescription);

    $refreshmentdescription = str_replace("rn","/n",$refreshmentdescription);
    $refreshmentdescription = str_replace(" ","_",$refreshmentdescription);

    $dinnerdescription = str_replace("rn","/n",$dinnerdescription);
    $dinnerdescription = str_replace(" ","_",$dinnerdescription);


	// $sql = "select * from food order by randid desc";
	// $result=$conn->query($sql);
	// if($result->num_rows > 0){
	// 	$row = $result->fetch_assoc();
	// 	$uuid = $row['randid'] + 1;
	// }else{
	// 	$uuid = 1;
	// }
	// $target_file1 = "../uploads/food/" .md5($uuid.'_1') .".jpg";
	// move_uploaded_file($_FILES["breakfast_img"]["tmp_name"], $target_file1);
	// $target_file2 = "../uploads/food/" .md5($uuid.'_2') .".jpg";
	// move_uploaded_file($_FILES["lunch_img"]["tmp_name"], $target_file2);
	// $target_file3 = "../uploads/food/" .md5($uuid.'_3') .".jpg";
	// move_uploaded_file($_FILES["refreshment_img"]["tmp_name"], $target_file3);
	// $target_file4 = "../uploads/food/" .md5($uuid.'_4') .".jpg";
	// move_uploaded_file($_FILES["dinner_img"]["tmp_name"], $target_file4);

	$fulldate = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['date']))));
	$date = substr($fulldate, -2);
	$month = substr($fulldate, 5,2);
	$year = substr($fulldate, 0,4);

	if($month=="01" || $month=="02" || $month=="03"|| $month=="04" || $month=="05"|| $month=="06" || $month=="07"|| $month=="08" || $month=="09"){
		$month = substr($month, 1,1);
	}

	// echo $sql."<br>";
	$sql = "UPDATE food set breakfast='$breakfast',lunch='$lunch',refreshment='$refreshment',dinner='$dinner',date='$date',month='$month',year='$year',fulldate='$fulldate',breakfastdescription='$breakfastdescription',lunchdescription='$lunchdescription',refreshmentdescription='$refreshmentdescription',dinnerdescription='$dinnerdescription' where fid='$fid'";
	echo $sql;
	$conn->query($sql);
}else{
	echo "No Fields Are Entered!!!";
	exit();
}
?>


<script type="text/javascript">
	window.location.href = 'food_entry.php';
</script>