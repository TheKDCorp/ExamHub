<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Examination System | Macro Vision Academy
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="../assets/fonts/myfont.css?family=Montserrat:400,700,200" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
<script src="../assets/js/core/jquery.min.js"></script>
</head>

<style type="text/css">
#style-10::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
  background-color: #F5F5F5;
  border-radius: 10px;
}

#style-10::-webkit-scrollbar
{
  width: 10px;
  background-color: #F5F5F5;
}

#style-10::-webkit-scrollbar-thumb
{
  background-color: #AAA;
  border-radius: 10px;
  background-image: -webkit-linear-gradient(90deg,
                                            rgba(0, 0, 0, .2) 25%,
                        transparent 25%,
                        transparent 50%,
                        rgba(0, 0, 0, .2) 50%,
                        rgba(0, 0, 0, .2) 75%,
                        transparent 75%,
                        transparent)
}
</style>

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

<body class="" style="">
  