 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 

$cid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));
$sql = "select * from students where sid = '$cid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{
  echo "No. Record Found!!!";
  exit();
}

 ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Student Details");
});
</script>

<style type="text/css">
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 15%;
    border-radius:5px;
}
</style>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
 <form action="profilesubmit.php" method="post" enctype="multipart/form-data">
                                  <div>                               <center>
                                      <img src="../profile/<?php echo md5($row['imgsrc']).'jt'.md5($row['imgsrc']); ?>.jpg" alt="No Image Is Choosen!!!">
                                        
                                    </center>
                                    <br>
                                    <br>
                                    <center>
                                      <input type="file" name="file">
                                    </center>
                                    <br>
                                    <br>
                                    <hr>
                                    </div>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required="true" value="<?php echo $row['name']; ?>">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="dob">Dob:</label>
                                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="fathersname">Father's name:</label>
                                        <input type="text" class="form-control" id="fathersname" name="fathersname" value="<?php echo $row['fathersname']; ?>">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="mothersname">Mother's Name:</label>
                                        <input type="text" class="form-control" id="mothersname" name="mothersname" value="<?php echo $row['mothersname']; ?>">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="batch">Batch:</label>
                                        <select class="form-control" id="batch" name="batch">
                                          <option value="none">None</option>
                                          <?php 
                                            $sql1 = "select * from studentbatchentry";
                                            $result1=$conn->query($sql1);
                                            if($result1->num_rows > 0){
                                              while($row1=$result1->fetch_assoc()){
                                                echo '<option value="'.$row1["name"].'"';
                                                if($row1['name']==$row['batch']){
                                                  echo " selected ";
                                                }
                                                echo '>'.$row1["name"].'</option>';
                                              }
                                            }
                                           ?>                                            
                                          </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="class">Class:</label>
                                        <select class="form-control" id="class" name="class">
                                          <option value="Class 1" <?php if($row['class'] == "Class 1"){echo " selected";} ?>>Class 1</option>
                                          <option value="Class 2" <?php if($row['class'] == "Class 2"){echo " selected";} ?>>Class 2</option>
                                          <option value="Class 3" <?php if($row['class'] == "Class 3"){echo " selected";} ?>>Class 3</option>
                                          <option value="Class 4" <?php if($row['class'] == "Class 4"){echo " selected";} ?>>Class 4</option>
                                          <option value="Class 5" <?php if($row['class'] == "Class 5"){echo " selected";} ?>>Class 5</option>
                                          <option value="Class 6" <?php if($row['class'] == "Class 6"){echo " selected";} ?>>Class 6</option>
                                          <option value="Class 7" <?php if($row['class'] == "Class 7"){echo " selected";} ?>>Class 7</option>
                                          <option value="Class 8" <?php if($row['class'] == "Class 8"){echo " selected";} ?>>Class 8</option>
                                          <option value="Class 9" <?php if($row['class'] == "Class 9"){echo " selected";} ?>>Class 9</option>
                                          <option value="Class 10" <?php if($row['class'] == "Class 10"){echo " selected";} ?>>Class 10</option>
                                          <option value="Class 11" <?php if($row['class'] == "Class 11"){echo " selected";} ?>>Class 11</option>
                                          <option value="Class 12" <?php if($row['class'] == "Class 12"){echo " selected";} ?>>Class 12</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="section">Section:</label>
                                        <input type="text" class="form-control" id="section" name="section" value="<?php echo $row['section']; ?>">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="mobileno">Mobile No.:</label>
                                        <input type="text" class="form-control" id="mobileno" minlength="10" name="mobileno" value="<?php echo $row['mobileno']; ?>">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="username">User Name:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $row['password']; ?>" required>
                                    </div>
                                  </div>
                                  <br>
                                  <hr>
                                  <br>     
                                  <center>
                                    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                  </center>
                                </form>
              </div>
            </div>
          </div>
        </div>
      </div>



  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
