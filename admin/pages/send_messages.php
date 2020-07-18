 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Send Messages");
});
</script>

      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
				<div class="container-fluid">
					<a href="send_messages_submit.php" class="btn btn-primary btn-lg"> Send Sample Messages To All</a>
					<a href="" class="btn btn-info btn-lg"> Send Mail Messages To All</a>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	</div>

  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
