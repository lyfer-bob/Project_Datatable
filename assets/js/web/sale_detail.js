
$('#sale_report').DataTable({
    "ajax": {
        "url": "web/data/sale_mock.php",
        "dataSrc": ""
    },
    order: [],
    // "language": {
    //     "lengthMenu": "แสดง _MENU_ รายการ",
    //     "info": "หน้าที่ _PAGE_ จาก _PAGES_ หน้า",
    // },
    columnDefs: [{
        "targets": 'no-sort',
        'orderable': false,
    }],
    deferRender: true,
    columns: [
        { title: "barcode", mData: "barcode" },
        { title: "ProName", mData: "Productname" },
        { title: "ProBrand", mData: "ProductBrandName" },
        { title: "PE", mData: "PE" },
        { title: "PM", mData: "PM" },
        { title: "GP%", mData: "GP%" },
        { title: "PPU", mData: "PricePerUnit" },
        { title: "QTY", mData: "QTY" },
        { title: "Amount", mData: "Amount" },
        { title: "Amount GP", mData: "Amount GP" },
        { title: "Inv_Date", mData: "Inv_Date" },
    ]
});



