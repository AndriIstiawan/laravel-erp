$('.idr-currency').on('change', function(){
    var number = $(this).val();
    number = number.replace('.',''); number = number.replace(',','.');
    if(parseFloat(number)){
        number = parseFloat(number);
    }else{
        number = parseFloat("0");
    }
    if(number == '0'){ 
        number = ''; 
    }else{
        number = number.toLocaleString('id-ID')
    }
    $(this).val(number);
});

$('.input-number').on('change', function(){
    var number = $(this).val();
    if(parseFloat(number)){
        number = parseFloat(number);
        if(number < 0 ){ number = ''; }
    }else{
        number = '';
    }
    $(this).val(number);
});