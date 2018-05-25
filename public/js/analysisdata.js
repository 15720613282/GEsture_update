var ax,ay,arrx,arry;
var ax1,ay1;
var xx;
var len;
var h=new Array();//变量设置：x为各点横坐标；y为各点纵坐标；h为步长
var c=new Array();
var a=new Array();
//var fxym=new Array();
var result=new Array();
var t=[];
var z;
var F=[];
var f0;
var f1;
var N;
var A,B,C,D,Z,H,nDataCount,M;   
var genetable_content=new Array();
//genetable_content[0]=new Array();
function unique(arrx,arry,n) {
      var x=document.getElementsByName("pattern");
       if(x[1].checked==true)
          {edit_contrast();return;}
       if(x[2].checked==true)
         {select_shift(); return;}
     if(arry=="")
      {  document.getElementById("attention_content").innerText = "please draw the curve first!";
          $("#attention").modal("show");
        // alert("please draw the curve first!");
      }
     else{
     ax=new Array();
     ay=new Array();
    result=new Array();
    var hash = {};
$("#searchModal").modal("show"); 
    for (var i = 0; i < arrx.length; i++) {
        var item = arrx[i];
        var key = typeof(item) + item;
        if (hash[key] !== 1) {
            ax.push(item);
            ay.push(arry[i]);
            hash[key] = 1;
            //alert(ay+" ");
        }
    }
    len=n;
    //alert(ax);

    if(ax[ax.length-1]<len){
         var j=1,m=ax.length-1;
         var k=n;
         f0=(ay[1]-ay[0])/(ax[1]-ax[0]);
         f1=(ay[m]-ay[m-1])/(ax[m]-ax[m-1]);
         var len1= 0,len2=0;
         while(j<ax[0])
         {
             j=j+1;
            len1=len1+1;
         }
         while(k>ax[m])
         {
           k=k-1;
          len2=len2+1;
         }
         for(var i=0;i<len1;i++)
         {
         if(f0>=0)
         {
         var q=ay[0]-(Math.random()*(ay[0]-yl));
         ay.unshift(q);
         ax.unshift(len1-i);

         }
         else{
         var q=yh-(Math.random()*(yh-ay[0]));
         ay.unshift(q);
         ax.unshift(len1-i);
         }
     }

     for(var i=0;i<len2;i++)
     {
      r=ay.length;
       var rr=ax[r-1]+1;
         if(rr>len)
            rr=len;
     if(f1>=0)
     {
     var q=yh-(Math.random()*(yh-ay[r-1]));
     ay.push(q);
     ax.push(rr);

     }
     else{
     var q=ay[r-1]-(Math.random()*(ay[r-1]-yl));
     ay.push(q);
     ax.push(rr);
     }
     }

    }
  
  // alert(ay);
 var all_newdata=new Array();  
 var corr=$("#ex7").val();
 var operafile=$("#operation").val();
 var filelink=$("#linkf").val();
if($("#shiftmode").is(":visible"))
       {
        $(".select").val("0");
        $(".select").val("0");
         $("#shiftmode").toggle();
       }

 var comUrl="/GEsture/index.php/File/compute";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {"len":n,"ax":ax,"ay":ay,"corr":corr,"operafile":operafile,"filelink":filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
			if(data['flag']==3){
                       var t=Date.now();
                        sleep(10000,t);
			readoperfile1(filelink);
                       }else{
                            $("#searchModal").modal("hide");
                         
                          if(data['flag']==110){
                            setdata(data['newy'],n);
                             document.getElementById("attention_content").innerText = "no result!";
                             $("#attention").modal("show");
                          }else{
                           document.getElementById("pattern_file").value=data['file_name'];
                             document.getElementById("max_y").value=data['ymax'];
                        document.getElementById("min_y").value=data['ymin'];
                             setIntervals(n,data['ymin'],data['ymax']);//drawaxes.js
                             showcanvas2();
                             setdata(data['newy'],n);  
                             SetOtherData(data['newda'],n);
                             $("#ex7").slider("enable");
                           setableform(data['selected_genes'],data['c'],data['file_name']);
                         
                         if(data['selected_genes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show");  tt.style.display="none";
                           }
                         else 
                          {  savetoscape2();tt.style.display="block";}
                          $('#contrast_radio').show();
                          $('#shift_radio').show();
                          if(ves.style.display=="none")
                               {
                                ves.style.display="block";
                               // tt.style.display="block";
                                showtable.style.display="block";
                               }
                         
                          $('#filter_slider').show();
                             
                         window.location.href="#anchor";
                      } } },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                  });
   
   }         
}

