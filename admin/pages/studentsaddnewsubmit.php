  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>
<div style="display:none;">
<?php 
$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
$dob = $_POST['dob'];
$fathersname = htmlspecialchars($_POST['fathersname'],ENT_QUOTES);
$mothersname = htmlspecialchars($_POST['mothersname'],ENT_QUOTES);
$class = htmlspecialchars($_POST['class'],ENT_QUOTES);
$section = htmlspecialchars($_POST['section'],ENT_QUOTES);
$mobileno = htmlspecialchars($_POST['mobileno'],ENT_QUOTES);
$address = htmlspecialchars($_POST['address'],ENT_QUOTES);
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$password = htmlspecialchars($_POST['password'],ENT_QUOTES);
$email = htmlspecialchars($_POST['email'],ENT_QUOTES);
$batch = htmlspecialchars($_POST['batch'],ENT_QUOTES);

$sql ="INSERT INTO students(sid,name,dob,fathersname,mothersname,class,section,mobileno,address,username,password,imgsrc,role,email,oldpassword,loggedin,updated,batch,active)VALUES(DEFAULT,'$name','$dob','$fathersname','$mothersname','$class','$section','$mobileno','$address','$username','$password','','student','$email','$password','false','false','$batch','yes')";
$conn->query($sql);

$sql = "select * from students order by sid desc limit 1";
$result=$conn->query($sql);
if($result->num_rows > 0){
	$row = $result->fetch_assoc();
}

$sid = $row['sid'];
$target_file = "../profile/" . md5($sid)."jt".md5($sid) . ".jpg";
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$sql = "UPDATE students SET imgsrc='$sid' where sid='$sid'";
$conn->query($sql);

 ?>
 	
 </div>


<script type="text/javascript">
  window.location = "students.php";
</script>