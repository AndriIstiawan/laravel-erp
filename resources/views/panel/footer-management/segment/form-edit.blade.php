<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('segment.update',['id' => $segment->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit New</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="row">
          	<div class="col-md-12">
              	<div class="form-group">
                	<label class="col-form-label" for="name">*Name</label>
                    	<input type="text" class="form-control" id="name" name="name" placeholder="Name" 
                  		aria-describedby="name-error" value="{{$segment['name']}}" >
                	<em id="name-error" class="error invalid-feedback">Please enter a name carriers</em>
              	</div>
              	<div class="form-group">
	                <label class="col-form-label" for="name">*Slug
	                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Slug attribute"></i>
	                </label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error" value="{{$segment['slug']}}" readonly="">
	                <em id="slug-error" class="error invalid-feedback">Please enter a slug</em>
	            </div>
              	<div class="form-group">
	            	<label class="col-form-label">*Attributes</label>
	              		<select id="attribute" class="form-control" style="width: 100% !important;" name="attribute[]"  aria-describedby="attribute-error" multiple="" selected="" required>
	                @foreach ($segment->attr as $attr)
	                  		<option value="{{$attr['_id']}}" selected>{{$attr['name']}} | {{$attr['type']}}</option>
	                @endforeach
	                @foreach ($att as $att)
                    <option value="{{ $att->id }}" > {{ $att->name }} | {{ $att->type }}</option>
                  	@endforeach
	              		</select>
		            	<small class="text-muted">
		              		You can select one or more attributes where the product will be displayed
		            	</small>
		            <em id="attribute-error" class="error invalid-feedback">Please enter a name attribute</em>
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
	$('#attribute').select2({theme:"bootstrap", placeholder:'Please select'});
  
	$('#jxForm').validate({
		rules:{
			name:{required:true,minlength:2}
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