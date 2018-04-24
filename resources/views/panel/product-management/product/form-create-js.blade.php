<script>  
  
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
        required:'Please fill this type'
      },
      code:{
        required:'Please fill this code'
      },
      stock:{
        required:'Please fill this stock'
      },
      satu:{
        required:'Please fill the blank'
      },
      dua:{
        required:'Please fill the blank'
      },
      tiga:{
        required:'Please fill the blank'
      },
      empat:{
        required:'Please fill the blank'
      },
      lima:{
        required:'Please fill the blank'
      },
      enam:{
        required:'Please fill the blank'
      },
      currency:{
        required:'Please fill the blank'
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