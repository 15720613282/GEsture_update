<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;">
<link href="<?=base_url('public/assets/css/bootstrap.min.css')?>" rel="stylesheet">
<script src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
<script src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('public/js/cytoscape/cytoscape.min.js')?>"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.rawgit.com/cytoscape/cytoscape.js-qtip/2.2.5/cytoscape-qtip.js"></script>
<script src="<?=base_url('public/js/Blob.js')?>"></script>
<script src="<?=base_url('public/js/utils.js')?>"></script>
     <!--<script src="http://cdn.bootcss.com/cytoscape/2.3.16/cytoscape.min.js"></script>
     <script src="https://cdn.rawgit.com/cytoscape/cytoscape.js-spread/1.0.9/cytoscape-spread.js"></script>-->
<title>Graph</title>
<STYLE TYPE="text/css">
body { 
  font: 14px helvetica neue, helvetica, arial, sans-serif;
}
#cy {
  height: 100%;
  width: 100%;
  position: absolute;
  /*left: 0;
  top: 0;*/
}
</STYLE>

</head>

<body><!--<a href="javascript:history.back(-1)">go back</a>-->
	<div class="pull-right"><a href="#" onclick="savepic('png');"><h4>save to png</h4></a></div>
  <br>
<div style="height:10px;">
    <p><button  style="width:36px; height:36px; border-radius:50px; background-color:#FF3030;" disabled></button><font color="black">similar genes</font></p>
  <p><button  style="background-color:#B23AEE;width:36px; height:36px; border-radius:50px;"disabled></button><font color="black">contrast genes</font></p>
  
  <p><button  style="background-color:#EE9A00;width:36px; height:36px; border-radius:50px;"disabled></button><font color="black">right-shift genes</font></p>
 
  <p><button  style="background-color:#1C86EE;width:36px; height:36px; border-radius:50px;"disabled></button><font color="black">left-shift genes</font></p>
</div>

  <br>
