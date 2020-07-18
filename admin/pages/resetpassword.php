 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 

$cid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));
$sql = "select * from students where sid = '$cid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
  $oldpassword = $row['oldpassword'];
}else{
  echo "No. Record Found!!!";
  exit();
}
$sql = "update students set password = '$oldpassword', updated='false' where sid='$cid'";
$conn->query($sql);

 ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Reset Account Password");
});
</script>

<style type="text/css">
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 15%;
    border-radius:5px;
}
</style>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <div>
                  <?php
                     echo '<a href="students.php" class="btn btn-primary">List Students</a>';
                  ?>
                  </div>
                  <hr>
              <div class="card-body">
                <h3>Password Reset: <span style="color:green">Done!</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>



  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
