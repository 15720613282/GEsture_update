var tc;
var List=[];
var colw,rowh=30,yl,yh;
var xInterval=1;
var yInterval=1;
var xh=10;
var re=[];

function setInterval(xx,cmax,cmin){
   xh=xx;
   
    yl=parseFloat(cmin);//.toFixed(2);
    yh=parseFloat(cmax);
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
    ydist=yh-yl;
    yInterval=ydist/10;
  

    for(var i=0; i<=xh;i++){
        re[i]=i*xInterval;  
    }
}
function drawback(data,ccount,count,cmax,cmin){

   
    setInterval(ccount,cmax,cmin);

    var ccc=document.getElementById("canvas0");
   if (ccc.getContext) {
    colw = ccc.offsetWidth/xh;
    if(xh>10&&xh<=40)
        colw =  ccc.offsetWidth /(xh/2);
    else if(xh>40&&xh<=100)
        colw =  ccc.offsetWidth / (xh/5);
    else if(xh>100&&xh<=200)
        colw =  ccc.offsetWidth / (xh/10);
    else if(xh>200&&xh<=400)
        colw =  ccc.offsetWidth / (xh/20);
    else if(xh>400&&xh<=1000)
        colw =  ccc.offsetWidth / (xh/100);
    }
    rowh=30;
   
    for(var i=0;i<count;i++){
       var tc="canvas"+i;
       List[i]=data[i];
    var tb="background"+i;
    var background = document.getElementById(tb);
    if (background.getContext){
        var bg = background.getContext('2d');
       // Line graph
        bg.lineWidth = 1; 
        bg.strokeStyle = '#024';
    }

    
  //画坐标系
   var can = document.getElementById(tc);
    if (can.getContext) {
        /*b = can.getContext("2d");
        b.strokeStyle = "red";
        b.beginPath();*/
       var c = can.getContext('2d');
    c.lineWidth = 2;
    //c.strokeStyle = '#ff0';
    //c.shadowColor = '#ff0';
    c.shadowOffsetX = 0;
    c.shadowOffsetY = 0;
    c.shadowBlur = 10;

    //c.fillStyle = '#FAF0E6';
    //c.fillRect(0, 0, can.offsetWidth, can.offsetHeight);
    //c.fillStyle = '#0A0A0A';//'#0ff';
    c.font = '9px verdana';
    }
    

    
            
            c.fillText(yh,5,10);
            //c.fillText(yh,5,60);
            var middle=parseFloat((yh+yl)/2).toFixed(1);
            c.fillText(middle, 5,150);
            c.fillText(yl, 5,300);
            c.stroke();
           
 
    Show1(c,List[i],can.offsetHeight,colw,rowh);
    }
}

function Show1(o, data, ht,colw, rowh){

  
    o.beginPath();
    //var i=Math.ceil(Math.random()*8);
   
    o.fillStyle = o.strokeStyle ="#FF4040";
      for(var j=0; j<data.length; j++){
        // var resultTimeIndex=compareTime(Data.Time,arr.Data[j].time);
        var resultTimeIndex=compareTime(j+1);
       
        if(resultTimeIndex!=null){
            var distanceToOrigin=(j+1>=xInterval? j+1-xInterval*resultTimeIndex:j+1)/xInterval*colw+resultTimeIndex*colw; 
            for(var k=yl;k<=yh;k=k+yInterval)
            {
                if(k>=data[j])
                    break;
            }
           
            yi=parseFloat((yh-k)*rowh)/yInterval+parseFloat((k-data[j])*rowh)/yInterval;
           o.lineTo(distanceToOrigin,yi);
         
        }
           
        /*if(resultTimeIndex!=null){
            var distanceToOrigin=(arr.Data[j].time>=xInterval?arr.Data[j].time-xInterval*resultTimeIndex:arr.Data[j].time)/xInterval*colw+resultTimeIndex*colw;
            if(text) {

                //先把%去掉，再按rowh的比例计算
                o.fillText(arr.Data[j].value, distanceToOrigin + 46, ht - parseInt(arr.Data[j].value.replace(/\%/g,""))/20*rowh - 46);
            }

            o.lineTo(distanceToOrigin + 50, ht-parseInt(arr.Data[j].value.replace(/\%/g,""))/20*rowh - 30);
            //o.lineTo(distanceToOrigin + 50, ht-parseInt(arr.Data[i].value.replace(/\%/g,""))/20*rowh - 30);
        }*/
    }

    o.stroke();

    o.closePath();


}

