var preURL='cpdata.php?id=';
//var dataFile = 'cpdb/ncbi.csv';

$(document).ready(function () {
    var source = {
        datatype: "csv",
        datafields: [
            { name: 'Name', type: 'string' },
            { name: 'SubGroup', type: 'string' },
            { name: 'RefSeq', type: 'string' },
            { name: 'INSDC', type: 'string' },
            { name: 'Size', type: 'string' },
            { name: 'GC%', type: 'string' },
            { name: 'Gene', type: 'string' },
            { name: 'Protein', type: 'string' },
            { name: 'rRNA', type: 'string' },
            { name: 'tRNA', type: 'string' },
            { name: 'Other RNA', type: 'string' },
            { name: 'Pseudogene', type: 'string' },
            { name: 'Release Date', type: 'string' },
            { name: 'Modify Date', type: 'string' }
        ],
        url: dataFile,
        pagenum: 0
    };  

    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#jqxgrid").jqxGrid ( {
        theme: 'office',
        width: 950,
        source: dataAdapter,
        sortable: true,
        pageable: true,
        autoheight: true,
        columnsresize: true,
        scrollbarsize: 10,
        selectionmode: 'checkbox',
        altrows: true,
        filterable: true,
        enabletooltips: true,
        pagesize: 10,
        showtoolbar: true,
        rendertoolbar: function(toolbar){
            var me = this;
            var container = $("<div style='margin-top: 10px; margin-right: 10px' class='text-right'>Last updated: "+last_update+"</div>");
            toolbar.append(container);
        },
        pagesizeoptions:['10', '20', '50'],
        columns: [
            { cellsalign: 'left', align: 'center', text: 'Organism/Name', datafield: 'Name', cellsformat: 'D', width: 250},
            { hidden: 'true', cellsalign: 'center', align: 'center', text: 'SubGroup', datafield: 'SubGroup', cellsformat: 'f' , width: 90},
            { cellsrenderer: renderer, cellsalign: 'center', align: 'center', text: 'RefSeq', datafield: 'RefSeq', cellsformat: 'f' , width: 100},
            { cellsalign: 'center', align: 'center', text: 'INSDC', datafield: 'INSDC', cellsformat: 'f' , width: 100},
            { cellsalign: 'center', align: 'center', text: 'Size (Kb)', datafield: 'Size', cellsformat: 'f', width: 80 },
            { cellsalign: 'center', align: 'center', text: 'GC%', datafield: 'GC%', cellsformat: 'f' , width: 80},
            { cellsalign: 'center', align: 'center', text: 'Gene', datafield: 'Gene', cellsformat: 'f' , width: 40},
            { cellsalign: 'center', align: 'center', text: 'Protein', datafield: 'Protein', cellsformat: 'f' , width: 55},
            { hidden: 'true', cellsalign: 'center', align: 'center', text: 'rRNA', datafield: 'rRNA', cellsformat: 'f', width: 40 },
            { hidden: 'true', cellsalign: 'center', align: 'center', text: 'tRNA', datafield: 'tRNA', cellsformat: 'f' , width: 40},
            { hidden: 'true', cellsalign: 'center', align: 'center', text: 'Other RNA', datafield: 'Other RNA', cellsformat: 'f' , width: 80},
            { hidden: 'true', cellsalign: 'center', align: 'center', text: 'Pseudogene', datafield: 'Pseudogene', cellsformat: 'f' , width: 60},
            { cellsalign: 'center', align: 'center', text: 'Release Date', datafield: 'Release Date', cellsformat: 'f', width: 100 },
            { cellsalign: 'center', align: 'center', text: 'Modify Date', datafield: 'Modify Date', cellsformat: 'f' , width: 100}
        ]
    });
    $("#jqxgrid").on('rowselect', updateOutput);
    $("#jqxgrid").on('rowunselect', updateOutput);

    $('#btnShowDetail').jqxSwitchButton( {height: 15, checked: false, theme: 'office'} );
    $('#btnShowDetail').on('change', showDetail);

    $('#txtOutput').jqxTextArea({ width: 950, height: 75, placeHolder: 'RefSeq here...', disabled: true, theme: 'office' });

    $('#btnSearch').jqxButton({ theme: 'office'});
    $("#btnSearch").click(applyFilter);

    $('#btnClear').jqxButton({ theme: 'office'});
    $("#btnClear").click(function () {
        $("#inpSearch").val("");
        $("#jqxgrid").jqxGrid('clearfilters');
    });

    $("#jqxNotification").jqxNotification({ 
        width: "auto", 
        position: "bottom-right", 
        opacity: 0.8, 
        autoClose: true, 
        template: "error",
        theme: "office"
    });

    $("#jqxNotification50").jqxNotification({ 
        width: "auto", 
        position: "bottom-right", 
        opacity: 0.8, 
        autoClose: true, 
        template: "error",
        theme: "office"
    });

    $("#jqxNotification20").jqxNotification({ 
        width: "auto", 
        position: "bottom-right", 
        opacity: 0.8, 
        autoClose: true, 
        template: "warning",
        theme: "office"
    });
});

