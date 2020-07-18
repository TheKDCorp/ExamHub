
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');

$qpid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['qpid']))));

$sql5 = "select * from questionpaper where qpid='$qpid'";
$result5=$conn->query($sql5);
if($result5->num_rows > 0){
  $row5 = $result5->fetch_assoc();
  $qpname=$row5['name'];
}
  
?>

    <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">              
                </div>

<?php
  $sqlp1 = "select * from questionpaper where qpid='$qpid'";
  $resultp1=$conn->query($sqlp1);
  if($resultp1->num_rows > 0){
    $rowp1 = $resultp1->fetch_assoc();
    $qpnamep1=$rowp1['name'];
    for ($i=1; $i <= $rowp1['noofparts']; $i++){ 
          $partname = $rowp1['part'.$i.'name'];
          echo '<center><h2>'.$partname.'</h2></center>';
          echo '<hr>';
          $sql = "select * from partsresult where examname='$qpname' and partname='$partname' order by mymarks desc";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            $rank = 0;
            echo '<div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">';
            echo '<table id="example'.$i.'" class="table table-striped table-bordered" style="width:100%;">';
            echo '<thead><tr><td>Rank</td><td>Exam Name</td><td>Mobile No.</td><td>St. Name</td><td>Correct</td><td>Incorrect</td><td>Total Marks</td><td>Percentage</td></tr></thead>';
            echo '<tbody>';
            $srno = 0;
            while($row=$result->fetch_assoc()){
              $srno = $srno + 1;
              $rank = $rank + 1;
              $cid = $row['cid'];
              $examname = $row['examname'];
              $mymarks = $row['mymarks'];
              $totalmarks = $row['totalmarks'];
              $correct = $row['questionscorrect'];
              $incorrect = $row['questionsincorrect'];

              $percentage  = ($mymarks / $totalmarks)*100;
              $percentile = number_format($percentage,2);
              
              $sql1 = "select * from students where sid='$cid'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0){
                $row1 = $result1->fetch_assoc();
                $mobileno = $row1['mobileno'];
                $name = $row1['name'];
              }

              echo '<tr><td>'.$rank.'</td><td>'.$examname.'</td><td>'.$mobileno.'</td><td>'.$name.'</td><td>'.$correct.'</td><td>'.$incorrect.'</td><td>'.$mymarks.'</td><td>'.$percentile.'%</td></tr>';
            }
            echo '</tbody></table></div>';
          }
          echo "<br>";
        } 
    } 



  ?>

              </div>
            </div>
          </div>
        </div>
      </div>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Rank Generation Subject Wise");
});
</script>

<script type="text/javascript">
$(document).ready(function() {
        var table = $('#example1').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );

          var table = $('#example2').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example3').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example4').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example5').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example6').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example7').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example8').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example9').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
            var table = $('#example10').DataTable( {
            lengthChange: true,
                    buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7],
                        download: 'save'
                    }
                },          
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },                
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },

            ]

        } ); 
        table.buttons().container()
            .appendTo( $('div.eight.column:eq(0)', table.table().container()) );
    });

</script>

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>
