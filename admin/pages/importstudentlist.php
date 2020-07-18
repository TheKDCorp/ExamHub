  <?php include_once('../created/header.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 
	$target_file = "../uploads/studentlist/temporary.csv";
	move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
?>

<script type="text/javascript">
  window.location = "importstudentsdetails.php";
</script>