<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gesture, A web-based Gene netwrok tool</title>
     <style type="text/css">

.sk-three-bounce {
  margin: 40px auto;
  width: 80px;
  text-align: center; }
  .sk-three-bounce .sk-child {
    width: 20px;
    height: 20px;
    background-color: #333;
    border-radius: 100%;
    display: inline-block;
    -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
            animation: sk-three-bounce 1.4s ease-in-out 0s infinite both; }
  .sk-three-bounce .sk-bounce1 {
    -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s; }
  .sk-three-bounce .sk-bounce2 {
    -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s; }

@-webkit-keyframes sk-three-bounce {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
  40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes sk-three-bounce {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0); }
  40% {
    -webkit-transform: scale(1);
            transform: scale(1); } }

  </style>



    <!-- Bootstrap core CSS -->
   
    <link href="<?=base_url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('public/assets/css/font-awesome.min.css')?>" rel="stylesheet" >
    <link rel="stylesheet" href="<?=base_url('public/css/line_style.css')?>" media="screen" type="text/css" />
    <!-- Custom styles for this template -->
    <link href="<?=base_url('public/assets/css/sticky-footer.css')?>" rel="stylesheet">

    <!-- Main CSS by Ethan-->
    <link href="<?=base_url('public/assets/css/main.css')?>" rel="stylesheet">
   
    <script src="<?=base_url('public/assets/js/ie-emulation-modes-warning.js')?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" href="<?=base_url('public/assets/css/font-awesome-ie7.min.css')?>">
<![endif]-->
    
   <link rel="stylesheet" href="<?=base_url('public/css/gif/gifplayer.css')?>" media="screen"  />
   
    <script type="text/javascript" src="<?=base_url('public/assets/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('public/js/line.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/gif/jquery.gifplayer.js')?>"></script>

</head>
<body>

<!-- Back to Top -->
<div style="position:fixed; _position:absolute; bottom:0px; left:0px; width:1300px; height:85px; display:none;" class="actGotop"><a href="javascript:;" title="Top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> Back to Top</a></div>

<!-- Begin page content -->
<div class="container">

<div class="page-header">
   <h1 id="t1">Step2:choose cluster or hand draw</h1>
     <h1 id="t2" hidden>Step3:input cluster number</h1>
     <h1 id="t3" hidden>Step4:look up search result</h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url();?>">Home</a></li>
      <li><a href="<?=site_url('File/fileSU')?>">File</a></li>
      <li class="active">cluster</li>
    </ol>
</div>
<div>

<div style="display:none" id="link">
  <h4>result link:<a href="<?=site_url('File/cluster/').$filelink.'/'.$filename;?>"><?php echo $filelink;?></a></h4>
</div>
  <div id="clu" style="display:none">
<span style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(255, 255, 255);">Cluster method:&nbsp;K-Means Cluster</span>
<!--<select id="method" style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(255, 255, 255);">
    <option value="K">K-Means Cluster</option>
</select>-->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Cluster number:<input placeholder="default 16" id="kinds" type="text"/>&nbsp;&nbsp;&nbsp;
<input value="Go" id="btnSearch" type="button" onclick="line()" />
<input value="<?php echo $filename;?>" id="f" type="hidden" />
<input  value="<?php echo $filelink;?>" id="linkf"  type="hidden" />
</div>
   
 



<br/>
<div style="height:10px;"></div>
<div id="jqxgrid">

<div id="drawlines" style="width:1100px"></div>
</div>
    <br/>
    <div class="row">
     <div class="col-md-5 col-sm-5" id="hideimg1">
      <img id="img1" src="<?=base_url('images/hdraw.gif')?>"  style="width:100%;height:100%" />
      <p><button class="btn btn-success" id="btnNext" onclick="handraw()" type="button" style="margin:5px 0px 0px 25%;">Hand-draw<i class="icon-circle-arrow-right" aria-hidden="true"></i></button></p>
    </div>
       <div class="col-md-2 col-sm-2">
      <span id="or"><font size="8">OR</font></span>
      </div>
      <div class="col-md-5 col-sm-5" id="hideimg2">
      <img id="img2" src="<?=base_url('images/cluster.gif')?>"  style="width:100%;height:100%" />
      <p><button class="btn btn-success" id="btncluster" onclick="choosecluster()" type="button" style="margin:5px 0px 0px 25%;">cluster first<i class="icon-circle-arrow-right" aria-hidden="true"></i></button></p>
    </div>
      
    </div>


  <!-- 模态框（Modal） -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content">    
  <div class="modal-body">
  <div id='modal_message' style="text-align: center"><h2>calculating......</h2></div>
   <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
      </div>
  </div>
 </div><!-- /.modal-content -->
 </div><!-- /.modal -->
</div>


</div>
</br>
<div id="jqxNotification16" style="display:none"> 16 is the default classification number and the max number we offer to cluster,you should choose a number <i>smaller than 16</i>.</div>
<div id="jqxNotificationskip">If you do not want to see cluster result, you can skip this step and click the Hand-draw button,go to the hand-draw mode.</div>
<div id="jqxNotificationchoose" style="display:none" >If the gene expression mode is what you want,you can click the <i>choose this mode</i>menu,and see more genes that express like this. </div>
<div id="jqxNotificationhand" style="display:none"> If all of those gene expression model are not what you want,you can click the <i>Hand-draw</i> button, draw the gene expression curve and search it.</div>


</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Cite: <a>GEsture, A web-based gene search tool</a> by <a href="mailto:carrie_chunyan@qq.com">chunyanwang</a> @ 2016</p>
  </div>
</footer>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url('public/assets/js/ie10-viewport-bug-workaround.js')?>"></script>
<script type="text/javascript">

$(document).ready( function(){

  $('.gifs').gifplayer();

});
function choosecluster()
{
  //var a=document.getElementsByClassName("gifs");
  $("#hideimg2").hide();
  $("#t1").hide();
  $("#t2").show();
  //$("#img1").hide();
  $("#img2").hide();
  $("#clu").toggle();
  //$("#link").toggle();
  $("jqxNotification16").toggle();
  //document.getElementById("btncluster").setAttribute("hidden",true);
  $("#btncluster").hide();
  document.getElementById("or").setAttribute("hidden",true);

}
</script>
</body>
</html>
