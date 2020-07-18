  <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 

if(!empty($_POST['name'])){
	$name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['name']))));
	$totalmarks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['totalmarks']))));
	$totalquestions = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['totalquestions']))));
	$subject = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['subject']))));
	$examtype = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['examtype']))));
	$batch = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['batch']))));
	$time = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['time']))));
	$noofattempts = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['noofattempts']))));
	$examdate = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['examdate']))));
	// $hidden = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['hidden']))));
	$qptype = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['qptype']))));
	$screentype = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['screentype']))));
	$shufflequestions = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['shufflequestions']))));
	$srnotype = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['srnotype']))));
	$entrydate = date('Y-m-d');

	$sql = "select * from questionpaper where name='$name'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		?>
		<div class="panel-header panel-header-sm">
	    </div>
	      <div class="content">
	        <div class="row">
	          <div class="col-md-12">
	            <div class="card">
	              <div class="card-body">
	              	The Question Paper Name You Have Entered is Already Exist... Please use different Question Paper Name !
	              	<hr>
	              	<?php 
	              	$sql1 = "select * from questionpaper order by qpid desc limit 1";
					$result1=$conn->query($sql1);
					if($result1->num_rows > 0){
						$row1= $result1->fetch_assoc();
						$qpid= $row1['qpid'];
						echo '<a href="questionpaperentryedit.php?qpid='.$qpid.'" class="btn btn-primary">Rename Question Paper</a>';
					}else{
						echo '<a href="questionpaperentry.php" class="btn btn-primary">Rename Question Paper</a>';
					}
					 ?>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>

		<?php
					echo '<div style="display:none;">';
		if($noofattempts==""){
			$noofattempts="0";
		}

		$part1name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname1']))));
		$part1topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic1']))));
		$part1marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks1']))));

		$part2name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname2']))));
		$part2topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic2']))));
		$part2marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks2']))));

		$part3name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname3']))));
		$part3topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic3']))));
		$part3marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks3']))));

		$part4name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname4']))));
		$part4topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic4']))));
		$part4marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks4']))));

		$part5name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname5']))));
		$part5topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic5']))));
		$part5marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks5']))));

		$part6name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname6']))));
		$part6topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic6']))));
		$part6marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks6']))));

		$part7name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname7']))));
		$part7topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic7']))));
		$part7marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks7']))));

		$part8name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname8']))));
		$part8topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic8']))));
		$part8marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks8']))));

		$part9name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname9']))));
		$part9topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic9']))));
		$part9marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks9']))));

		$part10name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname10']))));
		$part10topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic10']))));
		$part10marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks10']))));

		$part1noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque1']))));
		$part2noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque2']))));
		$part3noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque3']))));
		$part4noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque4']))));
		$part5noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque5']))));
		$part6noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque6']))));
		$part7noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque7']))));
		$part8noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque8']))));
		$part9noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque9']))));
		$part10noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque10']))));

		$noofparts = 0;
		
		if(($part1name!="") && ($part1topic!="") && ($part1marks!="")){
			$noofparts = 1;
		}
		if(($part2name!="") && ($part2topic!="") && ($part2marks!="")){
			$noofparts = 2;
		}
		if(($part3name!="") && ($part3topic!="") && ($part3marks!="")){
			$noofparts = 3;
		}
		if(($part4name!="") && ($part4topic!="") && ($part4marks!="")){
			$noofparts = 4;
		}
		if(($part5name!="") && ($part5topic!="") && ($part5marks!="")){
			$noofparts = 5;
		}
		if(($part6name!="") && ($part6topic!="") && ($part6marks!="")){
			$noofparts = 6;
		}
		if(($part7name!="") && ($part7topic!="") && ($part7marks!="")){
			$noofparts = 7;
		}
		if(($part8name!="") && ($part8topic!="") && ($part8marks!="")){
			$noofparts = 8;
		}
		if(($part9name!="") && ($part9topic!="") && ($part9marks!="")){
			$noofparts = 9;
		}
		if(($part10name!="") && ($part10topic!="") && ($part10marks!="")){
			$noofparts = 10;
		}

		$sql = "INSERT INTO questionpaper (qpid,name,totalmarks,totalquestions,subject,noofparts,part1name,part1topic,part1marks,part2name,part2topic,part2marks,part3name,part3topic,part3marks,part4name,part4topic,part4marks,part5name,part5topic,part5marks,part6name,part6topic,part6marks,part7name,part7topic,part7marks,part8name,part8topic,part8marks,part9name,part9topic,part9marks,part10name,part10topic,part10marks,time,examtype,noofattempts,examdate,entrydate,hidden,part1noofque,part2noofque,part3noofque,part4noofque,part5noofque,part6noofque,part7noofque,part8noofque,part9noofque,part10noofque,qptype,batch,screentype,error,shufflequestions,srnotype) VALUES (DEFAULT,'$name','$totalmarks','$totalquestions','$subject','$noofparts','$part1name','$part1topic','$part1marks','$part2name','$part2topic','$part2marks','$part3name','$part3topic','$part3marks','$part4name','$part4topic','$part4marks','$part5name','$part5topic','$part5marks','$part6name','$part6topic','$part6marks','$part7name','$part7topic','$part7marks','$part8name','$part8topic','$part8marks','$part9name','$part9topic','$part9marks','$part10name','$part10topic','$part10marks','$time','$examtype','$noofattempts','$examdate','$entrydate','true','$part1noofque','$part2noofque','$part3noofque','$part4noofque','$part5noofque','$part6noofque','$part7noofque','$part8noofque','$part9noofque','$part10noofque','$qptype','$batch','$screentype','true','$shufflequestions','$srnotype')";
		echo $sql;
		$conn->query($sql);
		echo '</div>';

		exit();
	}else{
		?>
		<div class="panel-header panel-header-sm">
	    </div>
	      <div class="content">
	        <div class="row">
	          <div class="col-md-12">
	            <div class="card">
	              <div class="card-body">
	              	Question Paper Submitted!!!
	              	<hr>
	              	<a href="questionpaperentry.php" class="btn btn-primary">Exit</a>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
		<?php
		echo '<div style="display:none;">';
		if($noofattempts==""){
			$noofattempts="0";
		}
		$part1name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname1']))));
		$part1topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic1']))));
		$part1marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks1']))));

		$part2name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname2']))));
		$part2topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic2']))));
		$part2marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks2']))));

		$part3name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname3']))));
		$part3topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic3']))));
		$part3marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks3']))));

		$part4name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname4']))));
		$part4topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic4']))));
		$part4marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks4']))));

		$part5name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname5']))));
		$part5topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic5']))));
		$part5marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks5']))));

		$part6name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname6']))));
		$part6topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic6']))));
		$part6marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks6']))));

		$part7name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname7']))));
		$part7topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic7']))));
		$part7marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks7']))));

		$part8name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname8']))));
		$part8topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic8']))));
		$part8marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks8']))));

		$part9name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname9']))));
		$part9topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic9']))));
		$part9marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks9']))));

		$part10name = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partname10']))));
		$part10topic = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['parttopic10']))));
		$part10marks = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partmarks10']))));

		$part1noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque1']))));
		$part2noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque2']))));
		$part3noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque3']))));
		$part4noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque4']))));
		$part5noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque5']))));
		$part6noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque6']))));
		$part7noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque7']))));
		$part8noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque8']))));
		$part9noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque9']))));
		$part10noofque = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_POST['partnoofque10']))));

			
			$noofparts = 0;
			
			if(($part1name!="") && ($part1topic!="") && ($part1marks!="")){
				$noofparts = 1;
			}
			if(($part2name!="") && ($part2topic!="") && ($part2marks!="")){
				$noofparts = 2;
			}
			if(($part3name!="") && ($part3topic!="") && ($part3marks!="")){
				$noofparts = 3;
			}
			if(($part4name!="") && ($part4topic!="") && ($part4marks!="")){
				$noofparts = 4;
			}
			if(($part5name!="") && ($part5topic!="") && ($part5marks!="")){
				$noofparts = 5;
			}
			if(($part6name!="") && ($part6topic!="") && ($part6marks!="")){
				$noofparts = 6;
			}
			if(($part7name!="") && ($part7topic!="") && ($part7marks!="")){
				$noofparts = 7;
			}
			if(($part8name!="") && ($part8topic!="") && ($part8marks!="")){
				$noofparts = 8;
			}
			if(($part9name!="") && ($part9topic!="") && ($part9marks!="")){
				$noofparts = 9;
			}
			if(($part10name!="") && ($part10topic!="") && ($part10marks!="")){
				$noofparts = 10;
			}

			$sql = "INSERT INTO questionpaper (qpid,name,totalmarks,totalquestions,subject,noofparts,part1name,part1topic,part1marks,part2name,part2topic,part2marks,part3name,part3topic,part3marks,part4name,part4topic,part4marks,part5name,part5topic,part5marks,part6name,part6topic,part6marks,part7name,part7topic,part7marks,part8name,part8topic,part8marks,part9name,part9topic,part9marks,part10name,part10topic,part10marks,time,examtype,noofattempts,examdate,entrydate,hidden,part1noofque,part2noofque,part3noofque,part4noofque,part5noofque,part6noofque,part7noofque,part8noofque,part9noofque,part10noofque,qptype,batch,screentype,error,shufflequestions,srnotype) VALUES (DEFAULT,'$name','$totalmarks','$totalquestions','$subject','$noofparts','$part1name','$part1topic','$part1marks','$part2name','$part2topic','$part2marks','$part3name','$part3topic','$part3marks','$part4name','$part4topic','$part4marks','$part5name','$part5topic','$part5marks','$part6name','$part6topic','$part6marks','$part7name','$part7topic','$part7marks','$part8name','$part8topic','$part8marks','$part9name','$part9topic','$part9marks','$part10name','$part10topic','$part10marks','$time','$examtype','$noofattempts','$examdate','$entrydate','true','$part1noofque','$part2noofque','$part3noofque','$part4noofque','$part5noofque','$part6noofque','$part7noofque','$part8noofque','$part9noofque','$part10noofque','$qptype','$batch','$screentype','false','$shufflequestions','$srnotype')";
			$conn->query($sql);
			
			?>
		</div>
			<?php
	}
}else{
	echo "No Fields Are Entered!!!";
	// header("Location: questionpaperentryaddnew.php");
	exit();
}

?>


<script type="text/javascript">
	// window.location.href = 'questionpaperentry.php';
</script>