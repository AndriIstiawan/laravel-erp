<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('courier.update',['id' => $carriers->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit New</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="row">
      	<div class="col-md-12">
        	<div class="form-group">
              <label class="col-form-label" for="name">*Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$carriers['name']}}" aria-describedby="name-error">
              <em id="name-error" class="error invalid-feedback">Please enter a name courier</em>
          	</div>
          	<div class="form-group">
	            <label class="col-form-label" for="price">Prices (optional)</label>
	                <input type="text" class="form-control idr-currency" value="{{$carriers['price']}}" name="price" placeholder="0" >
	        </div>
	        <div class="form-group">
	            <label class="col-form-label" for="status">Status</label> <p>
	              	<label class="switch switch-text switch-pill switch-info">
	              	<input type="checkbox" class="switch-input" id="status" name="status" {{($carriers->status? 'checked': '')}} tabindex="-1">
	              	<span class="switch-label" data-on="On" data-off="Off"></span>
	              	<span class="switch-handle"></span>
	            </label>
	        </div>
      	</div>
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
	$('.idr-currency').on('change', function(){
    var number = $(this).val();
    number = number.replace('.',''); number = number.replace(',','.');
    if(parseFloat(number)){
        number = parseFloat(number);
    }else{
        number = parseFloat("0");
    }
    if(number == '0'){
        number = '';
    }else{
        number = number.toLocaleString('id-ID')
    }
    $(this).val(number);
    });

	$('#jxForm').validate({
		rules:{
			name:{required:true,minlength:2},
		},
		messages:{
			name:{
				required:'Please enter a name courier',
				minlength:'Name must consist of at least 2 characters'
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
