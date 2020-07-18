
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
    $("#mytitle").text("Student Batch Entry");
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
                        columns: [0,1]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1]
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
                  <div><a href="studentbatchaddnew.php" class="btn btn-primary">Add New</a>
                    </div>    
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                  <?php 
                    $sql = "SELECT * FROM studentbatchentry";
                    $result = $conn->query($sql);
                  ?>
                  <table id="example" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                          <th>Batch Id</th>
                          <th>Batch Name</th>
                          <th>Functions</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            if($result->num_rows > 0) {
                              $srno = 0;
                            while($row = $result->fetch_assoc()) {
                              $srno = $srno + 1;
                              echo "<tr><td>" . $srno . "</td>" ."<td>" . $row['name'] . "</td><td><a href='studentbatchedit.php?id=".$row['batchid']."' class='btn btn-info'>Edit</a>&nbsp&nbsp<a href='studentbatchdelete.php?id=".$row['batchid']."' class='btn btn-danger'>Delete</a></td></tr>";
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
