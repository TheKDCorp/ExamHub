 <?php include_once('../created/header.php'); ?>
  <?php include_once('../created/sidebar.php'); ?>
  <?php include_once('../created/pageheader.php'); ?>
  <?php include_once('../includes/dbcon.php'); ?>

<?php 

if((isset($_GET['id'])) && (!empty($_GET['id']))){
  $qid = htmlspecialchars(stripslashes(trim(mysqli_real_escape_string($conn,$_GET['id']))));
}else{
  $qid="";
}

$sql = "SELECT * FROM questionpaper";
$result = $conn->query($sql);
 ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytitle").text("Question Edit");
});
</script>

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
                                    <script type="text/javascript">
                                      !function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
                                    </script>


<script type="text/javascript">
  MathJax.Hub.Config({
  tex2jax: {
         inlineMath: [ ['$','$'], ['\\(','\\)'] ]
  }
});
</script>


<script>
var tquestion1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("tquestion1preview");
    this.buffer = document.getElementById("tquestion1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    tquestion1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("tquestion1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
tquestion1method.callback = MathJax.Callback(["CreatePreview",tquestion1method]);
tquestion1method.callback.autoReset = true;

// -------------------------------------------toption1------------------------------------------------------------

var toption1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("toption1preview");
    this.buffer = document.getElementById("toption1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    toption1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("toption1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
toption1method.callback = MathJax.Callback(["CreatePreview",toption1method]);
toption1method.callback.autoReset = true;

// ---------------------------------------toption2----------------------------------------------------------

var toption2method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("toption2preview");
    this.buffer = document.getElementById("toption2buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    toption2method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("toption2input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
toption2method.callback = MathJax.Callback(["CreatePreview",toption2method]);
toption2method.callback.autoReset = true;

// ----------------------------------------------toption3----------------------------------------------------------

var toption3method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("toption3preview");
    this.buffer = document.getElementById("toption3buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    toption3method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("toption3input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
toption3method.callback = MathJax.Callback(["CreatePreview",toption3method]);
toption3method.callback.autoReset = true;


// ----------------------------------------------toption4--------------------------------------------

var toption4method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("toption4preview");
    this.buffer = document.getElementById("toption4buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    toption4method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("toption4input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
toption4method.callback = MathJax.Callback(["CreatePreview",toption4method]);
toption4method.callback.autoReset = true;

// ----------------------------------------------tcorrectanswer1--------------------------------------------

var tcorrectanswer1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("tcorrectanswer1preview");
    this.buffer = document.getElementById("tcorrectanswer1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    tcorrectanswer1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("tcorrectanswer1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
tcorrectanswer1method.callback = MathJax.Callback(["CreatePreview",tcorrectanswer1method]);
tcorrectanswer1method.callback.autoReset = true;




var tsolutionmethod = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("tsolutionpreview");
    this.buffer = document.getElementById("tsolutionbuffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    tsolutionmethod.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("tsolutioninput").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
tsolutionmethod.callback = MathJax.Callback(["CreatePreview",tsolutionmethod]);
tsolutionmethod.callback.autoReset = true;





// ---------------------------------------------------------iquestion--------------------------------------------------

var iquestion1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("iquestion1preview");
    this.buffer = document.getElementById("iquestion1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    iquestion1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("iquestion1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
iquestion1method.callback = MathJax.Callback(["CreatePreview",iquestion1method]);
iquestion1method.callback.autoReset = true;

// -------------------------------------------toption1------------------------------------------------------------

var ioption1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("ioption1preview");
    this.buffer = document.getElementById("ioption1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    ioption1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("ioption1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
ioption1method.callback = MathJax.Callback(["CreatePreview",ioption1method]);
ioption1method.callback.autoReset = true;

// ---------------------------------------toption2----------------------------------------------------------

var ioption2method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("ioption2preview");
    this.buffer = document.getElementById("ioption2buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    ioption2method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("ioption2input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
ioption2method.callback = MathJax.Callback(["CreatePreview",ioption2method]);
ioption2method.callback.autoReset = true;

// ----------------------------------------------toption3----------------------------------------------------------

var ioption3method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("ioption3preview");
    this.buffer = document.getElementById("ioption3buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    ioption3method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("ioption3input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
ioption3method.callback = MathJax.Callback(["CreatePreview",ioption3method]);
ioption3method.callback.autoReset = true;


// ----------------------------------------------toption4--------------------------------------------

var ioption4method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("ioption4preview");
    this.buffer = document.getElementById("ioption4buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    ioption4method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("ioption4input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
ioption4method.callback = MathJax.Callback(["CreatePreview",ioption4method]);
ioption4method.callback.autoReset = true;

// ----------------------------------------------tcorrectanswer1--------------------------------------------

var icorrectanswer1method = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("icorrectanswer1preview");
    this.buffer = document.getElementById("icorrectanswer1buffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    icorrectanswer1method.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("icorrectanswer1input").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
icorrectanswer1method.callback = MathJax.Callback(["CreatePreview",icorrectanswer1method]);
icorrectanswer1method.callback.autoReset = true;


// --------------------------------------------------solution-------------------------------------

var isolutionmethod = {
  delay: 150,        // delay after keystroke before updating

  preview: null,     // filled in by Init below
  buffer: null,      // filled in by Init below

  timeout: null,     // store setTimout id
  mjRunning: false,  // true when MathJax is processing
  mjPending: false,  // true when a typeset has been queued
  oldText: null,     // used to check if an update is needed

  Init: function () {
    this.preview = document.getElementById("isolutionpreview");
    this.buffer = document.getElementById("isolutionbuffer");
  },

 
  SwapBuffers: function () {
    var buffer = this.preview, preview = this.buffer;
    this.buffer = buffer; this.preview = preview;
    buffer.style.visibility = "hidden"; buffer.style.position = "absolute";
    preview.style.position = ""; preview.style.visibility = "";
  },

  Update: function () {
    if (this.timeout) {clearTimeout(this.timeout)}
    this.timeout = setTimeout(this.callback,this.delay);
  },

 
  CreatePreview: function () {
    isolutionmethod.timeout = null;
    if (this.mjPending) return;
    var text = document.getElementById("isolutioninput").value;
    if (text === this.oldtext) return;
    if (this.mjRunning) {
      this.mjPending = true;
      MathJax.Hub.Queue(["CreatePreview",this]);
    } else {
      this.buffer.innerHTML = this.oldtext = text;
      this.mjRunning = true;
      MathJax.Hub.Queue(
  ["Typeset",MathJax.Hub,this.buffer],
  ["PreviewDone",this]
      );
    }
  },

  PreviewDone: function () {
    this.mjRunning = this.mjPending = false;
    this.SwapBuffers();
  }

};
isolutionmethod.callback = MathJax.Callback(["CreatePreview",isolutionmethod]);
isolutionmethod.callback.autoReset = true;



</script>
<script type="text/javascript">
    window.onload = function () { 
        getname();
    }
</script>


      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php 
                  $sql2 = "select * from questionentry where qid='$qid'";
                  $res2 = $conn->query($sql2);
                  if($res2->num_rows > 0){
                    $row2 = $res2->fetch_assoc();
                    $qpname = $row2['qpname'];
                    $qpid = $row2['qpid'];
                    $posmarks = $row2['positivemarks'];
                    $negmarks = $row2['negativemarks'];
                  }

                  $sql2 ="select * from questionentry where qpname='$qpname' order by qid";
                  $res2 = $conn->query($sql2);
                  if($res2->num_rows > 0){
                    $questionno = 0;
                    while($row2=$res2->fetch_assoc()){
                      $questionno = $questionno + 1;
                      if($row2['qid'] == $qid){
                        $myquestionno = $questionno;
                      }                   
                    }
                  }

                  $sql2 = "select * from questionentry where qpname='$qpname' order by qid";
                  $res2 = $conn->query($sql2);
                  $previousqid = 0;
                  if($res2->num_rows > 0){
                    $myno = 1;
                    while($row2 = $res2->fetch_assoc()){
                      $myno = $myno + 1;
                      if($myno == $myquestionno){
                        $previousqid = $row2['qid'];
                      }
                    }
                  } 

                  $sql2 = "select * from questionentry where qpname='$qpname' order by qid";
                  $res2 = $conn->query($sql2);
                  $nextqid = 0;
                  if($res2->num_rows > 0){
                    $myno = -1;
                    while($row2 = $res2->fetch_assoc()){
                      $myno = $myno + 1;
                      if($myno == $myquestionno){
                        $nextqid = $row2['qid'];
                      }
                    }
                  } 

                 ?>
                  <div style="text-align:right;"><?php if($previousqid=="0"){}else{echo '<a style="float:left;" href="questionentryedit.php?id='.$previousqid.'" class="btn btn-primary">Previous</a>&nbsp&nbsp&nbsp';}?><?php if($nextqid=="0"){}else{echo '<a style="float:left;" href="questionentryedit.php?id='.$nextqid.'" class="btn btn-primary">Next</a>&nbsp&nbsp&nbsp';}?><a style="float:left;" href="questionentrydelete.php?qpid=<?php echo $qpid; ?>&id=<?php echo $qid; ?>" class="btn btn-danger">Delete</a>&nbsp&nbsp&nbsp<a style="float:left;" href="questionentryaddnew2.php?qpname=<?php echo $qpname; ?>&qpid=<?php echo $qpid; ?>&posmarks=<?php echo $posmarks; ?>&negmarks=<?php echo $negmarks; ?>" class="btn btn-warning">Add New</a>&nbsp&nbsp&nbsp<a href="questionentryforexam.php?qpid=<?php echo $qpid; ?>" class="btn btn-info">Que. List</a>&nbsp&nbsp&nbsp</div>
                  <hr>     
                </div>
              <div class="card-body">

                <form action="questionentryeditsubmit.php" method="post" enctype="multipart/form-data">
                                  <?php 
                  $sql2 ="select * from questionentry where qid='$qid'";
                  $res2 = $conn->query($sql2);
                  if($res2->num_rows > 0){
                    $row2 = $res2->fetch_assoc();
                    $qpname = $row2['qpname'];
                    $part = $row2['part'];
                    $level = $row2['level'];
                    $posmarks = $row2['positivemarks'];
                    $negmarks = $row2['negativemarks'];
                    $question = $row2['question'];
                    $option1 = $row2['option1'];
                    $option2 = $row2['option2'];
                    $option3 = $row2['option3'];
                    $option4 = $row2['option4'];
                    $correctoption = $row2['correctoption'];
                    $imgid = $row2['imgid'];
                    $opt1img = $row2['opt1img'];
                    $opt2img = $row2['opt2img'];
                    $opt3img = $row2['opt3img'];
                    $opt4img = $row2['opt4img'];
                    $solution = $row2['solution'];
                    $solutionimg = $row2['solutionimg'];

                  }

                  $questionno = 0;
                  $myquestionno = 0;

                  $sql2 ="select * from questionentry where qpname='$qpname' order by qid";
                  $res2 = $conn->query($sql2);
                  if($res2->num_rows > 0){
                    while($row2=$res2->fetch_assoc()){
                      $questionno = $questionno + 1;
                      if($row2['qid'] == $qid){
                        $myquestionno = $questionno;
                      }                   
                    }
                  }

                 echo "Question No: " . $myquestionno;

                 ?>
                 <input type="hidden" name="queno" value="<?php echo $myquestionno; ?>">
                <hr>
                                <div class="row">
                                  <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                      <label for="name">Paper Name</label>
                                      <select name="name" class="form-control">
                                        <?php 
                                        if($qpname!=''){
                                          $sql1 = "select * from questionpaper order by qpid desc";
                                          $result1 = $conn->query($sql1);
                                          if($result1->num_rows > 0){
                                            while($row1=$result1->fetch_assoc()){
                                              echo '<option value="'.$row1['name'].'"';
                                              if($row1['name']==$qpname){
                                                echo ' selected ';
                                              }
                                              echo '>'.$row1['name'].'</option>';                                                
                                            }
                                          }
                                        }else{
                                          $sql1 = "select * from questionpaper order by qpid desc";
                                          $result1 = $conn->query($sql1);
                                          if($result1->num_rows > 0){
                                            while($row1=$result1->fetch_assoc()){
                                              echo '<option value="'.$row1['name'].'"';
                                              echo '>'.$row1['name'].'</option>';                                                
                                            }
                                          }
                                        }
                                        ?>
                                      </select>
                                      <input type="hidden" name="qpid" id="qpid">
                                  </div>
                                  <div class="col-lg-1 col-md-1 col-xs-1 col-sm-1">
                                    <input type="button" value="Get Parts" onclick="getname()" class="btn btn-success" style="margin-top:2em"> 
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                      <label for="part">Part</label>
                                      <select name="part" class="form-control" id="part" autofocus="true">
                                        
                                      </select>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                      <label for="level">Question Level</label>
                                      <select name="level" class="form-control" id="level">
                                        <option value="beginner" <?php if($level == "beginner"){echo 'selected';} ?>>Beginner</option>
                                        <option value="intermediate" <?php if($level == "intermediate"){echo 'selected';} ?>>Intermediate</option>
                                        <option value="advanced" <?php if($level == "advanced"){echo 'selected';} ?>>Advanced</option>
                                      </select>
                                  </div>
                                </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="positivemarks">Positive Marks</label>
                                        <input type="text" value="<?php if($posmarks!=''){echo $posmarks;} ?>" class="form-control" id="positivemarks" name="positivemarks">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <label for="negativemarks">Negative Marks</label>
                                        <input type="text" value="<?php if($negmarks!=''){echo $negmarks;} ?>" class="form-control" id="negativemarks" name="negativemarks">
                                    </div>
                                  </div>
                                  <br>
                              </div>
                            </div>
                        </div>
                    </div> <!-- .card -->
         

                 
                    <div class="card">
                      <div class="card-body">
                          <div id="pay-invoice">
                              <div class="card-body">
                                  <div>
                                    <hr>
                                    <center><h3>Question Entry: </h3></center>
                                    <hr> 
                                    <br>
                                    <!-- <center><a href="../created/drawing/" target="_blank" class="btn btn-default">Make Drawing</a></center> -->
                                  <div class="row">
                                    <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                                        <label for="question">Question</label>
                                        <textarea id="iquestion1input" class="form-control" name="qquestion" onkeyup="iquestion1method.Update()" style="margin-top:5px"><?php if($question!=''){echo $question;} ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" name="quefile"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($imgid!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/questions/'.md5($imgid).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="myqueimage" name="quefile" style="border:0px;">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <label for="option1">Option 1</label>
                                        <textarea id="ioption1input" class="form-control" name="qoption1" onkeyup="ioption1method.Update()" style="margin-top:5px"><?php if($option1!=''){echo $option1;} ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-info btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" name="opt1file"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($opt1img!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/questions/options/'.md5($opt1img).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="myopt1image" name="opt1file">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <label for="option2">Option 2</label>
                                        <textarea id="ioption2input" class="form-control" name="qoption2" onkeyup="ioption2method.Update()" style="margin-top:5px"><?php if($option2!=''){echo $option2;} ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-info btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" name="opt2file"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($opt2img!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/questions/options/'.md5($opt2img).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="myopt2image" name="opt2file">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <label for="option3">Option 3</label>
                                        <textarea id="ioption3input" class="form-control" name="qoption3" onkeyup="ioption3method.Update()" style="margin-top:5px"><?php if($option3!=''){echo $option3;} ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-info btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" name="opt3file"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($opt3img!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/questions/options/'.md5($opt3img).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="myopt3image" name="opt3file">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <label for="option4">Option 4</label>
                                        <textarea id="ioption4input" class="form-control" name="qoption4" onkeyup="ioption4method.Update()" style="margin-top:5px"><?php if($option4!=''){echo $option4;} ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-info btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" name="opt4file"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($opt4img!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/questions/options/'.md5($opt4img).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="myopt4image" name="opt4file">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                      <label for="correctanswer">Correct Answer</label>
                                      <select class="form-control" name="qcorrectanswer">
                                        <?php 
                                            $sql = "select * from settings limit 1";
                                            $rs1=$conn->query($sql);
                                            if($rs1->num_rows > 0){
                                              $settings = $rs1->fetch_assoc();
                                            }

                                            if($settings['srnotype']=="alphabets"){
                                              ?>
                                                <option value="1" <?php if($correctoption=='1'){echo 'selected';} ?>>(A)</option>
                                                <option value="2" <?php if($correctoption=='2'){echo 'selected';} ?>>(B)</option>
                                                <option value="3" <?php if($correctoption=='3'){echo 'selected';} ?>>(C)</option>
                                                <option value="4" <?php if($correctoption=='4'){echo 'selected';} ?>>(D)</option>
                                              <?php
                                            }else{
                                              ?>
                                                <option value="1" <?php if($correctoption=='1'){echo 'selected';} ?>>(1)</option>
                                                <option value="2" <?php if($correctoption=='2'){echo 'selected';} ?>>(2)</option>
                                                <option value="3" <?php if($correctoption=='3'){echo 'selected';} ?>>(3)</option>
                                                <option value="4" <?php if($correctoption=='4'){echo 'selected';} ?>>(4)</option>
                                              <?php
                                            }

                                         ?>
                                      </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                        <label for="solution">Solution</label>
                                        <textarea id="isolutioninput" class="form-control" name="qsolution" onkeyup="isolutionmethod.Update()" style="margin-top:5px"><?php echo $solution; ?></textarea>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                       <!-- <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <span class="btn btn-info btn-file"><span class="fileupload-new">Select file</span>
                                          <span class="fileupload-exists">Change</span>         <input type="file" id="myopt4image" name="opt4file"></span>
                                          <span class="fileupload-preview"></span>
                                          <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                        </div> -->
                                        <?php 
                                          if($solutionimg!=""){
                                            echo '<div style="border:1px solid black;"><img src="../uploads/answers/'.md5($solutionimg).'.jpg" class="img-responsive"></div>';
                                          }
                                         ?>
                                        <input type="file" id="mysolutionimage" name="mysolutionfile">
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                        <div id="iquestion1preview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="iquestion1buffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <div id="ioption1preview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="ioption1buffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <div id="ioption2preview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="ioption2buffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <div id="ioption3preview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="ioption3buffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <div id="ioption4preview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="ioption4buffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                        <div id="isolutionpreview" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px"></div>
                                        <div id="isolutionbuffer" class="form-control" style="border:1px solid; padding: 3px; margin-top:5px;visibility:hidden; position:absolute; top:0; left: 0"></div>
                                    </div>
                                  </div>
                                  <br>
                                  </div>
                                  <hr>
                                  <br>     
                                  <center>
                                    <input type="hidden" name="questionid" value="<?php echo $qid; ?>">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                  </center>
                                </form>


              </div>
            </div>
          </div>
        </div>
      </div>




<script>
  tquestion1method.Init();
  toption1method.Init();
  toption2method.Init();
  toption3method.Init();
  toption4method.Init();
  tcorrectanswer1method.Init();
  tsolutionmethod.Init();

  iquestion1method.Init();
  ioption1method.Init();
  ioption2method.Init();
  ioption3method.Init();
  ioption4method.Init();
  icorrectanswer1method.Init();
  isolutionmethod.Init();
</script>
<script type="text/javascript">
  function getname(){

    partno = "<?php echo $part; ?>";

    var name = $('select[name="name"]').val();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: "namexyz="+ name,
        success: function(data) {
          $("#qpid").val(data);
        }
      });

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: "name2="+ name,
        success: function(data) {
          $("#part").html("");
          for(i = 1;i<=data;i++){
            if(i==partno){
              $("#part").append("<option value='"+i+"' selected>Part "+i+"</option>");
            }else{
              $("#part").append("<option value='"+i+"'>Part "+i+"</option>");
            }
          }
        }
      });
  }
</script>

<script type="text/javascript">
  const fileInputque = document.getElementById("myqueimage");
  const fileInputoption1 = document.getElementById("myopt1image");
  const fileInputoption2 = document.getElementById("myopt2image");
  const fileInputoption3 = document.getElementById("myopt3image");
  const fileInputoption4 = document.getElementById("myopt4image");
  const mysolution = document.getElementById("mysolutionimage");


  quetext1 = document.getElementById("iquestion1input");

  opttext1 = document.getElementById("ioption1input");
  opttext2 = document.getElementById("ioption2input");
  opttext3 = document.getElementById("ioption3input");
  opttext4 = document.getElementById("ioption4input");

  solution = document.getElementById("isolutioninput");

  quetext1.addEventListener('paste', e => {
    fileInputque.files = e.clipboardData.files;
  });

  opttext1.addEventListener('paste', e => {
    fileInputoption1.files = e.clipboardData.files;
  });

  opttext2.addEventListener('paste', e => {
    fileInputoption2.files = e.clipboardData.files;
  });

  opttext3.addEventListener('paste', e => {
    fileInputoption3.files = e.clipboardData.files;
  });

  opttext4.addEventListener('paste', e => {
    fileInputoption4.files = e.clipboardData.files;
  });


  solution.addEventListener('paste', e => {
    mysolution.files = e.clipboardData.files;
  });


</script>


  <?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
