<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('permission.index') }}">
	<div class="modal-header"><h4 class="modal-title">Create New Permission</h4>
	</div>
	<div class="modal-body">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-form-label" for="name">*Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error">
			<em id="name-error" class="error invalid-feedback">Please enter a name permission</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Slug</label>
			<input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error">
			<em id="slug-error" class="error invalid-feedback">Please enter a slug permission</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Type</label>
			<select id="type" class="form-control" style="width: 100% !important;" name="type" aria-describedby="type-error">
				<option value=""></option>
				<option value="access">Access</option>
				<option value="module-menu">Module Menu</option>
			</select>
			<em id="type-error" class="error invalid-feedback">Please select type permission</em>
			<div class="collapse" id="collapseE" style="margin-left:30px;">
				<div class="form-group">
					<label class="col-form-label" for="name">Icon</label>
					<input type="text" class="form-control" name="icon" placeholder="Icon">
				</div>
				<div class="form-group">
					<label class="col-form-label" for="name">Parent</label>
					<select class="form-control selectJx" style="width: 100% !important;" name="parent">
						<option value=""></option>
						@foreach ($permissions as $permission)
						<option value="{{$permission->id}}">{{$permission->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="description">*Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Description" aria-describedby="description-error">
			<em id="description-error" class="error invalid-feedback">Please enter a new description</em>
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
	$('#type').select2({theme:"bootstrap", placeholder:'Please select'});
	$('.selectJx').select2({theme:"bootstrap", placeholder:'Please select', allowClear: true});
	$('#type').on('change', function() {
		if(this.value == 'module-menu'){
			$('#collapseE').addClass('show');
		}else{
			$('#collapseE').removeClass('show');
		}
	})
  	$('#jxForm').validate({
    	rules:{
			name:{required:true,minlength:2},
			slug:{
				remote:{
					url: '{{ route('permission.index') }}/find',
					type: "post",
					data:{
						_token:'{{ csrf_token() }}',
						slug: function(){
							return $('#jxForm :input[name="slug"]').val();
						}
					}
				}
			},
			type:{required:true},
			description:{required:true,minlength:2},
		},
		messages:{
			name:{
				required:'Please enter a name permission',
				minlength:'Name must consist of at least 2 characters'
			},
			slug:{
                required:'Please enter a slug permission',
				remote:'Slug already in use. Please use other slug.'
			},
			type:{
				required:'Please select type permission'
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