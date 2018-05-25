<!DOCTYPE html>

<html lang="en">
<head>
    <!--<link href="<?//=base_url('public/css/fontstyle.css')?>" rel="stylesheet" type="text/css" >-->
    <?php include 'include/resource.php';?>
    <style type="text/css">

        #config {width:940px;padding:5px;background:#000;color:#fff;}
        #ServerList {margin-top:5px;}
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
    </style>
<script src="<?=base_url('public/js/jquery-1.11.1.min.js')?>" type="text/javascript"></script>
</head>

<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
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
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
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
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title"> Interface</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">File</h3>
                </li>
                <li class="nav-item start active open">
                    <a href="<?=site_url('File/open');?>" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">Open File</span>
                        <span class="selected"></span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="#select_file" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Load File</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="heading">
                    <h3 class="uppercase">New</h3>
                </li>
                <li class="nav-item ">
                    <a href="<?=site_url('File/newname');?>" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Random New</span>
                        <span class="arrow"></span>
                    </a>

                </li>
                <li class="nav-item  ">
                    <a href="<?=site_url('File/named_New');?>" class="nav-link nav-toggle">
                        <i class="icon-bulb"></i>
                        <span class="title">named New</span>
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
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>
            </div>

            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

            <div class="clearfix"></div>
            <!--<iframe id="menuFrame" name="menuFrame" style="overflow:visible;"
                    scrolling="yes"  frameborder="no" width="100%" height="100%"></iframe>--><!--onload="changeFrameHeight()" -->

            <div class="row">
               <!-- <div class="col-md-6 col-sm-6">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-blue"></i>
                                <span class="caption-subject font-blue bold uppercase">data files</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a class="btn btn-sm blue btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter By
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                        <label>
                                            <input type="checkbox" /> Finance</label>
                                        <label>
                                            <input type="checkbox" checked="" /> Membership</label>
                                        <label>
                                            <input type="checkbox" /> Customer Support</label>
                                        <label>
                                            <input type="checkbox" checked="" /> HR</label>
                                        <label>
                                            <input type="checkbox" /> System</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <li>
                                        <a href="<?=site_url('File/open/yeastExpression.csv')?>">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> yeastExpression.csv
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> Just now </div>
                                        </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=site_url('File/open').'/ToyData.csv';?>">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bar-chart-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> ToyData.csv </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                         <a href="<?=site_url('File/open/Human_cell_cycle_demo2.csv')?>">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-danger">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Human_cell_cycle_demo2.csv</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                         </a>
                                    </li>
                                    <li>
                                         <a href="<?=site_url('File/open/Human_cell_cycle_demo3.csv')?>">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Human_cell_cycle_demo3.csv
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 30 mins </div>
                                        </div>
                                         </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> gb-2008-9-8-r130-s1.csv </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> human_gene1.csv
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 2 hours </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-briefcase"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> human_gene2.csv</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> huaman_gene3.csv
                                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> Just now </div>
                                        </div>
                                    </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bar-chart-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> human_gene4.csv</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> human_gene5.csv </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-info">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> human_gene5.csv
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 30 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> human_gene6.csv</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> human_gene7.csv
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 2 hours </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="scroller-footer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">-->
                    <div class="portlet light tasks-widget bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-green-haze hide"></i>
                                <span class="caption-subject font-green bold uppercase">Files</span>
                                <span class="caption-helper">files upload...</span>
                            </div>
                            <div class="actions">
                                <div class="btn-group">
                                    <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;"> All Project </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="javascript:;"> AirAsia </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> Cruise </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> HSBC </a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="javascript:;"> Pending
                                                <span class="badge badge-danger"> 4 </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> Completed
                                                <span class="badge badge-success"> 12 </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> Overdue
                                                <span class="badge badge-warning"> 9 </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="task-content">
                                <div class="scroller" style="height: 312px;" data-always-visible="1" data-rail-visible1="1">
                                    <!-- START TASK LIST -->
                                    <ul class="task-list">
                                        <?php if($count==0){ ?>
                                            <li>no upload files!</li>
                                        <?php } else{ ?>
                                        <?php for($i=0;$i<$count;$i++){ ?>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <a href="<?=site_url('File/open/').$files[$i];?>"><span class="task-title-sp" ><?php echo $files[$i]; ?></span></a>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href=<?=site_url('File/open/').$files[$i]?> data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                        <a onclick="delete_files('<?php echo $files[$i];?>','<?php echo $username;?>')">
                                                            <i class="fa fa-pencil"></i> Delete
                                                        </a>
                                                        
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    <?php }} ?>
                                        <!--<li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data2 </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data3 </span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data4 </span>
                                                <span class="label label-sm label-warning">Company</span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data5 </span>
                                                <span class="label label-sm label-info">Internal Products</span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data6 </span>
                                                <span class="label label-sm label-danger">SmartVision</span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data7 </span>
                                                <span class="label label-sm label-default">AutoSmart</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group dropup">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data8 </span>
                                                <span class="label label-sm label-success">Cruise</span>
                                                        <span class="task-bell">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group dropup">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="last-line">
                                            <div class="task-checkbox">
                                                <input type="checkbox" class="liChild" value="" /> </div>
                                            <div class="task-title">
                                                <span class="task-title-sp"> data9 </span>
                                                <span class="label label-sm label-warning">KeenThemes </span>
                                            </div>
                                            <div class="task-config">
                                                <div class="task-config-btn btn-group dropup">
                                                    <a class="btn btn-sm default" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                        <i class="fa fa-cog"></i>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-check"></i> Complete </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-pencil"></i> Edit </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;">
                                                                <i class="fa fa-trash-o"></i> Cancel </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>-->
                                    </ul>
                                    <!-- END START TASK LIST -->
                                </div>
                            </div>
                            <div class="task-footer">
                                <?php if($count>8){ ?>
                                <div class="btn-arrow-link pull-right">
                                    <a href="javascript:;">See All Records</a>
                                    <i class="icon-arrow-right"></i>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                
            </div>
            <div class="row" >
                              <div class="form-group" >
                                <!--<input id="file-Portrait1" type="file">-->
                                <!--<input id="file-0a" class="file" type="file" multiple data-min-file-count="1" name="photo">-->
                               <label class="control-label">Select File</label>
                                <input id="input-7" name="input_file"  type="file" class="file file-loading" data-allowed-file-extensions='["csv"]' ><!--data-upload-url=""-->
                               <!--<input id="file-3" type="file" name="photo">-->
                               <!-- <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1" name="photo">
                                <!--<div class="btn btn-default btn-file" onclick="$('input[id=lefile]').click();">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input  type="file" name="photo" id="lefile" >
                                </div>
                                <input id="photoCover" type="text" class="form-control">-->
                               <!-- <input id="file-4" type="file" class="file" data-upload-url="<?//=base_url('Welcomne/editor')?>" name="photo">-->
                            </div>
                            <a name="select_file"></a>




               <!-- <form action="" enctype="multipart/form-data">
                    <input id="kv-explorer" type="file" multiple>
                    <br>
                    <input id="file-0a" class="file" type="file" multiple data-min-file-count="1">
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>-->
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
<script>
function delete_files(filename,username)
{
  //alert(filename);
  var editURL = "/GeneNetwork/index.php/File/delete_files";
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"filename":filename,"username":username},
        dataType: "json",
        async:true,
        success:function(data){  
            if(data)
                alert("delete successfully");
             setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },200); 
        }
    }); 
}

$("#input-7").fileinput({
    uploadUrl: "/GeneNetwork/index.php/File/file_upload", // server upload action
    uploadAsync: false,
    initialPreviewAsData: true // identify if you are sending preview data only and not the markup
    
    //initialPreview:"/GeneNetwork/uploads/files/", //要显示的图片的路径
});
</script>
</body>

</html>