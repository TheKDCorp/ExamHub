
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
$sid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['sid']))));

  $sql = "DELETE FROM students where sid='$sid'";
  $conn->query($sql);

  ?>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Student Deleted");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3>Student Deleted: <span style="color:green">Done!</span></h3>
                <hr>
                <center><a href="students.php" class="btn btn-info">Student List</a></center>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
