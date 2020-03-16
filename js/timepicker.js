
$('#date_search').datetimepicker({ //**-< add datae timpicker by class  $('.picker') if use date by id =  $('#picker')
    timepicker: false, //time format 00.00
    datepicker: true,
    format: 'Y-m-d',
    value: Date.now(),
    weeks: true
});