<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('archievement.update',['id' => $archievement->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit Level</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-form-label" for="name">*Name</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{$archievement->name}}">
			<em id="name-error" class="error invalid-feedback">Please enter a name Level</em>
		</div>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
      	{{ csrf_field() }}
        <div class="form-group">
            <label class="col-form-label" for="name">*Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{$archievement->name}}">
            <em id="name-error" class="error invalid-feedback">Please enter a name level</em>
        </div>
        <label class="col-form-label" for="range">*Order/pcs</label>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <input type="number" class="form-control" id="start" name="start" placeholder="Start" aria-describedby="start-error">
                <em id="start-error" class="error invalid-feedback">Please enter a start</em>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <input type="number" class="form-control" id="to" name="to" placeholder="To" aria-describedby="to-error">
                <em id="to-error" class="error invalid-feedback">Please enter a to</em>
            </div>
          </div>
        </div>
        <div class="form-group">
          	<label class="col-form-label" for="level">*Level</label>
          	<select id="level" class="form-control" style="width: 100% !important;" name="level[]" aria-describedby="level-error" required>
            	<option value=""></option>
            @foreach ($level as $level)
            	<option value="{{$level->_id}}">{{$level->name}}</option>
            	<option value=></option>
            @endforeach
          	</select>
          	<em id="level-error" class="error invalid-feedback">Please select level</em>
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
	$('#notification').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#jxForm').validate({
		rules:{
			name:{required:true},
		},
		messages:{
			name:{
				required:'Please enter a name level'
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