var xInterval=1;
var yInterval=1;
var col1,row1;
var Data = {

    'Text' : true,

    'Grid' : true,

    'Ruler' : true,

    'LineW' : 0.8,

    'Even' : 3,

    //'Time' : GetTimeList(),

    'Length':0,

    'Color':['#FF3030','#FF00FF','#7A378B','#9400D3','#698B22','#CD0000','#8B3626','#000000'],

   'List2':[],

   'List3':[],
    
    'xh1':10,

    'List' : []

};
var ctx;
var flag=1;
var xh1=10;
var yl=0,yh=10,ydist=10;
var re =[];
var ys;//横坐标最下面剩余的距离
var num=10;
function setIntervals(xx,yyl,yyh)
{
    xh1=xx;
    yl=yyl;
    yh=yyh;
    xInterval=1;
    yInterval=1;
    if(xx>10&&xx<=40)
        xInterval=2;
    else if(xx>40&&xx<=100)
        xInterval=5;
    else if(xx>100&&xx<=200)
       xInterval=10;
    else if(xx>200&&xx<=400)
        xInterval=20;
    else if(xx>400&&xx<=1000)
        xInterval=100;
    else
        xInterval=300;
    //alert("yh:"+yh+" "+yl);
    ydist=yh-yl;
    //alert(ydist);
    if(ydist<1)
        yInterval=yInterval*0.1;
    else if (ydist<=2)
        yInterval=yInterval*0.2;
    else if (ydist<=5)
        yInterval=yInterval*0.5;
    else if (ydist<=20)
        yInterval=yInterval*1;
    else if (ydist<=30)
        yInterval=yInterval*2;
    else if (ydist<=40)
        yInterval=yInterval*4;
    else if (ydist<=50)
        yInterval=yInterval*5;
    else if (ydist<=60)
        yInterval=yInterval*6;
    else if (ydist<=70)
        yInterval=yInterval*7;
    else if (ydist<=80)
        yInterval=yInterval*8;
    else if (ydist<=90)
        yInterval=yInterval*9;
    else if (ydist<=100)
        yInterval=yInterval*10;
    else if (ydist<=200)
        yInterval=yInterval*15;
    else if (ydist<=300)
        yInterval=yInterval*30;
    else if (ydist<=400)
        yInterval=yInterval*40;
    else if (ydist<=500)
        yInterval=yInterval*50;
    else if (ydist<=600)
        yInterval=yInterval*60;
    else if (ydist<=700)
        yInterval=yInterval*70;
    else if (ydist<=800)
        yInterval=yInterval*80;
    else if (ydist<=900)
        yInterval=yInterval*90;
    else if (ydist<=1500)
        yInterval=yInterval*100;
    else
        yInterval=yInterval*200;
    GetTimeList();
}

function GetTimeList(){

    num=0;
    if(xxh%xInterval!=0)
        num=xh1/xInterval+1;
    else
        num=xh1/xInterval;
   
//alert(num);
    for(var i=0; i<=num;i++){

        re[i]=i*xInterval;
        // re.push((now.getHours() + ':' + now.getMinutes() + ':' + (now.getSeconds() >=30 ? 30 : 0)).replace(/\b(\d)\b/g, '0$1'));
        //now=now.addSeconds(-30);

    }

    //return re.reverse();
    return re;
}

function prepCanvas1()
{
    canvas = document.getElementById('cvs1');
    if (canvas.getContext) {
        ctx = canvas.getContext("2d");
        ctx.strokeStyle = "red";
        ctx.beginPath();
        // y axis along the left edge of the canvas
        ctx.moveTo(0, 0);
        ctx.lineTo(0, 105);
        ctx.stroke();

    }

    Show1(document.getElementById('cvs1'), Data);
}

jQuery(document).ready(function($){
   
   /* canvas = document.getElementById("canvas1");
    if (canvas.getContext) {
        ctx = canvas.getContext("2d");
        ctx.strokeStyle = "red";
        ctx.beginPath();
        // y axis along the left edge of the canvas
        ctx.moveTo(0, 0);
        ctx.lineTo(0, 105);
        ctx.stroke();

    }

    Show1(document.getElementById("canvas1"), Data);*/

});

function Run(o, i){

    if(document.all) return false;//判断是否是ie

    if(o) Data.List[i].Check = o.checked;

    Show(document.getElementById('cvs1'), Data);

}

