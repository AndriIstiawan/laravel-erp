<script>
     $("#jxForm1").validate({
    rules:{
      name:{required:true,minlength:2}
    },
    messages:{
      name:{
        required:'Please enter a SO NO',
        minlength:'SO NO must consist of at least 2 characters'
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