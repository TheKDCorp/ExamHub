
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
$qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));

  $sql = "UPDATE questionpaper set examtype='originaltest' where qpid='$qpid'";
  $conn->query($sql);

  ?>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Convert To Original Test");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3>Converted To Original Test: <span style="color:green">Done!</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
