<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('commercial-status.update',['id' => $type->id]) }}">
    <div class="modal-header">
        <h4 class="modal-title">Edit Commercial Status</h4>
    </div>
    <div class="modal-body">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" 
                value="{{$type->name}}">
            <em id="name-error" class="error invalid-feedback">Please enter a name categories</em>
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
        rules: {
            name: {
                required: true,
                minlength: 2,
                remote:{
                    url: '{{ route('commercial-status.index') }}/find',
                    type: "post",
                    data:{
                        _token:'{{ csrf_token() }}',
                        id: '{{$type->id}}',
                        email: function(){
                            return $('#jxForm :input[name="name"]').val();
                        }
                    }
                }
            }
        },
        messages: {
            name: {
                required: 'Please enter a name category',
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