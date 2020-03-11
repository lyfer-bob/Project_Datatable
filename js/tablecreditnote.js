// Datatable
$(document).ready(function () {
    $('#tbBat').DataTable({

        paging: true,
        searching: true,
        // "serverSide": true, **add test slide
        "processing": true, // add waittime processing datatable
        "destroy": true,
        "retrieve": true,
        "ajax": {
            "url": "data/batch_creditnote.php",
            "dataSrc": ""
        },


        //"ajax": "data/batch_inv_rec.php",
        columns: [

            {"data": "BatchNumber"}, //add data to column
            {"data": "invoiceNumber"},
            {"data": "cnNumber", "className": "col-width-70"},
            {"data": "total"},
            {"data": "cnType"},
            {"data": "remark", "className": "dt[-head|-body]-center"},
            {"data": "customer_id", "className": "dt-body-center"},//alingh datatable = "center"
            {"data": "itemDetail"}
        ]
    });
});






