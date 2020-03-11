// $("#type_search").change(function () {
//     let table = $('#tbBat').DataTable();
//     let val = $("#type_search").val();
//
//     if(val == 'Creditnote'){
//
//         $(table.column(2).header()).text('Credit No.'); //change  header columns
//         $(table.column(3).header()).text('Total');
//         $(table.column(4).header()).text('CN_Type');
//         $(table.column(5).header()).text('remark');
//         $(table.column(6).header()).text('Customer ID');
//        // table.destroy("js/tablecreditnote.js");
//         $.getScript("", function() { // call table
//         });
//
//     }
//     else{
//         $(table.column(2).header()).text('PO Date'); //change  header columns
//         $(table.column(3).header()).text('Amount');
//         $(table.column(4).header()).text('Shipping BY');
//         $(table.column(5).header()).text('Shipping Package');
//         $(table.column(6).header()).text('Customer Name');
//       //  table.destroy();
//         $.getScript("js/tables.js", function() { // call table
//         });
//
//     }



    // comment

        //----- init
        //------ Event
        $('#type_search,#datetime,#tbBat').change(function () {
            tableDraw();
        });

      function tableDraw() {
          let table = $('#tbBat').DataTable();
          let typeSearch = $('#type_search').val();
          // let dateSearch = $('#datetime').val();
          // let batchSearch = $('#batch_search').val();
          // console.log('tableDraw')
          console.log('type_search: ', typeSearch)
          // console.log('datetime: ', dateSearch)
          // console.log('batch_search: ', batchSearch)
          if (typeSearch == 'Creditnote') {
              Console.log("testing");
              // tableCreditNoteDraw(typeSearch, dateSearch, batchSearch);
              $(table.column(2).header()).text('Credit No.'); //change  header columns
              $(table.column(3).header()).text('Total');
              $(table.column(4).header()).text('CN_Type');
              $(table.column(5).header()).text('remark');
              $(table.column(6).header()).text('Customer ID');

          } else {
              $(table.column(2).header()).text('PO Date'); //change  header columns
              $(table.column(3).header()).text('Amount');
              $(table.column(4).header()).text('Shipping BY');
              $(table.column(5).header()).text('Shipping Package');
              $(table.column(6).header()).text('Customer Name');
          }
    //       if (typeSearch != 'Creditnote') {
    //           if (typeSearch == 'Receive') {
    //               tableReciveDraw(typeSearch, dateSearch, batchSearch);
    //           }
    //       else {
    //           tableInvoiceDraw(typeSearch, dateSearch, batchSearch);
    //       }
    //   }
    //
    //     // console.log('tableDraw')
    //     // console.log('type_search: ', typeSearch)
    //     // console.log('datetime: ', dateSearch)
    //     // console.log('batch_search: ', batchSearch)
    //
    // }
    //
    //
    // function tableInvoiceDraw(typeSearch, dateSearch, batchSearch) {
    //     // Datatable
    //         $('#tbBat').DataTable({
    //             paging: true,
    //             searching: true,
    //             // "serverSide": true, **add test slide
    //             "processing": true, // add waittime processing datatable
    //             "destroy": true,
    //             "retrieve": true,
    //             "ajax": {
    //                 // "url": "data/batch_creditnote.php",
    //                 "url": "data/batch_inv_rec.php",
    //                 "dataSrc": ""
    //             },
    //             "scrollX": true,
    //             "info": true,
    //             //"ajax": "data/batch_inv_rec.php",
    //             columns: [
    //
    //                 {"data": "BatchNumber"}, //add data to column
    //                 {"data": "invoiceNumber"},
    //                 {"data": "poDate", "className": "col-width-70"},
    //                 {"data": "payAmount"},
    //                 {"data": "shippingBy", "className": "dt[-head|-body]-center"},
    //                 {
    //                     "data": null, "className": "dt-body-center",//alingh datatable = "center"
    //                     "render": function (data, type, row) { //check data = "" -> data="0"
    //                         let result = "";
    //                         if (row.shippingPackage === "") {
    //                             result = "0";
    //                         } else {
    //                             result = row.shippingPackage;
    //                         }
    //                         return result;
    //                     },
    //
    //                 },
    //                 // { "data": "shippingPackage" }, ** data =! 0 when data =""
    //                 {"data": "taxName", "className": "col-width-100"},
    //                 {"data": "itemDetail"}
    //                 /*{ "data": "productName" }, **don't using column
    //                 { "data": "unitPrice" },
    //                 { "data": "qty" },
    //                 { "data": "productGroupID" },
    //                 { "data": "itemDetail" }*/
    //             ]
    //         });
    //
    // }
    //
    // function tableReciveDraw(typeSearch, dateSearch, batchSearch) {
    //
    // }
    //
    // function tableCreditNoteDraw(typeSearch, dateSearch, batchSearch) {
    //     // Datatable
    //     Console.log("testeie");
    //
    //         $('#tbBat').DataTable({
    //             paging: true,
    //             searching: true,
    //             // "serverSide": true, **add test slide
    //
    //             "destroy": true,
    //             "retrieve": true,
    //             "ajax": {
    //                 "url": "data/batch_creditnote.php",
    //                 "dataSrc": ""
    //             },
    //             "processing": true, // add waittime processing datatable
    //             "scrollX": true,
    //             "info": true,
    //             //"ajax": "data/batch_inv_rec.php",
    //             columns: [
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
    //         });

    }