function setableform(selected_genes,n,file_name)
{ 
 html="";
                           $("#empty_table ul li").html("");

                           html1="";
                           $('#insert_head').html("");
                             html1+="<tr>"
                             html1+="<th scope='col' style='width:450px !important'> GeneName</th>";
                             html1+="<th scope='col'>p_value</th>";
                             html1+="<th scope='col'>corr</th>";
                                for(var i=1;i<=n;i++){
                                    html1+="<th scope='col'>"+i+"</th>";
                                }                         
                             html1+="</tr>";
                            $('#insert_head').html(html1);

                            genetable_content=new Array();
                            for(var i=0;i<selected_genes.length;i++)
                            { 
                                 html+="<tr>";
                                 genetable_content[i]=new Array();
                                for(var j=0;j<selected_genes[0].length;j++)
                                  {
                                     genetable_content[i][j]=selected_genes[i][j];
                                    if(j==0){
                                        
                                            var  aaa=selected_genes[i][j];
                                        html+="<td><a href='javascript:aline("+"\""+aaa+"\""+")'>"+selected_genes[i][j]+"</a></td>"; 
                                    }
                                    else
                                        html+="<td>"+selected_genes[i][j]+"</td>";
                                  }
                                html+="</tr>"; 
                            }
                            html+="<input type='hidden' id='file_name' value="+file_name+">";
                           $('#insert_selected_genes').html(html);
                           if(!$("#showtable").is(":visible"))
                                $("#showtable").toggle();
                           //$('#insert_selected_genes').prop("disabled",false);
                           
                            var $table=$('table');//获取表格对象
                            var currentPage=0;//设置当前页默认值为
                            var pageSize=10;//设置每一页要显示的数目
                            $table.bind('paging', function () {
                            $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();
                            //先将tbody中所有的行隐藏，再通过slice结合当前页数和页面显示的数目展现数据
                            });
                            var sumRows=$table.find('tbody tr').length;//获取数据总行数
                            
                            var sumPages=Math.ceil(sumRows/pageSize);//得到总页数
                            var $pager=$('<ul class="pager"></ul>');

                            for(var pageIndex=0;pageIndex<sumPages;pageIndex++){
                                $('<li><a name="anchor">'+(pageIndex+1)+'</a></li>').bind("click",{"newPage":pageIndex},function(event){
                                currentPage=event.data["newPage"];
                                $table.trigger("paging");
                            //为每一个要显示的页数上添加触发分页函数
                            }).appendTo($pager);
                                $pager.append(" ");
                            }
                            $pager.insertAfter('table');
                            $table.trigger("paging");
}

function sleep(d,t)//休眠10s
{
  while(Date.now-t<=d);
 
}

function readoperfile1(filelink)//第二次读取compute的结果文件，若能读到，显示结果，否则显示出错
{
var comUrl="/GEsture/index.php/File/readoperfile1";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {"filelink":filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
				$("#searchModal").modal("hide");
                           if(data['flag']==4){
                             alert('sorry,the network is bad,please try again later!');
                          }else{
                           if(data['flag']==110){
                            setdata(data['newy'],n);
                            document.getElementById("attention_content").innerText = "no result!";
                             $("#attention").modal("show");
                          }else{
                           document.getElementById("pattern_file").value=data['file_name'];
                            document.getElementById("max_y").value=data['ymax'];
                        document.getElementById("min_y").value=data['ymin'];
                           setIntervals(n,data['ymin'],data['ymax']);//drawaxes.js
                             showcanvas2();
                             setdata(data['newy'],n);  
                             SetOtherData(data['newda'],n);
                             $("#ex7").slider("enable");
                            setableform(data['selected_genes'],data['c'],data['file_name']);
                      
                           if(data['selected_genes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show"); tt.style.display="none";
                           }
                          else
                        { savetoscape2(); tt.style.display="block";}
                          $('#contrast_radio').show();
                          $('#shift_radio').show();
                          if(ves.style.display=="none")
                               {
                                ves.style.display="block";
                               // tt.style.display="block";
                                showtable.style.display="block";
                               }
                          
                          $('#filter_slider').show();
                               
                         window.location.href="#anchor";   
                         
                       } }},
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                  });
}

