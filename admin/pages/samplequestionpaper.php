<?php 
include_once('../includes/dbcon.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Sample Question Paper</title>
 </head>
 <body>
 	<form action="samplequestionpapersubmit.php" method="post">
	 	<textarea name="field1" style="width:100%;" placeholder="Enter First Field Details"></textarea>
	 	<br>
	 	<textarea name="field2" style="width:100%;" placeholder="Enter Second Field Details"></textarea>
	 	<br>
	 	<input type="submit">
 	</form>
 </body>
 </html>