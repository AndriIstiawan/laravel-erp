$(function(){
  $('#currency').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#price').keypress(validateNumber);
  $('#price').priceFormat({
         prefix:'',
         centsSeparator:'',
         centsLimit:'',
         clearPrefix:true,
         thousandsSeparator:'.'
     });
});
