 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php
$sql = "select * from settings";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{

}

 ?>


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
    $("#mytitle").text("Preferences");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form action="preferencessubmit.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="practisetest">Practise Test:</label>
                        <select class="form-control" id="practisetest" name="practisetest">
                          <option value="true" <?php if($row['practisetestallowed'] == "true"){echo " selected";} ?>>On</option>
                          <option value="false" <?php if($row['practisetestallowed'] == "false"){echo " selected";} ?>>Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="logs">Generate Logs:</label>
                        <select class="form-control" id="logs" name="logs">
                          <option value="true" <?php if($row['logs'] == "true"){echo " selected";} ?>>On</option>
                          <option value="false" <?php if($row['logs'] == "false"){echo " selected";} ?>>Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                        <label for="tracking">User Tracking:</label>
                        <select class="form-control" id="tracking" name="tracking">
                          <option value="true" <?php if($row['tracking'] == "true"){echo " selected";} ?>>On</option>
                          <option value="false" <?php if($row['tracking'] == "false"){echo " selected";} ?>>Off</option>
                        </select>
                    </div>
                  </div>
                  <br>
                  <hr>
                  <br>     
                  <center>
                    <input type="hidden" name="sid" value="<?php echo $row['sid']; ?>">
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
