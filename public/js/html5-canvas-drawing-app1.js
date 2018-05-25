var xInterval2=1;
var yInterval2=1;
var canvasWidth = 980;
var canvasHeight =470;
var paint = false;
var clickX2 = new Array();
var clickY2 = new Array();
var clickDrag = new Array();
var colorPurple = "#cb3594";
var curColor = colorPurple;
var curTool = "crayon";
var curSize = "normal";
var drawingAreaX = 50;
var drawingAreaY = 20;
var drawingAreaWidth = 960;
var drawingAreaHeight = 470;
var cX2=new Array();//存放坐标值x,y；
var cY2=new Array();
var flag=1;
var Data1 = {

    'Text' : true,

    'Grid' : true,

    'Ruler' : true,

    'LineW' : 0.8,

    //'Even' : 3,

    //'Time' : GetTimeList2(),
    
    'Color':['#FF3030','#FF00FF','#EAEAEA','#CDCD00','#CAFF70','#BA55D3','#A4D3EE','#515151'],

    'canvas_o':null,

    'Ax' :[],

    'Ax2':[],

    'List2':[],

    'List3':[],

    'List' : []

};
var ctx1;
var row1,col1;
var xxh=10;
var yl2=0,yh2=10,ydist2=10;
var re = [];
var len;
var ys;
var num=10;//横坐标的个数
function setInterval1(xx,yyl,yyh)
{
    xxh=Number(xx);
    yl2=yyl;
    yh2=yyh;
    yInterval2=1;
    if(xx>10&&xx<=40)
       xInterval2=2;
    else if(xx>40&&xx<=100)
        xInterval2=5;
    else if(xx>100&&xx<=200)
        xInterval2=10;
    else if(xx>200&&xx<=400)
        xInterval2=20;
    else if(xx>400&&xx<=1000)
        xInterval2=100;
    else
        xInterval2=300;
    ydist2=yh2-yl2;
   // alert("ydist2:"+ydist2);
    if(ydist2<1)
        yInterval2=yInterval2*0.1;
    else if (ydist2<=2)
        yInterval2=yInterval2*0.2;
    else if (ydist2<=5)
        yInterval2=yInterval2*0.5;
    else if (ydist2<=20)
        yInterval2=yInterval2*1;
    else if (ydist2<=30)
        yInterval2=yInterval2*2;
    else if (ydist2<=40)
        yInterval2=yInterval2*4;
    else if (ydist2<=50)
        yInterval2=yInterval2*5;
    else if (ydist2<=60)
        yInterval2=yInterval2*6;
    else if (ydist2<=70)
        yInterval2=yInterval2*7;
    else if (ydist2<=80)
        yInterval2=yInterval2*8;
    else if (ydist2<=90)
        yInterval2=yInterval2*9;
    else if (ydist2<=100)
        yInterval2=yInterval2*10;
    else if (ydist2<=200)
        yInterval2=yInterval2*15;
    else if (ydist2<=300)
        yInterval2=yInterval2*30;
    else if (ydist2<=400)
        yInterval2=yInterval2*40;
    else if (ydist2<=500)
        yInterval2=yInterval2*50;
    else if (ydist2<=600)
        yInterval2=yInterval2*60;
    else if (ydist2<=700)
        yInterval2=yInterval2*70;
    else if (ydist2<=800)
        yInterval2=yInterval2*80;
    else if (ydist2<=900)
        yInterval2=yInterval2*90;
    else if (ydist2<=1500)
        yInterval2=yInterval2*100;
    else
        yInterval2=yInterval2*200;
   //alert("yInterval2:"+yInterval2);

    GetTimeList2();

}
function GetTimeList2(){

    
     num=0;
    if(xxh%xInterval2!=0)
        num=xxh/xInterval2+1;
    else
        num=xxh/xInterval2;
   

    for(var i = 0; i<=num; i ++){

        re[i]=i*xInterval2;

    }

    //return re.reverse();
    return re;
}
//jQuery.noConflict();
//jQuery(document).ready(function($){
window.onload=function() {

    


//}


}
//});
function prepareCanvas()
{
   canvas = document.getElementById("can");
    if (canvas.getContext) {
        ctx1 = canvas.getContext("2d");
        ctx1.strokeStyle = "red";
        ctx1.beginPath();
        /* y axis along the left edge of the canvas*/
        ctx1.moveTo(0, 0);
        ctx1.lineTo(0, 105);
        ctx1.stroke();

    }
    Show(document.getElementById("can"), Data1);

//canvas.mousedown(function(e)
    $("#can").mousedown(function(e)
    {
        // Mouse down location
        var mouseX = e.pageX - this.offsetLeft;
        var mouseY = e.pageY - this.offsetTop;
        bb= e.pageY;
        aa=this.offsetTop;
        cc=e.pageX;
        dd=this.offsetLeft;

        if(mouseY > drawingAreaY && mouseY < drawingAreaHeight && mouseX>drawingAreaX && mouseX<drawingAreaWidth)
        {// Mouse click location on drawing area
            paint = true;
            addClick(mouseX, mouseY, false);
            redraw2();
        }

    });

    $("#can").mousemove(function(e){
        if(paint==true){
            var x=e.pageX - this.offsetLeft;
            var y=e.pageY - this.offsetTop;
            bb= e.pageY;
            aa=this.offsetTop;
            cc=e.pageX;
            dd=this.offsetLeft;
            addClick(x,y, true);
            redraw2();
        }
    });

    $("#can").mouseup(function(e){
        paint = false;
        redraw2();
    });

    $("#can").mouseleave(function(e){
        paint = false;
    });
}

