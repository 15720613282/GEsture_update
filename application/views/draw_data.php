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
    <?php include 'include/resource.php';?>
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







        #config {width:940px;padding:5px;background:#000;color:#fff;}
        .cTitle {position:absolute;width:12px;height:12px;overflow:hidden;}
        .cTitleHover {background:#000;border:1px solid yellow;opacity:0.5;}
        #temp_title {width:auto;height:auto;background:#000;color:#fff;border:1px solid yellow;line-height:20px;position:absolute;padding:5px;opacity:0.9;}
        .tip
        {
            color: #121212;
            background: #7A7A7A;
            display: none; /*--Hides by default--*/
            padding-top: 9px;
            padding-left: 6px;
            position: absolute;
            width: 120px;
            opacity: .8;
            font-weight: bold;
            font-size: 12px;
            z-index: 1000; /*-webkit-border-radius: 3px;
     -moz-border-radius: 3px; border-radius: 3px;*/
        }
        .slider-example {
            padding: 10px 0;
            margin: 35px 0;
        }

        #destroyEx5Slider, #ex6CurrentSliderValLabel, #ex7-enabled {
            margin-left: 45px;
        }


        /*进度条*/
        .six-sec-ease-in-out {
          -webkit-transition: width 6s ease-in-out;
          -moz-transition: width 6s ease-in-out;
          -ms-transition: width 6s ease-in-out;
          -o-transition: width 6s ease-in-out;
          transition: width 6s ease-in-out;
        }


.select{  
    background:#fafdfe;  
    height:20px;  
    width:18%;  
    line-height:20px;  
    border:1px solid #9bc0dd;  
    -moz-border-radius:2px;  
    -webkit-border-radius:2px;  
    border-radius:2px;  
}  



 
    </style>

<!--<script src="<?=base_url('public/js/jquery.min.js')?>" type="text/javascript"></script>-->

    <!-- Bootstrap core CSS -->
   
    <link href="<?=base_url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('public/assets/css/font-awesome.min.css')?>" rel="stylesheet" >
    <!-- Custom styles for this template -->
    <link href="<?=base_url('public/assets/css/sticky-footer.css')?>" rel="stylesheet">

    <!-- Main CSS by Ethan-->
    <link href="<?=base_url('public/assets/css/main.css')?>" rel="stylesheet">
    <link href="<?=base_url('public/css/switch/titatoggle-dist.css')?>" rel="stylesheet">
   
    <script src="<?=base_url('public/assets/js/ie-emulation-modes-warning.js')?>" type="text/javascript" ></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" href="<?=base_url('public/assets/css/font-awesome-ie7.min.css')?>">
<![endif]-->

   <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
   
    <script src="<?=base_url('public/js/echarts/echart.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('public/js/FileSaver.js')?>" type="text/javascript"></script>
<script src="<?=base_url('public/js/Blob.js')?>" type="text/javascript"></script> 
   

</head>
<body>

<!-- Back to Top -->
<div style="position:fixed; _position:absolute; bottom:0px; left:0px; width:1300px; height:85px; display:none;" class="actGotop"><a href="javascript:;" title="Top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> Back to Top</a></div>

<!-- Begin page content -->
<div class="container">

<div class="page-header">
    <h1>Main Interface</h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url();?>">Home</a></li>
      <li><a href="<?=site_url('File/fileSU')?>">File</a></li>
       <li><a href="<?=site_url('File/cluster/').$filelink.'/'.$operafile.'/1';?>">cluster</a></li>
      <li class="active">Main interface</li>
    </ol>
    <h4>result link:<a href="<?=site_url('File/cluster/').$filelink.'/'.$operafile.'/2';?>"><?php echo $filelink;?></a></h4>
