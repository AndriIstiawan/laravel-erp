@extends('master') @section('content')
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <p>
                    <a class="btn btn-primary" href="{{route('master-client.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Import client!</h4>
                    <p>Before import the client, make sure client is in accordance with {{env('APP_NAME','FITURE')}} terms and
                        conditions.
                    </p>
                </div>
                <form id="jxForm" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Import
                            <small>Form</small>
                        </div>
                        <div class="card-body">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-form-label" for="name">*Files
                                    <br>
                                    <small class="text-muted">Please download form file before import client data.</small>
                                </label>
                            </div>
                            <div class="form-group">
                                <input id="import" type="file" name="import" class="form-control" aria-describedby="import-error" accept=".xls, .xlsx" onchange="$(this).valid()">
                                <em id="import-error" class="error invalid-feedback"></em>
                            </div>
                            <div class="form-group progress-modal d-none">
                                <i class="fa fa-gear fa-spin"></i>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        <a class="btn btn-primary" href="{{url('/download-storage')}}/false/client-form-format.xlsx">
                            <i class="fa fa-download"></i>&nbsp; Download Form
                        </a>
                        <button type="button" class="btn btn-primary" name="signup" value="Sign up" onclick="save()">Import Data</button>
                        <a class="btn btn-secondary" href="{{route('master-client.index')}}"><i class="fa fa-remove"></i>&nbsp;Close</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
@section('myscript')
<script>
    $('#jxForm').validate({
        rules: {
            import: {
                required: true
            },
        },
        messages: {
            import: {
                required: 'Please input form',
            },
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

    function save() {
        if ($('#jxForm').valid()){
            $('.progress-modal').removeClass('d-none');
            $('.btn').addClass('disabled');
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
                url: "{{route('master-client.index')}}/import",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm')[0]),
                success: function (response) {
                    $('.btn').removeClass('disabled');
                    //toastr.success('Please check download file for detail data input', 'Import file success..');
                        act(response);
                    $('.progress-modal').addClass('d-none');
                    //window.open("{{url('/download-storage')}}/true/"+response, "_blank");
                    setTimeout(function(){
                        //window.open("{{route('master-client.index')}}", "_self");
                    }, {{env('SET_TIMEOUT', '500')}});
                },
                error: function (e) { 
                    /*$('.btn').removeClass('disabled');
                    toastr.warning('Please check download file for detail data input', 'Import file failed..');
                    $('.progress-modal').addClass('d-none');*/
                }
            });
        }
    }

    function act(response) {
        switch (response.alert) {
            case 'warning':
                toastr.warning(response.message, 'Warning');
                break;
            default:
                toastr.success(response.message,  'Success');
        }
    }
</script>
@endsection