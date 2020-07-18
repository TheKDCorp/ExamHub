 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 
$sql = "SELECT * FROM calender_events";
$result = $conn->query($sql);
 ?>

<script>
$(window).load(function() {
    $('#loading_wrap').fadeOut(5000);
  });
</script>

 <div id='loading_wrap' style='position:fixed; height:100%; width:100%; overflow:hidden; top:0; left:0;'>Loading, please wait.</div>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h6 class="title">
                  <button class="btn btn-primary" onClick ="$('#example').tableExport({type:'excel',escape:'false',ignoreColumn:'[6]'});">Excel</button>
                  <button class="btn btn-default" onClick ="$('#example').tableExport({type:'csv',escape:'false',ignoreColumn:'[6]'});">CSV</button>
                  <button class="btn btn-default" onClick ="$('#example').tableExport({type:'txt',escape:'false',ignoreColumn:'[6]'});">Text</button>
                  <button class="btn btn-default" onClick ="$('#example').tableExport({type:'doc',escape:'false',ignoreColumn:'[6]'});">Doc</button>
                  <button class="btn btn-default" onClick ="$('#example').tableExport({type:'sql',escape:'false',ignoreColumn:'[6]'});">Sql</button>

                  <a class="btn btn-default" style="float:right;color:white;" href="">Refresh</a>
                  <a class="btn btn-primary" style="float:right;color:white;" href="calender_events_addnew.php">Add New</a>
                </h6>
                <div class='' style="">
                  
                </div>
              </div>
              <hr>
              <div class="card-body">
                <div class="table-responsive" style="overflow:hidden;">
                  <table class="table table-striped table-bordered" style="width:100%;">
                    <thead class="text-primary">
                      <tr>
                          <th>Event ID</th>
                          <th>Details</th>
                          <th>Date</th>
                          <th>Functions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                            if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $details = $row['details'];
                                $details = str_replace("/n"," , ",$details);
                                $details = str_replace("_"," ",$details);
                                 
                              echo "<tr><td>" . $row['eventid'] . "</td>" ."<td>" . $details . "</td>" ."<td>" . $row['fulldate'] . "</td><td><a href='calender_events_edit.php?eventid=".$row['eventid']."' class='btn btn-info'>Edit</a>&nbsp&nbsp&nbsp<a href='calender_events_delete.php?eventid=".$row['eventid']."' class='btn btn-danger'>Delete</a></td><tr>";
                          }
                      } 
                    ?>
                    </tbody>
                  </table>
                </div>
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
