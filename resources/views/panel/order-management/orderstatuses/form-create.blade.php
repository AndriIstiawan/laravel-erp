<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('orderstatuses.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Order Statuses</h4>
  </div>
  <div class="modal-body">
      {{ csrf_field() }}
        <div class="form-group">
            <label class="col-form-label" for="name">*Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" 
              aria-describedby="name-error">
            <em id="name-error" class="error invalid-feedback">Please enter a name orderstatuses</em>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="value">*Notification</label>
                <select id="notification" name="notification" style="width: 100%;" class="form-control" aria-describedby="notification-error" required>
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disable</option>
                </select>
            <em id="notification-error" class="error invalid-feedback">Please enter a new notification</em>
        </div>
  </div>
  <div class="modal-footer">
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add New</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</form>

<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

<script>
  $('#notification').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#jxForm').validate({
    rules:{
      name:{required:true,minlength:2},
      notification:{required:true},
    },
    messages:{
      name:{
        required:'Please enter a name orderstatuses',
        minlength:'Name must consist of at least 2 characters'
      },
      notification:{
        required:'Please select a notification'
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