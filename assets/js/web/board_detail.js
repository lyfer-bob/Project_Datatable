
$('#sale_report').DataTable({
    "ajax": {
        "url": "web/data/sale_mock.php",
        "dataSrc": ""
    },
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
    columns: [
        { title: "Ways", mData: "barcode" },
        { title: "Targets", mData: "Productname" },
        { title: "Sales", mData: "ProductBrandName" },
        { title: "Pecenrate", mData: "PE" },
    ]
});


$('#sale_report1').DataTable({
    "ajax": {
        "url": "web/data/sale_mock.php",
        "dataSrc": ""
    },
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
    columns: [
        { title: "Ways", mData: "barcode" },
        { title: "Sales", mData: "ProductBrandName" },
        { title: "Pecenrate", mData: "PE" },
    ]
});





