  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 

$sid = htmlspecialchars($_POST['sid'],ENT_QUOTES);
$practisetest = htmlspecialchars($_POST['practisetest'],ENT_QUOTES);
$logs = htmlspecialchars($_POST['logs'],ENT_QUOTES);
$tracking = htmlspecialchars($_POST['tracking'],ENT_QUOTES);

$sql = "UPDATE settings SET practisetestallowed='$practisetest' , logs='$logs',tracking='$tracking' where sid='$sid'";
$conn->query($sql);

?>

 <script type="text/javascript">
  window.location = "preferences.php";
</script>