/*function ShowTitle(str, event, color){

    var e = window.event || event;

    if(document.getElementById("temp_title")){

        document.getElementById("temp_title").style.display = 'block';

        document.getElementById("temp_title").style.borderColor = color;

    }

    else{

        var v = document.createElement("div");

        v.id = "temp_title";

        v.style.borderColor = color;

        document.body.appendChild(v);

    }

    document.getElementById("temp_title").innerHTML =  str.replace(/\n/g, '<br />');

    var xtop = e.clientY + document.documentElement.scrollTop + 17;

    var xleft = e.clientX + document.documentElement.scrollLeft + 10;

    document.getElementById("temp_title").style.top = xtop + "px";

    document.getElementById("temp_title").style.left = xleft + "px";

}*/

function compareTime(timeStr){
    //alert("re="+re);
    outer:	for(var i = 0; i<re.length; i++){
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
    //alert("ht:"+ht+"yInterval:"+yInterval+"yl:"+yl+"ys:"+ys+"row1:"+row1+"arr:"+arr[0]);
    var i=Math.ceil(Math.random()*7);
    o.fillStyle = o.strokeStyle = Data['Color'][i];
      for(var j=0; j<arr.length; j++){
        var resultTimeIndex=compareTime(j+1); 
        if(resultTimeIndex!=null){
            var distanceToOrigin=(j+1>=xInterval? j+1-xInterval*resultTimeIndex:j+1)/xInterval*col1+resultTimeIndex*col1;
           //o.lineTo(distanceToOrigin + 50, ht-(arr[0][j]-yl)*row1 - ys);
          arr[j]=Number(arr[j]);
           var yi=parseFloat((yh-arr[j])*row1)/yInterval+20;
           //alert(yi);
           o.lineTo(distanceToOrigin + 50, yi);
            
        }
        
    }

    o.stroke();

    o.closePath();

}

function lineTo_l(o, arr, time, even, ht, text, colw, rowh){
    o.beginPath();
    o.fillStyle = o.strokeStyle = "#FF0000";
      for(var j=0; j<arr.length; j++){
        // var resultTimeIndex=compareTime(Data.Time,arr.Data[j].time);
        var resultTimeIndex=compareTime(j+1);
        
        if(resultTimeIndex!=null){
            var distanceToOrigin=(j+1>=xInterval? j+1-xInterval*resultTimeIndex:j+1)/xInterval*col1+resultTimeIndex*col1;
            arr[j]=Number(arr[j]);
            //o.lineTo(distanceToOrigin + 50, ht-(arr[0][j]-yl)*row1 - ys);
            var yi=parseFloat((yh-arr[j])*row1)/yInterval+20;
             o.lineTo(distanceToOrigin + 50, yi);
            
        }
    }

    o.stroke();

    o.closePath();

}

function lineTo_r(o, arr, time, even, ht, text, colw, rowh){
    var yy=ht-(arr[j]-yl)*row1/yInterval - ys;
    o.beginPath();
    o.fillStyle = o.strokeStyle = "#0000FF";
      for(var j=0; j<arr.length; j++){
        var resultTimeIndex=compareTime(j+1);
        
        if(resultTimeIndex!=null){
            var distanceToOrigin=(j+1>=xInterval? j+1-xInterval*resultTimeIndex:j+1)/xInterval*col1+resultTimeIndex*col1;
            arr[j]=Number(arr[j]);
            //o.lineTo(distanceToOrigin + 50, ht-(arr[0][j]-yl)*row1 - ys);
            var yi=parseFloat((yh-arr[j])*row1)/yInterval+20;
             o.lineTo(distanceToOrigin + 50,yi);
            
        }
    }

    o.stroke();

    o.closePath();

}

function isInteger(obj){
 return Math.floor(obj)===obj;
}

/*
 *colw--列宽，rowh--行高
 */
function Show1(d, data, f, colw, rowh){

    //var colw = colw || (d.offsetWidth - 20) / data.Time.length;
    //var colw = colw || (d.offsetWidth - 20) / (xh+1);
    var colw;
    
    colw = colw || (d.offsetWidth - 20) / (xh1+1);
    if(xh1>10&&xh1<=40)
        colw =  (d.offsetWidth - 20) / (xh1/2+1);
    else if(xh1>40&&xh1<=100)
        colw =  (d.offsetWidth - 20) / (xh1/5+1);
    else if(xh1>100&&xh1<=200)
        colw =  (d.offsetWidth - 20) / (xh1/10+1);
    else if(xh1>200&&xh1<=400)
        colw =  (d.offsetWidth - 20) / (xh1/20+1);
    else if(xh1>400&&xh1<=1000)
        colw =  (d.offsetWidth - 20) / (xh1/100+1);
    col1=colw;
    //alert("colw:"+colw);
    var rowh=rowh;
    var yd=ydist;
     if(((d.offsetHeight - 20) / yd) < 10){
            while (((d.offsetHeight - 20)/yd)<10)//行高小于10
            {    yInterval++;
                yd=ydist/yInterval;
            }
    }
    else
        yd=yd/yInterval;

    rowh=(d.offsetHeight - 20)/(yd+1);
    row1=rowh;

    //alert(col1+" "+row1);

    var c = d.getContext('2d');

    c.fillStyle = '#FAF0E6';

    c.lineWidth = 0.3;

    c.fillRect(0, 0, d.offsetWidth, d.offsetHeight);

    c.strokeStyle = "#ccc";

    c.fillStyle = '#0A0A0A';//'#0ff';

    c.font = '11px verdana';

    c.textBaseline = 'top';

    var j=0;
    for(var i =15; i < d.offsetHeight-5; i += rowh){

        c.beginPath();
        //y轴的刻度，到时候可以依照需求自己画
        if(data.Ruler){

            // var t=(yh-j).toFixed(1);
              var t = yh - j;
                 if(!isInteger(t))
                     t=t = (yh - j).toFixed(1);
            //var t=(100-j*20)*0.01;//左侧刻度百分比
            c.fillText(t, (5 - new String(t).length) * 7, i -4);

        }
        //画平行于 x轴的线
        if(data.Grid){

            c.lineTo(40, i);

            c.lineTo(d.offsetWidth, i);

        }

        c.stroke();

        c.closePath();
        j=j+yInterval;

    }
    ys= d.offsetHeight-(i-rowh);
    //alert(ys);
    if(data.Grid){
        //画平行于 y轴的线
        for(var i = 50; i < d.offsetWidth; i += colw){

            c.beginPath();

            c.lineTo(i, 0);

            c.lineTo(i, d.offsetHeight - 20);

            c.stroke();

            c.closePath();

        }

    }

    if(data.Ruler){

        c.beginPath();
        //x轴的刻度
        // for(var i = 0; i < data.Time.length; i ++){
        for(var i = 0; i <= num; i ++){
            //c.fillText(i*2, i * colw + 25, d.offsetHeight - 13)
            c.fillText(i*xInterval, i * colw + 45, d.offsetHeight - 13);

        }

        c.stroke();

        c.closePath();

    }

    c.lineWidth = data.LineW || 0.8;
    if(flag==1){

        for(var i = 0; i < data.List.length; i++){

                lineTo(c, data.List[i], data.Time, data.Even, d.offsetHeight, data.Text, colw, rowh);

        }
    }
    else if(flag==0){//画contrast图
        
        for(var i = 0; i < data.List2.length; i++){

                lineTo(c, data.List2[i], data.Time, data.Even, d.offsetHeight, data.Text, colw, rowh);

        }
        flag=1;
    }
    else{//画shift图像
        /*for(var i = 0; i < data.List.length; i++){

                lineTo(c, data.List[i], data.Time, data.Even, d.offsetHeight, data.Text, colw, rowh);

        }*/
        for(var i = 0; i < data.List2.length; i++){
                lineTo_l(c, data.List2[i], data.Time, data.Even, d.offsetHeight, data.Text, colw, rowh);
        }
        for(var i = 0; i < data.List3.length; i++){
                lineTo_r(c, data.List3[i], data.Time, data.Even, d.offsetHeight, data.Text, colw, rowh);
        }
        flag=1;
    }

}


function SetOtherData(result,n)
{

  //result=Number(result);
  Data.List=[];
  //alert(result[0]);

  for(var i=0;i<result.length;i++)
   { 
        Data.List[i]=result[i];
    }
    Data['Length']=n;
    //alert(typeof(Data.List[0]));
     Show1(document.getElementById('cvs1'), Data);

}

function SetOtherData1(result,n)//画contrast图
{

  
  Data.List2=[];


  for(var i=0;i<result.length;i++)
   { 
    
        Data.List2[i]=result[i];
        //alert(result[i]);
    }
    //alert("D:"+Data.List2[0].length);
    flag=0;
     Show1(document.getElementById('cvs1'), Data);//, document.getElementById("ServerList")

}


function SetOtherData2(snewy_l,snewy_r)
{

  
  Data.List2=[];
  Data.List3=[];
  if(snewy_l!=null){
      for(var i=0;i<snewy_l.length;i++)
       { 
            Data.List2[i]=snewy_l[i];
            
        }
}
if(snewy_r!=null){
    for(var i=0;i<snewy_r.length;i++)
   { 
        Data.List3[i]=snewy_r[i];
        
    }
}

    //alert("D:"+Data.List2[0].length);
    flag=2;
     Show1(document.getElementById('cvs1'), Data);

}













