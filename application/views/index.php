<!DOCTYPE HTML>
<html>
    <head>
        <title>GEsture</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="<?=base_url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet">
        <link href="<?=base_url('public/css/Buttons.css')?>" rel="stylesheet">
        <link href="<?=base_url('css/video-js.css')?>" rel="stylesheet">
        <!--[if lte IE 8]><script src="<?base_url('css/ie/html5shiv.js')?>"></script><![endif]-->
        
        <script src="public/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
        <script src="<?=base_url('js/jquery.poptrox.min.js')?>"></script>
        <script src="<?=base_url('js/skel.min.js')?>"></script>
        <script src="<?=base_url('js/init.js')?>"></script>
        <script src="<?=base_url('js/video.min.js')?>"></script>
        <script src="<?=base_url('js/videojs-ie8.min.js')?>"></script>
       <script type="text/javascript" src="<?=base_url('public/js/PDFObject/pdfobject.js')?>"></script>
        <noscript>
            <link rel="stylesheet" href="<?=base_url('css/skel-noscript.css')?>" />
            <link rel="stylesheet" href="<?=base_url('css/style.css')?>" />
            
        </noscript>
<style>
 *{  
            margin: 0px;  
            padding: 0px;  
        }  
        video{   
            right: 0px;  
            bottom: 0px;  
            min-width: 100%;  
            min-height: 100%;  
            height: 100%;  
            width: 100%; 
            /*加滤镜*/  
            /*-webkit-filter: grayscale(100%);*/  
            /*filter:grayscale(100%);*/  
        }  
        source{  
            min-width: 100%;  
            min-height: 100%;  
            height: 100%;  
            width: 100%;  
        }  
