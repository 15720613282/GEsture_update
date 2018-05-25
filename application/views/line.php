<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>HTML5 Canvas发光折线图表应用DEMO演示</title>
     <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.css')?>" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?=base_url('public/css/line_style.css')?>" media="screen" type="text/css" />

</head>
<body>
<div>
  <button onclick="line()">点击 </button>
</div>	
<?php for($i=0;$i<$count;$i=$i+2){?>
<div class="row">
	<div class="col-md-6 col-sm-6">
  <div class="cdiv">
  <canvas id="background" width="500" height="300"></canvas>
  <canvas id="canvas<?php echo $i;?>" width="500" height="300"></canvas>
</div>
</div>

<div class="col-md-6 col-sm-6">
  <div class="cdiv">
  <canvas id="background" width="500" height="300"></canvas>
  <canvas id="canvas<?php echo $i+1;?>" width="500" height="300"></canvas>
</div>s
</div>

</div>
<?php } ?>
<?php if($count%2!=0){?>

<div class="row">
	<div class="col-md-6 col-sm-6">
  <div class="cdiv">
  <canvas id="background" width="500" height="300"></canvas>
  <canvas id="canvas<?php echo $count;?>" width="500" height="300"></canvas>
</div>
</div>
</div>
<?php } ?>

  <script src="<?=base_url('public/js/line.js')?>"></script>
<div style="text-align:center;clear:both">
<!--<script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
<script src="/follow.js" type="text/javascript"></script>-->
</div>
</body>

</html>