</br>
   <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#example-navbar-collapse">
            <span class="sr-only">Switch navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Match pattern</a>
    </div>
    <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
         <label class="radio-inline"><li><p class="navbar-text" disable><input type="radio"  value="1" name="pattern" checked onclick="clearall()">brush pattern</p></li></label>

             <label class="radio-inline"><li hidden  id="contrast_radio"><p class="navbar-text" disable><input type="radio"  value="2" name="pattern"  onclick="edit_contrast()" >contrast pattern</p></li></label> 
             <label class="radio-inline"><li hidden  id="shift_radio"><p class="navbar-text" disable><input type="radio"  value="3" name="pattern"  onclick="edit_shift()">shift pattern</p></li></label> 
            

        </ul>
    </div>
    </div>
</nav>
</div>



<input  value="<?php echo $filelink;?>" id="linkf"  type="hidden" />
 <div class="row"> 
    <h4 class="pull-left">
    Drawing board&nbsp;&nbsp;&nbsp;<small>draw the curve using mouse in the following board</small>
</h4>           
     
   
<h5 class="pull-right"  id="shiftmode" style="width:30%;display:none">shift interval:
 <select id="select_shift1" class="select" style="width:15%; align:left;">
                        <option value="0" selected="selected">0</option>
                        <option value="-1">-1</option>
                        <option value="-2">-2</option>
                        <option value="-3">-3</option>
                        <option value="-4">-4</option>
                        <option value="-5">-5</option>
                        <option value="-6">-6</option>
                      </select>
                    <i class="icon-bulb"></i>
                    <span class="title"><font color="black" size="5">--</font></span>
                      <select  id="select_shift2" class="select" onchange="select_shift()" style="width:15%; align:left;">
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                      </select>
    </h5> 


</div>
              
           
                 
           <input type="text" hidden id="max_y" value="">
            <input type="text" hidden id="min_y" value="">      
            <div class="row" align="center">
                <canvas id="can" width="1000" height="500" style="cursor: pointer;">
                    Your browser does not support the canvas element.
                </canvas>
                <ul id="coo"></ul>
                <script type="text/javascript">
                    $(document).ready(function() {
                        var xx='<?=$xx ?>';
                        var yyl='<?=$YL ?>';
                        var yyh='<?=$YH ?>';
                        var str='<?=$str ?>';
                        var hi='<?=$hi ?>';
                        var title='<?=$title;?>';

                        document.getElementById("max_y").value=yyh;
                        document.getElementById("min_y").value=yyl;
                        setInterval1(xx,yyl,yyh);//html5-canvas-drawing-app1.js
                        prepareCanvas();//html5-canvas-drawing-app1.js

                                                
                        if(hi==1){
                        var filename;
                        var targetd=[];
                        var goal= new Array();
                        var tabledata=new Array();
                        filename='<?=$file_name ?>';
                        var i=0;
                        <?php for($i=0;$i<count($target);$i++){ ?>
                            targetd[i]=<?=$target[$i]?>;
                             i=i+1;
                        <?php } ?>
                       
                        var i=0;
                        <?php for($i=0;$i<count($clusterdata);$i++){ ?>
                               var j=0;
                               goal[i]=new Array();
                        <?php for($j=0;$j<count($clusterdata[$i]);$j++){ ?>
                                goal[i][j]=<?=$clusterdata[$i][$j]?>;
                                j=j+1;    
                            <?php }?>
                            i=i+1;
                        <?php } ?>
                       

                        
                        var i=0;
                        <?php for($i=0;$i<count($cluster);$i++){ ?>
                               var j=1;
                               tabledata[i]=new Array();
                               tabledata[i][0]='<?=$cluster[$i][0]?>';
                        <?php for($j=1;$j<count($cluster[$i]);$j++){ ?>
                                tabledata[i][j]=<?=$cluster[$i][$j]?>;
                                j=j+1;    
                            <?php }?>
                            i=i+1;
                        <?php } ?>
                        
                        setIntervals(xx,yyl,yyh);//drawaxes.js
                        showcanvas2();
                        setdata(targetd,xx);  
                        SetOtherData(goal,xx);
                        filltable(tabledata,filename);
                        savetoscape2();
                       // show_download('5',filename,tabledata);
                        if(!$("#ves").is(":visible")){
                                $("#ves").toggle();
                                $("#tt").toggle();
                                $("#dwd").toggle();
                        }

                     }   
                        
                    });
                </script>
            </div>
            
              </br>
        <div class="row">
        <div class="pull-left" style="width:30%;">
         <button class="btn btn-success" id="research" style="width:40%;">Search</button>
          <button class="pull-right btn btn-sm" onclick="clearall();">Reset</button>      
       </div>
          <script type="text/javascript">
               $("#research").click(function () { //function getXY()

                    var arrx;
                    var arry;
                    var ay,n;
                    var result=[];
                    //var ax=new Array();
                    arrx=Getclickx();
                    arry=Getclicky();
                    n='<?=$xx?>';
                    //alert(arrx);

                    unique(arrx,arry,n);


                });
                </script>

          <div class="pull-right">
          <div class="btn-group dropup">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">reference curve
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="#" onclick="show_genebox();">select a gene</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#" onclick="random_new();">random curve</a>
            </li>
            
        </ul>
    </div>
