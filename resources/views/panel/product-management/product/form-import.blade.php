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
                <div id="response" class="alert alert-warning" role="alert" style="display: none">
                    <h4 class="alert-heading"></h4>
                    <p></p>
                </div>
                <p>
                    <a class="btn btn-primary" href="{{route('product.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    <a class="btn btn-primary" href="{{url('/download-storage')}}/false/product-form-format.xlsx">
                        <i class="fa fa-download"></i>&nbsp; Download Form
                    </a>
                </p>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Import
                        <small>Form</small>
                    </div>
                    <div class="card-body">
                        <form id="jxForm" method="POST" enctype="multipart/form-data" action="{{ route('product.index') }}/import">
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
                            <!-- <div class="form-group progress-modal d-none">
                                <i class="fa fa-gear fa-spin"></i>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:0%"></div>
                                </div>
                            </div> -->
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
                required: 'Please select file',
            },
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
                        $('.showProgress').click();
                        toastr.success('Please check download file for detail data input', 'Import file success..');
                        // window.location.href = '{{ route("product.index") }}';
                        window.open("{{url('/download-storage')}}/"+response, "_self");
                        setTimeout(function () {
                            window.location.href = '{{ route("product.index") }}';
                        }, 10000);
                    }, {{env('SET_TIMEOUT', '500')}});
                },
                error: function (e) {
                    setTimeout(function () {
                        $('.showProgress').click();
                        $('#response').css('display', 'block');
                        $('#response h4').text('Import Product failed!');
                        $('#response p').text('Please contact technical for more information.');
                    }, {{env('SET_TIMEOUT', '500')}});
                }
            });
        }
    }
</script>
@endsection