
$( document ).ready(function() {
    $("#type_search").change(function () {
        let table = $('#tbBat').DataTable();
        let typeSearch = $('#type_search').val();
        let dateSearch = $('#datetime').val();
        let batchSearch = $('#batch_search').val();

    if (typeSearch == 'Creditnote') {

        $(table.column(2).header()).text('Credit No.'); //change  header columns
        $(table.column(3).header()).text('Total');
        $(table.column(4).header()).text('CN_Type');
        $(table.column(5).header()).text('remark');
        $(table.column(6).header()).text('Customer ID');
        tableCreditNoteDraw(typeSearch, dateSearch, batchSearch);
    } else {
        $(table.column(2).header()).text('PO Date'); //change  header columns
        $(table.column(3).header()).text('Amount');
        $(table.column(4).header()).text('Shipping BY');
        $(table.column(5).header()).text('Shipping Package');
        $(table.column(6).header()).text('Customer Name');

    }
});
});