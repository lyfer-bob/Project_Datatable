// Datatable

    $('#tbBat').DataTable({
        paging: true,
        searching: true,
        // "serverSide": true, **add test slide
        "processing": true, // add waittime processing datatable
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
            /*{ "data": "productName" }, **don't using column
            { "data": "unitPrice" },
            { "data": "qty" },
            { "data": "productGroupID" },
            { "data": "itemDetail" }*/
        ]
    });







