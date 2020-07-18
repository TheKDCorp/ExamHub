
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$id = htmlspecialchars($_POST['adminid'],ENT_QUOTES);
$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
$password = htmlspecialchars($_POST['password'],ENT_QUOTES);
$sql = "UPDATE admin_members SET username='$username',password='$password' where adminid='$id'";
$conn->query($sql);
 ?>

<script type="text/javascript">
  window.location = "adminaccount.php";
</script>