<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('promo.update',['id' => $promo->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit Promo</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-form-label" for="name">*Code</label>
			<input type="text" class="form-control" id="code" name="code" placeholder="code product" aria-describedby="name-error" 
				value="{{ $promo->code }}">
			<em id="name-error" class="error invalid-feedback">Please enter a code of product</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Promo</label>
			<input type="text" class="form-control" id="promo" name="promo" placeholder="promo" aria-describedby="slug-error" 
				value="{{ $promo->promo }}">
			<em id="slug-error" class="error invalid-feedback">Please fill the blank</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Time</label>
			<input type="text" class="form-control" id="time" name="time" placeholder="" aria-describedby="slug-error" 
				value="{{ $promo->time }}">
			<em id="slug-error" class="error invalid-feedback">Please enter a time</em>
		</div>
	<div class="modal-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add New</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>
<script>
	$('#jxForm').validate({
		rules:{
			code:{required:true,minlength:1},
			discount:{required:true,minlength:1},
			time:{required:true,minlength:1},
		},
		messages:{
			code:{
				required:'Please enter a code of product',
				minlength:'fill the blank'
			},
			promo:{
				required:'Please enter a discount',
				minlength:'fill the discount'
			},
			time:{
				required:'Please enter a time',
				minlength:'fill the time'
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