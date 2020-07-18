<?php

  include_once('../created/header2.php');
  include_once('../created/sidebar.php');
  include_once('../created/pageheader.php');
  include_once('../includes/dbcon.php');


$row = 1;
if (($handle = fopen("../uploads/studentlist/temporary.csv", "r")) !== FALSE) {
    $data = fgetcsv($handle, 1000);
        $num = count($data);
      
      
        for ($c=0; $c < $num; $c++){
            // echo $data[$c].",";
        }

    
}
?>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12 col-xs-12 col-lg-12">
            <div class="card">
              <div class="card-body">
                <form action="importstudentsdetailssubmit.php" method="post" enctype="multipart/form-data">
                  <h4 style="text-align:center;"><strong><u>Student Details</u></strong></h4>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="" class="label">Name:</label>
                      <select name="name" id="name" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Username:</label>
                      <select name="username" id="username" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Password:</label>
                      <select name="password" id="password" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <!-- <div class="col-md-3">
                      <label for="" class="label">Role:</label>
                      <select name="role" id="role" class="form-control" >
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div> -->
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="" class="label">Class:</label>
                      <select name="class" id="class" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Section:</label>
                      <select name="section" id="section" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Father'sname:</label>
                      <select name="fathersname" id="fathersname" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Mother's Name:</label>
                      <select name="mothersname" id="mothersname" class="form-control">
                       <option value="none">none</option>
                       <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="" class="label">Mobileno:</label>
                      <select name="mobileno" id="mobileno" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">DOB:</label>
                      <select name="dob" id="dob" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Address:</label>
                      <select name="address" id="address" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="" class="label">Email:</label>
                      <select name="email" id="email"  class="form-control" >
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label for="" class="label">Batch:</label>
                      <select name="batch" id="batch" class="form-control">
                        <option value="none">none</option>
                        <?php 
                          $num = count($data); 
                          for ($c=0; $c < $num; $c++){
                              echo '<option value="'.$c.'">'.$data[$c].'</option>';
                          } 
                        ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <center>
                     <button type="submit" class="btn btn-primary" style="margin-left:20%;">Submit</button>
                   </center>
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

 <?php 
 fclose($handle);
  ?>

