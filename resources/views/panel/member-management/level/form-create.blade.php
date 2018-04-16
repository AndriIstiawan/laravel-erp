<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('level.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Level</h4>
  </div>
  <div class="modal-body">
      {{ csrf_field() }}
        <div class="form-group">
            <label class="col-form-label" for="name">*Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" 
              aria-describedby="name-error">
            <em id="name-error" class="error invalid-feedback">Please enter a name level</em>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="point">*Point</label>
                <input type="text" class="form-control idr-curency" id="point" name="point" placeholder="Point" 
              aria-describedby="point-error">
            <em id="point-error" class="error invalid-feedback">Please enter a point</em>
        </div>
        <!-- <div class="form-group">
            <label class="col-form-label" for="value">*Notification</label>
                <select id="notification" name="notification" style="width: 100%;" class="form-control" aria-describedby="notification-error" required>
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disable</option>
                </select>
            <em id="notification-error" class="error invalid-feedback">Please enter a new notification</em>
        </div> -->
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
      name:{required:true},
      point:{required:true},
    },
    messages:{
      name:{
        required:'Please enter a name level'
      },
      point:{
        required:'Please enter a name point'
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