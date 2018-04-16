<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('taxes.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Taxes</h4>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    <div class="form-group">
      <label class="col-form-label" for="name">*Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error">
      <em id="name-error" class="error invalid-feedback">Please enter a name taxes</em>
    </div>
    <div class="form-group">
      <label class="col-form-label" for="value">*Value</label>
      <input type="number" class="form-control" id="value" name="value" placeholder="Value" aria-describedby="value-error">
      <em id="value-error" class="error invalid-feedback">Please enter a new value</em>
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
      name:{required:true,minlength:2},
      value:{required:true,number:true},
    },
    messages:{
      name:{
        required:'Please enter a name taxes',
        minlength:'Name must consist of at least 2 characters'
      },
      value:{
        required:'Please enter a value',
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