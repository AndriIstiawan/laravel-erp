$(function(){
  $('#currency').select2({theme:"bootstrap", placeholder:'Please Select Currency'});
  $('#price').keypress(validateNumber);
  $('#price').priceFormat({
         prefix:'',
         centsSeparator:'',
         centsLimit:'',
         clearPrefix:true,
         thousandsSeparator:'.'
     });
});
