<?php 
include_once('../includes/dbcon.php');
include_once('../created/header.php');

    $cid = addslashes(htmlspecialchars($_GET['cid'], ENT_QUOTES));
    $examname = addslashes(htmlspecialchars($_GET['examname'], ENT_QUOTES));
    $qindex = addslashes(htmlspecialchars($_GET['qindex'], ENT_QUOTES));

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	  <link href="../assets/fonts/myfont.css?family=Montserrat:400,700,200" rel="stylesheet" />
	  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	  <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
	  <link href="../assets/demo/demo.css" rel="stylesheet" />
	  <script type="text/x-mathjax-config">
		  MathJax.HTML.Cookie.Set("menu",{});
		  MathJax.Hub.Config({
		    extensions: ["tex2jax.js"],
		    jax: ["input/TeX","output/HTML-CSS"],
		    "HTML-CSS": {
		      availableFonts:[],
		      styles: {".MathJax_Preview": {visibility: "hidden"}}
		    }
		  });
		  MathJax.Hub.Register.StartupHook("HTML-CSS Jax Ready",function () {
		    var FONT = MathJax.OutputJax["HTML-CSS"].Font;
		    FONT.loadError = function (font) {
		      MathJax.Message.Set("Can't load web font TeX/"+font.directory,null,2000);
		      document.getElementById("noWebFont").style.display = "";
		    };
		    FONT.firefoxFontError = function (font) {
		      MathJax.Message.Set("Firefox can't load web fonts from a remote host",null,3000);
		      document.getElementById("ffWebFont").style.display = "";
		    };
		  });
		  (function (HUB) {

		    var MINVERSION = {
		      Firefox: 3.0,
		      Opera: 9.52,
		      MSIE: 6.0,
		      Chrome: 0.3,
		      Safari: 2.0,
		      Konqueror: 4.0,
		      Unknown: 10000.0 // always disable unknown browsers
		    };

		    if (!HUB.Browser.versionAtLeast(MINVERSION[HUB.Browser]||0.0)) {
		      HUB.Config({
		        jax: [],                   // don't load any Jax
		        extensions: [],            // don't load any extensions
		        "v1.0-compatible": false   // skip warning message due to no jax
		      });
		      setTimeout('document.getElementById("badBrowser").style.display = ""',0);
		    }

		  })(MathJax.Hub);

		  MathJax.Hub.Register.StartupHook("End",function () {
		    var HTMLCSS = MathJax.OutputJax["HTML-CSS"];
		    if (HTMLCSS && HTMLCSS.imgFonts) {document.getElementById("imageFonts").style.display = ""}
		  });
		</script>

		<script type="text/javascript" src="../mathjax/MathJax.js"></script>

		<script type="text/javascript">
		  MathJax.Hub.Config({
		    tex2jax: {
		           inlineMath: [ ['$','$'], ['\\(','\\)'] ]
		    }
		  });
		</script>