</div>
       </div>

          </br>
         
<hr>
            <a name="anchor"></a>   

       <div class="row"  id="ves" style="display:none" >
              <div class="portlet box grey"  >
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>result curves</div>
                                        <div class="tools">
                                             <button id='btnDownload_save' class='btn btn-xs btn-primary' onclick="savecurves('png');"><i class='fa fa-download' aria-hidden='true'></i> Download</button>
                                        </div>
                                    </div>
            
                                </div>      
           
        </div>

           <!-- <h4 hidden id="ves">result curves-->
            <p class="pull-right" id="filter_slider" hidden><b>corr</b><input id="ex7" type="text" data-slider-min="0.6" data-slider-max="1" data-slider-step="0.05" data-slider-value="0.67" data-slider-enabled="false" ／></p>
        
          <input type='hidden' id='pattern_file' value="">
          <div class="row" align="center" id="canv1" > </div>
          </br> 
            <input type='hidden' id='operation' value="<?php echo $operafile; ?>">
            <div class="row"  id="showtable" style="display:none" >
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet box grey">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>GeneData table</div>
                                        <div class="tools">
                                           <button id='btnDownload_Gene_Bank' class='btn btn-xs btn-primary' onclick='downloadAsFile();'><i class='fa fa-download' aria-hidden='true'></i> Download</button>
                                           <a href="javascript:;" class="collapse"> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable" id="empty_table">
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead id="insert_head">
                                                 
                                                </thead>
                                                <tbody id="insert_selected_genes">
                                                   
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
            
                                </div>
            </div>



    <br/>
</br>








</br>

<div class="row"  id="tt" style="display:none" >
 <img src="" id="img_src" hidden >
              <div class="portlet box grey"  >
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>heat map</div>
                                    <div class="tools">
                                         <button id='btnDownload_pic2' class='btn btn-xs btn-primary' onclick="savepic2('png');"><i class='fa fa-download' aria-hidden='true'></i> Download</button>
                                              <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                         <div id="heat_map" align="center" ></div>
                                    </div>
                                        
                                    </div>
            
                                </div>      
            


<div class="row"   id="cyto1"  style="display:none" >
 <div class="portlet box grey"  >
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>cytoscape</div>
                                        <div class="tools">
                                             <button id='btnDownload_pic1' class='btn btn-xs btn-primary' onclick="savepic('png');"><i class='fa fa-download' aria-hidden='true'></i> Download</button>
                                             <a href="javascript:;" class="collapse" onclick="nosee();" > </a>
                                        </div>
                                    </div>
            
                     </div>                 
        </div>
<div style="height:10px;" id="css_show" hidden >
    <p><button  style="width:30px; height:30px; border-radius:50px; background-color:#FF3030;" disabled></button><font color="black">similar genes</font></p>
  <p><button  style="background-color:#B23AEE;width:30px; height:30px; border-radius:50px;"disabled></button><font color="black">contrast genes</font></p>
  
  <p><button  style="background-color:#EE9A00;width:30px; height:30px; border-radius:50px;"disabled></button><font color="black">time-delay genes</font></p>
 
  <p><button  style="background-color:#1C86EE;width:30px; height:30px; border-radius:50px;"disabled></button><font color="black">time-ahead genes</font></p>
