@extends('master') 
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/color-picker/itsjavi/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}"
    rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <p>
                    <a class="btn btn-primary" href="{{route('variant.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    <button type="button" class="btn btn-success" onclick="save('exit')">
                        &nbsp; Save all and Exit
                    </button>
                </p>

                <!--start card -->
                <div class="card">
                    <form id="jxForm" onsubmit="return false;" enctype="multipart/form-data">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> New
                            <small>Variant</small>
                        </div>
                        <div class="card-body">
                            {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="name">*Name
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Name variant"></i>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" 
                                    onkeyup="$('#slug').val(convertToSlug($(this).val()));$('#slug').valid();">
                                <em id="name-error" class="error invalid-feedback">Please enter a name</em>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="slug">*Slug
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Key slug variant"></i>
                                </label>
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error">
                                <em id="slug-error" class="error invalid-feedback">Please enter a slug</em>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-form-label" for="type">*Type
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Type variant"></i>
                                </label>
                                <select id="type" name="type" class="form-control" aria-describedby="type-error">
                                    <option value=""></option>
                                    <option value="color">Color</option>
                                    <option value="text-option">Text Option</option>
                                </select>
                                <em id="type-error" class="error invalid-feedback">Please select type variant</em>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-form-label" for="list-variant">List Variant
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Optional list variant"></i>
                                </label>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="card">
                                    <div id="opt-type" class="card-body"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <button type="button" class="btn btn-success" onclick="save('new')">Save and Add New</button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="save('exit')">Save and Exit</a>
                                </div>
                            </div>
                            <a class="btn btn-secondary" href="{{route('variant.index')}}">
                                <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                            </a>
                        </div>
                    </form>
                </div>
                <!--end card -->

            </div>
        </div>
    </div>
</div>

<div class="fade">
    <!-- Type Option -->
    <div class="type-color">
        <button type="button" class="btn btn-link" onclick="$('#opt-type .option-card').append($('.opt-color').html());copick();">
            <i class="fa fa-plus"></i>&nbsp; Add Color Option
        </button>
        <hr>
        <div class="option-card"></div>
    </div>
    <div class="type-text-option">
        <button type="button" class="btn btn-link" onclick="$('#opt-type .option-card').append($('.opt-text').html())">
            <i class="fa fa-plus"></i>&nbsp; Add Text Option
        </button>
        <hr>
        <div class="option-card"></div>
    </div>
    <!-- Option Color/Text -->
    <div class="opt-color">
        <div class="row">
            <div class="form-group col-sm-4">
                <div class="cp9 input-group colorpicker-component">
                    <input type="text" name="color[]" class="form-control" placeholder="Color"/>
                    <span class="input-group-append input-group-addon">
                        <button type="button" class="btn bg-secondary">
                            <i class="fa"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="form-group col-sm-8">
                <div class="input-group">
                    <input type="text" name="option[]" class="form-control" placeholder="Option value" aria-describedby="option[]-error">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-danger" onclick="$(this).closest('.row').remove()">
                            <i class="fa fa-close"></i>
                        </button>
                    </span>
                </div>
                <em id="option[]-error" class="error invalid-feedback">Please enter each option</em>
            </div>
        </div>
    </div>
    <div class="opt-text">
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="option[]" class="form-control" placeholder="Option value" aria-describedby="option[]-error">
                <span class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="$(this).closest('.form-group').remove()">
                        <i class="fa fa-close"></i>
                    </button>
                </span>
            </div>
            <em id="option[]-error" class="error invalid-feedback">Please enter each option</em>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script src="{{ asset('fiture-style/color-picker/itsjavi/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<script>

    $('#type').select2({
        theme: "bootstrap",
        placeholder: 'Please select'
    }).change(function(){
        $('#opt-type').html($('.type-'+$(this).val()).html());
        $('#type').valid();
    });

    //color picker function
    function copick(){
        $('.cp9').colorpicker().on('colorpickerChange', function (e) {
            // alert(e.color.toRgbString());
        });
    }

    //all required
    jQuery.validator.addMethod("allRequired", function(value, elem){
        // Use the name to get all the inputs and verify them
        var formId = '#jxForm';
        var name = elem.name;
        return  $('#jxForm input[name="'+name+'"]').map(function(i,obj){return $(obj).val();}).get().every(function(v){ return v; });
    });

    //all unique
    jQuery.validator.addMethod("allUnique", function(value, elem){
        // Use the name to get all the inputs and verify them
        var formId = '#jxForm';
        var name = elem.name;
        var status = true;
        var arrList = [];
        $('#jxForm input[name="'+name+'"]').each(function(){
            if($.inArray( $(this).val(), arrList ) != -1){
                status = false;
            }else{
                arrList.push($(this).val());
            }
            console.log(arrList);
        });
        return  status;
    });

    //Validation form
    $('#jxForm').validate({
        rules: {
            name: {
                required: true
            },
            slug: {
                required: true,
                remote: {
                    url: "{{ route('variant.index') }}/find",
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        slug: function () {
                            return $('#jxForm :input[name="slug"]').val();
                        }
                    }
                }
            },
            type: {
                required: true
            },
            "option[]": {
                "allRequired": true,
                "allUnique": true
            }
        },
        messages: {
            name: {
                required: 'Please enter a name'
            },
            slug: {
                required: 'Please enter slug',
                remote: 'Slug already in use. Please use other slug.'
            },
            type: {
                required: 'Please select type variant'
            },
            "option[]": {
                "allRequired": 'Please enter each option',
                "allUnique": 'Each option must unique'
            }
        },
        errorElement: 'em',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
        },
        highlight: function (element, errorClass, validClass) {
            $('#jxForm input[name="'+$(element).attr('name')+'"]').addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $('#jxForm input[name="'+$(element).attr('name')+'"]').addClass('is-valid').removeClass('is-invalid');
        }
    });

    //save data
    function save(action) {
        if ($('#jxForm').valid()) {
            $('.showProgress').click();
            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            console.log(percentComplete);
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                            if (percentComplete === 1) {}
                        }
                    }, false);
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            console.log(percentComplete);
                            $('.progress-bar').css({
                                width: percentComplete * 100 + '%'
                            });
                        }
                    }, false);
                    return xhr;
                },
                url: "{{ route('variant.index') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm')[0]),
                success: function (response) {
                    setTimeout(function () {
                        $('#progressModal').modal('toggle');
                        act(action);
                    }, {{env('SET_TIMEOUT', '500')}} );
                },
                error: function (e) {}
            });
        }
    }

    function act(action) {
        switch (action) {
            case 'continue':
                toastr.success('Successfully saved..', '');
                break;
            case 'new':
                window.open("{{ route('variant.create') }}/?new=variant", "_self");
                break;
            case 'exit':
                window.open("{{ route('variant.index') }}/?new=variant", "_self");
        }
    }
</script>
@endsection