function aline(genename)
{
    
    var comUrl="/GEsture/index.php/File/oneline";
    var filelink=$("#linkf").val();
    var filename=$("#file_name").val();
  
    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink,'genename':genename,'filename':filename},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            SetOtherData(data['choosegene'],data['n']);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                  });

}


function bline(genename)//画cluster出来的图
{
  var comUrl="/GEsture/index.php/File/c_oneline";
    var filelink=$("#linkf").val();
    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink,'genename':genename},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                           
                            SetOtherData(data['choosegene'],data['n']);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                  });
}

function show_download(num,title,content)
{
  
    panel="#panel"+num;
    var html="";
     $(panel).html("");
    if(!$(panel).is(":visible")){
                   $(panel).toggle();
     }
    html+="<div class='panel-heading' role='tab' id='heading"+num+"'>";
    html+="<h4 class='panel-title'>";
    html+="<a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse"+num+"' aria-expanded='true' aria-controls='collapse"+num+"'>";
    html+="<i class='fa fa-search' aria-hidden='true'></i>";
    html+="</a>";
    html+="<span id='tle'>"+title+"</span>";    
    html+="<button id='btnDownload_Gene_Bank' class='btn btn-xs btn-primary pull-right' onclick='downloadAsFile("+"\""+num+"\""+");'><i class='fa fa-download' aria-hidden='true'></i> Download</button>";
    html+="</h4>";
    html+="</div>";
    html+="<div id='collapse"+num+"' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading"+num+"'>";
    html+="<div class='panel-body'>";
    html+="<pre class='bg-success' id='result_line'>";
    for(var i=0;i<content.length;i++)
      {html+=content[i];html+="\n";}
    html+="</pre>";
    html+="</div></div>";
    $(panel).html(html);

}

function downloadAsFile()
{
    var filename=$("#file_name").val();
    var filelink=$("#linkf").val();
     var comUrl="/GEsture/index.php/File/save_file";
var form=$("<form>");//定义一个form表单
form.attr("style","display:none");
form.attr("target","");
form.attr("method","post");
form.attr("action",comUrl);
var input1=$("<input>");
input1.attr("type","hidden");
input1.attr("name","filename");
input1.attr("value",filename);
var input2=$("<input>");
input2.attr("type","hidden");
input2.attr("name","filelink");
input2.attr("value",filelink);
/*var input3=$("<input>");
input3.attr("type","hidden");
input3.attr("name","filename");
input3.attr("value",filename);*/
$("body").append(form);//将表单放置在web中
form.append(input1);
form.append(input2);
//form.append(input3);
form.submit();


}


function showcanvas2()
{
 canv1.style.display="block";
 html="<canvas id='cvs1' width='1000' height='500'>Your browser does not support the canvas element.</canvas>";
 $("#canv1").html(html);
 prepCanvas1();
  if(!$("#ves").is(":visible")){
                   $("#ves").toggle();
                   $("#tt").toggle();
                   $("#dwd").toggle();
                        }
}




