tableInit();
$(document).ready(function () {
    //init

    $('#type_search,#date_search,#batch_search').change(function () {
        tableEdit();
    });
});

function tableInit(typeSearch, dateSearch, batchSearch) {
    $('#tbBat').DataTable({
        "destroy": true,
        "retrieve": true,
        "ajax": {
            // "url": "data/batch_creditnote.php",
            "url": "data/batch_inv_rec.php",
            "dataSrc": ""

        },
        //"ajax": "data/batch_inv_rec.php",
        columns: [

            {"data": "BatchNumber"}, //add data to column
            {"data": "invoiceNumber"},
            {"data": "poDate", "className": "col-width-70"},
            {"data": "payAmount"},
            {"data": "shippingBy", "className": "dt[-head|-body]-center"},
            {
                "data": null, "className": "dt-body-center",//alingh datatable = "center"
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
            {"data": "taxName", "className": "col-width-100"},
            {"data": "itemDetail"}
        ],
        "language": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
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
    let batchSearch = $('#batch_search').val();
    if (typeSearch !== 'null') {
        GetData(typeSearch, dateSearch);
        GetBatch(typeSearch, dateSearch);
    }
    // SendDatetime(dateSearch,typeSearch);
}

// function SendDatetime(date,type) {
//
//     if (type === 'Creditnote') {
//         console.log(date);
//         $.ajax({
//             url: "data/batch_creditnote.php?value="+date,
//             type: 'get',
//             success: function (data) {
//                 // success
//             }
//
//         });
//     } else if (type === 'Receive') {
//         console.log(date);
//         $.ajax({
//             url: "data/batch_rec.php?value="+date,
//             type: 'get',
//             success: function (data) {
//                 // success
//             }
//
//         });
//     } else if (type === 'Invoice') {
//         console.log(date );
//         $.ajax({
//             url: "data/batch_inv_rec.php?value="+date,
//             type: 'get',
//             success: function (data) {
//                 // success
//             }
//
//         });
//     }
// }


function GetData(type, date) {
    let params = {
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        //url : 'link',;
        success: function (response) {
            SetDataTable(response, type)
        },
    }
    //check url
    if (type === 'Creditnote') {
        params.url = 'data/batch_creditnote.php?date=' + date;
    } else if (type === 'Receive') {
        params.url = 'data/batch_rec.php?date=' + date;
    } else if (type === 'Invoice') {
        params.url = 'data/batch_inv_rec.php?date=' + date;
    }
    $.ajax(params);

    //check batch number from


}


function SetDataTable(data, type) {
    let columns = [];
    //check column draw data
    if (type === 'Creditnote') {
        columns = [
            {title: "BatchNumber", mData: "BatchNumber"}, // title -> ColumnTable1 , mData -> JSONdata1
            {title: "Invoice No.", mData: "invoiceNumber"},
            {title: "Credit No", mData: "cnNumber"},
            {title: "Total", mData: "total"},
            {title: "CN_Type", mData: "cnType"},
            {title: "remark", mData: "remark"},
            {title: "Customer ID", mData: "customer_id"},
            {title: "Items", mData: "itemDetail"},
        ]
    } else {
        columns = [
            {title: "BatchNumber", mData: "BatchNumber"},
            {title: "Invoice No.", mData: "invoiceNumber"},
            {title: "PO Date", mData: "poDate"},
            {title: "Amount", mData: "payAmount"},
            {title: "Ship BY", mData: "shippingBy"},
            {title: "Ship Pack", mData: "shippingPackage"},
            {title: "Cus Name", mData: "taxName"},
            {title: "Items", mData: "itemDetail"},
        ]
    }
    //clear data in
    if ($.fn.DataTable.isDataTable('#tbBat')) {
        $('#tbBat').DataTable().clear().destroy();
        $('#tbBat').empty();
    }
    //draw data
    $('#tbBat').DataTable({
        order: [],
        "language": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        },
        columnDefs: [{
            "targets": 'no-sort',
            'orderable': false,
        }],
        deferRender: true,
        data: data,
        columns: columns
    });


}

function GetBatch(type,date) {
    let table = '';
    let params = {
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        //url : 'link',;
        success: function (r) {
            let data = r;
            $("#batch_search").html('');
            for(var i=0; i<data.length; i++) { // Loop through the data & construct the options
                $.each(data, function(){
                    $("#batch_search").append('<option value="'+ data[i] +'">'+ data[i] +'</option>')
                })

            }

        },
    }
    //send get bat to batch_number
    if (type === 'Creditnote') {
        params.url = 'data/batch_number.php?type=CrediteNote_detail&date=' + date;
        table = 'CrediteNote_detail';
    } else if (type === 'Receive') {
        params.url = 'data/batch_number.php?type=Receive_detail&date=' + date;
        table = 'Receive_detail';
    } else if (type === 'Invoice') {
        params.url = 'data/batch_number.php?type=TaxInvoice_detail&date=' + date;
        table = 'TaxInvoice_detail';
    }
    $.ajax(params);
}


// function SetBatchNumber(data,table) {
//
//         $.getJSON("data/batch_number.php?type="+table, function(data){
//             $("#batch_search").html('');
//             $.each(data, function(){
//                 $("#batch_search").append('<option value="'+ this.value +'">'+ this.name +'</option>')
//
//             })
//
//         })
// }

