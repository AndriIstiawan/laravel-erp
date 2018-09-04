<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('tipe-promosi.update',['id' => $type->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit New Tipe Promo</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<input type="hidden" class="id" name="id" value="{{$type->id}}">
		<div class="form-group">
			<input type="text" class="form-control" id="name" name="name" placeholder="Name Type" aria-describedby="name-error" value="{{{$type->name}}}">
			<em id="name-error" class="error invalid-feedback">Please enter a name Taxes</em>
		</div>
		<div class="form-group">
	      	<select class="form-control" name="satuan" aria-describedby="satuan-error" id="satuan" style="width: 100%;">
	        	<option value=""></option>
	        	<option value="%" {{($type->satuan == '%'?'selected':'')}}>Percent</option>
	        	<option value=".00" {{($type->satuan == '.00'?'selected':'')}}>Currency</option>
	        	<option value="hari" {{($type->satuan == 'hari'?'selected':'')}}>Day</option>
            <option value="kg" {{($type->satuan == 'kg'?'selected':'')}}>Weight</option>
	        	<option value="free-ongkir" {{($type->satuan == 'free-ongkir'?'selected':'')}}>Free ongkir</option>
	      	</select>
	      	<em id="satuan-error" class="error invalid-feedback">Please pilih satuan</em>
	    </div>
	</div>
	<div class="modal-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>

<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
  $('#satuan').select2({
        theme: "bootstrap",
        placeholder: 'Satuan'
    }).change(function () {
        $(this).parent('.form-group').find('.select2-selection');
    });
    setTimeout(function() { $('input[name="name"]').focus() }, 500);
	$('#jxForm').validate({
    rules:{
      name:{
        required:true,
        minlength:2,
        remote:{
          url: '{{ route('tipe-promosi.index') }}/find',
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            id: $('.id').val(),
            email: function(){
              return $('#jxForm :input[name="name"]').val();
            }
          }
        }
      },
      satuan:{
        required:true
      }
    },
    messages:{
      name:{
        required:'Please enter a name tipe promosi',
        minlength:'Name must consist of at least 2 characters',
        remote:'Name already in use. Please use other name.'
      },
      satuan:{
        required:'Please select a satuan tipe'
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