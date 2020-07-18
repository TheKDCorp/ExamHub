
 <?php
  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
  
  include_once('../created/datatable.php');
  include_once('../created/datatablecss.php');
  ?>

<?php 

  $examname=addslashes(htmlspecialchars($_GET['en'],ENT_QUOTES));
  $type=addslashes(htmlspecialchars($_GET['type'],ENT_QUOTES));

  $sql = "UPDATE students set loggedin='false',page='',examname='' where loggedin='true'";
  $result = $conn->query($sql);
 ?>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Track Users");
    $("#errorscreen").css("display","block");

    var eling = window.location.href;
    var res = eling.replace("trackusers.php", "trackactiveusers.php");
   
   setTimeout(function() {
     window.location.href = res;
  }, 5000);
   
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

<style type="text/css">
        /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    </style>

<div id="errorscreen" style="position: fixed;z-index:1000;background-color:rgba(0,0,0,0.4);color:rgba(0,0,0,0.7);height:100%;width:90%;display:none;">
    <div class="modal-content">
        <h4><span style="color:red;">Wait!!! </span>We Are Checking Active Users In Our Database.</h4>
    </div>
</div>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="card-header">
                  <div>
                  <?php
                    if($type=="a512311409b3798234b19649fa105a27"){
                       $examtype="practise test";
                       echo '<a href="./practiseresults.php" class="btn btn-warning">All Results</a>';
                    }elseif($type=="c08beeed313883b21aadc5a8068f7ba5"){
                      $examtype="original test";
                      echo '<a href="./results.php" class="btn btn-warning">All Results</a>';
                    }else{
                      echo '<a href="./results.php" class="btn btn-warning">All Results</a>';
                      $examtype="not defined";
                    }
                   ?>
                     <?php echo '<a href="testlist.php?en='.$examname.'&type='.$type.'" class="btn btn-primary">List Attempts</a>';?>
                  </div>
                  <hr>              
                </div>
                <div class="table-responsive" style="overflow-y:hidden;padding-left:20px;">
                  
                 

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
