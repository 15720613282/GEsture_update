var dataFile = "data/test2.csv";

var columnName_geneName = "geneName";
var columnName_geneSum = "geneSum";
var rowName_spciesName_prefix = "rsp";

$(document).ready(function () {
    initData(tdata);
    
    $("#jqxgrid").on('rowselect', updateOutput);
    $("#jqxgrid").on('rowunselect', updateOutput);

    $('#txtOutput').jqxTextArea({
        width: 950, 
        height: 75, 
        placeHolder: 'Gene Name list here...', 
        disabled: true, 
        theme: 'office' 
    });

    //$("#btnNext").jqxButton({theme: 'office'});
    $('#btnNext').click(submitForm);
    $('#btnAuto').click(autoSelect);
    $('#btnSample').click(sampleNext);

    $("#jqxNotification").jqxNotification({
        width: "auto", 
        position: "bottom-right", 
        opacity: 0.8, 
        autoClose: true, 
        template: "error",
        theme: "office"
    });
});

function autoSelect() {
    //$("#jqxgrid").
    $("#jqxgrid").jqxGrid('clearselection');
    var rows = $('#jqxgrid').jqxGrid('getrows');

    var columnNumber = 0;
    var maxGeneNumber = 0;
    for (var iCount=0; iCount < rows.length; iCount ++) {
        if ( maxGeneNumber < rows[iCount].geneSum ) maxGeneNumber = rows[iCount].geneSum;
        columnNumber++;
    }

    var maxGeneSelected = 0;
    for (var iCount=0; iCount < rows.length; iCount ++) {
        if ( rows[iCount].geneSum >= maxGeneNumber - 1 )
        maxGeneSelected++;
    }

    if ( maxGeneNumber * 0.9 < maxGeneSelected ) {
        maxGeneNumber -= 1 ;
    }

    for (var iCount=0; iCount < rows.length; iCount ++) {
        if ( rows[iCount].geneSum >= maxGeneNumber )
        $('#jqxgrid').jqxGrid('selectrow', iCount);
    }
} 

function submitForm() {
    if ( $('#txtOutput').val() == '' ) {
        $("#jqxNotification").jqxNotification('open');
    } else {
        $("#geneList")[0].value = $('#txtOutput').val();
        $("#form").submit();
    }
} 

function sampleNext() {
    autoSelect();
    submitForm();
}

function updateOutput() {
    var titles = [];
    var rows = $("#jqxgrid").jqxGrid('selectedrowindexes');
    
    for (var iCount = 0; iCount < rows.length; iCount++) {
        var row = $("#jqxgrid").jqxGrid('getrowdata', rows[iCount]);  
        titles.push(row[columnName_geneName]);
    }

    $("#txtOutput").text(titles);
    $('#jqxgrid').jqxGrid({
        renderstatusbar: function (statusbar) {
            statusbar[0].innerHTML = '<div style="margin: 5px">'+ rows.length + ' genes selected.</div>';
    }});
}

function getShortName(fullName, size1, size2) {
    var parts = fullName.split(' ');
    if ( size2 == 0 ) return parts[0].substr(0,size1) +"."+ parts[1];
    return parts[0].substr(0,size1) +"."+ parts[1].substr(0,size2);
}

function initData(indata) {
    // console.log("start to init...")
    // console.log(indata);

    //对获取到的csv文件进行处理，根据逗号和换行进行分隔，一行作为一个数组
    var allTextLines = indata.split(/\r\n|\n/);
    var headers = allTextLines[0].split(',');

    var lines = [];
    var tarr = [];
    // 表头，最左上角
    tarr.push("Gene");
    tarr.push("Sum");
    // 表头，计算每一个字符串的压缩
    for(var i = 1; i < headers.length; i++){
        // 获取缩略名
        if ( headers.length > 15 )
            tarr.push( getShortName(headers[i], 1, 3) );
        else if ( headers.length > 6 )
            tarr.push( getShortName(headers[i], 1, 0) );
        else 
            tarr.push( headers[i] );
    }
    // 第一行构建完成
    lines.push(tarr);

    // 第二行开始，是数据部分
    for (var i = 1; i < allTextLines.length; i++) {
        var data = allTextLines[i].split(',');
        var sum=0; // 统计每行的总数
        if (data.length == headers.length) {
            tarr = [];
            tarr.push(data[0]);
            tarr.push("temp");
            for (var j = 1; j < headers.length; j++) {
                tarr.push( data[j]==0 ? false:true );
                if (data[j] != 0) sum++;
            }
            tarr[1]=sum;
            lines.push(tarr);
        }
    }
    //console.log(lines);
/*  
    已构建如下的二位数组
    Gene Sum  sp1   sp2   sp3
    gen1  3   true  true  true
    gen2  2   true  true  false
    gen3  2   false true  true
    gen4  1   false false true
*/
    var columns = new Array();
    var datafields = new Array();

    // 第一列
    columns.push({datafield: columnName_geneName, text: lines[0][0], width: 50, align: 'center', cellsalign: 'center', pinned: true});
    datafields.push({name: columnName_geneName, type: "string"});
    // 第二列
    columns.push({datafield: columnName_geneSum, text: lines[0][1], width: 50, align: 'center', cellsalign: 'center', pinned: true});
    datafields.push({name: columnName_geneSum, type: "int"});

    // 之后的每一列
    for (var i=2; i<=headers.length; i++) {
        var columnName = rowName_spciesName_prefix+i;
        columns.push({datafield: columnName, text: lines[0][i], width: 40, align: 'center', cellsalign: 'center', columntype: 'checkbox'});
        datafields.push({name: columnName, type: "bool"});
    }

    // 填充数据
    var data = new Array();
    // 第一行是表头，跳过
    for (var i=1; i<lines.length; i++) {
        var row = {};
        // 第一列是基因名称
        row[columnName_geneName] = lines[i][0];
        // 第二列是基因数量
        row[columnName_geneSum] = lines[i][1];
        // 之后每一列都是数据
        for (var j=2; j<=headers.length; j++) {
            row[rowName_spciesName_prefix+j] = lines[i][j];
        }
        // 填充
        data[i-1] = row;
    }

    var source = {
        localdata: data,
        datatype: "array",
        datafields: datafields
    };

    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid(
        {
            width: 950,
            height: 600,
            theme: 'office', 
            source: dataAdapter,
            sortable: true,
            selectionmode: 'checkbox',
            showstatusbar: true,
            statusbarheight: 30,
            columns: columns
        });
    $('#jqxgrid').jqxGrid('autoresizecolumns');
}