<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('role.update',['id' => $role->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit New Role</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-form-label" for="name">*Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{{$role->name}}}">
			<em id="name-error" class="error invalid-feedback">Please enter a name user</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="description">*Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Description" aria-describedby="description-error" value="{{{$role->description}}}">
			<em id="description-error" class="error invalid-feedback">Please enter a new description</em>
		</div>
	</div>
	<div class="modal-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>

<script>
	$('#jxForm').validate({
		rules:{
			name:{required:true,minlength:2},
			description:{required:true,minlength:2},
		},
		messages:{
			name:{
				required:'Please enter a name user',
				minlength:'Name must consist of at least 2 characters'
			},
			description:{
				required:'Please enter a description',
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