function edit_contrast()
{
     if($("#shiftmode").is(":visible"))
       {
        $(".select").val("0");
        $(".select").val("0");
         $("#shiftmode").toggle();
       }
     ax_c=new Array();
     ay_c=new Array();
     arrx=new Array();
    arry=new Array();
    var mySlider = $("#ex7").slider();
         mySlider.slider('setValue',0.67);
    var corr=$("#ex7").val();
    var filelink=$("#linkf").val();
    var max_y=$("#max_y").val();
    var min_y=$("#min_y").val();
     arrx=Getclickx();
     arry=Getclicky();
   
     var hash = {};  
    if(arry.length===0||arry.length<=2)
       {
         document.getElementById("attention_content").innerText = "please draw the curve first!";
         // $('#attention_content').value="please draw the curve first!";
          $("#attention").modal("show");
          var x=document.getElementsByName("pattern");
       if(x[0].checked==false)
           x[0].checked=true;
       }
    else{
        if(arry.length!=len&&arrx[arrx.length-1]!=len)
          {   document.getElementById("attention_content").innerText = "please search after brush pattern!";
          $("#attention").modal("show");
             
              var x=document.getElementsByName("pattern");
       if(x[0].checked==false)
           x[0].checked=true;
          }
        else{   
       for (var i = 0; i < arrx.length; i++) {
        var item = arrx[i];
        var key = typeof(item) + item;
        if (hash[key] !== 1) {
            ax_c.push(item);
            ay_c.push(arry[i]);
            hash[key] = 1;
        }
    }


    $("#searchModal").modal("show");
    var comUrl="/GEsture/index.php/File/contrast";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'corr':corr,'ax':ax_c,'ay':ay_c,'filelink':filelink,'max_y':max_y,'min_y':min_y},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if(data['flag']==2){
                             var t=Date.now();
                        sleep(10000,t);
                        readoperfile2(filelink);
                          }else{
   				$("#searchModal").modal("hide");
                          if(data['flag']==110){
                           // setInterval1(data['c'],data['min'],data['max']);
                           // prepareCanvas();
                           // drawdata(data['c'],data['ax'],data['c_ay']);
                           document.getElementById("attention_content").innerText = "no contrast expression result!";
                             $("#attention").modal("show");
                          }else{
                         document.getElementById("pattern_file").value=data['file_name'];
                         setInterval1(data['c'],data['min'],data['max']);
                            prepareCanvas();
                          setIntervals(data['c'],data['cmin'],data['cmax']);//drawaxes.js
                             showcanvas2();
                         
                           drawdata(data['c'],data['ax'],data['c_ay']);//在html5-canvas-drawing-app1.js中
                           SetOtherData1(data['c_newda'],data['c']);//drawaxes.js中
                         setableform(data['c_selected_genes'],data['c'],data['file_name']);
                         if(data['c_selected_genes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show");
                           tt.style.display="none";
                           }
                         else
                        { savetoscape2(); tt.style.display="block";}    
                       // show_download('2',data['title'],data['c_selected_genes']);
                           }  } },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

               });
     }}
}

function readoperfile2(filelink)//第二次读取contrast的结果文件，若能读到，显示结>果，否则显示出错
{
var comUrl="/GEsture/index.php/File/readoperfile2";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {"filelink":filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                        $("#searchModal").modal("hide");
                         if(data['flag']==2){
                           alert("Sorry,the network is bad,please try again later!");
                          }else{
                           if(data['flag']==110){
                          // setInterval1(data['c'],data['min'],data['max']);
                           // prepareCanvas();
                          // drawdata(data['c'],data['ax'],data['c_ay']);
                           document.getElementById("attention_content").innerText = "no contrast expression result!";
                             $("#attention").modal("show");
                           }else{
                        document.getElementById("pattern_file").value=data['file_name'];
                         setInterval1(data['c'],data['min'],data['max']);
                            prepareCanvas();
                          setIntervals(data['c'],data['cmin'],data['cmax']);//drawaxes.js
                             showcanvas2();
                           drawdata(data['c'],data['ax'],data['c_ay']);//在html5-canvas-drawing-app1.js中
                           SetOtherData1(data['c_newda'],data['c']);//drawaxes.js中
                         setableform(data['c_selected_genes'],data['c'],data['file_name']);
                         if(data['c_selected_genes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data!";
          $("#attention").modal("show");
             tt.style.display="none";
                           }
                        else
                       { savetoscape2(); tt.style.display="block";}      
                // show_download('2',data['title'],data['c_selected_genes']);
                   }  } },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

               });
}

