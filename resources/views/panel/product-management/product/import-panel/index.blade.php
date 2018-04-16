@extends('master')
@section('content')
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Import product!</h4>
                    <p>Before import the product, make sure the product is in accordance with {{env('APP_NAME','FITURE')}} terms
                        and conditions.</p>
                </div>
                <p>
                    <a class="btn btn-primary" href="{{route('product.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    <a class="btn btn-primary" href="{{route('product.index')}}/download-import-form">
                        <i class="fa fa-download"></i>&nbsp; Download Form
                    </a>
                </p>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Import
                        <small>Form </small>
                    </div>
                    <div class="card-body">
                        <form id="jxForm" onsubmit="return false;" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">*Files
                                    <br>
                                    <small class="text-muted">Please download form file before import product data.</small>
                                </label>
                                <div class="col-md-9">
                                    <input type="file" name="import" class="form-control" aria-describedby="import-error" accept=".xls, .xlsx">
                                    <em id="import-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-success pull-right" onclick="save('continue')">Proccess Import Data</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->
@section('myscript')
<script>
    $('#jxForm').validate({
        rules: {
            import: {
                required: true
            }
        },
        messages: {
            import: {
                required: 'Please select file'
            }
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $('#jxForm input[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
            $('#jxForm select[name="' + $(element).attr('name') + '"]').addClass('is-invalid').removeClass(
                'is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $('#jxForm input[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
            $('#jxForm select[name="' + $(element).attr('name') + '"]').addClass('is-valid').removeClass(
                'is-invalid');
        }
    });
    function save(action) {
        if ($('#jxForm').valid()){
            $('.showProgress').click();
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                            if (percentComplete === 1) {}
                        }
                    }, false);
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                        }
                    }, false);
                    return xhr;
                },
                url: "{{ route('product.index') }}/import",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm')[0]),
                success: function (response) {
                    setTimeout(function () {
                        $('#progressModal').modal('toggle');
                        //act(action);
                    }, {{env('SET_TIMEOUT', '500')}});
                },
                error: function (e) {}
            });
        }else{}
    }
</script>
@endsection