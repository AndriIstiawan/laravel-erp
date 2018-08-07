
<script>
  $('#item_type').select2({theme:"bootstrap", placeholder:'Please select Item Type'});
  $('#item_type').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });

    $('#jxForm').validate({
      rules:{
      item_type:{required:true},
      type:{required:true},
      assign_area:{required:true},
      no:{
        required:true,
        remote:{
          url: '{{ route('warehouse-rack.index') }}/find',
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            _id:'{{ $wr->id }}',
            no: function(){
              return $('#jxForm :input[name="no"]').val();
            }
          }
        }
      }
    },
    messages:{
      no:{
        required:'Please enter a no warehouse',
        remote:'no already in use. Please use other no.'
      },
      type:{
        required:'Please enter a type'
      },
      item_type:{
        required:'Please enter a item_type'
      },
      assign_area:{
        required:'Please enter a assign_area'
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