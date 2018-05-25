<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gesture, A web-based Gene network tool</title>

    <!-- Bootstrap core CSS -->
   
    <link href="<?=base_url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('public/assets/css/font-awesome.min.css')?>" rel="stylesheet" >
    <link rel="stylesheet" href="<?=base_url('public/css/line_style.css')?>" media="screen" type="text/css" />
    <link href="<?=base_url('public/assets/css/sticky-footer.css')?>" rel="stylesheet">
    <!-- Custom styles for this template -->
       <link href="<?=base_url('public/global/css/components.min.css" rel="stylesheet')?>" id="style_components" type="text/css" />
        <link href="<?=base_url('public/global/css/plugins.min.css')?>" rel="stylesheet" type="text/css" />
         <link href="<?=base_url('public/css/fileinput.css')?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
    



    <script type="text/javascript" src="<?=base_url('public/assets/js/ie-emulation-modes-warning.js')?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" href="<?=base_url('public/assets/css/font-awesome-ie7.min.css')?>">
<![endif]-->
    
    <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
  <!-- <script type="text/javascript" src="<?//=base_url('public/js/bootstrap-modal.js')?>"></script>-->
   <script type="text/javascript" src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/line.js')?>"></script>

</head>
<body>
<!-- Back to Top -->
<div style="position:fixed; _position:absolute; bottom:0px; left:0px; width:1300px; height:85px; display:none;" class="actGotop"><a href="javascript:;" title="Top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> Back to Top</a></div>
<!-- Begin page content -->
<div class="container">

<div class="page-header">
    <h1>Step1:upload a file</h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url();?>">Home</a></li>
      <li class="active">File</li>
    </ol>
</div>

             

<br/>
<div calss="row">
   <form enctype="multipart/form-data" method="POST">
     <div class="form-group">
         <input id="file-1" type="file" multiple class="file" name="input_file" data-overwrite-initial="false" data-min-file-count="1">
     </div>
 </form>
</div>

    <br/>
<div id="jqxNotification"><span class="glyphicon glyphicon-exclamation-sign"></span><font size="4">Tips:</font></div>
<div>1. Please upload a <strong>csv</strong> file.</div>
<div>2. Do not include the  <strong>header </strong>in the file.</div>
<div>3. First column is the  <strong>gene name</strong>,the rest columns are the <strong>data</strong>.</div>
<div>4. The<strong> dimension</strong> of your file should not less than 5 and the <strong>size</strong> of your file should less than 15MB,or it will cause error!</div>   



<div class="modal fade" id="tips" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-sm">
 <div class="modal-content"> 
 <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">normalize the file data</h4>
            </div>     
  <div class="modal-body">
  	<p>Do you want to normalize the file data?</p>
  </div>
 <div class="modal-footer">
  <button  type="button" class="btn btn-default cancel"  data-dismiss="modal">no</button>
  <button  type="button" class="btn btn-primary ok"  id="norm_yes" value="0" onclick="normalize_file();" data-dismiss="modal">yes</button>
</div>
  
  </div>
 </div>
 </div>

</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Cite: <a>GEsture, A web-based gene search tool  </a> by <a href="mailto:carrie_chunyan@qq.com">chunyanwang</a> @ 2017</p>
  </div>
</footer>

       
       <script src="<?=base_url('public/global/scripts/app.min.js')?>" type="text/javascript"></script>

        <script src="<?=base_url('public/layouts/layout/scripts/layout.min.js')?>" type="text/javascript"></script>
         <script src="<?=base_url('public/layouts/global/scripts/quick-sidebar.min.js')?>" type="text/javascript"></script>

<script type="text/javascript" src="<?=base_url('public/assets/js/ie10-viewport-bug-workaround.js')?>"></script>

<script src="<?=base_url('public/js/fileinput.min.js')?>" type="text/javascript"></script>


   
<script type="text/javascript">

 $("#file-1").fileinput({
              uploadUrl: "/GEsture/index.php/File/file_upload", // you must set a valid URL here else you will get an error
              uploadAsync: true, //默认异步上传
             // showPreview : false, 
              allowedPreviewTypes:['image'],
              allowedFileExtensions : ['csv'],
              overwriteInitial: false,
              maxFileSize: 0,
              slugCallback: function(filename) {
                 $("#tips").modal("show");
                 return filename.replace('(', '_').replace(']', '_');
                 
             }
         }).on("fileuploaded", function (event, data) {
            //异步上传后返回结果处理
            //后台一定要返回json对象,空的也行。否则会出现提示警告。
            //返回对象的同时会显示进度条，可以根据返回值进行一些功能扩展
           // $("#tips").modal("show");//显示“正在查询”字样的模态框
          if(data.response['flag']==1)  
              prepareinterface(data.response['link'],data.response['filename']);          else
            {  alert("the file content does't conform to the format, please refer to the Manual on the home page !"); 
               $("#file-1").fileinput('reset');
          } 
         // window.location.href="/GEsture/index.php/File/cluster/"+data.response['link']+"/"+data.response['filename']+"/1";


        });
function normalize_file()
{
   $("#norm_yes").val('1');
}
function prepareinterface(filelink,filename)
{
 // $("#tips").modal("show");
  var flag1=document.getElementById("norm_yes").value;
  htmlobj = $.ajax({ 
 url:"/GEsture/index.php/File/process", 
 type : 'POST', 
 data : { 'filelink' :filelink,'filename':filename,'flag1':flag1}, 
 dataType : "json", 
 //contentType : 'application/x-www-form-urlencoded', 
 async : false, 
 success : function(data) { 

  if(data['flag']==1)
 // alert(data['row']);
  window.location.href="/GEsture/index.php/File/cluster/"+filelink+"/"+filename+"/1";
 }, 
 error: function (XMLHttpRequest, textStatus, errorThrown) { 
 alert("fail to upload the file!");
   console.log(errorThrown); 
 } 
}); 

}
</script>
</body>
</html>