function compareTime(timeStr){
   
    outer:  for(var i = 0; i<re.length; i++){
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

function line()
{
    $("#searchModal").modal("show");
    var temp,tb;
    var method="K";
    var number=$("#kinds").val();
    var filelink=$("#linkf").val();
    if(number=='')
        number=16;
   
    $("#t2").hide();
    $("#t3").show();
    var filename=$("#f").val();
    var comUrl="/GEsture/index.php/File/line";
    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'method':method,'kinds':number,'filename':filename,'filelink':filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                           if(data['flag']==6){
                             var t=Date.now();
                             sleep(10000,t);
                            readclusterfile(filelink);
                           }else{
                             $("#searchModal").modal("hide");
                             setdataform(data['count']);
                             /* html="";
                            $('#drawlines').html(html);
                           for(var i=0;i<data['count']-1;i=i+2){
                            html+="<div class='row'>";
                            html+="<div class='col-md-6 col-sm-6'>";
                            html+="<div class='cdiv'>";
                            tb="background"+i;
                            html+="<canvas id="+tb+" width='500' height='300'></canvas>";
                            temp="canvas"+i;
                            html+="<canvas id="+temp+" width='500' height='300'></canvas>";
                            html+=" </div>";
                            html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+i+");'>choose this mode</button>";
                            html+="</div>";

                            html+=" <div class='col-md-6 col-sm-6'>";
                            html+=" <div class='cdiv'>";
                            tb="background"+(i+1);
                            temp="canvas"+(i+1);
                            html+=" <canvas id="+tb+" width='500' height='300'></canvas>";
                            html+=" <canvas id="+temp+" width='500' height='300'></canvas>";
                            html+="</div>";
                            var cc=i+1;
                            html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+cc+");'>choose this mode</button>";
                            html+=" </div></div>";
                            html+="</br>";

                            
                                }
                                if(data['count']%2!=0){
                                    html+="<div class='row'>";
                                    html+=" <div class='col-md-6 col-sm-6'>";
                                    html+="<div class='cdiv'>";
                                    tb="background"+(data['count']-1);
                                    html+="<canvas id="+tb+" width='500' height='300'></canvas>";
                                    temp="canvas"+(data['count']-1);
                                    html+="<canvas id="+temp+" width='500' height='300'></canvas>";
                                    html+="</div>";
                                    var cc=data['count']-1;
                                    html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+cc+");'>choose this mode</button>";
                                    html+=" </div></div>";
                                }

                        $('#drawlines').html(html);*/
                       
                        drawback(data['gdata'],data['ccount'],data['count'],data['dmax'],data['dmin']);
                        changetips();
                            
                       } },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

});

}

function sleep(d,t)//休眠10s
{
  while(Date.now-t<=d);

}

function readclusterfile(filelink)
{
   var comUrl="/GEsture/index.php/File/readclusterfile";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {"filelink":filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                                $("#searchModal").modal("hide");
                           if(data['flag']==6){
                             alert('sorry,please try again!');
                          }else{
                                setdataform(data['count']);
                               drawback(data['gdata'],data['count'],data['dmax'],data['dmin']);
                        changetips();
                          }
                          },
                           error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                  });

}

 function setdataform(count)
{
                            html="";
                            $('#drawlines').html(html);
                           for(var i=0;i<count-1;i=i+2){
                            html+="<div class='row'>";
                            html+="<div class='col-md-6 col-sm-6'>";
                            html+="<div class='cdiv'>";
                            tb="background"+i;
                            html+="<canvas id="+tb+" width='500' height='300'></canvas>";
                            temp="canvas"+i;
                            html+="<canvas id="+temp+" width='500' height='300'></canvas>";
                            html+=" </div>";
                            html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+i+");'>choose this mode</button>";
                            html+="</div>";

                            html+=" <div class='col-md-6 col-sm-6'>";
                            html+=" <div class='cdiv'>";
                            tb="background"+(i+1);
                            temp="canvas"+(i+1);
                            html+=" <canvas id="+tb+" width='500' height='300'></canvas>";
                            html+=" <canvas id="+temp+" width='500' height='300'></canvas>";
                            html+="</div>";
                            var cc=i+1;
                            html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+cc+");'>choose this mode</button>";
                            html+=" </div></div>";
                            html+="</br>";

                            
                                }
                                if(count%2!=0){
                                    html+="<div class='row'>";
                                    html+=" <div class='col-md-6 col-sm-6'>";
                                    html+="<div class='cdiv'>";
                                    tb="background"+(count-1);
                                    html+="<canvas id="+tb+" width='500' height='300'></canvas>";
                                    temp="canvas"+(count-1);
                                    html+="<canvas id="+temp+" width='500' height='300'></canvas>";
                                    html+="</div>";
                                    var cc=count-1;
                                    html+="<button class='btn btn-primary' type='button' style='margin:10px 0px 0px 30%;' onclick='showline("+cc+");'>choose this mode</button>";
                                    html+=" </div></div>";
                                }

                        $('#drawlines').html(html);

}

function changetips()
{
document.getElementById("jqxNotification16").setAttribute("hidden",true);
document.getElementById("jqxNotificationskip").setAttribute("hidden",true);
//document.getElementById('jqxNotificationchoose').setAttribute("hidden",false);
//document.getElementById('jqxNotificationhand').setAttribute("hidden",false);
//xxx.style.visibility="visible"
$("#jqxNotificationchoose").toggle();
$("#jqxNotificationhand").toggle();
}

function showline(num)
{
    var filename=$("#f").val();
    var filelink=$("#linkf").val();
    
     window.location.href="/GEsture/index.php/File/showline/"+num+"/"+filelink+"/"+filename;

}

function handraw()
{
  var filename=$("#f").val();
  var filelink=$("#linkf").val();
  //document.getElementById("img1").setAttribute("hidden",true);

     window.location.href="/GEsture/index.php/File/handraw/"+filelink+"/"+filename;
}




