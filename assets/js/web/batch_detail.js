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
            "url": "data/batch_inv.php?&date=" + date,
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
    let typeSearch = $('#type_search').val();
    let dateSearch = $('#date_search').val();
    if (typeSearch !== 'null') { //check type not null
        getDatatable(typeSearch, dateSearch); //send para to getDatatable for DrawDatable onChange
        getBatch(typeSearch, dateSearch);   //send para to getBatch for get batch On SelectOption
    }
}
function tableBatchEdit() {
    let typeSearch = $('#type_search').val();
    let dateSearch = $('#date_search').val();
    let batchSearch = $('#batch_search').val();
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
    if (type === 'Creditnote') {
        params.url = 'data/batch_cre.php?date=' + date;
    } else if (type === 'Receive') {
        params.url = 'data/batch_rec.php?date=' + date
    } else if (type === 'Invoice') {
        params.url = 'data/batch_inv.php?date=' + date;
    }
    $.ajax(params);
}

function batchChange(type, date, batch) {
    let types;
    //check type
    if(type === 'Invoice') {
        types = 'inv';
    } else  if (type === 'Receive') {
        types = 'rec';
    } else {
        types = 'cre';
    }
    $.ajax({
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        url: 'data/query_all.php?date=' + date + '&batch=' +  batch + '&type=' +  types, //send Get[date,batch,types] to php ,query on MySQL
        success: function (response) {
            SetDataTable(response, type) //send response and type to SetDataTable (DrawTable date +  type + batch)
        },
    });
}

function SetDataTable(data, type) {
    let columns;
    //check column draw data
    if (type === 'Creditnote') {
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
        var tableDraw = $('#tbBat');
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
            $("#batch_search").html('');    //clear data on SelectOption
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
        params.url = 'data/batch_number.php?type=cre&date=' + date;
    } else if (type === 'Receive') {
        params.url = 'data/batch_number.php?type=rec&date=' + date;
    } else if (type === 'Invoice') {
        params.url = 'data/batch_number.php?type=inv&date=' + date;
    }
    $.ajax(params);
}

