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

        {title: "Waybill", mData: "barcode"},
        {title: "Pack_num", mData: "Productname"},
        {title: "Rec_name", mData: "ProductBrandName"},
        {title: "Rec_phone", mData: "PE"},
        {title: "Rec_code", mData: "PM"},
        {title: "Rec_add", mData: "barcode"},
        {title: "Rec_mail", mData: "Productname"},
        {title: "COD_amount", mData: "ProductBrandName"},
        {title: "Pro_name", mData: "PE"},
        {title: "Ins_amount", mData: "PM"},
        {title: "Weight", mData: "barcode"},
        {title: "Length", mData: "Productname"},
        {title: "Width", mData: "ProductBrandName"},
        {title: "Height", mData: "PE"},
        {title: "Cartoon_pri", mData: "PM"},
        {title: "Cartoon_num", mData: "barcode"},
        {title: "Packcarge", mData: "Productname"},
        {title: "Remark", mData: "ProductBrandName"},
    ]
});

