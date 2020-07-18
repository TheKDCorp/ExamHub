  <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

	  <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <a data-toggle="modal" data-target="#createalbum" style="color:white;" class="btn btn-info">Create Album</a>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>

       <div class="modal fade" id="createalbum" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Album</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="myapi.php">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                      <label for="name">Album Name:</label>
                      <textarea name="eventdetails" id="eventdetails" class="form-control" autofocus="true"></textarea>
                      <input type="hidden" name="method" value="addalbumingallery">
                  </div>
                </div>
                <br>
                <center>
                 <button type="submit" id="addmyalbum" class="btn btn-primary">Add Album</button>
                </center>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
