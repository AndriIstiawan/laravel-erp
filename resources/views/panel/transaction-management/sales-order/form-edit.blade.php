@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('sales-order.update',['id' => $order['id']]) }}"
    enctype="multipart/form-data">
    {{ method_field('PUT') }} {{ csrf_field() }}
    <div class="container-fluid">
        <div class="animate fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <a class="btn btn-primary" href="{{ route('sales-order.index') }}">
                            <i class="fa fa-backward"></i>&nbsp; Back to List
                        </a>
                    </p>
                </div>
            </div>
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
                                                <option value="{{$member->id}}" {{($client['id']==$member->id?'selected':'')}}>{{$member->display_name}} - {{$member->sales[0]['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <em id="client-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                            </div>
                            <div class="row divisi-list">
                                @if(count($client['divisi']) > 0)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="#format: Divisi Name - Sales"></i>
                                                </span>
                                            </div>
                                            <select id="divisi" class="form-control" name="divisi" aria-describedby="divisi-error">
                                                <option value=""></option>
                                                <?php $i=-1; ?>
                                                @foreach($client['divisi'] as $client_divisi)
                                                <?php 
                                                    $i++;
                                                    $selected = "";
                                                    $index = (isset($order['divisi'][0]['index'])?(int)$order['divisi'][0]['index']:null);
                                                    $div_name = (isset($order['divisi'][0]['divisi_name'])?$order['divisi'][0]['divisi_name']:"");
                                                    $div_id = (isset($order['divisi'][0]['sales'][0]['detail'][0]['_id'])?$order['divisi'][0]['sales'][0]['detail'][0]['_id']:null);
                                                    if($i == $index && $client_divisi['divisi_name'] == $div_name
                                                    && $client_divisi['sales'][0]['detail'][0]['_id'] == $div_id){
                                                        $selected = "selected";
                                                    }
                                                ?>
                                                <option value="{{$i}}" {{$selected}}>{{$client_divisi['divisi_name']}} - {{$client_divisi['sales'][0]['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <em id="divisi-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                @endif
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
                                    <input id="billing" type="hidden" name="billing" class="form-control" placeholder="Billing" readonly value="{{$order['billing']}}">
                                </p>
                            </div>
                            <div class="row shipping-list">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="form-control shipping-valid" name="shipping" aria-describedby="shipping-error">
                                                <option value=""></option>
                                                <?php $i=-1; ?>
                                                @foreach($client['shipping_address'] as $shipping_list)
                                                <?php $i++; ?>
                                                <option value="{{$i}}" {{ ($order['shipping']==$shipping_list['address']?'selected':'') }}>{{$shipping_list['address']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <em id="shipping-error" class="error invalid-feedback"></em>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <div class="input-group col-md-12">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control idr-currency" id="limit" name="limit" placeholder="00" aria-describedby="limit-error"
                                                        value="{{(isset($client['limit'])?$client['limit']:'')}}" readonly="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Limit Hutang
                                                        </span>
                                                    </div>
                                                    <em id="limit-error" class="error invalid-feedback"></em>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="padding-left:30px;">
                                                <input class="form-check-input" type="checkbox" name="whiteLabel" {{($order['white_label']=='Ya'?'checked':'')}}>Label Polos
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" style="padding-left:30px;">
                                                <input class="form-check-input" type="checkbox" name="packkayu" {{($order['pack_kayu']=='Ya'?'checked':'')}}>Kemasan Kayu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-sm">TOP</span>
                                            </div>
                                            <input type="text" class="form-control input-number" name="TOP" placeholder="Hari" value="{{$order['TOP']}}" aria-describedby="TOP-error">
                                            <em id="TOP-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select id="delivery" class="form-control" name="delivery" aria-describedby="delivery-error">
                                            <option value=""></option>
                                                @foreach($carrier as $carriers)
                                                <option value="{{$carriers->_id}}" {{($delivery['id']==$carriers->id?'selected':'')}}>{{$carriers->name}}</option>
                                                @endforeach
                                        </select>
                                        <em id="delivery-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group" style="padding-left:30px;">
                                        <input class="form-check-input" type="checkbox" name="packkayu" {{($order['pack_kayu']=='Ya'?'checked':'')}}>Kemasan Kayu
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="packkayu" class="form-control" name="packkayu" aria-describedby="delivery-error">
                                            <option value=""></option>
                                                @foreach($packaging as $packagings)
                                                <option value="{{$packagings->name}}" {{($order['pack_kayu']==$packagings->name?'selected':'')}}>{{$packagings->name}}</option>
                                                @endforeach
                                        </select>
                                        <em id="delivery-error" class="error invalid-feedback"></em>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea name="notes" rows="3" class="form-control" placeholder="Catatan" style="resize: none;">{{$order['notes']}}</textarea>
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
                                    <?php $i=0; ?>
                                    @foreach($order['products'] as $product_list)
                                    <?php $i++; ?>
                                    <div class="row div-items">
                                        <input type="hidden" name="arrProduct[]" value="{{$i}}">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" data-original-title="#format: Product Name - Type"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control products" name="product{{$i}}" aria-describedby="product{{$i}}-error">
                                                        <option value=""></option>
                                                        @foreach($products as $product)
                                                        <option value="{{$product->id}}" {{ ($product_list['product_id']==$product->id?'selected':'') }}>{{$product->code}} - {{$product->name}} - {{$product->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <em id="product{{$i}}-error" class="error invalid-feedback products-em"></em>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control packages" name="package{{$i}}" aria-describedby="package{{$i}}-error">
                                                    <option value=""></option>
                                                    <option value="Plastik" {{($product_list['package']=='Plastik'?'selected':'')}}>Plastik</option>
                                                    <option value="Aluminium" {{($product_list['package']=='Aluminium'?'selected':'')}}>Aluminium</option>
                                                    <option value="Jerigen" {{($product_list['package']=='Jerigen'?'selected':'')}}>Jerigen</option>
                                                    <option value="Drum" {{($product_list['package']=='Drum'?'selected':'')}}>Drum</option>
                                                </select>
                                                <em id="package{{$i}}-error" class="error invalid-feedback packages-em"></em>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control text-center quantity" type="text" name="quantity{{$i}}" value="{{$product_list['quantity']}}" readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">X</span>
                                                    </div>
                                                    <select class="form-control weights" name="weight{{$i}}" aria-describedby="weight{{$i}}-error" onchange="countTotal($(this))">
                                                        <option value=""></option>
                                                        <?php
                                                        switch($product_list['package']){
                                                            case "Plastik":
                                                            case "Aluminium":
                                                                ?>
                                                                <option value="250" {{($product_list['weight']=='250'?'selected':'')}}>250g</option>
                                                                <option value="500" {{($product_list['weight']=='500'?'selected':'')}}>500g</option>
                                                                <option value="1000" {{($product_list['weight']=='1000'?'selected':'')}}>1kg</option>
                                                                <?php
                                                            break;
                                                            case "Jerigen":
                                                                ?>
                                                                <option value="5000" {{($product_list['weight']=='5000'?'selected':'')}}>5kg</option>
                                                                <option value="25000" {{($product_list['weight']=='25000'?'selected':'')}}>25kg</option>
                                                                <option value="30000" {{($product_list['weight']=='30000'?'selected':'')}}>30kg</option>
                                                                <?php
                                                            break;
                                                            case "Drum":
                                                                ?>
                                                                <option value="25000" {{($product_list['weight']=='25000'?'selected':'')}}>25kg</option>
                                                                <?php
                                                            break;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <em id="quantity{{$i}}-error" class="error invalid-feedback quantity-em text-left"></em>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <em id="weight{{$i}}-error" class="error invalid-feedback weights-em text-right" style="padding-right:5px;"></em>
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
                                                        <input type="text" class="form-control text-center totals input-number" name="total{{$i}}" placeholder="Total" aria-describedby="total{{$i}}-error"
                                                                onchange="countTotal($(this))" value="{{(double)$product_list['total']/1000}}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                        <span class="input-group-btn {{($i==1?'fade':'')}}">
                                                            <button type="button" class="btn btn-danger" style="margin:0 20px 0 25px; {{($i==1?'cursor: default;':'')}}" onclick="$(this).closest('.div-items'){{($i!=1?'.remove()':'')}}">
                                                                <i class="fa fa-remove"></i>
                                                            </button>
                                                        </span>
                                                        <em id="total{{$i}}-error" class="error invalid-feedback totals-em"></em>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" style="display:none;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center realisasi" name="realisasi{{$i}}" placeholder="Realisasi" aria-describedby="realisasi{{$i}}-error"
                                                    value="{{(double)$product_list['realisasi']/1000}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                    <em id="realisasi{{$i}}-error" class="error invalid-feedback realisasi-em"></em>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
@include('panel.transaction-management.sales-order.fade-form-edit') @endsection
<!-- /.container-fluid -->
@section('myscript') @include('panel.transaction-management.sales-order.form-edit-js') @endsection