</style>
        <!--[if lte IE 8]><link rel="stylesheet" href="<?=base_url('css/ie/v8.css')?>" /><![endif]-->
    </head>
    <body>

        <!-- Header -->
            <header id="header">

                <!-- Logo -->
                    <h1 id="logo"><a href="#">GEsture</a></h1>
                
                <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li><a href="#intro">Intro</a></li>
                            <li><a href="#one">Who I Am</a></li>
                            <li><a href="#two">What I Do</a></li>
                            <li><a href="#work">Video</a></li>
                            <li><a href="javascript:void(0);" onclick="showpdf()">Manual</a></li>
                            
                        </ul>
                    </nav>

            </header>
            
        <!-- Intro -->
            <section id="intro" class="main style1 dark fullscreen">
               <!-- <video autoplay="autoplay" loop="loop">
                      <source  src="<?//=base_url('mv.mp4')?>" type="video/mp4">
                    </video>-->
                <div class="content container small"> 
                    <header>
                        <h2>Hi.</h2>
                    </header>
                    <p>Welcome to <strong>GEsture</strong>, an effective, visual search tool by drawing the curve of gene expression
                    
                     </p>
                    
                     <a href="<?=site_url('File/example') ?>" class="button button-glow button-rounded button-caution"><b>Demo</b></a>or
                     <a href="<?=site_url('File/fileSU') ?>" class="button button-glow button-rounded button-caution"><b>Start</b></a> 
                    <footer>
                        <a href="#one" class="button style2 down">More</a>
                    </footer>
                </div>
            </section>
           <!-- <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >Website Template</a></div>-->
        
        <!-- One -->
            <section id="one" class="main style2 right dark fullscreen">
                
               
                <div class="content box style2">
                    <header>
                        <h2>Who I am</h2>
                    </header>
                    <p>I am designed to identify genes that exhibit an expression pattern similar to that of interest by drawing or using a familiar gene expression curve, and simultaneously can dig invert, shift expression genes. </p>
                     <p><img src="<?=base_url('images/workflow.jpg');?>" style="width:50%;height:50%" /></p>
                    
                </div>
                <a href="#two" class="button style2 down anchored">Next</a>
            </section>
        
        <!-- Two -->
            <section id="two" class="main style2 left dark fullscreen"> 
                <div class="content box style2">
                    <header>
                        <h2>My advantages</h2>
                    </header>
                    <p>generate online display,operate flexibly and quickly</p>
                    <p><img src="<?=base_url('images/new.png');?>" style="width:60%;height:60%" /></p>
                </div>  
                
                <a href="#work" class="button style2 down anchored">Next</a>
            </section>

            
        <!-- Work -->
            <section id="work" class="main style3 primary">
                <div class="content container">
                    <header>
                        <h2>Video</h2>
                        <p>Here we use an video to show the key procedures of GEsture.</p>
                    </header>
                    
                    <!--
                         Lightbox Gallery
                         
                         Powered by poptrox. Full docs here: https://github.com/n33/jquery.poptrox
                    -->
                        <div class="container small gallery">
                            <div class="row flush images">
                             <video id="video_1" class="video-js vjs-default-skin" controls preload="none" width="800" height="400" position="relative" poster="<?=base_url('images/about/step10.jpg')?>"
                                  data-setup="{}">
                                <source src="<?=base_url('mv1.mp4')?>" type='video/mp4' />
                                 </video>
                              <!-- <video controls="controls">
                      <source  src="<?//=base_url('mv1.mp4')?>" type="video/mp4">
                    </video>-->
                            </div>
                           <!-- <div class="row flush images">
                                <div class="6u"><a href="images/about/step3.jpg" class="image full l"><img src="images/about/step3.jpg" title="query the curve of YNL309W" alt="" /></a></div>
                                <div class="6u"><a href="images/about/step4.jpg" class="image full r"><img src="images/about/step4.jpg" title="the curve of YNL309W" alt="" /></a></div>
                            </div>
                            <div class="row flush images">
                                <div class="6u"><a href="images/about/step5.jpg" class="image full l"><img src="images/about/step5.jpg" title="the co-expression gene curves of YNL309W" alt="" /></a></div>
                                <div class="6u"><a href="images/about/step6.jpg" class="image full r"><img src="images/about/step6.jpg" title="the curve of contrast pattern" alt="" /></a></div>
                            </div>
                            <div class="row flush images">
                                <div class="6u"><a href="images/about/step7.jpg" class="image full l"><img src="images/about/step7.jpg" title="the curve of shift pattern" alt="" /></a></div>
                                <div class="6u"><a href="images/about/step8.jpg" class="image full r"><img src="images/about/step8.jpg" title="the result table of similar genes of  YNL309W" alt="" /></a></div>
                            </div>
                            <div class="row flush images">
                                <div class="6u"><a href="images/about/step9.jpg" class="image full l"><img src="images/about/step9.jpg" title="heat map of result genes " alt="" /></a></div>
                                <div class="6u"><a href="images/about/step10.jpg" class="image full r"><img src="images/about/step10.jpg" title="network map of total result genes" alt="" /></a></div>
                            </div>
                         <div class="row flush images">
                                <div class="6u"><a href="images/about/step11.jpg" class="image full l"><img src="images/about/step11.jpg" title="k-means clustering and input the number of k" alt="" /></a></div>
                                <div class="6u"><a href="images/about/step12.jpg" class="image full r"><img src="images/about/step12.jpg" title="the results of clustering" alt="" /></a></div>
                            </div>-->
                        </div>

                </div>
            </section>
            
        <!-- Contact -->
            <section id="contact" class="main style3 secondary">
               
                    
                       
                          
            </section>
            
        <!-- Footer -->
            <footer id="footer">
            
               
                    <ul class="menu" align="center">
                        <li>&copy; WCY</li>
                        <li>Cite: <a>GEsture, A web-based gene search tool</a> by <a href="mailto:carrie_chunyan@qq.com">Chunyanwang</a> @ 2017</li>
                    </ul>
            
            </footer>
<script type="text/javascript">
function showpdf()
{var url="<?=base_url('pdf/Manual.pdf');?>";
PDFObject.embed(url);
}
</script>
    </body>
</html>
