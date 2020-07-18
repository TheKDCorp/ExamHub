<?php

  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');
?>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <form action="importstudentlist.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                      <input type="file" name="file" accept=".csv" style="margin-left:2%;"><span style="position: relative; left:65%;color:red;"><a href="../assets/Examination Portal Dummy Student List.csv" download>**Download Sample Student List**</a></span>
                  </div>
                  <hr>
                  <div class="row">
                       <button type="submit" class="btn btn-primary" style="margin-left:2%;">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

  <?php include_once('../created/pagefooter.php'); ?>
<?php
 include_once('../created/footer2.php');

 ?>

