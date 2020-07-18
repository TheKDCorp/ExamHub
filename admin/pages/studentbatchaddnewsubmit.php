  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 
$name = htmlspecialchars($_POST['name'],ENT_QUOTES);

$sql ="INSERT INTO studentbatchentry(batchid,name)VALUES(DEFAULT,'$name')";
$conn->query($sql);

 ?>

<script type="text/javascript">
  window.location = "studentbatchentry.php";
</script>