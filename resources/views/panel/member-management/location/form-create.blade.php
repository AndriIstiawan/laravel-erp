@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('location.index') }}">
                        <div class="card-header">
                            <i class="fa fa-plus"></i> Location Create
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name Location" aria-describedby="name-error" onkeyup="$('#slug').val(convertToSlug($(this).val()));$('#slug').valid();">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: Jakarta Barat"></i>
                                        </span>
                                    </div>
                                    <em id="name-error" class="error invalid-feedback">Please enter a name location</em>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Key ID Location" aria-describedby="slug-error">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="ex: jakarta-barat"></i>
                                        </span>
                                    </div>
                                </div>
                                <em id="slug-error" class="error invalid-feedback">Please enter key id</em>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="require type of location"></i>
                                        </span>
                                    </div>
                                    <select id="type" class="form-control" name="type">
                                        <option value=""></option>
                                        <option value="asd">Country</option>
                                        <option value="asd">Provice</option>
                                        <option value="asd">City / Kab Name</option>
                                    </select>
                                </div>
                                <em id="type-error" class="error invalid-feedback">Please select type of location</em>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
    $('#type').select2({
        theme: "bootstrap",
        placeholder: 'Please select type'
    });
    $('#jxForm').validate({
        rules: {
            name: {
                required: true
            },
            slug: {
                required: true
            },
        },
        messages: {
            name: {
                required: 'Please enter a name location'
            },
            slug: {
                required: 'Please enter a key id'
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
@endsection