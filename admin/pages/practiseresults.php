
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');
  ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Practise Test Results");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
    });

</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <center><h2 class="text">Original Exam</h2></center>
                      <hr>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  <?php 
                    $sql = "SELECT * FROM results where examtype='practisetest' group by(examname) order by rid desc";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                      
                        <tr>
                          <th>Id</th>
                          <th>Exam Name</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $examno=0;
                            while($row = $result->fetch_assoc()) {
                              $examno = $examno + 1;
                              
                              $qpname = $row['examname'];
                              $sql2 = "select * from questionpaper where name='$qpname'";
                              $result2=$conn->query($sql2);
                              if($result2->num_rows > 0){
                                $row2 = $result2->fetch_assoc();
                                $qpid = $row2['qpid'];
                              }else{
                                $qpid="";
                              }
                                echo "<tr><td>" . $examno . "</td>"."<td>" . $row['examname'] . "</td>"."<td>" . date("d-m-Y", strtotime($row['date'])) . "</td>"."<td><a href='testlist.php?en=".md5($row['examname'])."&type=".md5('practisetest')."' class='btn btn-info'>List Attempts</a>&nbsp&nbsp&nbsp<a href='generateresult.php?en=".$row['examname']."&type=".'practisetest'."' class='btn btn-info'>Publish Result</a>&nbsp&nbsp&nbsp<a href='recalculateresults.php?qpid=".$qpid."' class='btn btn-info'>Recalculate Results</a>&nbsp&nbsp&nbsp<a href='rankgeneration.php?qpid=".$qpid."&type=".md5('practisetest')."' class='btn btn-info'>Generate Rank</a>&nbsp&nbsp&nbsp<a href='trackusers.php?en=".md5($row['examname'])."&type=".md5('practisetest')."' class='btn btn-info'>Track Users</a>&nbsp&nbsp&nbsp</td></tr>";
                            
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

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
