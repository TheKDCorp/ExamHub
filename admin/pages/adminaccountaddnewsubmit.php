  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$password = htmlspecialchars($_POST['password'],ENT_QUOTES);

$sql ="INSERT INTO admin_members(adminid,username,password,post)VALUES(DEFAULT,'$username','$password','ADMINISTRATOR')";
$conn->query($sql);

 ?>

<script type="text/javascript">
  window.location = "adminaccount.php";
</script>