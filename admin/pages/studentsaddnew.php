 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>


<style type="text/css">
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 15%;
    border-radius:5px;
}
</style>
<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Students Add New");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
 <form action="studentsaddnewsubmit.php" method="post" enctype="multipart/form-data">
                                  <div>                               <center>
                                      <img src="../images/profile.jpg" alt="No Image Is Choosen!!!">
                                        
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
                                        <input type="text" class="form-control" id="name" name="name" required="true">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="dob">Dob:</label>
                                        <input type="date" class="form-control" id="dob" name="dob">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="fathersname">Father's name:</label>
                                        <input type="text" class="form-control" id="fathersname" name="fathersname">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="mothersname">Mother's Name:</label>
                                        <input type="text" class="form-control" id="mothersname" name="mothersname">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                         <label for="batch">Batch:</label>
                                         <select class="form-control" id="batch" name="batch">
                                          <option value="none">None</option>
                                          <?php 
                                            $sql = "select * from studentbatchentry";
                                            $result=$conn->query($sql);
                                            if($result->num_rows > 0){
                                              while($row=$result->fetch_assoc()){
                                                echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
                                              }
                                            }
                                           ?>                                            
                                          </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="class">Class:</label>
                                        <select class="form-control" id="class" name="class">
                                          <option value="Class 1">Class 1</option>
                                          <option value="Class 2">Class 2</option>
                                          <option value="Class 3">Class 3</option>
                                          <option value="Class 4">Class 4</option>
                                          <option value="Class 5">Class 5</option>
                                          <option value="Class 6">Class 6</option>
                                          <option value="Class 7">Class 7</option>
                                          <option value="Class 8">Class 8</option>
                                          <option value="Class 9">Class 9</option>
                                          <option value="Class 10">Class 10</option>
                                          <option value="Class 11">Class 11</option>
                                          <option value="Class 12">Class 12</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                        <label for="section">Section:</label>
                                        <input type="text" class="form-control" id="section" name="section">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="mobileno">Mobile No.:</label>
                                        <input type="text" class="form-control" id="mobileno" name="mobileno">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                  </div>
                                  <br>
                                  <hr>
                                  <br>     
                                  <center>
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
