
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
    $("#mytitle").text("Students Details");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: true,
                 
                    buttons: [
                     {
                    extend: 'colvis'
                  },
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8]
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
              <div class="card-body" style="min-height:60em;">
                <div class="card-header">
                  <div><a href="studentsaddnew.php" class="btn btn-primary">Add New</a>
                    <a href="trackallusers.php" class="btn btn-warning">Track All Users</a>   
                    <a href="generateliveusers.php" class="btn btn-success">Live Users</a>   
                    <a href="students.php" class="btn btn-warning">Activated Students</a>   
                    <a href="importstudents.php" class="btn btn-danger">Import Students</a></div>    
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                  <?php 
                    $sql = "SELECT * FROM students where active!='yes'";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Student Name</th>
                          <th>Dob</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Batch</th>
                          <th>Father's Name</th>
                          <th>Mobile No.</th>
                          <th>User Name</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td>" ."<td>" . $row['dob'] . "</td>" ."<td>" . $row['class'] . "</td>" ."<td>" . $row['section'] . "</td>"."<td>" . $row['batch'] . "</td>" ."<td>" . $row['fathersname'] . "</td><td>" . $row['mobileno'] . "</td><td>" . $row['username'] . "</td><td><a href='viewstudent.php?id=".$row['sid']."' class='btn btn-info'>View</a>&nbsp&nbsp<a href='viewexamhistory.php?id=".$row['sid']."' class='btn btn-info'>Exam History</a>&nbsp&nbsp<a href='resetpassword.php?id=".$row['sid']."' class='btn btn-info'>Reset Password</a>";
                              if($row['active']=="yes"){
                                echo "&nbsp&nbsp<a href='deactivatestudent.php?sid=".$row['sid']."' class='btn btn-warning'>Deactivate Student</a>";
                              }else{
                                echo "&nbsp&nbsp<a href='activatestudent.php?sid=".$row['sid']."' class='btn btn-warning'>Activate Student</a>";
                              }
                              echo "&nbsp&nbsp<a href='deletestudent.php?sid=".$row['sid']."' class='btn btn-danger'>Delete Student</a>";
                              echo "</td></tr>";
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
