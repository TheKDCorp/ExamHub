
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
    $("#mytitle").text("Track Live Users");
});
</script>

<?php 


 ?>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
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
                <div class="card-header">
                  <div>
                     <?php echo '<a href="students.php" class="btn btn-primary">List Students</a>';?>
                  </div>
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                  <?php 
                    $sql = "SELECT * FROM students where loggedin='true' and page!=''";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Mobile No.</th>
                          <th>Status</th>
                          <th>Current Page</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td>" ."<td>" . $row['class'] . "</td>" ."<td>" . $row['section'] . "</td>" ."<td>" . $row['mobileno'] . "</td>"."<td>" . $row['loggedin'] . "</td><td>" . $row['page'];
                              if($row['page']=="Exam Window"){
                                echo " --> Exam Name: '".strtoupper($row['examname'])."'";
                              }
                              echo "</td><td><a href='viewstudent.php?id=".$row['sid']."' class='btn btn-info'>View</a>&nbsp&nbsp<a href='viewexamhistory.php?id=".$row['sid']."' class='btn btn-info'>Exam History</a></td></tr>";
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
