$('#sale_report').DataTable({
    "ajax": {
        "url": 'link',
        "dataSrc": ""
    },
    "ordering": false,
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

        {title: "So_code", mData: "barcode"},
        {title: "Inv_code", mData: "Productname"},
        {title: "Ship_by", mData: "ProductBrandName"},
        {title: "Pro_name", mData: "PE"},
        {title: "QTY", mData: "PM"},
    ]
});