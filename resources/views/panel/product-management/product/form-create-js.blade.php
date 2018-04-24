<script>  
  
  $(document).ready(function() {
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
  });
      
  /*
  $('#tunggu').select2({theme:"bootstrap", placeholder:'Please select'});/*
  $('#packaging').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#check').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#produksi').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#sales').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#package').select2({theme:"bootstrap", placeholder:'Please select'}); 
  $('#packages').select2({theme:"bootstrap", placeholder:'Please select'});*/
  


  $("#jxForm1").validate({
    rules:{
      name:{required:true},
      type:{required:true},
      code:{required:true},
      stock:{required:true},
      satu:{required:true},
      dua:{required:true},
      tiga:{required:true},
      empat:{required:true},
      lima:{required:true},
      enam:{required:true},
      currency:{required:true}
    },
    messages:{
      name:{
        required:'Please enter a SO NO'
      },
      type:{
        required:'Please enter a SO NO'
      },
      code:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
      },
      name:{
        required:'Please enter a SO NO'
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
  
</script>