<div id="cy" ></div> 
</body>
<script type="text/javascript">
//var min=<?php //echo $min;?>;
//var max=<?php //echo $max;?>;
//alert("min:"+min);
 
      
/*$(function(){
  var cy = window.cy = cytoscape({
          container: document.getElementById('cy'),

          boxSelectionEnabled: false,
          autounselectify: true,
          
          layout: {
            name: 'concentric',
            concentric: function( node ){
              return node.degree();
            },
            levelWidth: function( nodes ){
              return 2;
            }
          },
          style: [
           {
              selector: 'node[label="source"]',
              style: {
                'height': 20,
                'width': 20,
                'background-color': '#6959CD'
              }
            },
            {
              selector: 'node[label="target1"]',
              style: {
                'height': 20,
                'width': 20,
                'background-color': '#FF3030'
              }
            },
            {
              selector: 'node[label="target2"]',
              style: {
                'height': 20,
                'width': 20,
                'background-color': '#D1EEEE'
              }
            },
            {
              selector: 'node[label="target3"]',
              style: {
                'height': 20,
                'width': 20,
                'background-color': '#B23AEE'
              }
            },
            {
              selector: 'node[label="target4"]',
              style: {
                'height': 20,
                'width': 20,
                'background-color': '#30c9bc'
              }
            },

            {
              selector: 'edge',
              style: {
                'curve-style': 'haystack',
                'haystack-radius': 0,
                'width': 5,
                'opacity': 0.5,
                'line-color': '#a8eae5'
              }
            }
          ],
});*/
$('#cy').cytoscape({
       
         /* container: document.getElementById('cy'),

          boxSelectionEnabled: false,
          autounselectify: true,
          
          layout: {
            concentric: function(node){
              alert(node.degree());
              return node.degree();
              //this.data('weight');

            },
            levelWidth: function( nodes ){
              return 2;
            }
          },*/
                    
style: cytoscape.stylesheet()
     .selector('node[label="target1"]')
       .css({
         'content': 'data(id)',
         'font-family': 'helvetica',
         'font-size': 10,
         'text-valign': 'center',
         'color': '#333333',
         'opacity':0.7,
         'width':100,
         'height':100,
         'border-color': '#fff',
         'background-color':  '#FF3030',//'mapData(weight,<?php //echo $min;?>,<?php //echo $max;?>,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
         'border-width':10

       })

       .selector('node[label="target2"]')
       .css({
         'content': 'data(id)',
         'font-family': 'helvetica',
         'font-size': 20,
         'text-valign': 'center',
         'color': '#333333',
         'opacity':0.7,
         'width':100,
         'height':100,
         'border-color': '#fff',
         'background-color':  '#B23AEE',//'mapData(weight,<?php //echo $min;?>,<?php //echo $max;?>,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
         'border-width':10


       })

       .selector('node[label="target3"]')
       .css({
         'content': 'data(id)',
         'font-family': 'helvetica',
         'font-size': 20,
         'text-valign': 'center',
         'color': '#333333',
         'opacity':0.7,
         'width':100,
         'height':100,
         'border-color': '#fff',
         'background-color':  '#EE9A00',//'mapData(weight,<?php //echo $min;?>,<?php //echo $max;?>,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
         'border-width':10

       })

       .selector('node[label="target4"]')
       .css({
         'content': 'data(id)',
         'font-family': 'helvetica',
         'font-size': 20,
         'text-valign': 'center',
         'color': '#333333',
         'opacity':0.7,
         'width':100,
         'height':100,
         'border-color': '#fff',
         'background-color':  '#1C86EE',//'mapData(weight,<?php //echo $min;?>,<?php //echo $max;?>,blue,red)',//'#EE4000',//'mapData(weight,0,50,blue,red)',//'#EE4000',//'#CD5B45',
         'border-width':10

       })
       .selector('node[label="source"]')
       .css({
         'content': 'data(id)',
         'font-family': 'helvetica',
         'font-size': 20,
         'text-valign': 'center',
         'color': '#333333',
         'opacity':0.7, 
         'width':150,
         'height':150,
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
<?php  
 $outs=$outsource;
//$outs=array_unique($outsource);
//for($j=0;$j<count($outs);$j++){
?>
//var tmpId="<?php echo $outs[$j]?>";
var tmpId="<?php echo $outs; ?>";
var tmpWeight = <?php echo 100; ?>;
var _x=$(window).width()/2;
var _y=$(window).height()/2;
cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'source',position:{"x":_x,"y":_y}}});

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
<?php 
//}
?>

 var r1=300;
 var r2=600;
 var r3=900;
 var r4=1200;
 var i1=0,i2=0,i3=0,i4=0;
<?php 
 $c1=count($outarget1);
 $c2=count($outarget2);
 $c3=count($outarget3);
 $c4=count($outarget4);
 $nc1=360/$c1;
 $nc2=360/$c2;
 $nc3=360/$c3;
 $nc4=360/$c4;
for($i=0;$i<count($outarget1);$i++){
?>
var tmpId="<?php echo $outarget1[$i]?>";
var tmpWeight =10; <?php //echo $rval[$i]; ?>;
i1=i1+<?php echo $nc1; ?>;
var x = Math.cos(Math.PI / 180 * i1) * r1 + _x;
var y = Math.sin(Math.PI / 180 * i1) * r1 + _y;
cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'target1',position:{"x":x,"y":y}}});
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

<?php
}
?>

<?php 
for($i=0;$i<count($outarget2);$i++){
?>
var tmpId="<?php echo $outarget2[$i]?>";
var tmpWeight =30; <?php //echo $rval[$i+$c1]; ?>;
i2=i2+<?php echo $nc2; ?>;
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

<?php
}
?>

<?php 
for($i=0;$i<count($outarget3);$i++){
?>
var tmpId="<?php echo $outarget3[$i]?>";
var tmpWeight =50; <?php //echo $rval[$i+$c1+$c2]; ?>;
i3=i3+<?php echo $nc3; ?>;
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
<?php
}
?>

