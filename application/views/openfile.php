<!DOCTYPE html>

<html lang="en">
<head>
    <?php include 'include/resource.php';?>
    <style type="text/css">

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
<script src="<?=base_url('public/js/jquery.min.js')?>" type="text/javascript"></script>
</head>
<? $this->load->library('session');?>
<!-- END HEAD -->

<body  class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#">
                <h4>GestureNetwork</h4> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                    <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                    <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                        <a href="javascript:;" class="remove">
                            <i class="icon-close"></i>
                        </a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="nav-item start active open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Interface</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">File</h3>
                </li>
                <li class="nav-item ">
                    <a href="<?=site_url('File/login2');?>" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">Open File</span>
                        <span class="selected"></span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="<?=site_url('File/load_file');?>" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Load File</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">Genes</h3>
                </li>
                <li class="nav-item " onclick="random_selected()">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Random selected</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="nav-item" onclick="random_new()">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Random New</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">Option</h3>
                </li>
                <li class="nav-item " onclick="brush()" id="brush">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Brush model</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item" onclick="edit_contrast()">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Contrast model</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item " onclick="edit_shift()">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Shift model</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item" align="center"> 
                      <select  id="select_shift1" class="select" disabled>
                        <option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>

                  
                    <i class="icon-bulb"></i>
                    <span class="title"><font color="white" size="5">--</font></span>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select  id="select_shift2" class="select" onchange="select_shift()" disabled>
                        <option  value="0" selected="selected" >--</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>
                    
                </li>
                <li class="heading">
                    <h3 class="uppercase">Output</h3>
                </li>
                <li class="nav-item " onclick="save_file()">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Save to file</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('File/cyto1')?>" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Save to Cyto1</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item" onclick="savetoscape2()">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">Save to Cyto2</span>
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->


        <div class="page-content">
           
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?=base_url();?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>

                         <span>Hand-draw</span>
                    </li>
                </ul>
                <?php if($hi==1) ?>
                  <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" onclick="javascript:history.back(-1);">
                       <span>Go  back</span>
                      <!--<i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                        <i class="fa fa-angle-down"></i>-->
                    </div>
                </div>
            </div>
            <h3 class="page-title">Gesture
                <small><input id="strpara" type="text" value="" size="30" style="margin-right:300px;margin-left:50px;background:transparent;border:0"></small>
                <div class="pull-right" style="width:30%;">
                <button class="  btn btn-sm" id="research">Research</button>
                <button class="pull-right tooltips btn btn-sm" onclick="clearall();">Reset</button>
               </div>
                <input id="ex7" type="text" data-slider-min="0" data-slider-max="1.0" data-slider-step="0.1" data-slider-value="0.67" data-slider-enabled="true"／>
               <!-- <input id="ex7-enabled" type="checkbox"/><small>Enabled</small>-->
            </h3>
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

                   //alert("result="+result);

                    //setdata(result,n);
                   // arrx=arrx.join(",");
                   // arry=arry.join(",");
                    //var comUrl="<?php echo site_url('File/compute')?>";
                   //console.log(arrx);

                });
                </script>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="clearfix"></div>
            <!--<iframe id="menuFrame" name="menuFrame" style="overflow:visible;"
                    scrolling="yes"  frameborder="no" width="100%" height="100%"></iframe>--><!--onload="changeFrameHeight()" -->
            
            <div class="row" align="center">
                <canvas id="can" width="1000" height="500">
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
                        //alert(yyh);
                        document.getElementById("strpara").value=str;

                        
                        setInterval1(xx,yyl,yyh);//html5-canvas-drawing-app1.js
                        prepareCanvas();//html5-canvas-drawing-app1.js

                         setIntervals(xx,yyl,yyh);//drawaxes.js
                        //prepareCanvas1();//drawaxes.js
                        
                        
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
                        

                        showcanvas2();
                        //alert(targetd);
                        setdata(targetd,xx);  
                        SetOtherData(goal,xx);
                        filltable(tabledata,filename);
                        }
                        
                        
                    });
                </script>
            </div>
            <div class="row" align="center" id="canv1" >
                
                  <div id="config">
                </div>

            </div>
           <input type='hidden' id='operation' value="<?php echo $operafile; ?>">
            <div class="row" style="display:none" id="showtable">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <a name="anchor"></a>
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>GeneData table</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable" id="empty_table">
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th scope="col" style="width:450px !important"> GeneName</th>
                                                        <th scope="col">p_value </th>
                                                        <?php for($i=0;$i<$xx;$i++){ ?>
                                                        <th scope="col"> Column <?php echo $i+1;?> </th>
                                                        <?php } 
                                                        ?>

                                                    </tr>
                                                </thead>
                                                <tbody id="insert_selected_genes">
                                                   
                                                </tbody>
                                               <!-- <ul class="pager"> 
                                                    <li id="spanPre"><a href="#">Previous</a></li>
                                                    <li id="spanNext"><a href="#">Next</a></li>
                                                </ul>-->
                                                
                                            </table>
                                        </div>
                                    </div>
            
                                </div>
            </div>
          

          <div class="progress">
            <div class="progress-bar progress-bar-info six-sec-ease-in-out" role="progressbar" data-transitiongoal="60"></div>
          </div>
          
           
        </div>




        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->


    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes.
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<!-- END FOOTER -->
<?php include 'include/footer.php';?>
<!--[if IE]><script type="text/javascript" src="<?=base_url('public/js/excanvas.js')?>"></script><![endif]-->

<script type="text/javascript" src="<?=base_url('public/js/html5-canvas-drawing-app1.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/drawaxes.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/js/analysisdata.js')?>"></script>
<script type="text/javascript">
$("#ex7").slider();
  $('.progress .progress-bar').progressbar({display_text: 'fill'});
 /*var slider = new Slider("#ex7");

$("#ex7-enabled").click(function() {
    if(this.checked) {
        // With JQuery
        $("#ex7").slider("enable");

        // Without JQuery
        slider.enable();
    }
    else {
        // With JQuery
        $("#ex7").slider("disable");

        // Without JQuery
        slider.disable();
    }
});*/

</script>

</body>

</html>