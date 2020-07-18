
<script src="../assets/js/core/bootstrap.min.js"></script>
    <link href="./assets/Quiz/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/custom.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/Quiz/css/style.default.css" rel="stylesheet" />
       <script src="assets/Quiz/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/Quiz/js/bootstrap.min.js" type="text/javascript"></script>
        <?php 
        include_once('../includes/dbcon.php');
        
        $cid = $_GET['cid'];
        $qindex = $_GET['qindex'];
        $examname = $_GET['examname'];

    $sql = "select * from answers_new where cid='$cid' and qindex='$qindex' and examname='$examname'";
    $result=$conn->query($sql);
    if($result->num_rows > 0){
      $qno = 0;
      while($row = $result->fetch_assoc()){
        $qno = $qno + 1;
        $qid = $row['qid'];
        $sql1="select * from questionentry where qid='$qid'";
        $result1=$conn->query($sql1);
        if($result1->num_rows > 0){
          $row1 = $result1->fetch_assoc();
          $sql = "select * from settings limit 1";
          $rs1=$conn->query($sql);
          if($rs1->num_rows > 0){
            $settings = $rs1->fetch_assoc();
          }
          if($settings['srnotype']=="alphabets"){
            if($correctoption == "1"){
              $correctoption="A";
            }elseif($correctoption=="2"){
              $correctoption = "B";
            }elseif($correctoption=="3"){
              $correctoption = "C";
            }elseif ($correctoption == "4") {
              $correctoption = "D";
            }

            if($myanswer == "1"){
              $myanswer="A";
            }elseif($myanswer=="2"){
              $myanswer = "B";
            }elseif($myanswer=="3"){
              $myanswer = "C";
            }elseif ($myanswer == "4") {
              $myanswer = "D";
            }
          }else{ 
          }
    
          if($row1['question']!="" || $row1['imgid']!=""){
            $question = "true";
          }else{
            $question = "false";
          }
          if($row1['option1']!="" || $row1['opt1img']!=""){
            $option1 = "true";
          }else{
            $option1 = "false";
          }
          if($row1['option2']!="" || $row1['opt2img']!=""){
            $option2 = "true";
          }else{
            $option2 = "false";
          }
          if($row1['option3']!="" || $row1['opt3img']!=""){
            $option3 = "true";
          }else{
            $option3 = "false";
          }
          if($row1['option4']!="" || $row1['opt4img']!=""){
            $option4 = "true";
          }else{
            $option4 = "false";
          }
          ?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="card" style="border: 1px solid rgba(0,0,0,.125);">
                  <div class="card-body">
                    <?php
                    if($question == "true"){
                      ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <?php
                              echo "<h3>".$qno . ") </h3>";
                              if($row1['question']!= ""){
                                echo $row1['question']; 
                                echo "<br>";                                                        
                              }

                              if($row1['imgid']!=""){?>
                                <img alt="Question" src="../admin/uploads/questions/<?php echo md5($row1['imgid']); ?>.jpg" class="img-responsive"><br>
                                <?php 
                              }
                                ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                      if($option1!="" || $option2!=""){
                       ?>
                         <div class="row">
                          <?php
                          if($option1 == "true"){
                            ?>
                            <div class="col-lg-6">
                              <div class="card">
                                <div class="card-body">
                                  <?php
                                  if($row1['option1']!= ""){
                                      echo "<br>(1) ";
                                      echo $row1['option1'];                                                        
                                  }
                                  if($row1['opt1img']!= ""){
                                      echo "<br>(1) ";
                                      ?>
                                      <img alt="Option" src="../admin/uploads/questions/options/<?php echo md5($row1['opt1img']); ?>.jpg" class="img-responsive"><br>
                                      <?php                                                       
                                  }
                                  ?>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                          if($option2 == "true"){
                            ?>
                            <div class="col-lg-6">
                              <div class="card">
                                <div class="card-body">
                                    <?php
                                      if($row1['option2']!= ""){
                                          echo "<br>(2) ";
                                          echo $row1['option2'];                                                         
                                      }
                                      if($row1['opt2img']!= ""){
                                          echo "<br>(2) ";
                                          ?>
                                          <img alt="Option" src="../admin/uploads/questions/options/<?php echo md5($row1['opt2img']); ?>.jpg" class="img-responsive"><br>
                                          <?php                                                           
                                      }
                                      ?>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                          ?>  
                        </div>
                       <?php
                      }
                      if($option3!="" || $option4!=""){
                        ?>
                        <div class="row">
                          <?php 
                          if($option3 == "true"){
                            ?>
                            <div class="col-lg-6">
                              <div class="card">
                                <div class="card-body">
                                    <?php
                                    if($row1['option3']!= ""){
                                        echo "<br>(3) ";
                                        echo $row1['option3'];                                                         
                                    }
                                    if($row1['opt3img']!= ""){
                                        echo "<br>(3) ";
                                        ?>
                                        <img alt="Option" src="../admin/uploads/questions/options/<?php echo md5($row1['opt3img']); ?>.jpg" class="img-responsive"><br>
                                        <?php                                                        
                                    }
                                    ?>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                          if($option4 == "true"){
                            ?>
                            <div class="col-lg-6">
                              <div class="card">
                                <div class="card-body">
                                    <?php
                                    if($row1['option4']!= ""){
                                        echo "<br>(4) ";
                                        echo $row1['option4'];                                                         
                                    }
                                    if($row1['opt4img']!= ""){
                                        echo "<br>(4) ";
                                        ?>
                                        <img alt="Option" src="../admin/uploads/questions/options/<?php echo md5($row1['opt4img']); ?>.jpg" class="img-responsive"><br>
                                        <?php                                                        
                                    }
                                    ?>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                          ?>
                        </div>
                      <?php 
                      }
                      ?>
                    <?php
                    } 
                    ?>
                  </div>
                </div>
              </div>
            </div>
           </div>
           <?php
        }
      }
    }
   ?>