function edit_shift()
{ 
    arry=new Array();
    arrx=new Array();
    arrx=Getclickx();
     arry=Getclicky();      
     if(arry==""||arry.length<=1)
        {
          document.getElementById("attention_content").innerText = "please draw the curve first!";
          $("#attention").modal("show");
          
          var x=document.getElementsByName("pattern");
       if(x[0].checked==false)
           x[0].checked=true;
         }
      else if(arry.length!=len&&arrx[arrx.length-1]!=len)
        {
          document.getElementById("attention_content").innerText = "please search after brush pattern!";
          $("#attention").modal("show");
         
          var x=document.getElementsByName("pattern");
       if(x[0].checked==false)
           x[0].checked=true;    
        }
     else{
       if(!$("#shiftmode").is(":visible"))
       {
         $("#shiftmode").toggle();
       }
     }
       

}


function select_shift()
{
   $("#gname").hide();
     ax=new Array();
     ay=new Array();
     ax=Getclickx();
     ay=Getclicky();
 //  var corr=$("#ex7").val();
   var L=$("#select_shift1").val();
   var R=$("#select_shift2").val();
   var filelink=$("#linkf").val();
   var operafile=$("#operation").val();
   var mySlider = $("#ex7").slider();
         mySlider.slider('setValue',0.67);
   var corr=$("#ex7").val();
   if(ay==""||ay.length<=2)
      {
        document.getElementById("attention_content").innerText = "please draw the curve first!";
          $("#attention").modal("show");
      
        var x=document.getElementsByName("pattern");
       if(x[0].checked==false)
           x[0].checked=true;
      }
    else{
         $("#searchModal").modal("show");
         var comUrl="/GEsture/index.php/File/shift";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'corr':corr,'L':L,'R':R,'ax':ax,'ay':ay,'filelink':filelink,'filename':operafile},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            if(data['flag']==3){
                            
                             var t=Date.now();
                             sleep(10000,t);
                             readoperfile3(filelink);
                             }else{
                            $("#searchModal").modal("hide");
                            if(data['flag']==110){
                            document.getElementById("attention_content").innerText = "no shift expression result!";
                             $("#attention").modal("show");
                           }else{
                             document.getElementById("pattern_file").value=data['file_name'];     
                             setIntervals(data['n'],data['smin'],data['smax']);//drawaxes.js
                             showcanvas2();
                            setdata(data['ay'],data['n']);
                            if(L!=0||R!=0)
                             {
                             
setdata_shift(data['ax_b'],data['ay_b'],data['ax_c'],data['ay_c'],data['nb'],data['nc']);  
                             SetOtherData2(data['snewy_l'],data['snewy_r']);}//画shift的图像
                          setableform2(data['selected_shiftgenes'],data['n'],data['file_name']); 
                      if(data['selected_shiftgenes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show");
                tt.style.display="none";
                           } 
                       else
                     { savetoscape2();tt.style.display="block";
                      $("#cyto1").show();
                       cytoscape1();
                      }     
                      // $("#cyto1").show();
                      // cytoscape1();    
                 
                            /* if(!$("#cmap").is(":visible"))
                               {
                                 $("#cmap").show();
                               }*/
                            } } },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                            

          }); 
   }
}