function Run(o, i){

    if(document.all) return false;//判断是否是ie

    if(o) Data1.List[i].Check = o.checked;

    Show(document.getElementById("can"), Data1, document.getElementById("ServerList"));

}



function compareTime(rr){

    outer:	for(var i = 0; i < re.length; i ++){
        var d1=rr;
        var d2=re[i];
        var s;
        if(d1>d2)
            s=1;
        else if(d1==d2)
            s=0;
        else
            s=-1;

        if(i==0){
            switch(s){
                case -1:
                    return null;
                case 0:
                    return i;
                case 1:
                    continue outer;
                default:
                    break;
            }
        }else if(i==re.length-1){
            switch(s){
                case -1:
                    return i-1;
                case 0:
                    return i;
                case 1:
                    return null;
                default:
                    break;
            }
        }else{
            switch(s){
                case -1:
                    return i-1;
                case 0:
                    return i;
                case 1:
                    continue outer;
                default:
                    break;
            }
        }
    }
}
function compare1(re,timeStr){//这个是用来画contrast model图和shift model图时用的比较函数
    outer:  for(var i = 0; i < re.length; i++){
        var d1=timeStr;
        var d2=re[i];
        var s;
        if(d1>d2)
            s=1;
        else if(d1==d2)
            s=0;
        else
            s=-1;

        if(i==0){
            switch(s){
                case -1:
                    return null;
                case 0:
                    return i;
                case 1:
                    continue outer;
                default:
                    break;
            }
        }else if(i==re.length-1){
            switch(s){
                case -1:
                    return i-1;
                case 0:
                    return i;
                case 1:
                    return null;
                default:
                    break;
            }
        }else{
            switch(s){
                case -1:
                    return i-1;
                case 0:
                    return i;
                case 1:
                    continue outer;
                default:
                    break;
            }
        }
    }
}

