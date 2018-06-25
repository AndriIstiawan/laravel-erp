@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('production.update',['id' => $order->id]) }}" enctype="multipart/form-data">
		{{ method_field('PUT') }}
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
            <div class="col-md-12">
                <p>
                    <a class="btn btn-primary" href="{{ route('production.index') }}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> SO
						<small>data </small>
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
                                            <input class="form-control" placeholder=" {{$member->display_name}} - {{$member->sales[0]['detail'][count($member->sales[0]['detail'])-1]['name']}}" readonly>
                                            <input type="hidden" class="form-control" name="client" value="{{$member->id}}">
                                        </div>
                                        <em id="client-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                            </div>
                        </div>
				</div>
				<!--end card -->
			</div>
			<div class="col-md-7">
                <!--start SO information -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> SO
                        <small>Information</small>
                    </div>
                    <div class="card-body">
                        <div class="row shipping-list">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group"><!--
                                        <select class="form-control shipping-valid" name="shipping" aria-describedby="shipping-error">
                                            <option value=""></option>
                                            <?php $i=-1; ?>
                                            @foreach($client['shipping_address'] as $shipping_list)
                                            <?php $i++; ?>
                                            <option value="{{$i}}" {{ ($order['shipping']==$shipping_list['address']?'selected':'') }}>{{$shipping_list['address']}}</option>
                                            @endforeach
                                        </select> -->
                                        <textarea id="billing" type="text" name="shipping" class="form-control" placeholder="Shipping" readonly value="{{$order['shipping']}}">Shipping ( {{$order['shipping']}} )</textarea>
                                    </div>
                                    <em id="shipping-error" class="error invalid-feedback"></em>
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
                                        <input type="text" class="form-control input-number" name="TOP" placeholder="Day" value="{{$order['TOP']}}" aria-describedby="TOP-error" readonly="">
                                        <em id="TOP-error" class="error invalid-feedback"></em>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <!-- <button type="button" class="btn btn-dark" style="padding-left:30px;" aria-pressed="true" disabled>
                                    <input class="form-check-input" type="checkbox" name="whiteLabel" {{($order['white_label']!=null?'checked':'')}} readonly>White Label
                                </button> -->
                                @if($order['white_label'] == 'Ya')
                                <input type="text" value="Label Polos Iya" class="form-control" readonly="">
                                @else
                                <input type="text" value="Label Polos Tidak" class="form-control" readonly="">
                                @endif
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="notes" rows="3" class="form-control" placeholder="Notes" style="resize: none;" readonly="">{{$order['notes']}}</textarea>
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
                                                <input type="text" class="form-control" placeholder="{{$product_list['name']}}" readonly>
                                                <input type="hidden" value="{{$product_list['product_id']}}" name="product{{$i}}">
                                            </div>
                                            <em id="product{{$i}}-error" class="error invalid-feedback products-em"></em>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="{{$product_list['package']}}" readonly>
                                            <input type="hidden" class="form-control" name="package{{$i}}" value="{{$product_list['package']}}" readonly>
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
                                                <input type="text" class="form-control" value="{{$product_list['weight']/1000}}kg" readonly>
                                            	<input type="hidden" class="form-control" name="weight{{$i}}" value="{{$product_list['weight']}}" readonly>
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
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">=</span>
                                                </div>
                                                <input type="text" class="form-control text-center totals input-number" name="total{{$i}}" placeholder="Total" aria-describedby="total{{$i}}-error"
                                                    onchange="countTotal($(this))" value="{{(double)$product_list['total']/1000}}" readonly="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                                <em id="total{{$i}}-error" class="error invalid-feedback totals-em"></em>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control text-center realisasi" name="realisasi{{$i}}" placeholder="Realisasi" aria-describedby="realisasi1{{$i}}-error"
                                                        required="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                    <em id="realisasi{{$i}}-error" class="invalid-feedback realisasi-em">Mohon input realisasi</em>
                                                </div><!--
                                            <div class="col-md-12">
                                                <div class="form-group" style="padding-left:10px;">
                                                     <button type="button" class="btn btn-danger pull-right" style="cursor:default;">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <select class="form-control tunggu" name="tunggu{{$i}}" aria-describedby="tunggu{{$i}}-error">
                                                <option value=""></option>
                                                <option value="Ada" {{($product_list['tunggu'] == 'Ada'?'selected':'')}}>Ada</option>
                                                <option value="Tidak Ada" {{($product_list['tunggu'] == 'Tidak Ada'?'selected':'')}}>Tidak Ada</option>
                                            </select>
                                            <em id="tunggu{{$i}}-error" class="invalid-feedback">Please select a status</em>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select class="form-control produksi" name="produksi{{$i}}" aria-describedby="produksi{{$i}}-error">
                                            <option value=""></option>
                                        @foreach($users as $users)
                                            <option value="{{$users['name']}}" {{
                                            ($product_list['produksi'] == $users['name']?'selected':'') }}>{{$users['name']}}</option>
                                        @endforeach
                                        </select>
                                        <em id="produksi{{$i}}-error" class="invalid-feedback">Please select a produksi</em>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div><!--
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary pull-right" onclick="addProduct()">
                                    <i class="fa fa-plus"></i>&nbsp; Add Product
                                </button>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!--end Product order-->
            </div>
        </div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<p>
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					    <button type="submit" class="btn btn-primary" onclick="save()">
                            <i class="fa fa-save"></i>&nbsp; Save
                        </button>&nbsp;
					    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
					    <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
					    </button>
					</div>
					</p>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
</form>
@include('panel.transaction-management.production.fade-form-edit')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.transaction-management.production.form-edit-js')
@endsection
