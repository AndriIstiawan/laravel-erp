@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('buat-so.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="targetUrl" value="/">
    <div class="container-fluid">
        <div class="animate fadeIn">
            <div class="row">
                <div class="col-md-5">
                    <!--start SO data -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> SO
                            <small>data</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="#format: Client Display Name - Sales"></i>
                                                </span>
                                            </div>
                                            <select id="client" class="form-control" name="client" aria-describedby="client-error">
                                                <option value=""></option>
                                                @foreach($members as $member)
                                                    <?php 
                                                    $sales_member = $member->sales[0]['detail'][count($member->sales[0]['detail'])-1];
                                                    $status = false;
                                                    foreach($member->divisi as $member_divisi){
                                                        if($member_divisi['sales'][0]['detail'][0]['email'] == $user['email']){
                                                            $status = true;
                                                        }
                                                    }
                                                    ?>
                                                    @if(!$user['role'] || $user['role'][0]['name'] == 'Admin' )
                                                    <option value="{{$member->id}}">{{$member->display_name}} - {{$member['sales'][0]['name']}}</option>
                                                    @else
                                                        @if($user['email'] == $sales_member['email'] || $status)
                                                        <option value="{{$member->id}}">{{$member->display_name}} - {{$member['sales'][0]['name']}}</option>
                                                        @endif
                                                    @endif
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <em id="client-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                            </div>
                            <div class="row divisi-list">
                            </div>
                        </div>
                    </div>
                    <!--end SO data -->
                </div>
                <div class="col-md-7">
                    <!--start SO information -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> SO
                            <small>Information</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="col-md-12">
                                    <input id="billing" type="hidden" name="billing" class="form-control" placeholder="Billing" readonly>
                                </p>
                            </div>
                            <div class="row shipping-list">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm">TOP</span>
                                            </div>
                                            <input type="text" class="form-control input-number" name="TOP" placeholder="Hari" aria-describedby="TOP-error">
                                            <em id="TOP-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <!-- <div class="col-md-3">
                                    <div class="form-group" style="padding-left:30px;">
                                        <input class="form-check-input" type="checkbox" name="whiteLabel">Label Polos
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select id="delivery" class="form-control" name="delivery" aria-describedby="delivery-error">
                                            <option value=""></option>
                                            @foreach($carrier as $carriers)
                                            <option value="{{$carriers->id}}">{{$carriers->name}}</option>
                                            @endforeach
                                        </select>
                                        <em id="delivery-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group" style="padding-left:30px;">
                                        <input class="form-check-input" type="checkbox" name="packkayu">Kemasan Kayu
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="packkayu" class="form-control" name="packkayu" aria-describedby="packkayu-error">
                                            <option value=""></option>
                                            @foreach($packaging as $packagings)
                                            <option value="{{$packagings->name}}">{{$packagings->name}}</option>
                                            @endforeach
                                        </select>
                                        <em id="packkayu-error" class="error invalid-feedback"></em>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea name="notes" rows="3" class="form-control" placeholder="Catatan" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end SO information -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!--start Product order-->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Products
                            <small>Order </small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 product-order-list">
                                    <div class="row div-items">
                                        <input type="hidden" name="arrProduct[]" value="1">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="#format: Product Name - Type"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control products" name="product1" aria-describedby="product1-error">
                                                        <option value=""></option>
                                                        @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->code}} - {{$product->name}} - {{$product->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <em id="product1-error" class="error invalid-feedback products-em"></em>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control packages" name="package1" aria-describedby="package1-error">
                                                    <option value=""></option>
                                                    <option value="Plastik">Plastik</option>
                                                    <option value="Aluminium">Aluminium</option>
                                                    <option value="Jerigen">Jerigen</option>
                                                    <option value="Drum">Drum</option>
                                                </select>
                                                <em id="package1-error" class="error invalid-feedback packages-em"></em>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control text-center quantity" type="text" name="quantity1" readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">X</span>
                                                    </div>
                                                    <select class="form-control weights" name="weight1" aria-describedby="weight1-error" onchange="countTotal($(this))">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <em id="quantity1-error" class="error invalid-feedback quantity-em text-left"></em>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <em id="weight1-error" class="error invalid-feedback weights-em text-right" style="padding-right:5px;"></em>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">=</span>
                                                        </div>
                                                        <input type="text" class="form-control text-center totals input-number" name="total1" placeholder="Total" aria-describedby="total1-error"
                                                                onchange="countTotal($(this))">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                        <span class="input-group-btn fade">
                                                            <button type="button" class="btn btn-danger" style="margin:0 20px 0 25px; cursor: default;">
                                                                <i class="fa fa-remove"></i>
                                                            </button>
                                                        </span>
                                                        <em id="total1-error" class="error invalid-feedback totals-em"></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="display:none;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center realisasi" name="realisasi1" placeholder="Realisasi" aria-describedby="realisasi1-error">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                    <em id="realisasi1-error" class="error invalid-feedback realisasi-em"></em>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary pull-right" onclick="addProduct()">
                                        <i class="fa fa-plus"></i>&nbsp; Add Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end Product order-->

                </div>
            </div>

            <div class="row">
                <!-- Form Button Information -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" onclick="save()">
                                <i class="fa fa-save"></i>&nbsp; Save
                            </button>
                            <a class="btn btn-secondary" href="{{route('sales-order.index')}}">
                                <i class="fa fa-remove"></i>&nbsp; Cancel
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Form Button Information -->
            </div>
        </div>
    </div>
</form>
@include('panel.transaction-management.order-create.fade-form-create') @endsection
<!-- /.container-fluid -->

@section('myscript') @include('panel.transaction-management.order-create.form-create-js') @endsection