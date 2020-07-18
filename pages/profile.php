  <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 

$cid = $_COOKIE['user_id'];
$sql = "select * from students where sid = '$cid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}else{
  echo "No. Record Found!!!";
  exit();
}

 ?>

 <?php 

$sid = $cid;

$sql = "select * from settings limit 1";
$rs1=$conn->query($sql);
if($rs1->num_rows > 0){
  $settings = $rs1->fetch_assoc();
  if($settings['logs']=="true"){
    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date('Y/m/d h:i:s a', time());
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $IP = $_SERVER["HTTP_CLIENT_IP"];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $IP = $_SERVER['REMOTE_ADDR'];
    }
    $mycomputername = gethostbyaddr($IP); 
    $sql = "insert into logs(lid,macaddress,devicename,cid,message,datetime)values(DEFAULT,'$IP','$mycomputername','$sid','Clicked Profile','$timestamp')";
    $conn->query($sql);
  }
  if($settings['tracking']=="true"){
    $sql = "update students set page='Profile View' where sid='$sid'";
    $conn->query($sql);
  }
}
 ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("My Profile");
});

  function updatepage(){
      var mysid=<?php echo $sid; ?>;
      var page="Profile View";
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: "updatepage='true'&page='"+page+"'&examname=''&sid='"+mysid+"'",
        success: function(data) {
        }
      });
    }

    $(document).ready(function() {
      setInterval(function(){ 
         updatepage();
      }, 3000);
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

input[type="text"]:disabled{
    background: white;
}
input[type="date"]:disabled{
    background: white;
}
#class:disabled{
    background-color: white;
    font-color:black;
}

</style>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div>
                  <center>
                     <?php 
                      $imgsrc = $row['imgsrc'];
                      $imglink = "../admin/profile/".md5($imgsrc)."jt". md5($imgsrc).".jpg";
                      if (file_exists($imglink)){
                       ?>
                        <img src="../admin/profile/<?php echo md5($row['imgsrc'])."jt".md5($row['imgsrc']); ?>.jpg" alt="Image Unavailable!!!">
                        <?php 
                        }else{
                          ?>
                          <img src="../admin/images/profile.jpg" alt="No Image File Chosen!!!">
                          <?php
                        }
                      ?>
                  </center>
                  <br>
                  <br>
                  <hr>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" name="name" required="true" value="<?php echo str_replace("_"," ",$row['name']); ?>" disabled>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="dob">Dob:</label>
                      <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob']; ?>" disabled>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="fathersname">Father's name:</label>
                      <input type="text" class="form-control" id="fathersname" name="fathersname" value="<?php echo str_replace("_"," ",$row['fathersname']); ?>" disabled>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="mothersname">Mother's Name:</label>
                      <input type="text" class="form-control" id="mothersname" name="mothersname" value="<?php echo str_replace("_"," ",$row['mothersname']); ?>" disabled>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="class">Class:</label>
                      <select class="form-control" id="class" name="class" disabled>
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
                      <input type="text" class="form-control" id="section" name="section" value="<?php echo str_replace("_"," ",$row['section']); ?>" required disabled>
                  </div>
                  <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                      <label for="batch">Batch:</label>
                      <input type="text" class="form-control" id="batch" name="batch" value="<?php echo str_replace("_"," ",$row['batch']); ?>" required disabled>
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="mobileno">Mobile No.:</label>
                      <input type="text" class="form-control" id="mobileno" name="mobileno" value="<?php echo str_replace("_"," ",$row['mobileno']); ?>" required disabled>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo str_replace("_"," ",$row['address']); ?>" disabled>
                  </div>
                </div>
                <br>
                <hr>
                <br> 

                <?php if($row['updated']=="false"){
                  ?>

                    <form action="profilesubmit.php" method="post">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="username">Email:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo str_replace("_"," ",$row['username']); ?>" disabled>
                      </div>
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="password">Password:</label>
                          <input type="password" name="password" id="password" class="form-control" value="<?php echo $row['password']; ?>" required>
                      </div>
                    </div>
                    <br>
                    <center>
                      <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                      <input type="hidden" name="oldusername" value="<?php echo $row['username']; ?>">
                     <button type="submit" class="btn btn-primary">Submit</button>
                    </center>
                    </form>
                    <hr> 
                    
                <?php 
                } ?> 

              </div>
            </div>
          </div>
        </div>
      </div>



  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
