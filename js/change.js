tableInit();
$(document).ready(function () {
    //init

    $('#type_search,#datetime,#tbBat').change(function () {
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
    let table = $('#tbBat').DataTable();
    let typeSearch = $('#type_search').val();
    let dateSearch = $('#datetime').val();
    let batchSearch = $('#batch_search').val();
    // sendate(dateSearch);
    if (typeSearch !== 'null') {
        GetData(typeSearch);

    }
}

function sendate(dateSearch) {
    if (typeSearch === 'Creditnote') {
        window.location.href = "data/batch_creditnote.php?date=" + dateSearch;
    } else if (typeSearch === 'Receive') {
        window.location.href = "data/batch_rec.php?date=" + dateSearch;
    } else if (typeSearch === 'Invoice') {
        window.location.href = "data/batch_inv_rec.php?date=" + dateSearch;
    }
}

function GetData(typeSearch) {
    let params = {
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: 'json',
        //url : 'link',;
        success: function (response) {
            SetDataTable("tbBat", response, typeSearch)
        },
    }
    //check url
    if (typeSearch === 'Creditnote') {
        params.url = 'data/batch_creditnote.php';
    } else if (typeSearch === 'Receive') {
        params.url = 'data/batch_rec.php';
    } else if (typeSearch === 'Invoice') {
        params.url = 'data/batch_inv_rec.php';
    }
    $.ajax(params);
}

function SetDataTable(tableName, data, typeSearch) {
    let columns = [];
    //check column draw data
    if (typeSearch === 'Creditnote') {
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



