$(document).ready(function () {
    //init
    tableInvoiceDraw();
    //     tableCreditNoteDraw();
     // tableDraw();
    $('#type_search,#datetime,#tbBat').change(function () {
        tableDraw();
    });
});


function tableDraw() {
    let table = $('#tbBat').DataTable();
    let typeSearch = $('#type_search').val();
    let dateSearch = $('#datetime').val();
    let batchSearch = $('#batch_search').val();
    if (typeSearch === "Creditnote") {
        $(table.column(2).header()).text('Credit No.'); //change  header columns
        $(table.column(3).header()).text('Total');
        $(table.column(4).header()).text('CN_Type');
        $(table.column(5).header()).text('remark');
        $(table.column(6).header()).text('Customer ID');
        tableCreditNoteDraw();

    } else {
        $(table.column(2).header()).text('PO Date'); //change  header columns
        $(table.column(3).header()).text('Amount');
        $(table.column(4).header()).text('Shipping BY');
        $(table.column(5).header()).text('Shipping Package');
        $(table.column(6).header()).text('Customer Name');
    }
    if (typeSearch == "Receive" || typeSearch == "Invoice" ) {
        if (typeSearch === "Receive") {
            tableReciveDraw();
            // tableReciveDraw(typeSearch, dateSearch, batchSearch);
        } else {
            tableInvoiceDraw();
            // tableInvoiceDraw(typeSearch, dateSearch, batchSearch);
        }
    }

}

function tableInvoiceDraw(typeSearch, dateSearch, batchSearch) {
    // Datatable

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
        "paging": true,
        "searching": true,
        "processing": true,
        "info": true
    });
}

function tableReciveDraw(typeSearch, dateSearch, batchSearch) {
    console.log('recive');
}

function tableCreditNoteDraw() {
    GetData();
    function GetData() {
        console.log("maggg");
        $.ajax({
            type: 'GET',
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            url: "data/batch_creditnote.php",
            success: function (response) {
                console.log("SetDataTable");
                SetDataTable("tbBat", response)
            },
        })
    }

    function SetDataTable(tableName, data) {
        if ($.fn.DataTable.isDataTable('#tbBat')) {
            $('#tbBat').DataTable().clear().destroy();
            $('#tbBat').empty();
        }

        $('#tbBat').DataTable({
            order: [],
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการ",
                "info": "หน้าที่ _PAGE_ จาก _PAGES_ หน้า",
            },
            columnDefs: [{
                "targets": 'no-sort',
                'orderable': false,
            }],
            deferRender: true,
            data: data,
            columns: [
                { title: "BatchNumber", mData: "BatchNumber" },
                { title: "Invoice No.", mData: "invoiceNumber" },
                { title: "Credit No", mData: "cnNumber" },
                { title: "Total", mData: "total" },
                { title: "CN_Type", mData: "cnType" },
                { title: "remark", mData: "remark" },
                { title: "Customer ID", mData: "customer_id" },
                { title: "Items", mData: "itemDetail" },
            ]
        });

    }



}
    // console.log('tableCreditNoteDraw');
    // let table = $('#tbBat').DataTable;

    // $.ajax({
    //     url : "data/batch_creditnote.php",
    //     type: 'GET',
    //     contentType: "application/json",
    //     success: function(data) {
    //         // var table = $('#tbBat').DataTable();
    //         // table.clear();
    //         // table.rows.add(data.data);
    //         // table.draw();
    //
    //     },
    //     columns: [
    //
    //         {"data": "BatchNumber"}, //add data to column
    //         {"data": "invoiceNumber"},
    //         {"data": "cnNumber", "className": "col-width-70"},
    //         {"data": "total"},
    //         {"data": "cnType"},
    //         {"data": "remark", "className": "dt[-head|-body]-center"},
    //         {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
    //         {"data": "itemDetail"}
    //     ]
    //
    // });
    // console.log($ajax);
    // table.clear().draw();
    // table.rows.add($.ajax).draw();


    // table({
    //     destroy: true,
    //     retrieve: true,
    //         "ajax": { "dataSrc": "jsonload",
    //         },
    //         //"ajax": "data/batch_inv_rec.php",
    //         columns: [
    //
    //             {"data": "BatchNumber"}, //add data to column
    //             {"data": "invoiceNumber"},
    //             {"data": "cnNumber", "className": "col-width-70"},
    //             {"data": "total"},
    //             {"data": "cnType"},
    //             {"data": "remark", "className": "dt[-head|-body]-center"},
    //             {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
    //             {"data": "itemDetail"}
    //         ],
    //         "paging": true,
    //         "searching": true,
    //         "processing": true,
    //         "info": true
    // });


    // Datatable
    // console.log('CreditNote');
// }
//     $('#tbBat').DataTable({
//         "destroy": true,
//         "retrieve": true,
//         "ajax": {
//             "url": "data/batch_creditnote.php",
//             "dataSrc": "",
//         },
//         //"ajax": "data/batch_inv_rec.php",
//         columns: [
//
//             {"data": "BatchNumber"}, //add data to column
//             {"data": "invoiceNumber"},
//             {"data": "cnNumber", "className": "col-width-70"},
//             {"data": "total"},
//             {"data": "cnType"},
//             {"data": "remark", "className": "dt[-head|-body]-center"},
//             {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
//             {"data": "itemDetail"}
//         ],
//         "paging": true,
//         "searching": true,
//
//         "processing": true,
//         "info": true
//
//     });


    // var viewdatatab  =  $('#tbBat').dataTable({
    //     columns: [
    //
    //         {"data": "BatchNumber"}, //add data to column
    //         {"data": "invoiceNumber"},
    //         {"data": "cnNumber", "className": "col-width-70"},
    //         {"data": "total"},
    //         {"data": "cnType"},
    //         {"data": "remark", "className": "dt[-head|-body]-center"},
    //         {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
    //         {"data": "itemDetail"}
    //     ]
    //
    // });

    // var table = $('#tbBat').DataTable();
    // table.clear();
    // table.rows.add( [ {
    //     "ajax": {
    //         "type": 'GET',
    //         // "url": "data/batch_creditnote.php",
    //         "url": "data/batch_inv_rec.php",
    //         "dataSrc": "",
    //         "contentType": "application/json",
    //     },
    //     columns: [
    //
    //                 {"data": "BatchNumber"}, //add data to column
    //                 {"data": "invoiceNumber"},
    //                 {"data": "cnNumber", "className": "col-width-70"},
    //                 {"data": "total"},
    //                 {"data": "cnType"},
    //                 {"data": "remark", "className": "dt[-head|-body]-center"},
    //                 {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
    //                 {"data": "itemDetail"}
    //             ]
    // }]);
    // table.draw();





