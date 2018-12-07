@extends('master') @section('content')
<link href="{{ asset('fiture-style/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
			<div class="col-sm-6">
                <p>
                    <a class="btn btn-primary" href="{{route('image-upload.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
			</div>
		</div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Image <small>Upload</small>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="file-loading">
                                <label>Preview File Icon</label>
                                <input id="file-3" type="file" name="file" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer>"</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/bootstrap-fileinput/js/plugins/sortable.js') }}" type="text/javascript"></script>
<script src="{{ asset('fiture-style/bootstrap-fileinput/js/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('fiture-style/bootstrap-fileinput/themes/fa/theme.js') }}" type="text/javascript"></script>
<script>
    $("#file-3").fileinput({
        theme: 'fa',
        uploadUrl: "{{route('image-upload.index')}}",
        browseClass: "btn btn-primary",
        uploadClass: "btn btn-success",
        uploadLabel: "Upload All Files",
        removeIcon: "<i class=\"fa fa-close\"></i> ",
        removeClass: "btn btn-secondary",
        removeLabel: "Clear",
        allowedFileTypes:['image'],
        overwriteInitial: true,
        browseOnZoneClick: true,
        initialPreviewAsData: true,
        uploadExtraData: function(previewId, index) {
            return { key: index, _token: "{{ csrf_token() }}" };
        },
        deleteExtraData: function(previewId, index) {
            return { _token: "{{ csrf_token() }}", _method: 'DELETE' };
        },
    });
</script>
@endsection