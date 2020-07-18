  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 

$sid = htmlspecialchars($_POST['cid'],ENT_QUOTES);
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

$target_file = "../profile/" . md5($sid)."jt".md5($sid) . ".jpg";
echo $target_file."<br>";
move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

$sql = "select * from students where sid = '$sid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $oldpassword = $row['password'];
}else{
  echo "No. Record Found!!!";
  exit();
}

$sql = "UPDATE students SET name='$name' , dob='$dob',fathersname='$fathersname',mothersname='$mothersname',class='$class', section='$section',mobileno='$mobileno',address='$address',username='$username',password='$password',imgsrc='$sid',email='$email',oldpassword='$oldpassword',batch='$batch' where sid='$sid'";
$conn->query($sql);
 ?>

 <script type="text/javascript">
  window.location = "viewstudent.php?id=<?php echo $sid;?>";
</script>