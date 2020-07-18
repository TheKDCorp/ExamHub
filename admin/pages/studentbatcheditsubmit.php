
<?php include_once('../includes/dbcon.php'); ?>


<?php 
$name = htmlspecialchars($_POST['name'],ENT_QUOTES);
$id = htmlspecialchars($_POST['batchid'],ENT_QUOTES);
$sql = "UPDATE studentbatchentry SET name='$name' where batchid='$id'";
$conn->query($sql);
 ?>

<script type="text/javascript">
  window.location = "studentbatchentry.php";
</script>