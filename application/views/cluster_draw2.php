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

    <script type="text/javascript" src="<?=base_url('public/assets/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('public/js/line.js')?>"></script>

</head>
<body>

<!-- Back to Top -->
<div style="position:fixed; _position:absolute; bottom:0px; left:0px; width:1300px; height:85px; display:none;" class="actGotop"><a href="javascript:;" title="Top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> Back to Top</a></div>

<!-- Begin page content -->
<div class="container">

<div class="page-header">
    <h1 id="t1">Step4:look up search result</h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url();?>">Home</a></li>
      <li><a href="<?=site_url('File/fileSU')?>">File</a></li>
      <li class="active">cluster</li>
    </ol>
</div>
<div>
  <div class="row" id="clu">
Cluster method:
<select id="method" style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(255, 255, 255);">
    <option value="K">K-Means Cluster</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Cluster number:<input placeholder="default 16" id="kinds" type="text"/>&nbsp;&nbsp;&nbsp;
<input value="Go" id="btnSearch" type="button" onclick="line()" />
<input value="<?php echo $filename;?>" id="f" type="hidden" />
<input  value="<?php echo $filelink;?>" id="linkf"  type="hidden" />
</div>
   
 



<br/>
<div style="height:10px;"></div>
<div id="jqxgrid">

<div id="drawlines">
<?php for($i=0;$i<$count-1;$i=$i+2){ ?>
  <div class="row">
     <div class="col-md-6 col-sm-6">
        <div class="cdiv">
           <canvas id="background<?php echo $i;?>" width='500' height='300'></canvas> 
                <canvas id="canvas<?php echo $i?>" width='500' height='300'></canvas>
                    </div>
                          <button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick="showline(<?php echo $i; ?>)">choose this mode</button>
                            </div>

                            <div class='col-md-6 col-sm-6'>
                               <div class='cdiv'>
            
                            <canvas id="background<?php echo $i+1;?>" width='500' height='300'></canvas>
                            <canvas id="canvas<?php echo $i+1;?>" width='500' height='300'></canvas>
                            </div>
                      
                            <button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick="showline(<?php echo $i+1; ?>);">choose this mode</button>
                            </div></div>
                            </br>

                            
                           <?php  } ?>
                              <?php  if($count%2!=0){ ?>
                                  <div class='row'>
                                    <div class='col-md-6 col-sm-6'>
                                        <div class='cdiv'>
                                    <canvas id="background<?php echo $count-1; ?>" width='500' height='300'></canvas>
                                      <canvas id="canvas<?php echo $count-1; ?>" width='500' height='300'></canvas>
                                    </div>
                                    <button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick="showline(<?php echo $count-1; ?>);">choose this mode</button>
                                    </div></div>
                               <?php  } ?>
</div>
</div>
    <br/>
    <button class="btn btn-success" id="btnNext" onclick="handraw()" type="button">Hand-draw<i class="icon-circle-arrow-right" aria-hidden="true"></i></button>
</div>
</br>

<div id="jqxNotificationchoose" >If the gene expression mode is what you want,you can click the <i>choose this mode</i>menu,and see more genes that express like this. </div>
<div id="jqxNotificationhand"> If all of those gene expression model are not what you want,you can click the <i>Hand-draw</i>button, draw the gene expression curve and search it.</div>


  <!-- 模态框（Modal） -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content">    
  <div class="modal-body">
  <div id='modal_message' style="text-align: center"><h2>calculation....</h2></div>
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
<footer class="footer">
  <div class="container">
    <p class="text-muted">Cite: <a>GEsture, A web-based gene search tool</a> by <a href="mailto:carrie_chunyan@qq.com">chunyanwang</a> @ 2017</p>
  </div>
</footer>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url('public/assets/js/ie10-viewport-bug-workaround.js')?>"></script>
<script type="text/javascript">

 jQuery(document).ready(function($){
     var count='<?=$count ?>';//聚类的个数
     var ccount='<?=$ccount ?>';//数据的列数（维度）
     var dmax='<?=$dmax ?>';
     var dmin='<?=$dmin ?>';
     var gedata=new Array();
     var i=0;
                        <?php for($i=0;$i<count($gdata);$i++){ ?>
                               var j=0;
                               gedata[i]=new Array();
                        <?php for($j=0;$j<count($gdata[$i]);$j++){ ?>
                                gedata[i][j]=<?=$gdata[$i][$j]?>;
                                j=j+1;    
                            <?php }?>
                            i=i+1;
                        <?php } ?>

   drawback(gedata,ccount,count,dmax,dmin);

});
</script>
</body>
</html>
