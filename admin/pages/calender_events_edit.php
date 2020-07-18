
 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<?php 
$eventid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['eventid']))));
$sql = "SELECT * FROM calender_events where eventid='$eventid'";
$result = $conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{
  exit();
}
 ?>


	  <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              	<form action="calender_events_editsubmit.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <label for="name">Event Details:</label>
                          <?php $details = $row['details'];
                          $details = str_replace("/n","\n",$details);
                          $details = str_replace("_"," ",$details);
                           ?> 

                          <input type="text" name="eventdetails" id="eventdetails" class="form-control" autofocus="true" value="<?php echo $details; ?>">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                          <label for="examdate">Event Date</label>
                          <input type="date" class="form-control" id="eventdate" autocomplete="false" name="eventdate" required value="<?php echo $row['fulldate']; ?>">
                      </div>
                    </div>
                    <br>
                    <center>
                      <input type="hidden" name="eventid" value="<?php echo $row['eventid']; ?>">
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
