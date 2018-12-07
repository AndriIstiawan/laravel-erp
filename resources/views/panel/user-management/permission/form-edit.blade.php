<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('permission.update',['id' => $permission->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit Permission</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-form-label" for="name">*Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{{$permission->name}}}">
			<em id="name-error" class="error invalid-feedback">Please enter a name permission</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Slug</label>
			<input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error" value="{{{$permission->slug}}}">
			<em id="slug-error" class="error invalid-feedback">Please enter a slug permission</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Type</label>
			<select id="type" class="form-control" style="width: 100% !important;" name="type" aria-describedby="type-error">
				<option value=""></option>
				<option value="access" {{($permission->type == 'access'?'selected':'')}} >Access</option>
				<option value="module-menu" {{($permission->type == 'module-menu'?'selected':'')}} >Module Menu</option>
			</select>
			<em id="type-error" class="error invalid-feedback">Please select type permission</em>
			<div class="collapse {{($permission->type == 'module-menu'?'show':'')}}" id="collapseE" style="margin-left:30px;">
				<div class="form-group">
					<label class="col-form-label" for="name">Icon</label>
					<input type="text" class="form-control" name="icon" placeholder="Icon" value="{{{$permission->icon}}}">
				</div>
				<div class="form-group">
					<label class="col-form-label" for="name">Parent</label>
					<select class="form-control selectJx" style="width: 100% !important;" name="parent">
						<option value=""></option>
						@foreach ($permissions as $prm)
						<option value="{{$prm->id}}" {{($permission->parent == $prm->id?'selected':'')}} >{{$prm->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="description">*Description</label>
			<input type="text" class="form-control" id="description" name="description" placeholder="Description" aria-describedby="description-error" value="{{{$permission->description}}}">
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
                required:true,
				remote:{
					url: '{{ route('permission.index') }}/find',
					type: "post",
					data:{
						_token:'{{ csrf_token() }}',
						id:'{{ $permission->id }}',
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