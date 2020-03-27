
$('#sale_report').DataTable({
    "ajax": {
        "url": 'link',
        "dataSrc": ""
    },
    order: [],
    "ordering": false,
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
        { title: "Date", mData: "barcode" ,'classname' : 'row-span' },
        { title: "In_talk", mData: "Productname" ,'classname' : 'row-span' },
        { title: "In_spot", mData: "ProductBrandName" ,'classname' : 'row-span' },
        { title: "Online_in and online ", mData: "PE" ,'classname' : 'row-span cos-span' },
        { title: "Online", mData: "PM" ,'classname' : 'row-span' },
        { title: "Outbound", mData: "GP%" },
        { title: "Other Chanel", mData: "PricePerUnit" ,'classname' : 'row-span' },
        { title: "Sales", mData: "QTY" ,'classname' : 'row-span' },
        { title: "Goal", mData: "Amount" ,'classname' : 'row-span' },
        { title: "Amount GP", mData: "Amount GP" ,'classname' : 'row-span' },
        { title: "Different", mData: "Inv_Date" ,'classname' : 'row-span' },
    ]
});