</div>
<div class="row" id="cytoshow" hidden style="border-style:groove">
 <div id="cy" style="height: 800px; width: 1000px;"></div>
</div>





  </div>     





</br>

  <!-- 模态框（Modal） -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" >
 <div class="modal-dialog">
 <div class="modal-content">    
  <div class="modal-body">
  <div id='modal_message' style="text-align: center"><h2>calculating..</h2></div>
  <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
      </div>
  



  </div>
 </div><!-- /.modal-content -->
 </div><!-- /.modal -->
</div>


 <!-- 模态框 产生基因名 -->
<div class="modal fade" id="searchModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content"> 
 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">select a gene</h4>
            </div>     
  <div class="modal-body">
 <div class="input-append">
  <input class="span2" type="text" placeholder="Gene Name" id="gename">
  <button class="btn" type="button" onclick="gename_search()">query</button>
  <button class="btn" type="button" onclick="random_selected();">randomly</button>
</div>
  
  </div>
 </div><!-- /.modal-content -->
 </div><!-- /.modal -->
</div>
</br>

  <!-- 模态框（Modal） -->
<div class="modal fade" id="attention" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
 <div class="modal-content"> 
<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Attention</h4>
            </div> 
  <div class="modal-body">
   <span id="attention_content"></span>
  </div>
 </div><!-- /.modal-content -->
 </div><!-- /.modal -->
</div>
</br>
</br>

<footer class="footer">
  <div class="container">
    <p class="text-muted">Cite: <a>GEsture, A web-based gene search tool </a> by <a href="mailto:carrie_chunyan@qq.com">chunyanwang</a> @ 2017</p>
  </div>
</footer>
<?php include 'include/footer.php';?>
<!--[if IE]><script type="text/javascript" src="<?=base_url('public/js/excanvas.js')?>"></script><![endif]-->

<script type="text/javascript"  src="<?=base_url('public/js/cytoscape/cytoscape.min.js')?>"></script>
<script src="<?=base_url('public/js/cytoscape/jquery.qtip.min.js')?>"></script>

<link href="<?=base_url('public/css/jquery.qtip.min.css" rel="stylesheet')?>" type="text/css" />
<script type="text/javascript"  src="<?=base_url('public/js/cytoscape/cytoscape-qtip.js')?>"></script>
<script type="text/javascript"  src="<?=base_url('public/js/Blob.js')?>"></script>
<script type="text/javascript"  src="<?=base_url('public/js/Utils.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/html5-canvas-drawing-app1.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/drawaxes.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/analysisdata.js')?>"></script>
 <script type="text/javascript">

                     

 $("#ex7").slider({
    }).on('slideStop',function(val){
        //alert(val.value);
        line_change(val.value);

    });