function lineTo(o, arr, time, even, ht, text, colw, rowh){
    o.beginPath();

    o.fillStyle = o.strokeStyle = arr.Color;

    for(var j = 0; j < arr.Data.length; j ++){
        var resultTimeIndex=compareTime(Data.Time,arr.Data[j].time);
        if(resultTimeIndex!=null){
            var distanceToOrigin=(arr.Data[j].time>=xInterval2?arr.Data[j].time-xInterval2*resultTimeIndex:arr.Data[j].time)/xInterval2*colw+resultTimeIndex*colw;
           
            if(text) {

                //先把%去掉，再按rowh的比例计算
                o.fillText(arr.Data[j].value, distanceToOrigin + 46, ht - parseInt(arr.Data[j].value.replace(/\%/g,""))/20*rowh - 46);
            }

            o.lineTo(distanceToOrigin + 50, ht-parseInt(arr.Data[j].value.replace(/\%/g,""))/20*rowh - 30);
            //o.lineTo(distanceToOrigin + 50, ht-parseInt(arr.Data[i].value.replace(/\%/g,""))/20*rowh - 30);
        }
    }

    o.stroke();

    o.closePath();

    for(var i = 0; i < arr.Data.length; i ++){
        var resultTimeIndex=compareTime(Data.Time,arr.Data[i].time);
        if(resultTimeIndex!=null){
            //var timeArray=arr.Data[i].time.split(":");
            //timeArray[2]=timeArray[2].replace(/\b0{1}/g,"");
            //var distanceToOrigin=(timeArray[2]>=xInterval?timeArray[2]-xInterval:timeArray[2])/xInterval*colw+resultTimeIndex*colw;
            var distanceToOrigin=(arr.Data[i].time>=xInterval2?arr.Data[i].time-xInterval2*resultTimeIndex:arr.Data[i].time)/xInterval2*colw+resultTimeIndex*colw;
            o.beginPath();

            //var x = distanceToOrigin + 50, y = ht - parseInt(arr.Data[i].value.replace(/\%/g,""))/20*rowh - 30;//计算x的坐标
            var x = distanceToOrigin + 50, y = ht - parseInt(arr.Data[i].value.replace(/\%/g,""))/20*rowh - 30;//计算x的坐标

            o.arc(x, y, even || 3, 0, 360, false);

            var d = document.createElement('div');

            d.className = 'cTitle';

            d.style.left = x - 7 + 'px';

            d.style.top = (y - 7+document.getElementById("can").getBoundingClientRect().top+document.documentElement.scrollTop) + 'px';

            d.style.borderColor = arr.Color;

            d._title = 'Title:' + arr.Title + '\nTime:' + arr.Data[i].time + '\nData:' + arr.Data[i].value;

            d.onmouseover = function(event){

                ShowTitle(this._title, event, arr.Color);

                this.className += ' cTitleHover';

                this.onmouseout = function(){

                    if(document.getElementById("temp_title")) document.getElementById("temp_title").style.display='none';

                    this.className = 'cTitle';

                }

            }

            document.body.appendChild(d);

            o.stroke();

            o.fill();

            o.closePath();
        }

    }

}
function isInteger(obj){
 return Math.floor(obj)===obj;
}

/*
 *colw--列宽，rowh--行高
 */
