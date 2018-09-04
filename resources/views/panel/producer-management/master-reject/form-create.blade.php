<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('master-reject.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Master Reject</h4>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    <div class="form-group">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name Master Reject" aria-describedby="name-error">
      <em id="name-error" class="error invalid-feedback">Please enter a name taxes</em>
    </div>
    <div class="form-group">
      <select id="type" name="type" class="form-control" aria-describedby="type-error" style="width:100%; height:50%;">
          <option value=""></option>
          <option value="qc_labeling">QC Labeling</option>
          <option value="qc_production">QC Production</option>
      </select>
      <em id="type-error" class="error invalid-feedback">Please enter a name taxes</em>
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
  $('#type').select2({
        theme: "bootstrap",
        placeholder: 'Type'
    }).change(function () {
        $(this).valid();
    });

  setTimeout(function() { $('input[name="name"]').focus() }, 500);
  $('#jxForm').validate({
    rules:{
      name:{
        required:true,
        minlength:2,
        remote:{
          url: '{{ route('master-reject.index') }}/find',
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            id: $('.id').val(),
            email: function(){
              return $('#jxForm :input[name="name"]').val();
            }
          }
        }
      },
      type:{
        required:true,
      }
    },
    messages:{
      name:{
        required:'Please enter a name master reject',
        minlength:'Name must consist of at least 2 characters',
        remote:'Name already in use. Please use other name.'
      },
      type:{
        required:'Please select a type master reject',
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