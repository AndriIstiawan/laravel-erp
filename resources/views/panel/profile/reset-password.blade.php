<form id="jxForm" novalidate="novalidate" method="POST" action="{{ url('profile/change-password') }}">
	<div class="modal-header"><h4 class="modal-title">Reset Password</h4>
	</div>
	<div class="modal-body">
		{{ csrf_field() }}
		<div class="row">
			<div class="form-group col-md-6">
				<label class="col-form-label" for="password">*New Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-describedby="password-error">
				<em id="password-error" class="error invalid-feedback">Please provide a password</em>
			</div>
			<div class="form-group col-md-6">
				<label class="col-form-label" for="confirm_password">*Confirm password</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" aria-describedby="confirm_password-error">
				<em id="confirm_password-error" class="error invalid-feedback">Please provide a password</em>
			</div>
		</div>
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
			password:{required:true,minlength:5},
			confirm_password:{required:true,minlength:5,equalTo:'#password'}
		},
		messages:{
			password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long'
			},
			confirm_password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long',
				equalTo:'Please enter the same password'
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