function Show(d, data, colw, rowh){

       
        var colw = colw || (d.offsetWidth - 20) / (xxh + 1);
        if (xxh > 10 && xxh <= 40)
            colw = (d.offsetWidth - 20) / (xxh / 2 + 1);
        else if (xxh > 40 && xxh <= 100)
            colw = (d.offsetWidth - 20) / (xxh / 5 + 1);
        else if (xxh > 100 && xxh <= 200)
            colw = (d.offsetWidth - 20) / (xxh / 10 + 1);
        else if (xxh > 200 && xxh <= 400)
            colw = (d.offsetWidth - 20) / (xxh / 20 + 1);
        else if (xxh > 400 && xxh <= 1000)
            colw = (d.offsetWidth - 20) / (xxh / 100 + 1);
       // var aaaa= (d.offsetWidth - 20) / (xh / 2 + 1);
       
        col1 = colw;
        var yd = ydist2;
        var rowh = rowh;
        
        if(((d.offsetHeight - 20) / yd) < 10){
                while (((d.offsetHeight - 20) / yd) < 10)//行高小于10
                {
                    yInterval2++;
                    yd = ydist2 / yInterval2;
                }
       }
       else
        yd=yd/yInterval2;

        rowh = (d.offsetHeight - 20) /(yd+1);
        
        row1 = rowh;

    var c = d.getContext('2d');

    c.fillStyle = '#FAF0E6';

    c.lineWidth = 0.3;

    c.fillRect(0, 0, d.offsetWidth, d.offsetHeight);

    c.strokeStyle = "#ccc";

    c.fillStyle = '#0A0A0A';//'#0ff';

    c.font = '11px verdana';

    c.textBaseline = 'top';
        var j = 0;
        
        for (var i = 15; i < d.offsetHeight-5; i += rowh) {

            c.beginPath();
            //y轴的刻度，到时候可以依照需求自己画
            if (data.Ruler) {

               
                var t = yh2 - j;
                 if(!isInteger(t))
                     t=t = (yh2 - j).toFixed(1);
                //var t=(100-j*20)*0.01;//左侧刻度百分比
                   // alert(t);            
                c.fillText(t, (5 - new String(t).length) * 7, i - 4);

            }
            //画平行于 x轴的线
            if (data.Grid) {

                c.lineTo(40, i);

                c.lineTo(d.offsetWidth, i);

            }

            c.stroke();

            c.closePath();
            j = j + yInterval2;
        }
    
    ys= d.offsetHeight-(i-rowh);
    
        if (data.Grid) {
            //画平行于 y轴的线
            for (var i = 50; i < d.offsetWidth; i += colw) {

                c.beginPath();

                c.lineTo(i, 0);

                c.lineTo(i, d.offsetHeight - 20);

                c.stroke();

                c.closePath();

            }

        }

        if (data.Ruler) {

            c.beginPath();
            //x轴的刻度
            // for(var i = 0; i < data.Time.length; i ++){
            for (var i = 0; i <=num; i++) {
                //c.fillText(i*2, i * colw + 25, d.offsetHeight - 13)
                c.fillText(i*xInterval2, i * colw + 45, d.offsetHeight - 13);

            }

            c.stroke();

            c.closePath();

        }

        c.lineWidth = data.LineW || 0.8;
        data.canvas_o=c;


      // for (var i = 0; i < data.List.length; i++) {
         if(data.List.length!=0){
          // if (data.List[i].Check) {
             if(flag==1)
                 { 
                    lineshow(c,data.List, d.offsetHeight,colw,rowh);}
                 else if(flag==2)//画contrast 图
                    {
                        lineshow(c,data.List, d.offsetHeight,colw,rowh);
                        lineshow2(c,data.List2,data.Ax,d.offsetHeight,colw,rowh);
                    }
                else{//画shift图
                       lineshow(c,data.List, d.offsetHeight,colw,rowh);
                     lineshow2(c,data.List2,data.Ax,d.offsetHeight,colw,rowh);
                     lineshow3(c,data.List3,data.Ax2,d.offsetHeight,colw,rowh);
                }
          // }
        

       }



}

function addClick(x, y, dragging)
{
    clickX2.push(x);
    clickY2.push(y);
    clickDrag.push(dragging);
}




/**
 * Redraws the canvas.
 */