function readoperfile3(filelink)
{
  var comUrl="/GEsture/index.php/File/readoperfile3";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {"filelink":filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                         $("#searchModal").modal("hide");
                          if(data['flag']==3){
                          alert("Sorry,the network is bad,please try again later!");
                          }else{
                            if(data['flag']==110){
                            document.getElementById("attention_content").innerText = "no shift expression result!";
                             $("#attention").modal("show");
                           }else{
                            document.getElementById("pattern_file").value=data['file_name'];
                             setIntervals(data['n'],data['smin'],data['smax']);//drawaxes.js 
                            showcanvas2();
                            setdata(data['ay'],data['n']);
                            if(L!=0||R!=0)
                             {
                          
 setdata_shift(data['ax_b'],data['ay_b'],data['ax_c'],data['ay_c'],data['nb'],data['nc']);  
                             SetOtherData2(data['snewy_l'],data['snewy_r']);}//画shift的图像
                           setableform2(data['selected_shiftgenes'],data['n'],data['file_name']);
                           if(data['selected_shiftgenes'].length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show"); tt.style.display="none";
                           }
                           else
                         { savetoscape2();tt.style.display="block";
                      $("#cyto1").show(); 
                      cytoscape1();
                         }         
                // show_download('3',data['title'],data['selected_shiftgenes']);
                          /*  if(!$("#cmap").is(":visible"))
                               {
                                 $("#cmap").show();
                               }  */  
                     } } },
                         error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);
                        }
                            

          });
}
function setableform2(selected_shiftgenes,n,file_name)
{
 html="";
                           $("#empty_table ul li").html("");

                           html1="";
                           $('#insert_head').html("");
                             html1+="<tr>"
                             html1+="<th scope='col' style='width:450px !important'> GeneName</th>";
                             html1+="<th scope='col'>p_value</th>";
                             html1+="<th scope='col'>corr</th>";
                             html1+="<th scope='col'>interval</th>";
                                for(var i=1;i<=n;i++){
                                    html1+="<th scope='col'>"+i+"</th>";
                                }                         
                             html1+="</tr>";
                            $('#insert_head').html(html1);

                            genetable_content=new Array();
                            for(var i=0;i<selected_shiftgenes.length;i++)
                            { 
                                 html+="<tr>";
                                 genetable_content[i]=new Array();
                                for(var j=0;j<selected_shiftgenes[0].length;j++)
                                  {
                                    genetable_content[i][j]=selected_shiftgenes[i][j];
                                    if(j==0)
                                        {var aaa=selected_shiftgenes[i][j];
                                        html+="<td><a href='javascript:aline("+"\""+aaa+"\""+")'>"+selected_shiftgenes[i][j]+"</a></td>";}
                                    else
                                        html+="<td>"+selected_shiftgenes[i][j]+"</td>";
                                  }
                                html+="</tr>"; 
                            }
                           
                            html+="<input type='hidden' id='file_name' value="+file_name+">";
                           $('#insert_selected_genes').html(html);
                           if(!$("#showtable").is(":visible"))
                                $("#showtable").toggle();
                            var $table=$('table');//获取表格对象
                            var currentPage=0;//设置当前页默认值为
                            var pageSize=10;//设置每一页要显示的数目
                            $table.bind('paging', function () {
                            $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();
                            //先将tbody中所有的行隐藏，再通过slice结合当前页数和页面显示的数目展现数据
                            });
                            var sumRows=$table.find('tbody tr').length;//获取数据总行数
                            
                            var sumPages=Math.ceil(sumRows/pageSize);//得到总页数
                            var $pager=$('<ul class="pager"></ul>');

                            for(var pageIndex=0;pageIndex<sumPages;pageIndex++){
                                $('<li><a name="anchor">'+(pageIndex+1)+'</a></li>').bind("click",{"newPage":pageIndex},function(event){
                                currentPage=event.data["newPage"];
                                $table.trigger("paging");
                            //为每一个要显示的页数上添加触发分页函数
                            }).appendTo($pager);
                                $pager.append(" ");
                            }
                            $pager.insertAfter('table');
                            $table.trigger("paging");
}

function random_selected()
{   if(!$("#rdgene").is(":visible"))
       {
         $("#rdgene").toggle();
       }
    var filelink=$("#linkf").val();
var comUrl="/GEsture/index.php/File/random_selected";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                           
                            document.getElementById("gename").value=data['randomgene'];
                           
                         
                            setInterval1(data['n'],data['rmin'],data['rmax']);
                            prepareCanvas();
                            setdata(data['random_y'],data['n']);  
                             
                        },

                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

});
}


function brush()
{
    
    //html="<li class='nav-item start active open'>";
    //$("#brush").html(html);
    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },0);

}

function random_new()
{
    $("#gname").hide();
    var filelink=$("#linkf").val();
    var comUrl="/GEsture/index.php/File/random_new";
                    $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            setInterval1(data['n'],data['min'],data['max']);
                            prepareCanvas();
                            setdata(data['ay'],data['n']);  
                             //SetOtherData(data['newda'],n);
                        },

                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }
                            

});
}

