@extends('master') @section('content')
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <!--start card -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Settings
                        <small>management</small>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="home" aria-selected="false">General Setting</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="web-tab" data-toggle="tab" href="#web" role="tab" aria-controls="home" aria-selected="false">Web Setting</a>
                            </li> -->
                        </ul>
                        <div class="tab-content" id="myTab1Content">
                            <!-- TAB CONTENT -->
                            <div class="tab-content">

                                <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <form id="jxForm1" onsubmit="return false;" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{ method_field('PUT') }} {{ csrf_field() }}
                                                <input type="hidden" class="id" name="id">
                                                <!-- <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img class="rounded logoPrev" src="{{ asset('img/'.$setting->logo) }}" style="width: 300px; height: 150px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-12 col-form-label" for="file-input">Logo
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="website logo, size in pixel(150x150)"></i>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input type="file" id="logo" class="imagePrev" name="logo" accept="image/jpg, image/jpeg, image/png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="text-center">
                                                                <img class="rounded faviconPrev" src="{{ asset('img/'.$setting->favicon) }}" style="width: 150px; height: 150px;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-12 col-form-label" for="file-input">Favicon
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="website favicon, size in pixel(90x90)"></i>
                                                            </label>
                                                            <div class="col-md-12">
                                                                <input type="file" id="favicon" class="imagePrev" name="favicon" accept="image/jpg, image/jpeg, image/png, image/x-icon">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- <div class="form-group">
                                                            <label class="col-form-label" for="siteTitle">*Site Title
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Declaration of title website"></i>
                                                            </label>
                                                            <input type="text" class="form-control" id="siteTitle" name="siteTitle" aria-describedby="siteTitle-error" placeholder="Fiture E-Commerce"
                                                                value="{{$setting->site_title}}">
                                                            <em id="siteTitle-error" class="error invalid-feedback">Please enter site title</em>
                                                        </div> -->
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="transPoint">*Kurs $USD
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kurs $USD"></i>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Rp. </span>
                                                                </div>
                                                                <input type="text" class="form-control idr-currency" id="kurs" name="kurs" aria-describedby="kurs-error"
                                                                    placeholder="00" value="{{$setting->kurs}}">
                                                            </div>
                                                            <em id="kurs-error" class="error invalid-feedback">Please set kurs price</em>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="transPoint">*PPN
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="PPN /Barang"></i>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Rp. </span>
                                                                </div>
                                                                <input type="text" class="form-control idr-currency" id="ppn" name="ppn" aria-describedby="ppn-error"
                                                                    placeholder="00" value="{{$setting->ppn}}">
                                                            </div>
                                                            <em id="ppn-error" class="error invalid-feedback">Please set kurs price</em>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="col-form-label" for="siteStatus">Site Status
                                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Setting status site"></i>
                                                        </label>
                                                        <div class="form-group">
                                                            <label class="switch switch-text switch-pill switch-success">
                                                                <input type="checkbox" class="switch-input" id="siteStatus" name="siteStatus" {{($setting->site_status? 'checked': '')}} tabindex="-1">
                                                                <span class="switch-label" data-on="On" data-off="Off"></span>
                                                                <span class="switch-handle"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="siteTitle">*Phone Number Header
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Phone number on top website"></i>
                                                            </label>
                                                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" aria-describedby="phoneNumber-error" placeholder="(021) 2939123"
                                                                value="{{$setting->phone_number}}">
                                                            <em id="phoneNumber-error" class="error invalid-feedback"></em>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="siteTitle">*Email Info Header
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email info on top website"></i>
                                                            </label>
                                                            <input type="text" class="form-control" id="emailInfo" name="emailInfo" aria-describedby="emailInfo-error" placeholder="info@hoky.com"
                                                                value="{{$setting->email_info}}">
                                                            <em id="emailInfo-error" class="error invalid-feedback"></em>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="odExpire">*Order Expire
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="order expire"></i>
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" id="odExpire" name="odExpire" class="form-control text-right input-number" placeholder="00" value="{{$setting->order_expire}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Hours</span>
                                                                </div>
                                                                <em id="odExpire-error" class="invalid-feedback">Please set order expire</em>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="transPoint">*Transaction Point Setting
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Transaction Point"></i>
                                                            </label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Rp. </span>
                                                                </div>
                                                                <input type="text" class="form-control idr-currency" id="transPrice" name="transPrice" aria-describedby="transPrice-error"
                                                                    placeholder="00" value="{{number_format($setting->transaction_price, 2, ',', '.')}}">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> / </span>
                                                                </div>
                                                                <input type="text" class="form-control text-right col-md-3 input-number" id="transPoint" name="transPoint" aria-describedby="transPoint-error"
                                                                    placeholder="00" value="{{$setting->transaction_point}}">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"> Point </span>
                                                                </div>
                                                            </div>
                                                            <em id="transPrice-error" class="error invalid-feedback">Please set transaction price</em>
                                                            <em id="transPoint-error" class="error invalid-feedback">Please set transaction point</em>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="odExpire">*Member Log Expire
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="member log expire"></i>
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="text" id="memberExpire" name="memberExpire" class="form-control text-right input-number" placeholder="00" value="{{$setting->member_log_expire}}">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Hours</span>
                                                                </div>
                                                                <em id="memberExpire-error" class="invalid-feedback">Please set member log expire</em>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="btn-group">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <button type="submit" class="btn btn-success" onclick="save()">Save Setting</button>
                                        </div>
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                            <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                                        </button>
                                    </form>
                                </div>
                                <!-- end tab 1 -->

                                <div class="tab-pane fade" id="web" role="tabpanel" aria-labelledby="web-tab">
                                    <form id="jxForm2" onsubmit="return false;" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{ method_field('PUT') }} {{ csrf_field() }}
                                                <input type="hidden" class="id" name="id">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="metaTitle">*meta-title
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="meta-title for SEO"></i>
                                                            </label>
                                                            <input type="text" class="form-control" id="metaTitle" name="metaTitle" aria-describedby="metaTitle-error" placeholder="Fiture E-Commerce"
                                                                value="{{$setting->meta_title}}">
                                                            <em id="metaTitle-error" class="error invalid-feedback">Please enter meta title</em>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="metaDesc">*meta-description
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="meta-description for SEO"></i>
                                                            </label>
                                                            <input type="text" class="form-control" id="metaDesc" name="metaDesc" aria-describedby="metaDesc-error" placeholder="Fiture E-Commerce B2B"
                                                                value="{{$setting->meta_description}}">
                                                            <em id="metaDesc-error" class="error invalid-feedback">Please enter meta description</em>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="odExpire">Google Analytic Script
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google tracks and reports website traffic."></i>
                                                            </label>
                                                            <textarea id="googleAnalytic" class="form-control" name="googleAnalytic" rows="5">{{ (isset($setting->google_analytic)?$setting->google_analytic:'')
                                                                }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="btn-group">
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <button type="submit" class="btn btn-success" onclick="save2()">Save Setting</button>
                                        </div>
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                            <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                                        </button>
                                    </form>
                                </div>
                                <!-- end tab 2 -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card -->
            </div>
        </div>
    </div>
</div>

<!-- attribute type -->
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script>
    function readURL(input, parent) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.' + parent + 'Prev').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".imagePrev").change(function () {
        readURL(this, $(this).attr('id'));
    });

    $("#jxForm1").validate({
        rules: {
            siteTitle: {
                required: true
            },
            kurs: {
                required: true
            },
            phoneNumber: {
                required: true
            },
            emailInfo: {
                required: true
            },
            odExpire: {
                required: true
            },
            transPrice: {
                required: true
            },
            transPoint: {
                required: true
            },
            memberExpire: {
                required: true
            }
        },
        messages: {
            siteTitle: {
                required: 'Please enter site name'
            },
            phoneNumber: {
                required: 'Please enter phone number'
            },
            emailInfo: {
                required: 'Please enter email info'
            },
            odExpire: {
                required: 'Please set order expire'
            },
            transPrice: {
                required: 'Please set transaction point price'
            },
            transPoint: {
                required: 'Please set transaction point value'
            },
            kurs: {
                required: 'Please set kurs value'
            },
            memberExpire: {
                required: 'Please set member log expire'
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

    $("#jxForm2").validate({
        rules: {
            metaTitle: {
                required: true
            },
            metaDesc: {
                required: true
            },
        },
        messages: {
            metaTitle: {
                required: 'Please enter meta title'
            },
            metaDesc: {
                required: 'Please enter meta description'
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
        if ($("#jxForm1").valid()) {
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
                url: "{{ route('master-setting.update',['id' => $setting->id]) }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm1')[0]),
                success: function (response) {
                    setTimeout(function () {
                        $('#progressModal').modal('toggle');
                        toastr.success('successfully saved..', 'Setting');
                    }, <?php echo env('SET_TIMEOUT', '500'); ?>);
                },
                error: function (e) {

                }
            });
        }
    }

    function save2() {
        if ($("#jxForm2").valid()) {
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
                url: "{{ route('master-setting.update',['id' => $setting->id]) }}",
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData($('#jxForm2')[0]),
                success: function (response) {
                    setTimeout(function () {
                        $('#progressModal').modal('toggle');
                        toastr.success('successfully saved..', 'Setting');
                    }, <?php echo env('SET_TIMEOUT', '500'); ?>);
                },
                error: function (e) {

                }
            });
        }
    }
</script>
@endsection