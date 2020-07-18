
 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

 <style type="text/css">
                                      .clearfix{*zoom:1;}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0;}
.clearfix:after{clear:both;}
.hide-text{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0;}
.input-block-level{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
.btn-file{overflow:hidden;position:relative;vertical-align:middle;}.btn-file>input{position:absolute;top:0;right:0;margin:0;opacity:0;filter:alpha(opacity=0);transform:translate(-300px, 0) scale(4);font-size:23px;direction:ltr;cursor:pointer;}
.fileupload{margin-bottom:9px;}.fileupload .uneditable-input{display:inline-block;margin-bottom:0px;vertical-align:middle;cursor:text;}
.fileupload .thumbnail{overflow:hidden;display:inline-block;margin-bottom:5px;vertical-align:middle;text-align:center;}.fileupload .thumbnail>img{display:inline-block;vertical-align:middle;max-height:100%;}
.fileupload .btn{vertical-align:middle;}
.fileupload-exists .fileupload-new,.fileupload-new .fileupload-exists{display:none;}
.fileupload-inline .fileupload-controls{display:inline;}
.fileupload-new .input-append .btn-file{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;}
.thumbnail-borderless .thumbnail{border:none;padding:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
.fileupload-new.thumbnail-borderless .thumbnail{border:1px solid #ddd;}
.control-group.warning .fileupload .uneditable-input{color:#a47e3c;border-color:#a47e3c;}
.control-group.warning .fileupload .fileupload-preview{color:#a47e3c;}
.control-group.warning .fileupload .thumbnail{border-color:#a47e3c;}
.control-group.error .fileupload .uneditable-input{color:#b94a48;border-color:#b94a48;}
.control-group.error .fileupload .fileupload-preview{color:#b94a48;}
.control-group.error .fileupload .thumbnail{border-color:#b94a48;}
.control-group.success .fileupload .uneditable-input{color:#468847;border-color:#468847;}
.control-group.success .fileupload .fileupload-preview{color:#468847;}
.control-group.success .fileupload .thumbnail{border-color:#468847;}
                                    </style>

	  <div class="panel-header panel-header-sm">
      </div>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
              	<form action="food_entry_addnewsubmit.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                          <label for="breakfast">breakfast</label>
                          <input type="text" class="form-control" id="breakfast" autocomplete="false" name="breakfast">
                      </div>
                      <!-- <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1">
                      	   <div class="fileupload fileupload-new" data-provides="fileupload">
                              <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                              <span class="fileupload-exists">Change</span>         <input type="file" name="breakfast_img"></span>
                              <span class="fileupload-preview"></span>
                              <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>
                      </div> -->
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="breakfast">breakfast Description</label>
                          <textarea class="form-control" id="breakfastdescription" autocomplete="false" name="breakfastdescription"></textarea>
                          <br>
                      </div>                      
                    </div>
                    <br>
                    <div class="row">                
                      <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                          <label for="lunch">lunch</label>
                          <input type="text" class="form-control" id="lunch" autocomplete="false" name="lunch">
                      </div>
                      <!-- <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                          <span class="fileupload-exists">Change</span>         <input type="file" name="lunch_img"></span>
                          <span class="fileupload-preview"></span>
                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                        </div>
                      </div> -->
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="lunch">lunch Description</label>
                          <textarea class="form-control" id="lunchdescription" autocomplete="false" name="lunchdescription"></textarea>
                          <br>
                      </div>    
                    </div>
                    <br>
                    <div class="row">                
                      <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                          <label for="refreshment">Refreshment</label>
                          <input type="text" class="form-control" id="refreshment" autocomplete="false" name="refreshment">
                      </div>
                      <!-- <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1">
                           <div class="fileupload fileupload-new" data-provides="fileupload">
                              <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                              <span class="fileupload-exists">Change</span>         <input type="file" name="refreshment_img"></span>
                              <span class="fileupload-preview"></span>
                              <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>
                      </div>         -->              
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="refreshment">refreshment Description</label>
                          <textarea class="form-control" id="refreshmentdescription" autocomplete="false" name="refreshmentdescription"></textarea>
                          <br>
                      </div>    
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                          <label for="dinner">Dinnner</label>
                          <input type="text" class="form-control" id="dinner" autocomplete="false" name="dinner">
                      </div>
                      <!-- <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1">
                  	    <div class="fileupload fileupload-new" data-provides="fileupload">
                          <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                          <span class="fileupload-exists">Change</span>         <input type="file" name="dinner_img"></span>
                          <span class="fileupload-preview"></span>
                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                        </div>
                      </div> -->
                      <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                          <label for="dinner">dinner Description</label>
                          <textarea class="form-control" id="dinnerdescription" autocomplete="false" name="dinnerdescription"></textarea>
                          <br>
                      </div>    
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                          <label for="date">Food Date</label>
                          <input type="date" class="form-control" id="date" autocomplete="false" name="date">
                      </div>
                    </div>
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