function filltable(goal,file_name)
{
    //document.getElementById('gname').setAttribute("hidden",true);
                           html="";
                           $("#empty_table ul li").html("");

                           html1="";
                           $('#insert_head').html("");
                             html1+="<tr>"
                             html1+="<th scope='col' style='width:450px !important'> GeneName</th>";
                             html1+="<th scope='col'>class</th>";
                                for(var i=1;i<=goal[0].length-2;i++){
                                    html1+="<th scope='col'>"+i+"</th>";
                                }                         
                             html1+="</tr>";
                            $('#insert_head').html(html1);

                            genetable_content=new Array();
                            for(var i=0;i<goal.length;i++)
                            { 
                                 genetable_content[i]=new Array();
                                 html+="<tr>";
                                 for(var j=0;j<goal[0].length;j++){
                                    genetable_content[i][j]=goal[i][j];
                                 if(j==0)
                                    {
                                        var aaa=goal[i][0];
                                        html+="<td><a href='javascript:bline("+"\""+aaa+"\""+")'>"+goal[i][0]+"</a></td>";
                                    }
                                 else if(j==1)
                                    html+="<td>"+goal[i][1]+"</td>";
                                 else                                 
                                     html+="<td>"+goal[i][j]+"</td>"; 
                              }
                               html+="</tr>";              

                            }
                            html+="<input type='hidden' id='file_name' value="+file_name+">";
                           $('#insert_selected_genes').html(html);
                           if(!$("#showtable").is(":visible"))
                                $("#showtable").toggle();
                            //$('#insert_selected_genes').prop("disabled",false);
                            var $table=$('table');//获取表格对象
                            var currentPage=0;//设置当前页默认值为
                            var pageSize=10;//设置每一页要显示的数目
                            $table.bind('paging', function () {
                            $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();
                            //先将tbody中所有的行隐藏，再通过slice结合当前页数和页面显示的数目展现数据
                            });
                            var sumRows=$table.find('tbody tr').length;//获取数据总行数
                            
                            var sumPages=Math.ceil(sumRows/pageSize);//得到总页数
                            var $pager=$('<ul class="pager"></ul>');

                            for(var pageIndex=0;pageIndex<sumPages;pageIndex++){
                                $('<li><a name="anchor">'+(pageIndex+1)+'</a></li>').bind("click",{"newPage":pageIndex},function(event){
                                currentPage=event.data["newPage"];
                                $table.trigger("paging");
                            //为每一个要显示的页数上添加触发分页函数
                            }).appendTo($pager);
                                $pager.append(" ");
                            }
                            $pager.insertAfter('table');
                            $table.trigger("paging");
                            // show_download('1',file_name,goal);
                             
}


