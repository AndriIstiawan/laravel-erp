<script>  
  
  /*$(document).ready(function() {
    var counter = 0;
      $("#addMe").click(function(){
          counter++;
          if (counter=='10') {
            $("#addMe").prop('disabled', true);
            alert('You Can Only 10 Click Add More');
          }else{
            $("#addMe").prop('disabled', false);
          }
      });
      //submit button
        $(document).on('click', '#save', function(e) {
            e.preventDefault();
            if($('#jxForm1').valid()){
                swal({
                    title: "Are you sure want to submit the form?",
                    text: "Please make sure all data inputted correctly",
                    buttons: true,
                }).then((confirm) => {
                    if(confirm){ $('#jxForm1').submit(); }
                });
            }
        });
  });*/

    <?php $i=-1; ?>
    @foreach($order['products'] as $product_list)
    <?php $i++; ?>
    count = parseInt('{{$i}}');
    $('.product-order-list .check').select2({
        theme: "bootstrap",
        placeholder: 'Checker'
    }).change(function () {
            $(this).valid();
    });
    $('.product-order-list .tunggu').select2({
        theme: "bootstrap",
        placeholder: 'Status Tunggu'
    }).change(function () {
            $(this).valid();
    });
    $('.product-order-list .produksi').select2({
        theme: "bootstrap",
        placeholder: 'Produksi'
    }).change(function () {
            $(this).valid();
    });
    @endforeach
      
  $('#product')/*.select2({theme:"bootstrap", placeholder:'Please select'})*/
    .change(function(){
      var element= $(this).find('option:selected');
      $('#product-type').val(element.attr('data-type'));
      $('#product-code').val(element.attr('data-code'));
    });

  $('#products')/*.select2({theme:"bootstrap", placeholder:'Please select'})*/
    .change(function(){
      var element= $(this).find('option:selected');
      alert('adsadsdasS');
    });


  /*$('#tunggu').select2({theme:"bootstrap", placeholder:'Status Tunggu'});*//*
  $('#packaging').select2({theme:"bootstrap", placeholder:'Please select'});*/
/*  $('#check').select2({theme:"bootstrap", placeholder:'Checker'});
  $('#produksi').select2({theme:"bootstrap", placeholder:'Produser'});*/
  $('#sales').select2({theme:"bootstrap", placeholder:'Please select'});/*
  $('#package').select2({theme:"bootstrap", placeholder:'Please select'}); 
  $('#packages').select2({theme:"bootstrap", placeholder:'Please select'});  */
  
  function findTotal(){
      var value = $('#packaging option:selected').attr('value');
      var tot = parseInt($('#total').val())/value;
      var total = parseInt(tot);
      $('#amount').val(total);

    }

  function findTotals(){
      var value = $('#packagings option:selected').attr('value');
      var tot = parseInt($('#totals').val())/value;
      var total = parseInt(tot);
      $('#amounts').val(total);

    }

  $("#picture").change(function (){ readURL(this); });

    /*$('#tunggu').on('change', function(){
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
    });*/

  $("#jxForm1").validate({
    rules:{
      sono:{required:true,minlength:2},
      client:{required:true,minlength:2},
      sales:{required:true},
      product:{required:true},
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
      product:{
        required:'Please select a product'
      },
      total:{
        required:'Please enter a total'
      },
      packaging:{ required:'Please select a packaging' 
      },
      tunggu:{ required:'mohon pilih status' 
      },
      check:{ required:'mohon pilih checked' 
      },
      produksi:{ required:'mohon pilih produksi' 
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
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight:function(element,errorClass,validClass){
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  });

  function save(){
        submit = true;
        if(!$('#jxForm1').valid()){
            toastr.warning('Mohon cek kembali data inputan anda', 'Form not valid');
        }
    }
  
</script>