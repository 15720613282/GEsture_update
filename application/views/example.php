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
    <!-- Custom styles for this template -->
    <link href="<?=base_url('public/assets/css/sticky-footer.css')?>" rel="stylesheet">
     <link href="<?=base_url('public/css/fileinput.css')?>" rel="stylesheet" type="text/css" />

    <!-- Main CSS by Ethan-->
   
    <script src="<?=base_url('public/assets/js/ie-emulation-modes-warning.js')?>"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE 7]>
<link rel="stylesheet" href="<?=base_url('public/assets/css/font-awesome-ie7.min.css')?>">
<![endif]-->

    <script type="text/javascript" src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('public/js/fileinput.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('public/js/line.js')?>"></script>

</head>
<body>

<!-- Back to Top -->
<div style="position:fixed; _position:absolute; bottom:0px; left:0px; width:1300px; height:85px; display:none;" class="actGotop"><a href="javascript:;" title="Top"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> Back to Top</a></div>

<!-- Begin page content -->
<div class="container">

<div class="page-header">
    <h1>Step1:choose a file</h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url();?>">Home</a></li>
      <li class="active">File</li>
    </ol>
</div>
 <div class="row">
 <font size="5">example files:</font>&nbsp;&nbsp;&nbsp;<select id="select_file" onchange="change_pic();"  style="font-family: Arial, Helvetica, sans-serif; background-color: rgb(255, 255, 255);" >
    <option value="yeastExpression.csv" selected>yeastExpression.csv</option>
    <option value="Arabidopsis.csv">Arabidopsis.csv</option>
    
</select>
&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-exclamation-sign"></span><font size="4">Tips:</font> After choosing a file,click the  <strong>Next</strong> button directly,the example files have been uploaded.
</div>
 <br>
 <div class="row">
 <img id="img1" src="<?=base_url('public/images/screen1.png')?>" style="width:100%; height:100%; z-index:-1" />
 
</div>
   
 

<br/>
<div style="height:10px;"></div>
<div id="jqxgrid">

<div id="drawlines" style="width:1200px"></div>
</div>
    <br/>
    <button class="btn btn-success" id="btnNext" onclick="clustera()" type="button">Next<i class="icon-circle-arrow-right" aria-hidden="true"></i></button>
<br/><br/>
</div>
<footer class="footer">
  <div class="container">
    <p class="text-muted">Cite: <a>GEsture, A web-based gene search tool</a> by <a href="mailto:carrie_chunyan@qq.com">chunyanwang</a> @ 2017</p>
  </div>
</footer>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url('public/assets/js/ie10-viewport-bug-workaround.js')?>"></script>
<script type="text/javascript">
function change_pic()
{
  var str=document.getElementById('select_file').value;
  var element = document.getElementById('img1');
  if(str=="Arabidopsis.csv")
      element.src = "<?=base_url('public/images/screen2.png')?>";
  else
      element.src = "<?=base_url('public/images/screen1.png')?>";
}

function clustera(){
  var fi=$("#select_file").val();
  var str = "";
    var pos,filelink;
     var arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    for(var i=0; i<4; i++){
        pos = Math.round(Math.random() * (arr.length-1));
        str += arr[pos];
    }
     filelink="WCY"+str;
  window.location.href="/GEsture/index.php/File/cluster/"+filelink+"/"+fi+"/1";
}
</script>
<script type="text/javascript">  

 $("#file-1").fileinput({
              uploadUrl: "/GEsture/index.php/File/file_upload", // you must set a valid URL here else you will get an error
              uploadAsync: true, //默认异步上传
              allowedFileExtensions : ['csv'],
              overwriteInitial: false,
              maxFileSize: 6000,
              maxFilesNum: 10,
              //allowedFileTypes: ['image', 'video', 'flash'],
              slugCallback: function(filename) {
                //alert(filename);
                 return filename.replace('(', '_').replace(']', '_');

             }
         }).on("fileuploaded", function (event, data) {
            //异步上传后返回结果处理
            //后台一定要返回json对象,空的也行。否则会出现提示警告。
            //返回对象的同时会显示进度条，可以根据返回值进行一些功能扩展
            alert("upload successfully!");
            //alert(data.response['link']);
             window.location.href="/GEsture/index.php/File/cluster/"+data.response['link']+"/"+data.response['filename']+"/1";


        });
  

</script>
</body>
</html>