<?php 
for($i=0;$i<count($outarget4);$i++){
?>
var tmpId="<?php echo $outarget4[$i]?>";
var tmpWeight = 80;<?php //echo $rval[$i+$c1+$c2+$c3]; ?>;
i4=i4+<?php echo $nc4; ?>;
var x = Math.cos(Math.PI / 180 * i4) * r4 + _x;
var y = Math.sin(Math.PI / 180 * i4) * r4 + _y;
cy.add({group: "nodes", data: { id: tmpId , weight: tmpWeight,label:'target4',position:{"x":x,"y":y}}});
var tid="#"+tmpId;
cy.$(tid).qtip({
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
<?php
}
?>


var tmpSource="<?php echo $outsource;?>";
var tmpTarget="<?php echo $outarget1[0];?>";
//var tmp2="<?php echo $outarget2[0];?>";
//var tmp3="<?php echo $outarget3[0];?>";
//var tmp4="<?php echo $outarget4[0];?>";
//cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });
//cy.add({ group: "edges", data: { source: tmpSource, target: "<?php echo //$outarget2[0];?>" } });
//cy.add({ group: "edges", data: { source: tmpSource, target: "<?php echo //$outarget3[0];?>"} });
//cy.add({ group: "edges", data: { source: tmpSource, target: "<?php echo //$outarget4[0];?>" } });

<?php  
for($i=0;$i<$c1;$i++){
?>
//var tmpSource="<?php //echo $outarget1[0];?>";
var tmpTarget="<?php echo $outarget1[$i];?>";
cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });
<?php
}
?>
<?php  
for($i=0;$i<$c2;$i++){
?>
//var tmpSource="<?php //echo $outarget2[0];?>";
var tmpTarget="<?php echo $outarget2[$i];?>";
cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });
<?php
}
?>
<?php  
for($i=0;$i<$c3;$i++){
?>
//var tmpSource="<?php //echo $outarget3[0];?>";
var tmpTarget="<?php echo $outarget3[$i];?>";
cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });
<?php
}
?>
<?php  
for($i=0;$i<$c4;$i++){
?>
//var tmpSource="<?php //echo $outarget4[0];?>";
var tmpTarget="<?php echo $outarget4[$i];?>";
cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });
<?php
}
?>

/*cy.$(tmpId).qtip({
  content: 'Hello!',
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
});*/

<?php  
//for($i=0;$i<$count;$i++){
?>
/*var tmpSource="<?php echo $outsource[$i];?>";
var tmpTarget="<?php echo $outarget[$i];?>";
cy.add({ group: "edges", data: { source: tmpSource, target: tmpTarget } });*/
<?php
//}
?>
//});
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
  
/*name: 'breadthfirst',

  fit: true, // whether to fit the viewport to the graph
  directed: true, // whether the tree is directed downwards (or edges can point in any direction if false)
  padding: 30, // padding on fit
  circle: true, // put depths in concentric circles if true, put depths top down if false
  spacingFactor: 3, // positive spacing factor, larger => more space between nodes (N.B. n/a if causes overlap)
  boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
  avoidOverlap: true, // prevents node overlap, may overflow boundingBox if not enough space
  roots: undefined, // the roots of the trees
  maximalAdjustments: 0, // how many times to try to position the nodes in a maximal way (i.e. no backtracking)
  animate: false, // whether to transition the node positions
  animationDuration: 500, // duration of animation in ms if enabled
  animationEasing: undefined, // easing of animation if enabled
  ready: undefined, // callback on layoutready
  stop: undefined // callback on layoutstop*/
/*name: 'concentric',
  fit: true, // whether to fit the viewport to the graph
  padding: 30, // the padding on fit
  startAngle: 3 / 2 * Math.PI, // where nodes start in radians
  sweep: undefined, // how many radians should be between the first and last node (defaults to full circle)
  clockwise: true, // whether the layout should go clockwise (true) or counterclockwise/anticlockwise (false)
  equidistant: false, // whether levels have an equal radial distance betwen them, may cause bounding box overflow
  minNodeSpacing: 10, // min spacing between outside of nodes (used for radius adjustment)
  boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
  avoidOverlap: true, // prevents node overlap, may overflow boundingBox if not enough space
  height: undefined, // height of layout area (overrides container height)
  width: undefined, // width of layout area (overrides container width)
  concentric: function( node ){ // returns numeric value for each node, placing higher nodes in levels towards the centre
  //alert(node.degree());
  return node.degree();
  //this.data('weight');
  },
  levelWidth: function( nodes ){ // the variation of concentric values in each level
  return nodes.maxDegree() / 4;
  //return 2;
  },
  animate: false, // whether to transition the node positions
  animationDuration: 500, // duration of animation in ms if enabled
  animationEasing: undefined, // easing of animation if enabled
  ready: undefined, // callback on layoutready
  stop: undefined // callback on layoutstop*/
   /*name: 'cose',//'cose',
   fit: true, // whether to fit the viewport to the graph
   ready: undefined, // callback on layoutready
   stop: undefined, // callback on layoutstop
   rStepSize: 10, // the step size for increasing the radius if the nodes don't fit on screen
   padding: 30, // the padding on fit
   startAngle: 3/2 * Math.PI, // the position of the first node
   counterclockwise: false // whether the layout should go counterclockwise (true) or clockwise (false)*/
};

cy.layout( options );

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
    imgdata = imgdata.replace(fixtype(type), 'image/octet-stream')
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

</script>
</html>
