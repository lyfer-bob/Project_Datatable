tableInit(); //call table init
$(document).ready(function () {
    $('#type_search,#date_search').change(function () {//if date and type  onchange
        tableEdit(); //call table where type or date onchange
    });
    $('#batch_search').change(function () {
        tableBatchEdit();
    });
});

function tableInit() {
    let date = $('#date_search').val();
    //draw table init
    $('#tbBat').DataTable({
        "destroy": true,
        "retrieve": true,
        "ordering": false,
        "ajax": {
            "url": 'link',
            "dataSrc": ""
        },
        columns: [

            {"data": "BatchNumber", "className": "v-align-top"}, //add data to column
            {"data": "invoiceNumber"},
            {"data": "poDate", "className": "col-width-50"},
            {"data": "payAmount", "className": "col-width-30 text-center "},
            {"data": "shippingBy","className": "col-width-50 text-center" },
            {
                "data": null, "className": "col-width-70  text-center  v-align-top",//alingh datatable = "center"
                "render": function (data, type, row) { //check data = "" -> data="0"
                    let result = "";
                    if (row.shippingPackage === "") {
                        result = "0";
                    } else {
                        result = row.shippingPackage;
                    }
                    return result;
                },
            },
            // { "data": "shippingPackage" }, ** data =! 0 when data =""
            {"data": "taxName", "className": "col-width-70"},
            {"data": "itemDetail"}
        ],
        "language": {
            "sLengthMenu": "Show :&nbsp;&nbsp;" + "_MENU_ &nbsp;Row",
        },
        "paging": true,
        "searching": true,
        "processing": true,
        "info": true
    });
}


function tableEdit() {
    let typeSearch;
    let dateSearch ;
    if (typeSearch !== 'null') { //check type not null
        getDatatable(typeSearch, dateSearch); //send para to getDatatable for DrawDatable onChange
        getBatch(typeSearch, dateSearch);   //send para to getBatch for get batch On SelectOption
    }
}
function tableBatchEdit() {
    let typeSearch;
    let dateSearch ;
    let batchSearch;
    batchChange(typeSearch, dateSearch, batchSearch); //send all para for get  DrawDatable
}

function getDatatable(type, date ) {

    let params = {
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        //if don't ise param url : 'link',;
        success: function (response) {
            SetDataTable(response, type) ////send response and type to SetDataTable (DrawTable date +  type )
        },
    };
    //check url and sent Get date to
    if (type === 'test') {
        params.url = 'link';
    } else if (type === 'test') {
        params.url = 'link'
    } else if (type === 'test') {
        params.url = 'link';
    }
    $.ajax(params);
}

function batchChange(type, date, batch) {
    let types;
    //check type
    if(type === 'test') {
        types = 'inv';
    } else  if (type === 'test') {
        types = 'test';
    } else {
        types = 'test';
    }
    $.ajax({
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: 'link',
        success: function (response) {
            SetDataTable(response, type) ////send response and type to SetDataTable (DrawTable date +  type )
        },
    });
}

function SetDataTable(data, type) {
    let columns;
    //check column draw data
    if (type === 'test') {
        columns = [
            {title: "BatchNumber", mData: "BatchNumber", "className": "v-align-top"}, // title -> ColumnTable1 , mData -> JSONdata1
            {title: "Invoice No.", mData: "invoiceNumber"},
            {title: "Credit No", mData: "cnNumber"},
            {title: "Total", mData: "total","className": "text-center"},
            {title: "CN_Type", mData: "cnType","className": "text-center"},
            {title: "remark", mData: "remark","className": "text-center"},
            {title: "Cus ID", mData: "customer_id","className": "text-center col-width-50"},
            {title: "Items", mData: "itemDetail"},
        ]
    } else {
        columns = [
            {title: "BatchNumber", mData: "BatchNumber", "className": "v-align-top"},
            {title: "Invoice No.", mData: "invoiceNumber"},
            {title: "PO Date", mData: "poDate", "className": "col-width-50"},
            {title: "Amount", mData: "payAmount", "className": "col-width-30 text-center "},
            {title: "Ship BY", mData: "shippingBy","className": "col-width-50 text-center" },
            {title: "Ship Pack", mData:null,
                "className": "col-width-70  text-center  v-align-top",
                "render": function (data, type, row) { //can use render where mData:null
                    let result;
                    if (row.shippingPackage === "") {//check data = "" -> data="0
                        result = "0";
                    } else {
                        result = row.shippingPackage;
                    }
                    return result;
                },

            },
            {title: "Cus Name", mData: "taxName", "className": "col-width-70"},
            {title: "Items", mData: "itemDetail"},
        ]
    }
    //clear data in table
    if ($.fn.DataTable.isDataTable('#tbBat',data)) {
        var tableDraw;
        tableDraw.DataTable().clear().destroy();
        tableDraw.empty();
    }
    //draw data
    tableDraw.DataTable({
        "ordering": false,
        "language": {
            "sLengthMenu": "Show :&nbsp;&nbsp;" + "_MENU_ &nbsp;Row",
        },
        columnDefs: [{
            "targets": 'no-sort',
            'orderable': false,
        },
          ],
        deferRender: true,
        data: data,
        columns: columns
    });
}

function getBatch(type,date) {
    let params = {
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        //url : 'link',;
        success: function (r) {
            let data = r;
            let seart;
            seart.html('');    //clear data on SelectOption
            seart.append('<option value="'+ 'null' + '">' + '--batch detail--' +'</option>'); //add default value
            for(let i=0; i<data.length;) { // fetch data on SelectOption
                $.each(data, function(){
                    $("#batch_search").append('<option value="'+ data[i] +'">'+ data[i] +'</option>');
                    i++; //use i++ only here!
                })
            }
        },
    };
    //send get bat to batch_number
    if (type === 'Creditnote') {
        params.url = 'link';
    } else if (type === 'Receive') {
        params.url = 'link';
    } else if (type === 'Invoice') {
        params.url = 'link';
    }
    $.ajax(params);
}