function manualSelect(ncList) {
    $("#jqxgrid").jqxGrid('clearselection');
    var rows = $('#jqxgrid').jqxGrid('getrows');

    var ncs = ncList.split(',');
    for ( var i=0; i<ncs.length; i++ ) {
        console.log( ncs[i] );
        for (var iCount=0; iCount < rows.length; iCount ++) {
            if ( rows[iCount].RefSeq == ncs[i] )
            $('#jqxgrid').jqxGrid('selectrow', iCount);
        }
    }
    submitForm();
}

function submitForm() {
    if ( $('#txtOutput').val().indexOf(",") == -1 ) {
        $("#jqxNotification").jqxNotification('open');
    } else {
        if ( $('#txtOutput').val().match(/,/g).length+1 > 50 ) {
            $("#jqxNotification50").jqxNotification('open'); 
            return;
        }
        $("#nameList")[0].value = $('#txtOutput').val();
        $("#form").submit();
    }
} 

function showDetail(event) {
    var checked = event.args.check;
    if (checked) {
        //$("#jqxgrid").jqxGrid( {width: 1200} );
        $("#jqxgrid").jqxGrid('showcolumn', 'SubGroup');
        $("#jqxgrid").jqxGrid('showcolumn', 'rRNA');
        $("#jqxgrid").jqxGrid('showcolumn', 'tRNA');
        $("#jqxgrid").jqxGrid('showcolumn', 'Other RNA');
        $("#jqxgrid").jqxGrid('showcolumn', 'Pseudogene');
    } else {
        //$("#jqxgrid").jqxGrid( {width: 950} );
        $("#jqxgrid").jqxGrid('hidecolumn', 'SubGroup');
        $("#jqxgrid").jqxGrid('hidecolumn', 'rRNA');
        $("#jqxgrid").jqxGrid('hidecolumn', 'tRNA');
        $("#jqxgrid").jqxGrid('hidecolumn', 'Other RNA');
        $("#jqxgrid").jqxGrid('hidecolumn', 'Pseudogene');
    }
}

function renderer(row, column, value) {
    return '<div style="text-align: center; margin-top: 5px;"><a href='+ preURL + value + ' target="_blank">' + value + '</a></div>';
}       

function applyFilter() {
    var datafield = 'Name';
    $("#jqxgrid").jqxGrid('clearfilters');
    var filtertype = 'stringfilter';
    var filtergroup = new $.jqx.filter();
            var filter_or_operator = 1;
            var filtervalue =$("#inpSearch").val();
          // alert(filtervalue);
            var filtercondition = 'contains';
            var filter = filtergroup.createfilter(filtertype, filtervalue, filtercondition);
            filtergroup.addfilter(filter_or_operator, filter);
    // add the filters.
    $("#jqxgrid").jqxGrid('addfilter', datafield, filtergroup);
    // apply the filters.
    $("#jqxgrid").jqxGrid('applyfilters');
}

function updateOutput(event) {
      //  $("#test2").text("取消选择操作第"+event.args.rowindex+"行被取消！");
        var rowindexes = $('#jqxgrid').jqxGrid('getselectedrowindexes');
        var res="";
        res+=$('#jqxgrid').jqxGrid('getcellvalue', rowindexes[0], "RefSeq");
        for(var i=1;i<rowindexes.length;i++){
            var value1 = $('#jqxgrid').jqxGrid('getcellvalue', rowindexes[i], "Name");
            var value2 = $('#jqxgrid').jqxGrid('getcellvalue', rowindexes[i], "RefSeq");

            res=res+','+value2;
        }

        //$('#txtOutput').jqxTextArea('val', res);

        $("#txtOutput").text(res);

        if ( $('#txtOutput').val().indexOf(",") != -1 ) {
            var total_nc = $('#txtOutput').val().match(/,/g).length+1;
            if ( total_nc > 20 ) {
                $("#jqxNotification20").jqxNotification('open');
            }
            if ( total_nc > 50 ) {
                $("#jqxNotification50").jqxNotification('open');
            }
        }
}