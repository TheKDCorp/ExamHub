
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  ?>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Student Batch Deleted");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <h3>Student Batch Deleted: <span style="color:green">Done!</span></h3>
                <hr>
                <center><a href="studentbatchentry.php" class="btn btn-info">Batch List</a></center>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
