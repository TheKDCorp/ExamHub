 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<style type="text/css">
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 15%;
    border-radius:5px;
}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Students Batch Add New");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                 <form action="studentbatchaddnewsubmit.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required="true">
                    </div>
                  </div>
                  <br>
                  <hr>
                  <br>     
                  <center>
                   <button type="submit" class="btn btn-primary">Submit</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
