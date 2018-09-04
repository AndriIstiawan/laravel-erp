@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <p>
                    <a class="btn btn-primary" href="{{route('promo.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
                <form id="jxForm" method="POST" action="{{route('promo.index')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!--start card -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Create
                            <small>Promo</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="title">*Promo Title
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Declaration of title discount"></i>
                                        </label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" aria-describedby="title-error">
                                        <em id="title-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="status">Set Status Promo
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set discount status"></i>
                                    </label>
                                    <div class="form-group">
                                        <label class="switch switch-text switch-pill switch-success">
                                            <input type="checkbox" class="switch-input" id="status" name="status" tabindex="-1">
                                            <span class="switch-label" data-on="On" data-off="Off"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="description">Description
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="description of discount"></i>
                                        </label>
                                        <textarea class="form-control" id="description" name="description" placeholder="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">*Mulai Promosi
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set start date"></i>
                                        </label>
                                        <input type="text" class="form-control" id="startDate" name="startDate" placeholder="0000-00-00 0:00:00" aria-describedby="startDate-error">
                                        <em id="startDate-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">*Akhir Promosi
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set expired date"></i>
                                        </label>
                                        <input type="text" class="form-control" id="expiredDate" name="expiredDate" placeholder="0000-00-00 0:00:00" aria-describedby="expiredDate-error">
                                        <em id="expiredDate-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Member
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Target specific member"></i>
                                        </label>
                                        <select id="member" class="form-control" name="member" aria-describedby="member-error">
                                            <option value=""></option>
                                            @foreach ($member as $member)
                                                <option value="{{$member->id}}" >{{$member->display_name}}</option>
                                            @endforeach
                                        </select>
                                        <em id="member-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-form-label" for="status">Set Currency
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set discount status"></i>
                                    </label>
                                    <div class="form-group">
                                        <select class="form-control" name="currency" id="currency" aria-describedby="currency-error" id="currency">
                                            <option value=""></option>
                                            <option value="IDR">IDR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                        <em id="currency-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card -->

                    <!--start card -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Setting
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="tipe">Tipe Promosi
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="tipe of promosi"></i>
                                        </label>
                                        <select id="tipe" class="form-control" name="tipe_promosi" aria-describedby="tipe-error">
                                            <option value=""></option>
                                            @foreach ($tipe as $tipe)
                                                <option data-tipe="{{$tipe->satuan}}" value="{{$tipe->id}}" >{{$tipe->name}}</option>
                                            @endforeach
                                        </select>
                                        <em id="tipe-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">*Value
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Set value discount"></i>
                                        </label>
                                        <div class="input-group">
                                            <input type="text" id="value" name="value" class="form-control text-right input-number" placeholder="00" aria-describedby="value-error" style="width: 60%;">
                                            <div class="input-group-append">
                                                <input type="hidden" name="type" value="price">
                                                <input type="text" name="promosi-tipe" id="promosi-tipe" readonly="" class="form-control" style="width: 100px;">
                                                <!-- <button type="button" class="btn btn-secondary dropdown-toggle type-btn" data-toggle="dropdown">.00
                                                    <span class="caret"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" onclick="changeType('price')">.00</a>
                                                    <a class="dropdown-item" onclick="changeType('percent')"> % </a>
                                                </div> -->
                                            </div>
                                            <em id="value-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card -->

                    <!--start card -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Unique
                            <small>Modifier</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Type Product
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Type of product"></i>
                                        </label>
                                        <select id="category" class="form-control" name="category[]" multiple>
                                            <option value=""></option>
                                            @foreach ($category as $category)
                                                <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="name">Name Product
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Product of member"></i>
                                        </label>
                                        <select id="product" class="form-control" name="product[]" multiple>
                                            <option value=""></option>
                                            @foreach ($product as $product)
                                                <option value="{{$product->id}}" >{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card -->

                    <!--start card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                        <i class="fa fa-times-rectangle"></i>&nbsp;Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script src="{{ asset('fiture-style/datetimepicker/build/js/moment.min.js') }}"></script>
<script src="{{ asset('fiture-style/datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    $('#currency').select2({
        theme: "bootstrap",
        placeholder: 'Please Select'
    }).change(function () {
        $(this).valid();
    });

    $('#brand').select2({
        theme: "bootstrap",
        placeholder: 'Level'
    }).change(function () {
        $(this).parent('.form-group').find('.select2-selection').css('height', '55px');
    });

    $('#category').select2({
        theme: "bootstrap",
        placeholder: 'Please Select'
    }).change(function () {
        $(this).parent('.form-group').find('.select2-selection').css('height', '55px');
    });

    $('#tipe').select2({
        theme: "bootstrap",
        placeholder: 'Please Select'
    }).change(function () {
        $(this).valid();
    });

    $(document).ready(function() {
    $('select[name="tipe_promosi"]').on('change', function() {
        var element = $(this).find('option:selected');
        var provinceID = element.attr('data-tipe');
        console.log(provinceID);
        $('#promosi-tipe').val(provinceID);
            if (provinceID == 'free-ongkir') {
                $('#value').prop("readonly", true);
                $('#value').val(0);
            }else{
                $('#value').prop("readonly", false);
                $('#value').val(null);
            }
        });
    });

    $('#product').select2({
        theme: "bootstrap",
        placeholder: 'Please Select'
    }).change(function () {
        $(this).parent('.form-group').find('.select2-selection').css('height', '55px');
    });

    $('#level').select2({
        theme: "bootstrap",
        placeholder: 'Level'
    }).change(function () {
        $(this).parent('.form-group').find('.select2-selection').css('height', '55px');
    });

    $('#member').select2({
        theme: "bootstrap",
        placeholder: 'Please Select'
    }).change(function () {
        $(this).valid();
    });

    $('#brand').change();
    $('#category').change();
    $('#product').change();
    $('#level').change();
    $('#expiredDate').datetimepicker({
        format: 'YYYY-MM-DD H:mm:ss',
    });

    $('#startDate').datetimepicker({
        format: 'YYYY-MM-DD H:mm:ss',
    });

    function changeType(typeValue){
        $("input[name='type']").val(typeValue);
        if(typeValue == 'price'){
            $(".type-btn").html('.00');
        }else{
            $(".type-btn").html('&nbsp;%&nbsp;');
        }
    }

    $("#jxForm").validate({
        rules: {
            title: {
                required: true,
            },
            currency: {
                required: true,
            },
            member: {
                required: true,
            },
            tipe_promosi: {
                required: true,
            },
            value: {
                required: true,
            },
            expiredDate: {
                required: true,
            },
            startDate: {
                required: true,
            }
        },
        messages: {
            title: {
                required: 'Please enter title',
            },
            member: {
                required: 'Please select member',
            },
            tipe_promosi: {
                required: 'Please select tipe promosi',
            },
            currency: {
                required: 'Please select currency',
            },
            value: {
                required: 'Please set value',
            },
            expiredDate: {
                required: 'Please set expired date',
            },
            startDate: {
                required: 'Please set start date',
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
        },
        ignore: "#editor *"
    });
</script>
@endsection