function cytoscape1()
{
    var slide=$("#ex7").val();
    var filelink=$("#linkf").val();
     var comUrl="/GEsture/index.php/File/cyto1";
    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'slide':slide,'filelink':filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if(data['count']<=1000)
                                cyshow(data);
                            else
                                alert("the number of genes are too large to show in relation network map!");

                        },
                         error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

}); 

}
 function savetoscape2()
{
    var filename=$("#file_name").val();
   // var corr=$("#ex7").val();
    var filelink=$("#linkf").val();
     if(filename==null)
       alert("please search first! ");
    else{
     var comUrl="/GEsture/index.php/File/Cyto2";
     $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink,'filename':filename},
                        dataType: 'json',
                        async: true,
                        success: function (data1) {
                           
                            
                            // alert(data1['genes'].length);
                             var hours =[];
                             var j=0;
                             var k=0;
                             var z=0;
                             var days=[];
                             var data=[];
                             var hh,hl;
                            var bb=data1['recordnum'];
                            var mx=data1['maxc'];
                            var mn=data1['minc'];
                            //alert(mx+" "+mn);
                                for(var i=0;i<bb;i++) {
                                   hours[j]=(i+1).toString();
                                   j=j+1;
                                }

                                  for(var i=0;i<data1['count'];i++) {
                                    days[k]=data1['genes'][i].toString();
                                        for(var m=0;m<data1['genedata'][i][0].length;m++){
                                          data[z]=[i,m,data1['genedata'][i][0][m]];
                                          z++;
                                          } 
                                         k=k+1;
                                }
                                //alert(data1['genedata']);
                                data = data.map(function (item) {
                                    return [item[1], item[0], item[2] || '-'];
                                });
                                if(data1['count']<=10)
                                     { hh=200;hl=400;}
                                else if(data1['count']<=20)
                                    { hh=600;hl=800;}
                                else if(data1['count']<=40)
                                    { hh=700; hl=1000;}
                                else if(data1['count']<=60)
                                    { hh=1200; hl=1500;}
                                else 
                                    { hh=1700; hl=2000;}
                              
                                document.getElementById("heat_map").style.width="1000";
                                document.getElementById("heat_map").style.height=hl.toString();
                                document.getElementById("heat_map").style.margin=0;

                                 var chart = echarts.init(document.getElementById('heat_map'));
                                chart.setOption({
                                    tooltip: {
                                        position: 'top'
                                    },
                                    animation: false,
                                    grid: {
                                        height: hh
                                    },
                                    xAxis: {
                                        type: 'category',
                                        data: hours
                                    },
                                    yAxis: {
                                        type: 'category',
                                        data: days
                                    },

                                /*   toolbox:{
					itemSize: 25,
                                        right: '5%',
					feature: {
                                            saveAsImage:{
						title: 'Save as PNG',
						name: 'heat-map'
					    }
                                        }
                                    },*/
                                   

                                    visualMap: {
                                        min: mn,
                                        max:mx,
                                        calculable: true,
                                        orient: 'horizontal',
                                        left: 'center',
                                        bottom: '6%',
                                         inRange: {
                                           color: ['#313695', '#4575b4', '#74add1', '#abd9e9', '#e0f3f8', '#ffffbf', '#fee090', '#fdae61', '#f46d43', '#d73027', '#a50026']
                                           }
                                    },
                                    series: [{
                                        name: 'Gaussian',//Punch Card',
                                        type: 'heatmap',
                                        data: data,
                                        label: {
                                            normal: {
                                                show: true
                                            }
                                        },
                                        itemStyle: {
                                            emphasis: {
                                                shadowBlur: 10,
                                                shadowColor: 'rgba(0, 63, 198, 0.5)'
                                            }
                                        }
                                    }]
                                });

                                /* if(!$("#mapshow").is(":visible")){
                                
                                    $('#mapshow').toggle();
                                }*/
                              
                             },

                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

}); 
    
 }      
}

