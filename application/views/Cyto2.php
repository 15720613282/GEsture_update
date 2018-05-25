<html>
    <head>
        <meta charset="utf-8">
        <script src="<?=base_url('public/js/jquery-1.11.1.min.js')?>"></script>
        <script src="<?=base_url('public/js/echarts/echart.js')?>" type="text/javascript"></script>
       <!-- <script src="<?=base_url('public/js/echarts/esl.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/js/echarts/config.js')?>" type="text/javascript"></script>-->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    </head>
    <body>
        <style>
            html, body, #main {
                width: 100%;
                height: 100%;
                margin: 0;
            }
        </style>
        <div ><a href="#" onClick="history.back(1);">go back</a></div>
        <div id="main"></div>
        <script>
         var chart = echarts.init(document.getElementById('main'));
         var hours =[];
         var j=0;
         var k=0;
         var z=0;
         var days=[];
         var data=[];
var bb=<?php echo $recordnum;?>;
alert(bb);
                <?php for($i=0;$i<$recordnum;$i++) {?>
                hours[j]="<?php echo $i+1;?>";
                j=j+1;
                <?php } ?>

              <?php for($i=0;$i<$count;$i++) {?>
                days[k]="<?php echo $genes[$i];?>";
                
                <?php 
                  //$gg=count($genedata[$i][0]);
                for($m=0;$m<count($genedata[$i][0]);$m++){?>
                  data[z]=[<?php echo $i;?>,<?php echo $m;?>,<?php echo $genedata[$i][0][$m];?>];
                  z++;
                 <?php } ?> 
                 k=k+1;
                <?php } ?>
                data = data.map(function (item) {
                    return [item[1], item[0], item[2] || '-'];
                });
                chart.setOption({
                    tooltip: {
                        position: 'top'
                    },
                    animation: false,
                    grid: {
                        height: 400
                    },
                    xAxis: {
                        type: 'category',
                        data: hours
                    },
                    yAxis: {
                        type: 'category',
                        data: days
                    },
                    visualMap: {
                        min: -2,
                        max:2,
                        calculable: true,
                         inRange: {
                           color: ['#313695', '#4575b4', '#74add1', '#abd9e9', '#e0f3f8', '#ffffbf', '#fee090', '#fdae61', '#f46d43', '#d73027', '#a50026']
                           }
                    },
                    series: [{
                        name: 'Gaussian',//Punch Card',
                        type: 'heatmap',
                        data: data,
                        label: {
                            normal: {
                                show: true
                            }
                        },
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowColor: 'rgba(0, 63, 198, 0.5)'
                            }
                        }
                    }]
                });
       
        </script>
    </body>
</html>