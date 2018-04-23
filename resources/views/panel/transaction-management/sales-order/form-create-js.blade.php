<script>  
  
  $(document).ready(function() {
    var counter = 0;
      $("#addMe").click(function(){
          counter++;
          if (counter=='1000000') {
            $("#addMe").prop('disabled', true);
            alert('You Can Only 1000000 Click Add More');
          }else{
            $("#addMe").prop('disabled', false);
          }
      });
  });
      
  // $('#product')/*.select2({theme:"bootstrap", placeholder:'Please select'})*/
  //   .change(function(){
  //     var element= $(this).find('option:selected');
  //     $('#product-type').val(element.attr('data-type'));
  //     $('#product-code').val(element.attr('data-code'));
  //   });

  function refProductChange(){
    $('.products').change(function(){
      var element= $(this).find('option:selected');
      var productType = element.attr('data-type');
      var productCode = element.attr('data-code');
      $(this).parent().parent().find('input[name="type[]"]').val(productType);
      $(this).parent().parent().find('input[name="code[]"]').val(productCode);
    });
  }
  refProductChange();


  $('#tunggu').select2({theme:"bootstrap", placeholder:'Please select'});/*
  $('#packaging').select2({theme:"bootstrap", placeholder:'Please select'});*/
  $('#check').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#produksi').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#sales').select2({theme:"bootstrap", placeholder:'Please select'});/*
  $('#package').select2({theme:"bootstrap", placeholder:'Please select'}); 
  $('#packages').select2({theme:"bootstrap", placeholder:'Please select'});  */
  
  /*function findTotal(){
      var value = $('#packaging option:selected').attr('value');
      var tot = parseInt($('#total').val())/value;
      var total = parseInt(tot);
      $('#amount').val(total);

    }*/

  function findTotal(){
    $('.packaging').change(function(){
      var values = $(this).find('option:selected');
      var value = values.attr('value');
      var tot = parseInt($('.total').val())/value;
      var total = parseInt(tot);
      $(this).parent().parent().parent().find('input[name="amount[]"]').val(total);
        });
    }
    findTotal();

    $('#tunggu').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#packaging').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#sales').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#produksi').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#check').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#package').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    //add method validate "allRequired"
    jQuery.validator.addMethod("allRequired", function (value, elem) {
        // Use the name to get all the inputs and verify them
        var name = elem.name;
        return $('#jxForm1 input[name="' + name + '"]').map(function (i, obj) {
            return $(obj).val();
        }).get().every(function (v) {
            return v;
        });
    });

  $("#jxForm1").validate({
    rules:{
      sono:{required:true,minlength:2},
      client:{required:true,minlength:2},
      sales:{required:true},
      'product[]':{
        "allRequired": true,
        "allUnique": true
      },
      total:{required:true},
      packaging:{required:true},
      tunggu:{required:true},
      check:{required:true},
      produksi:{required:true},
      package:{required:true},
      realisasi:{required:true},
      stockk:{required:true},
      pending:{required:true},
      balance:{required:true},
      pendingpr:{required:true}
    },
    messages:{
      sono:{
        required:'Please enter a SO NO',
        minlength:'SO NO must consist of at least 2 characters'
      },
      client:{
        required:'Please enter a client',
        minlength:'name client must consist of at least 2 characters'
      },
      sales:{
        required:'Please select a sales'
      },
      'product[]]':{
        "allRequired": 'Please select a product',
      },
      total:{
        required:'Please enter a total'
      },
      packaging:{ required:'Please select a packaging' 
      },
      tunggu:{ required:'Please select a status' 
      },
      check:{ required:'Please select a checked' 
      },
      produksi:{ required:'Please select a produksi' 
      },
      package:{ required:'Please select a package' 
      },
      realisasi:{ required:'Please enter a realisasi' 
      },
      stockk:{ required:'Please enter a stock' 
      },
      pending:{ required:'Please enter a pending so' 
      },
      balance:{ required:'Please enter a balance' 
      },
      pendingpr:{ required:'Please enter a pending pr' 
      }
    },
    errorElement:'em',
    errorPlacement:function(error,element){
      error.addClass('invalid-feedback');
    },
    highlight:function(element,errorClass,validClass){
      $('#jxForm1 input[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                    'is-valid');
      $('#jxForm1 select[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                    'is-valid');
    },
    unhighlight:function(element,errorClass,validClass){
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  });
  
</script>