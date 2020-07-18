 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>
<?php 

  $cid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));

 ?>

<?php 
  $sql = "select * from settings limit 1";
  $rs1=$conn->query($sql);
  if($rs1->num_rows > 0){
    $settings = $rs1->fetch_assoc();
  }
 ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Reset Exam Attempt");
});
</script>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
               	<center>
                                  <h3>Please Choose Exam To Reset Attempt...</h3>
                                  <br>
                                  <hr>
                                  <br>
                                  <div class="row">
                                    <div class="<?php if($settings['practisetestallowed']=="true"){echo 'col-sm-6';}else{echo 'col-sm-12';} ?>">
                                      <center>
                                        <h4>Original Test</h4>
                                      </center>
                                      <hr>
                                      <table class="table table-bordered table-striped" style="max-height: 200px;">
                                        <tr>
                                          <th>Exam Name</th>
                                          <th>Date</th>
                                          <th>Function</th>
                                        </tr>
                                        <?php 
                                        $sql = "select * from questionpaper where examtype='originaltest' and hidden='false' order by examdate desc";
                                          $result = $conn->query($sql);
                                          if($result->num_rows > 0){
                                              while($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                  <td><?php echo $row['name']; ?></td>
                                                  <?php $name = $row['name'];  ?>
                                                  <?php $qpid = $row['qpid'];  ?>
                                                  <?php $examtype = $row['examtype'];  ?>
                                                  <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                                  <td><a href="resetattempt.php?id=<?php echo $cid;?>&examname=<?php echo $name;?>&qpid=<?php echo $qpid;?>&examtype=<?php echo $examtype;?>" style="color:white;" class="btn btn-info">Reset Attempt</a></td>
                                                </tr>
                                              <?php
                                              }
                                          }
                                         ?>
                                      </table>
                                    </div>
                                    <?php 
                                      if($settings['practisetestallowed'] == "true"){
                                        ?>
                                    <div class="col-sm-6">
                                      <center>
                                        <h4>Practise Test</h4>
                                      </center>
                                      <hr>
                                      <table class="table table-bordered table-striped" style="max-height: 200px;">
                                        <tr>
                                          <th>Exam Name</th>
                                          <th>Date</th>
                                          <th>Function</th>
                                        </tr>
                                        <?php 
                                        $sql = "select * from questionpaper where examtype='practisetest' and hidden='false' order by examdate desc";
                                          $result = $conn->query($sql);
                                          if($result->num_rows > 0){
                                              while($row = $result->fetch_assoc()) {
                                                ?>
                                                <tr>
                                                  <td><?php echo $row['name']; ?></td>
                                                  <td><?php echo date("d-m-Y", strtotime($row['examdate'])); ?></td>
                                                  <td><a href="resetattempt.php?id=<?php echo $cid;?>&examname=<?php echo $name;?>&qpid=<?php echo $qpid;?>&examtype=<?php echo $examtype;?>" style="color:white;" class="btn btn-info">Reset Attempt</a></td>
                                                </tr>
                                              <?php
                                            }
                                          }
                                         ?>
                                      </table>
                                    </div>
                                  <?php 
                                        }
                                     ?>
                                  </div>
                                  <br>
                                  <br>
                                 
                                </center>

              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').dataTable({
        "columnDefs": [{
          "defaultContent": "-",
          "targets": "_all",
        }]
      });
      table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
  });
  </script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
