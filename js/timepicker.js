
$('#datetime').datetimepicker({ //**-< add datae timpicker by class  $('.picker') if use date by id =  $('#picker')
    timepicker: false, //time format 00.00
    datepicker: true,
    format: 'd/m/Y',
    value: Date.now(),
    weeks: true
});