function cyshow(data)
{
                     $("#cy").cytoscape({
                            style: cytoscape.stylesheet()
                                 .selector('node[label="target1"]')
                                   .css({
                                     'content': 'data(id)',
                                     'font-family': 'helvetica',
                                     'font-size': 10,
                                     'text-valign': 'center',
                                     'color': '#000000',//#333333',
                                     'opacity':0.7,
                                     'width':80,
                                     'height':80,
                                     'border-color': '#fff',
                                     'background-color':  '#FF3030',//'mapData(weight,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
                                     'border-width':10

                                   })

                                   .selector('node[label="target2"]')
                                   .css({
                                     'content': 'data(id)',
                                     'font-family': 'helvetica',
                                     'font-size': 10,
                                     'text-valign': 'center',
                                     'color':'#000000', //'#333333',
                                     'opacity':0.7,
                                     'width':80,
                                     'height':80,
                                     'border-color': '#fff',
                                     'background-color':  '#B23AEE',//'mapData(weight,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
                                     'border-width':10

                                   })

                                   .selector('node[label="target3"]')
                                   .css({
                                     'content': 'data(id)',
                                     'font-family': 'helvetica',
                                     'font-size': 10,
                                     'text-valign': 'center',
                                     'color': '#000000',//'#333333',
                                     'opacity':0.7,
                                     'width':80,
                                     'height':80,
                                     'border-color': '#fff',
                                     'background-color':  '#EE9A00',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
                                     'border-width':10

                                   })

                                   .selector('node[label="target4"]')
                                   .css({
                                     'content': 'data(id)',
                                     'font-family': 'helvetica',
                                     'font-size': 10,
                                     'text-valign': 'center',
                                     'color': '#000000',//'#333333',
                                     'opacity':0.7,
                                     'width':80,
                                     'height':80,
                                     'border-color': '#fff',
                                     'background-color':  '#1C86EE',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
                                     'border-width':10

                                   })
                                   .selector('node[label="source"]')
                                   .css({
                                     'content': 'data(id)',
                                     'font-family': 'helvetica',
                                     'font-size': 20,
                                     'text-valign': 'center',
                                     'color': '#000000',//'#333333',
                                     'opacity':0.7, 
                                     'width':100,
                                     'height':100,
                                     'border-color': '#fff',
                                     'background-color':  '#7CCD7C',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
                                     'border-width':20
                                   })

                                 .selector(':selected')
                                   .css({
                                'content': 'data(weight)',
                                     'background-color': '#000',
                                     'line-color': '#000',
                                     'target-arrow-color': '#000',
                                     'text-outline-color': '#000'
                                   })
                                 .selector('node:selected')
                                   .css({
                                'content': 'data(weight)',
                                     'background-color': 'green',
                                     'text-outline-color': '#000'
                                   })
                                 .selector('edge')
                                   .css({
                                     
                                     'target-arrow-shape': 'triangle',
                                     'width':'2',
                                     'line-color':'blue'
                                   })
                              // so we can see the ids 
 });


                        var cy = $("#cy").cytoscape("get");
                        var tmpWeight = data['sR'];
                        

                        var _x=500;
                        var _y=500;
                     
                        cy.add({group: "nodes", data: { id: data['outsource'] , weight: tmpWeight,label:'source',position:{"x":_x,"y":_y}}});
                        cy.$("#"+tmpId).qtip({
                          content: tmpId,
                          position: {
                            my: 'top center',
                            at: 'bottom center'
                          },
                          style: {
                            classes: 'qtip-bootstrap',
                            tip: {
                              width: 16,
                              height: 8
                            }
                          }
                        });
                       var c1,c2,c3,c4;
                        if(data['outarget1']!=null)
                           { c1=data['outarget1'].length;  var nc1=360/c1;}
                        else
                            c1=0;
                         if(data['outarget2']!=null)
                            { c2=data['outarget2'].length; var nc2=360/c2;}
                         else
                             c2=0;
                         if(data['outarget3']!=null)
                           { c3=data['outarget3'].length; var nc3=360/c3;}
                         else
                            c3=0;
                         if(data['outarget4']!=null)
                          { c4=data['outarget4'].length; var nc4=360/c4;}
                         else
                           c4=0;
                        var r1=200;
                        var r2=400;
                        var r3=600;
                        var r4=800;
                        var i1=0,i2=0,i3=0,i4=0;
                       /* var nc1=360/c1;
                        var nc2=360/c2;
                        var nc3=360/c3;
                        var nc4=360/c4;*/
                        for(var i=0;i<c1;i++){
                        var tmpId=data['outarget1'][i];
                        var tmpWeight =data['out1R'][i];
                        i1=i1+nc1;
                        var x = Math.cos(Math.PI / 180 * i1) * r1 + _x;
                        var y = Math.sin(Math.PI / 180 * i1) * r1 + _y;
                        cy.add({group: "nodes", data: { id: tmpId, weight: tmpWeight,label:'target1',position:{"x":x,"y":y}}});
                        cy.$("#"+tmpId).qtip({
                          content: tmpId,
                          position: {
                            my: 'top center',
                            at: 'bottom center'
                          },
                          style: {
                            classes: 'qtip-bootstrap',
                            tip: {
                              width: 16,
                              height: 8
                            }
                          }
                        });
                        }


                        for(var i=0;i<c2;i++){
                        var tmpId=data['outarget2'][i];
                        var tmpWeight =data['out2R'][i];
                        i2=i2+nc2;
                        var x = Math.cos(Math.PI / 180 * i2) * r2 + _x;
                        var y = Math.sin(Math.PI / 180 * i2) * r2 + _y;
                        cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'target2',position:{"x":x,"y":y}}});
                        cy.$("#"+tmpId).qtip({
                          content: tmpId,
                          position: {
                            my: 'top center',
                            at: 'bottom center'
                          },
                          style: {
                            classes: 'qtip-bootstrap',
                            tip: {
                              width: 16,
                              height: 8
                            }
                          }
                        });
                        }

                        for(var i=0;i<c3;i++){
                        var tmpId=data['outarget3'][i];
                        var tmpWeight =data['out3R'][i]; 
                        i3=i3+nc3;
                        var x = Math.cos(Math.PI / 180 * i3) * r3 + _x;
                        var y = Math.sin(Math.PI / 180 * i3) * r3 + _y;
                        cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'target3',position:{"x":x,"y":y}}});
                        cy.$("#"+tmpId).qtip({
                          content: tmpId,
                          position: {
                            my: 'top center',
                            at: 'bottom center'
                          },
                          style: {
                            classes: 'qtip-bootstrap',
                            tip: {
                              width: 16,
                              height: 8
                            }
                          }
                        });
                        }

                        for(var i=0;i<c4;i++){
                        var tmpId=data['outarget4'][i];
                        var tmpWeight =data['out4R'][i]; 
                        i4=i4+nc4;
                        var x = Math.cos(Math.PI / 180 * i4) * r4 + _x;
                        var y = Math.sin(Math.PI / 180 * i4) * r4 + _y;
                        cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'target4',position:{"x":x,"y":y}}});
                        cy.$("#"+tmpId).qtip({
                          content: tmpId,
                          position: {
                            my: 'top center',
                            at: 'bottom center'
                          },
                          style: {
                            classes: 'qtip-bootstrap',
                            tip: {
                              width: 16,
                              height: 8
                            }
                          }
                        });
                        }
                        
                        /*cy.add({ group: "edges", data: { source: data['outsource'][0].toString(), target: data['outarget1'][0].toString() } });
                        cy.add({ group: "edges", data: { source: data['outsource'][0].toString(), target: data['outarget2'][0].toString() } });
                        cy.add({ group: "edges", data: { source: data['outsource'][0].toString(), target: data['outarget3'][0].toString()} });
                        cy.add({ group: "edges", data: { source: data['outsource'][0].toString(), target: data['outarget4'][0].toString() } });*/
                        var tmpSource=data['outsource'];
 
                        for(var i=0;i<c1;i++){
                        //var tmpSource=data['outarget1'][0];
                        var tmpTarget=data['outarget1'][i];
                        cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });

                        }

 
                        for(var i=0;i<c2; i++){
                        //var tmpSource=data['outarget2'][0];
                        var tmpTarget=data['outarget2'][i];
                        cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });

                        }

 
                        for(var i=0;i<c3;i++){
                        //var tmpSource=data['outarget3'][0];
                        var tmpTarget=data['outarget3'][i];
                        cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });

                        }

 
                        for(var i=0;i<c4;i++){
                        //var tmpSource=data['outarget4'][0];
                        var tmpTarget=data['outarget4'][i];
                        cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });

                        }


                        options = {
                          
                        name: 'preset',

  positions: function(node){ return this.data('position'); }, // map of (node id) => (position obj); or function(node){ return somPos; }
  zoom: undefined, // the zoom level to set (prob want fit = false if set)
  pan: undefined, // the pan level to set (prob want fit = false if set)
  fit: true, // whether to fit to viewport
  padding: 30, // padding on fit
  animate: false, // whether to transition the node positions
  animationDuration: 500, // duration of animation in ms if enabled
  animationEasing: undefined, // easing of animation if enabled
  ready: undefined, // callback on layoutready
  stop: undefined // callback on layoutstop

                        };

                        cy.layout( options );
                            if(!$("#cytoshow").is(":visible")){
                                $('#css_show').toggle();
                                    $('#cytoshow').toggle();
                                }
}
function nosee()
{
    // if($("#mapshow").is(":visible")){
     // $('#mapshow').toggle();
   // }

    // if($("#cytoshow").is(":visible")){
      $('#css_show').toggle();
      $('#cytoshow').toggle();
   // }
}

  function savecurves(type)
{
  var oCanvas= document.querySelector("canvas[id='cvs1']");
   // var oCanvas=document.getElementById("cvs1"); 
   //设置保存图片的类型
    var imgdata = oCanvas.toDataURL(type);
    //将mime-type改为image/octet-stream,强制让浏览器下载
    var fixtype = function (type) {
        type = type.toLocaleLowerCase().replace(/jpg/i, 'jpeg');
        var r = type.match(/png|jpeg|bmp|gif/)[0];
        return 'image/' + r;
    }
    imgdata = imgdata.replace(fixtype(type), 'image/octet-stream');
    //将图片保存到本地
    var saveFile = function (data, filename) {
        var link = document.createElement('a');
        link.href = data;
        link.download = filename;
        var event = document.createEvent('MouseEvents');
        event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        link.dispatchEvent(event);
    }
    var filename = new Date().toLocaleDateString() + '.' + type;
    saveFile(imgdata, filename);
}



