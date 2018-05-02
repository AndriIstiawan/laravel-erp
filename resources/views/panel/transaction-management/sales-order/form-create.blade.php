@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('sales-order.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-md-6">
				<p>
					<button type="button" class="btn btn-primary" onclick="window.history.back()">
							<i class="fa fa-backward"></i>&nbsp; Back to List
					</button>
				</p>
				<!--start card -->
				
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> SO
						<small>data </small>
					</div>
					<div class="card-body">
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<input type="hidden" class="id" name="id">
											<div class="row">
												<div class="col-md-12">
													<input type="hidden" class="form-control" id="sono" name="sono" aria-describedby="sono-error" value="{{$so_id}}" readonly>
													<em id="sono-error" class="error invalid-feedback">Please enter a SO NO</em>
													<input type="hidden" class="form-control" id="date" name="date" value="{{ date('Y-m-d H:i:s') }}" readonly>
												<div class="input-group">
													<select id="client" class="form-control" style="width: 100% !important;" name="client" aria-describedby="client-error">
														<option value=""></option>
														@foreach($member as $member)
														<option value="{{$member->id}}">{{$member->name}}</option>
														@endforeach
													</select>
													<em id="client-error" class="error invalid-feedback">Please enter a client</em>
												</div>
												</div>
											</div>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<!--end card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Packaging
						<small>Product </small>
					</div>
					<div class="card-body">
	                	<div class="form-group input_">
								<div class="row product-list">
									<div class="col-md-4">
										<label class="col-form-label" for="type"></label>
											<select name="product[]" style="width: 100% !important;" class="form-control form-control-sm products" aria-describedby="product[]-error">
		                        				<option value=""></option>
						                        @foreach ($product as $product)
						                          	<option data-code="{{$product->code}}" data-type="{{$product->type}}" value="{{$product->id}}">{{$product->code}}-{{$product->type}}-{{$product->name}}</option>
						                        @endforeach
				                        	</select>
				                        <em id="product[]-error" class="error invalid-feedback"></em>
									</div>
									<div style="display: none;" class="col-md-2">
									<label class="col-form-label" for="type">*Type</label>
										<input type="text" class="form-control product-type" name="type[]" readonly>
									</div>
									<div style="display: none;" class="col-md-2">
										<label class="col-form-label" for="code">*Code</label>										
										<input type="text" class="form-control" name="code[]" id="product-code" readonly>
									</div>

									<div class="col-md-2">
										<label class="col-form-label" for="type"></label>
			                            <input type="number" onkeyup="findTotal($(this))" class="form-control total" id="total" name="total[]" placeholder="KG" aria-describedby="total-error" placeholder="00 Kg">
			                            <em id="total-error" class="error invalid-feedback">
			                              Please enter a total
			                            </em>
				                    </div>
									<div class="col-md-4">
										<label class="col-form-label" for="type"></label>
				                        <select name="packaging[]" style="width: 100% !important;" class="form-control form-control-sm packaging" aria-describedby="packaging-error" onchange="findTotal($(this))">
					                        <option value=""></option>
											<option data-package="Plastik" value="0.25" >250 gram - Plastik</option>
											<option data-package="Plastik" value="0.5">500 gram - Plastik</option>  
											<option data-package="Plastik" value="1">1 kg - Plastik</option> 
											<option data-package="Aluminium" value="0.25" >250 gram - Aluminium</option>
											<option data-package="Aluminium" value="0.5">500 gram - Aluminium</option>  
											<option data-package="Aluminium" value="1">1 kg - Aluminium</option>   
											<option data-package="Jerigen" value="5">5 kg - Jerigen</option>  
											<option data-package="Jerigen" value="25">25 kg - Jerigen</option>
											<option data-package="Jerigen" value="30">30 kg - Jerigen</option>
											<option data-package="Drum" value="25">25 kg - Drum</option>
				                        </select>
				                        <em id="packaging-error" class="error invalid-feedback">Please select packaging</em>
		                    		</div>
			                        <div class="col-md-2">
			                        	<label class="col-form-label" for="type"></label>
				                        <div class="control-group input-group">
				                        <input class="form-control" type="number" name="amount[]" id="amount" placeholder="Amount" aria-describedby="amount-error" readonly/>
				                        <em id="amount-error" class="error invalid-feedback"></em>
				                    	</div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
									<label class="col-form-label" for="type">*Package</label>
										<input type="text" class="form-control packages" name="package[]" readonly>
									</div>
				                    <div class="col-md-4" style="display: none;"> 
				                        <div class="form-group">
				                          <label class="col-form-label" >*Realisasi (Kg)</label>
				                          <input class="form-control" type="text" value="" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error"/>
				                        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Stock Kapuk</label>
				                          <input class="form-control" type="text" value="1" name="stockk[]" id="stockk" aria-describedby="stockk-error"/>
				                        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Pending SO</label>
				                          <input class="form-control" type="text" value="1" name="pending[]" id="pending" aria-describedby="pending-error"/>
				                        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Balance Stock</label>
				                          <input class="form-control" type="text" value="1" name="balance[]" id="balance" aria-describedby="balance-error"/>
				                        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Pending PR</label>
				                          <input class="form-control" type="text" value="1" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error"/>
				                        <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
				                        </div>
				                    </div>
								</div>
								<hr style="border-top: 4px solid #20a8d8; ">
							<div class="option-card1">
							</div>
						<button  type="button" class="btn btn-primary pull-right" id="addMe" onclick="$('.input_ .option-card1').append($('.optt').html());refProductChange();"> Add More</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Pemeriksaan
						<small>Product </small>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-12">
									<div class="form-group">
										
										<textarea type="text" rows="5" class="form-control" id="catatan" name="catatan" placeholder="Catatan" aria-describedby="catatan-error"></textarea>
									</div>
									</div>
										<input class="form-control" type="hidden" value="1" name="status" >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<p>
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					    <button type="submit" name="save" id="save" class="btn btn-success">Save</button>&nbsp;
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
</form>

@include('panel.transaction-management.sales-order.fade-form-create')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.transaction-management.sales-order.form-create-js')
@endsection