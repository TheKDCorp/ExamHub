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
    $("#mytitle").text("Admin Account Add New");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                 <form action="adminaccountaddnewsubmit.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                        <label for="username">Username:</label>
                        <input type="email" class="form-control" id="username" name="username" required="true">
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required="true">
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