function redraw2()
{
    // Make sure required resources are loaded before redrawing
    //if(curLoadResNum < totalLoadResources){ return; }

    
   
    //var coo = document.getElementById("coo");

    ctx1.save();
    ctx1.beginPath();
    ctx1.rect(drawingAreaX, drawingAreaY, drawingAreaWidth, drawingAreaHeight);
    ctx1.clip();

    var radius;
    var i = 0;
    radius = 5;
    for(; i < clickX2.length; i++)
    {

        ctx1.beginPath();
        if(clickDrag[i] && i){
            ctx1.moveTo(clickX2[i-1], clickY2[i-1]);

        }else{
            ctx1.moveTo(clickX2[i], clickY2[i]);
        }
        //coo.innerHTML ="<li>"+ "x="+(clickX2[i]-50)/col1*xInterval2+"y="+(yh2-(clickY2[i]-20)/row1*yInterval2)+"bb="+bb+" aa="+aa+" cc="+cc+" dd="+dd+"</li>";
        var xxx,yyy;
        //xxx=Math.round((clickX[i]-50)/col1*xInterval,2);
        xxx=(clickX2[i]-50)/col1*xInterval2;
       // parseInt(yh);
        //parseInt(yl);
        //yyy=Math.round(yh-(clickY[i]-20)/row1*yInterval,2);
        yyy=yh2-(clickY2[i]-20)/row1*yInterval2;
        cX2.push(xxx);
        cY2.push(yyy);
       
        ctx1.lineTo(clickX2[i], clickY2[i]);
        ctx1.closePath();
        ctx1.lineJoin = "round";
        ctx1.lineWidth = radius;
        ctx1.stroke();

    }
    //context.globalCompositeOperation = "source-over";// To erase instead of draw over with white
    ctx1.restore();

    // Overlay a crayon texture (if the current tool is crayon)
    if(curTool == "crayon"){
        ctx1.globalAlpha = 0.4; // No IE support
        //context.drawImage(crayonTextureImage, 0, 0, canvasWidth, canvasHeight);
    }
    ctx1.globalAlpha = 1; // No IE support


}
/**
 * Clears the canvas.
 */
function clearCanvas()
{
    ctx1.clearRect(0, 0, canvasWidth, canvasHeight);
    Show(document.getElementById("can"),Data1,canvasWidth,canvasHeight);
   
}


function clearall()
{
    clickX2=[];
    clickY2=[];
    clickDrag=[];
    Data1.List=[];
    cX2=[];
    cY2=[];
    $("#gname").hide();
    clearCanvas();
        $("#empty_table ul li").html("");
        if($("#shiftmode").is(":visible"))
       {
        $(".select").val("0");
        $(".select").val("0");
         $("#shiftmode").toggle();
       }
       var x=document.getElementsByName("pattern");
       if(x[0].checked==false) 
           x[0].checked=true;
        var mySlider = $("#ex7").slider();
 
// Call a method on the slider
         mySlider.slider('setValue',0.67);
        $("#cyto1").hide();
       $("#css_show").hide();
      $("#cytoshow").hide();
      $("#filter_slider").hide();
      tt.style.display="none";
      ves.style.display="none";
      canv1.style.display="none"; 
      showtable.style.display="none"; 
    
       var filelink=$("#linkf").val();
var comUrl="/GEsture/index.php/File/delete_files";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                          setInterval1(data['c'],data['min'],data['max']);//在html5-canvas-drawing-app1.js中
                            prepareCanvas(); 
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

});  
}

function Getclickx()
{
    
    if(cX2=='')
    {
        for(var i=0;i<len;i++)
            cX2[i]=i+1;
    }
    return cX2;
}

function Getclicky()
{
 // alert(cY2); 
    return cY2;

}
function setdata(result,n)
{
    len=n;
    cY2=[],cX2=[];
    for(var i=0;i<n;i++)
    {
        Data1.List[i]=Number(result[i]);
        cY2[i]=result[i];
    }
    //alert(Data1.List[14]);
    Show(document.getElementById("can"), Data1);
    //return xxh;
}