function savepic(type)
{
    //var oCanvas = document.getElementById("layer2-node");
  var oCanvas= document.querySelector("canvas[data-id='layer2-node']");
   //设置保存图片的类型
    var imgdata = oCanvas.toDataURL(type);
    //将mime-type改为image/octet-stream,强制让浏览器下载
    var fixtype = function (type) {
        type = type.toLocaleLowerCase().replace(/jpg/i, 'jpeg');
        var r = type.match(/png|jpeg|bmp|gif/)[0];
        return 'image/' + r;
    }
    imgdata = imgdata.replace(fixtype(type), 'image/octet-stream');
    //将图片保存到本地
    var saveFile = function (data, filename) {
        var link = document.createElement('a');
        link.href = data;
        link.download = filename;
        var event = document.createEvent('MouseEvents');
        event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        link.dispatchEvent(event);
    }
    var filename = new Date().toLocaleDateString() + '.' + type;
    saveFile(imgdata, filename);

}


function savepic2(type){
    var oCanvas= document.querySelector("canvas[data-zr-dom-id='zr_0']");
   //设置保存图片的类型
      var fixtype = function (type) {
        type = type.toLocaleLowerCase().replace(/jpg/i, 'jpeg');
        var r = type.match(/png|jpeg|bmp|gif/)[0];
        return 'image/' + r;
    }   

    var imgdata = oCanvas.toDataURL(type);
     imgdata = imgdata.replace(fixtype(type), 'image/octet-stream');       
    var image = new Image;
     image.src = imgdata;
     image.onload = function() {
       

       var canvasdata = oCanvas.toDataURL("image/png");

       var pngimg = '<img src="'+canvasdata+'">';
       $("#img_src").html(pngimg);
        var filename = new Date().toLocaleDateString() + '.' + type;
       oCanvas.toBlob(function(blob) {
        saveAs(blob, filename);
    });
   };

    //将mime-type改为image/octet-stream,强制让浏览器下载
   // imgdata = imgdata.replace(fixtype(type), 'image/octet-stream');
    //将图片保存到本地
   /* var saveFile = function (data, filename) {
        var link = document.createElement('a');
        link.href = data;
        link.download = filename;
        var event = document.createEvent('MouseEvents');
        event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
        link.dispatchEvent(event);
    }
    var filename = new Date().toLocaleDateString() + '.' + type;
    saveFile(imgdata, filename);*/
}


  //$('.progress .progress-bar').progressbar({display_text: 'fill'});
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url('public/js/bootstrap-switch.js')?>"></script>
<script src="<?=base_url('public/assets/js/ie10-viewport-bug-workaround.js')?>"></script>
</body>
</html>