</head>
<body>
	<br>
	<?php 
		$sql = "select * from answers where cid='$cid' and qindex='$qindex' and examname='$examname'";
		$result=$conn->query($sql);
		if($result->num_rows > 0){
			$qno = 0;
			while($row = $result->fetch_assoc()){
				$qno = $qno + 1;
				$qid = $row['qid'];
				$sql1= "select * from questionpaper where name='$examname'";
                $result1=$conn->query($sql1);
                if($result1->num_rows > 0){
                  $row1=$result1->fetch_assoc();
                  $srnotype = $row1['srnotype'];
                }
				$sql1="select * from questionentry where qid='$qid'";
				$result1=$conn->query($sql1);
				if($result1->num_rows > 0){
					$row1 = $result1->fetch_assoc();
					$correctoption = $row1['correctoption'];
					$myanswer = $row['choosedoption'];

                    $sql = "select * from settings limit 1";
                    $rs1=$conn->query($sql);
                    if($rs1->num_rows > 0){
                      $settings = $rs1->fetch_assoc();
                    }

                    if($srnotype=="alphabets"){
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
                      if($correctoption == "1"){
                      	$correctoption="1";
                      }elseif($correctoption=="2"){
                      	$correctoption = "2";
                      }elseif($correctoption=="3"){
                      	$correctoption = "3";
                      }elseif ($correctoption == "4") {
                      	$correctoption = "4";
                      }

                      if($myanswer == "1"){
                      	$myanswer="1";
                      }elseif($myanswer=="2"){
                      	$myanswer = "2";
                      }elseif($myanswer=="3"){
                      	$myanswer = "3";
                      }elseif ($myanswer == "4") {
                      	$myanswer = "4";
                      }
                    }

                    if($myanswer == ""){
                    	$myanswer = "BLANK";
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

					if($row['status']=="correct"){
						$status = "correct";
					}else{
						if($row['choosedoption'] == ""){
							$status = "blank";
						}else{
							$status = "incorrect";
						}
					}

					?>
					<div class="container-fluid">
	 					<div class="row">
	 						<div class="col-lg-12">
	 							<div class="card" <?php if($status=="correct"){echo 'style="box-shadow: 0 0 8px 2px #5cb85c;"';}elseif($status=="incorrect"){echo 'style="box-shadow: 0 0 8px 2px #d9534f;"';} ?>>
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
						                                              if($row1['option1']!= "" && $row1['opt1img']!= ""){
						                                              	if($srnotype=="alphabets"){
																			echo "<br>(A) ";
						                                              	}else{
						                                              		echo "<br>(1) ";
						                                              	} 
		                                                                  echo $row1['option1'];
		                                                                  ?>
		                                                                  <br>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt1img']); ?>.jpg" class="img-responsive"><br>
		                                                                  <?php
		                                                              }elseif($row1['option1']!= ""){
		                                                                if($srnotype=="alphabets"){
																			echo "<br>(A) ";
						                                              	}else{
						                                              		echo "<br>(1) ";
						                                              	} 
		                                                                 echo $row1['option1'];

		                                                              }elseif($row1['opt1img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(A) ";
						                                              	}else{
						                                              		echo "<br>(1) ";
						                                              	} 
		                                                                  ?>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt1img']); ?>.jpg" class="img-responsive"><br>
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
						                                              if($row1['option2']!= "" && $row1['opt2img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(B) ";
						                                              	}else{
						                                              		echo "<br>(2) ";
						                                              	} 
		                                                                  echo $row1['option2'];
		                                                                  ?>
		                                                                  <br>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt2img']); ?>.jpg" class="img-responsive"><br>
		                                                                  <?php
		                                                              }elseif($row1['option2']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(B) ";
						                                              	}else{
						                                              		echo "<br>(2) ";
						                                              	} 
		                                                                  echo $row1['option2'];
		                                                                  
		                                                              }elseif($row1['opt2img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(B) ";
						                                              	}else{
						                                              		echo "<br>(2) ";
						                                              	} 
		                                                                  ?>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt2img']); ?>.jpg" class="img-responsive"><br>
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
						                                              if($row1['option3']!= "" && $row1['opt3img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(C) ";
						                                              	}else{
						                                              		echo "<br>(3) ";
						                                              	} 
		                                                                  echo $row1['option3'];
		                                                                  ?>
		                                                                  <br>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt3img']); ?>.jpg" class="img-responsive"><br>
		                                                                  <?php
		                                                              }elseif($row1['option3']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(C) ";
						                                              	}else{
						                                              		echo "<br>(3) ";
						                                              	} 
		                                                                  echo $row1['option3'];
		                                                                  
		                                                              }elseif($row1['opt3img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(C) ";
						                                              	}else{
						                                              		echo "<br>(3) ";
						                                              	} 
		                                                                  ?>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt3img']); ?>.jpg" class="img-responsive"><br>
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
						                                              if($row1['option4']!= "" && $row1['opt4img']!= ""){
		                                                                  if($srnotype=="alphabets"){
																			echo "<br>(D) ";
						                                              	}else{
						                                              		echo "<br>(4) ";
						                                              	} 
		                                                                  echo $row1['option4'];
		                                                                  ?>
		                                                                  <br>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt4img']); ?>.jpg" class="img-responsive"><br>
		                                                                  <?php
		                                                              }elseif($row1['option4']!= ""){
		                                                                   if($srnotype=="alphabets"){
																			echo "<br>(D) ";
						                                              	}else{
						                                              		echo "<br>(4) ";
						                                              	} 
		                                                                  echo $row1['option4'];
		                                                                  
		                                                              }elseif($row1['opt4img']!= ""){
		                                                                   if($srnotype=="alphabets"){
																			echo "<br>(D) ";
						                                              	}else{
						                                              		echo "<br>(4) ";
						                                              	} 
		                                                                  ?>
		                                                                  <img alt="Question" src="../admin/uploads/questions/options/<?php echo md5($row1['opt4img']); ?>.jpg" class="img-responsive"><br>
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
				 							<div class="row">
				 								<div class="col-lg-6">
				 									<div class="card">
						 								<div class="card-body">
						 									  <?php
						 									  echo "<h3>Correct Answer: ".$correctoption."</h3>";
				                                              ?>
						 								</div>
						 							</div>
				 								</div>
				 								<div class="col-lg-6">
				 									<div class="card">
						 								<div class="card-body">
						 									  <?php
						 									  echo "<h3>Your Answer: ".$myanswer."</h3>";
				                                              ?>
						 								</div>
						 							</div>
				 								</div>
				 							</div>
				 							<?php if($row1['solution']!="" || $row1['solutionimg']!==""){
				 								?>
				 							<div class="row">
				 								<div class="col-lg-12">
				 									<div class="card">
						 								<div class="card-body">
						 									  <?php
						 									  echo "<h3>Solution: </h3><br>";
						 									  if($row1['solution']!=""){
						 									  	echo $row1['solution'];
						 									  }
						 									  if($row1['solutionimg']!=""){
						 									  	$solutionimg = $row1['solutionimg'];
						 									  	echo '<img src="../admin/uploads/answers/'.md5($solutionimg).'.jpg" class="img-responsive">';
						 									  }
				                                              ?>
						 								</div>
						 							</div>
				 								</div>
				 							</div>
				 							<?php 
				 							} ?>
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



</body>
</html>