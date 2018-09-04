<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('commercial-status.index') }}">
    <div class="modal-header">
        <h4 class="modal-title">Create New Commercial Status</h4>
    </div>
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name Commercial Status" aria-describedby="name-error">
            <em id="name-error" class="error invalid-feedback">Please enter a name taxes</em>
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
  setTimeout(function() { $('input[name="name"]').focus() }, 500);
    $('#jxForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                remote:{
                  url: '{{ route('commercial-status.index') }}/find',
                  type: "post",
                  data:{
                    _token:'{{ csrf_token() }}',
                    id: $('.id').val(),
                    email: function(){
                      return $('#jxForm :input[name="name"]').val();
                    }
                  }
                }
            }
        },
        messages: {
            name: {
                required: 'Please enter a name commercial-status',
                minlength: 'Name must consist of at least 2 characters',
                remote:'Name already in use. Please use other name.'
            }
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
</script>