
<script>
  $('#fromdays').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#fromdays').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  $('#todays').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#todays').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  //Read Picture function
    function readURL(input, prodImage) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (prodImage) {
                    $('.fade .opt .mediaPrev').attr('src', e.target.result);
                    $('.image-add').before($('.fade .opt').html());
                    $('.image-add').prev('.pull-left').find('.fade').remove();
                    $clone = $(input).clone();
                    $('.image-add').prev('.pull-left').append($clone);
                }else{
                    $(input).siblings('.vars-btn').find('.mediaPrev').attr('src', e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#jxForm').validate({
      rules:{
      name:{required:true,minlength:2},
      segment:{required:true},
      slug:{required:true,
        remote:{
          url: '{{ route('footer.index') }}/find',
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            slug: function(){
              return $('#jxForm :input[name="slug"]').val();
            }
          }
        }
      },
    },
    messages:{
      name:{
        required:'Please enter a name category',
        minlength:'Name must consist of at least 2 characters'
      },
      segment:{
        required:'Please select segment'
      },
      slug:{
        required:'Please enter a slug category',
        remote:'Slug already in use. Please use other slug.'
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

  $(document).ready(function() {
    var max_fields      = 10000; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_btn-primary"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="option-card"><div class="row"><div class="form-group col-md-4"><label class="col-form-label" for="name">*Name</label><div id="name" class="control-group input-group" style="margin-top:10px"><input type="text" name="name[]" class="form-control" placeholder="Ex About Us" aria-describedby="name-error" required><em id="name-error" class="error invalid-feedback">Please enter a name</em></div></div><div class="form-group col-md-8"><label class="col-form-label" for="link">*Link</label><div id="link" class="control-group input-group" style="margin-top:10px"><input type="text" name="link[]" class="form-control" placeholder="Ex Https://hoky/aboutus" aria-describedby="link-error" required><div class="input-group-btn"><button class="btn btn-danger remove" type="button"><i class="fa fa-close"></i></button></div><em id="link-error" class="error invalid-feedback">Please enter a link</em></div></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });
	$(document).ready(function() {
  //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).closest('.option-card').remove();
          });
  });
</script>