function setdata_shift(ax_b,ay_b,ax_c,ay_c,nb,nc)
{
    //n=ax.length;
    //nb=ax_b.length;
   //nc=ax_c.length;
    //alert(ay_b[1]);
    Data1.List2=[];
    Data1.List3=[];
    Data1.Ax=[];
    Data1.Ax2=[];
    for(var j=0;j<nb;j++)
    {
        Data1.Ax[j]=Number(ax_b[j]);
        Data1.List2[j]=Number(ay_b[j]);

    }
    //alert("Data.list2:"+Data1.List2);
    for(var i=0;i<nc;i++)
    {
       
        Data1.Ax2[i]=Number(ax_c[i]); 
        Data1.List3[i]=Number(ay_c[i]);
        
        //cY2[i]=result[i];
    }
    
    flag=3;

    Show(document.getElementById("can"), Data1);
    //return xxh;
}

function  drawdata(c,c_ax,c_ay){//画contrast model的图
    var n=c;
    
    Data1.List2=[];
    Data1.Ax=[];
   // alert(c_ay[0]);
   for(var i=0;i<n;i++)
    {
        Data1.List2[i]=Number(c_ay[i]);
        Data1.Ax[i]=Number(c_ax[i]);
    }
    flag=2;
    
   Show(document.getElementById("can"), Data1);
  //var c=document.getElementById("canvas").getContext('2d');
  //lineshow2(Data1.canvas_o,Data1.List2,Data1.Ax);
}


function lineshow(o, resulty, ht,colw,rowh){
   
    o.beginPath();
    o.fillStyle = o.strokeStyle = '#0A0A0A';
     //alert(re);
    //alert(resulty.length);
    for(var j = 0; j < resulty.length; j++){
        var resultTimeIndex=compareTime(j+1);
        if(resultTimeIndex!=null){
            var distanceToOrigin=(j+1>=xInterval2? j+1-xInterval2*resultTimeIndex:j+1)/xInterval2*col1+resultTimeIndex*col1;
             
            //var yi=ht-(resulty[j]-yl2)/yInterval2*row1 - ys;
           var yi=parseFloat((yh2-resulty[j])*row1)/yInterval2+20;
           
            //yy=ht-(resulty[j]-yl2)*row1/yInterval2 - ys;
            o.lineTo(distanceToOrigin + 50,yi);
        }
    }

    o.stroke();

    o.closePath();


}

function lineshow2(o, c_ay, c_ax,ht,colw,rowh){
   
    o.beginPath();
    o.fillStyle = o.strokeStyle = '#0000FF';
   
    for(var j = 0; j < c_ax.length; j++){
        var resultTimeIndex=compare1(re,c_ax[j]);
       
        if(resultTimeIndex!=null){
            var distanceToOrigin=(c_ax[j]>=xInterval2? c_ax[j]-xInterval2*resultTimeIndex:c_ax[j])/xInterval2*col1+resultTimeIndex*col1;    
            //o.lineTo(distanceToOrigin + 50, ht-(c_ay[j]-yl2)*row1 - ys);
            var yi=parseFloat((yh2-c_ay[j])*row1)/yInterval2+20;

            o.lineTo(distanceToOrigin + 50, yi);
            
        }
    }

    o.stroke();

    o.closePath();
    flag=1;

}

function lineshow3(o, c_ay, c_ax,ht,colw,rowh){
  
    o.beginPath();
    o.fillStyle = o.strokeStyle = '#FF0000';
    
    for(var j = 0; j < c_ax.length; j++){
        var resultTimeIndex=compare1(re,c_ax[j]);
        
      if(resultTimeIndex!=null){
            var distanceToOrigin=(c_ax[j]>=xInterval2? c_ax[j]-xInterval2*resultTimeIndex:c_ax[j])/xInterval2*col1+resultTimeIndex*col1;    
             
            //o.lineTo(distanceToOrigin + 50, ht-(c_ay[j]-yl2)*row1 - ys);
             var yi=parseFloat((yh2-c_ay[j])*row1)/yInterval2+20;
            o.lineTo(distanceToOrigin + 50, yi);
            
        }
    }

    o.stroke();

    o.closePath();
    flag=1;

}