function line_change(slideEvt)
{
        var filename=$("#pattern_file").val();
	var filelink=$("#linkf").val();
	var lc_tabledata=new Array();
	var flag=1;
	var lc_gene=new Array();
	var row=0;
	var att=0;
	var n=genetable_content[0].length;
	var title="filter result";
	var start=3;
	if($("#shiftmode").is(":visible"))
	{ start=4; att=1;}
	for(var i=0;i<genetable_content.length;i++)
	{

		if(slideEvt<=genetable_content[i][2])
		{
			lc_tabledata[row]=new Array();
			lc_gene[row]=new Array();

			for(var j=0;j<n;j++)
			{
				if(j>=start)
					lc_gene[row][j-start]=genetable_content[i][j];
				lc_tabledata[row][j]=genetable_content[i][j];
			}
			row=row+1;
		}

	}
	
	SetOtherData(lc_gene,n-start);//drawaxes.js中
	if(row==0)
		flag=0;


	  var comUrl="/GEsture/index.php/File/line_change";
                     $.ajax({
                      type: 'post',
                      url: comUrl,
                      data: {'filelink':filelink,'flag':flag,'filename':filename,'corr':slideEvt },
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                            //alert(data);
                            if(data)
                             {

                           html="";
                           //$("#empty_table ul li").html("");
                           $('#insert_selected_genes').html("");
                           $("#empty_table ul li").hide();
                           //$("#pager").html("");

                           html1="";
                           $('#insert_head').html("");
                             html1+="<tr>"
                             html1+="<th scope='col' style='width:450px !important'> GeneName</th>";
                             html1+="<th scope='col'>p_value</th>";
                             html1+="<th scope='col'>corr</th>";
                             if($("#shiftmode").is(":visible"))
                                html1+="<th scope='col'>class</th>";
                                for(var i=1;i<=n-start;i++){
                                    html1+="<th scope='col'>"+i+"</th>";
                                }                         
                             html1+="</tr>";
                            $('#insert_head').html(html1);


                            for(var i=0;i<lc_tabledata.length;i++)
                            { 
                                 html+="<tr>";
                                for(var j=0;j<lc_tabledata[i].length;j++)
                                  {
                                    if(j==0)
                                        {
                                        var aaa=lc_tabledata[i][j];
                                        html+="<td><a href='javascript:aline("+"\""+aaa+"\""+")'>"+lc_tabledata[i][j]+"</a></td>";
                                        }
                                    else
                                        html+="<td>"+lc_tabledata[i][j]+"</td>";
                                  }
                                html+="</tr>"; 
                            }
                           html+="<input type='hidden' id='file_name' value='filter_gene.csv'>";
                           $('#insert_selected_genes').html(html);
                           if(!$("#showtable").is(":visible"))
                                $("#showtable").toggle();

                            var $table=$('table');//获取表格对象
                            var currentPage=0;//设置当前页默认值为
                            var pageSize=10;//设置每一页要显示的数目
                            $table.bind('paging', function () {
                            $table.find('tbody tr').hide().slice(currentPage*pageSize,(currentPage+1)*pageSize).show();
                            //先将tbody中所有的行隐藏，再通过slice结合当前页数和页面显示的数目展现数据
                            });
                            var sumRows=$table.find('tbody tr').length;//获取数据总行数
                            //alert(sumRows);
                            var sumPages=Math.ceil(sumRows/pageSize);//得到总页数
                            //var sumPages=0;
                            var $pager=$('<ul class="pager"></ul>');

                            for(var pageIndex=0;pageIndex<sumPages;pageIndex++){
                                $('<li><a name="anchor">'+(pageIndex+1)+'</a></li>').bind("click",{"newPage":pageIndex},function(event){
                                currentPage=event.data["newPage"];
                                $table.trigger("paging");
                            //为每一个要显示的页数上添加触发分页函数
                            }).appendTo($pager);
                                $pager.append(" ");
                            }
                            $pager.insertAfter('table');
                            $table.trigger("paging");
                            if(lc_tabledata.length>500)
                           {
                          document.getElementById("attention_content").innerText = " heat map will show when the number of result genes are lower than 500 , please filter the data if you want to see the heat map!";
          $("#attention").modal("show"); tt.style.display="none";
                           }
                           else
                           { savetoscape2(); tt.style.display="block";}
                            if(att==1)
                              {
                                $("#cyto1").show(); 
                                cytoscape1();
                              }
                            }
                            else{
                                 $('#insert_selected_genes').html("");
                                 $("#empty_table ul li").hide();
                                 $('#insert_head').html("");
                                 tt.style.display="none";
                                showtable.style.display="none";
                                }
                            
                        },
                     error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }

                    });

                            if(att==1)
                              {
                                $("#cyto1").show();
                                cytoscape1();
                              }
 
}

function gename_search()
{
   if($("#shiftmode").is(":visible"))
       {
        $(".select").val("0");
        $(".select").val("0");
         $("#shiftmode").toggle();
       }
     var gname=$("#gename").val();
     if(gname.length==0)
       {
          document.getElementById("attention_content").innerText = "please input the gene name!";
          $("#attention").modal("show");
        }
     var filelink=$("#linkf").val();
     var filename=$("#operation").val();
     //var fn=<?//=$this->config->item('proname');?>;
     var comUrl="/GEsture/index.php/File/select_gename";
                            $.ajax({
                        type: 'post',
                        url: comUrl,
                        data: {'filelink':filelink,'gname':gname,'filename':filename},
                        dataType: 'json',
                        async: true,
                        success: function (data) {
                           if(data['flag']==0)
                               {
                                document.getElementById("attention_content").innerText = "no search result!";
                              $("#attention").modal("show");
                               }
                            else{
                            setInterval1(data['n'],data['gmin'],data['gmax']);
                            prepareCanvas();
                            setdata(data['geney'],data['n']);
                           } 
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log(errorThrown);

                        }

                    });

}


function show_genebox()
{
    $("#searchModal2").modal("show");
}








