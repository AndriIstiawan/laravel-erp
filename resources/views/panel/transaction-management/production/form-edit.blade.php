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
			<div class="col-md-8">
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
												<label class="col-form-label" for="sono">*SO NO</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="sono" name="sono" placeholder="NO1029ON" aria-describedby="sono-error" value="{{$order->sono}}" readonly="">
													<em id="sono-error" class="error invalid-feedback">Please enter a SO NO</em>
												</div>
												<label class="col-form-label" for="type">*SO Date</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="date" name="date" value="{{$order->date}}" readonly>
												</div>
												<label class="col-form-label" for="phone">*Client</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="client" name="client" aria-describedby="client-error" value="{{$order->client}}" placeholder="Member" readonly="">
													<em id="client-error" class="error invalid-feedback">Please enter a client</em>
												</div>
												<label class="col-form-label" for="sales">*Sales</label>
												<div class="input-group">
													@foreach($order->sales as $sales)
													<input type="hidden" id="saless" class="form-control form-control-sm" value="{{$sales['_id']}}" placeholder="{{$sales['name']}}" name="sales" aria-describedby="sales-error">
													<input class="form-control form-control-sm" placeholder="{{$sales['name']}}" aria-describedby="sales-error" readonly="">
													@endforeach
													<em id="sales-error" class="error invalid-feedback">Please select a sales</em>
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
              			<div type="hidden" id="theCount" value="0"></div>
              		<div class="option-card type-attr_3">
                	<div class="form-group input_">
                  	<div class="option-card">
						<div class="row">
							<div style="width: 13%;">
					        @foreach ($order->product as $product)
							<div style="width: 100%;">
									<label class="col-form-label" for="name">Name Product</label>
										<input type="hidden" id="product" value="{{$product['_id']}}" name="product[]" class="form-control form-control-sm" aria-describedby="product-error">
										<input value="{{$product['name']}}" class="form-control form-control-sm" aria-describedby="product-error" readonly="">
			                        <em id="product-error" class="error invalid-feedback">Please select product</em>
							</div>
							@endforeach
							</div>
							<div style="width: 4%;">
							@foreach ($order->product as $product)
							<div style="width: 100%;">
							<label class="col-form-label" for="type">Type</label>
									<input type="text" class="form-control form-control-sm" value={{$product['type']}} name="type[]" id="product-type" readonly>
							</div>
							@endforeach
							</div>
							<div style="width: 4.4%;">
							@foreach ($order->product as $product)
							<div style="width: 100%;">
								<label class="col-form-label" for="code">Code</label>
								<input type="text" value="{{$product['code']}}" class="form-control form-control-sm" name="code[]" id="product-code" readonly>
							</div>
							@endforeach
							</div>
							<div class="col-md-1">
							@foreach($order->total as $totals)
		                       <div style="width: 100%;">
		                          <label class="col-form-label" for="total">Total(Kg)</label>
		                          <input type="number" onkeyup="findTotal()" class="form-control form-control-sm" id="total" name="total[]" value="{{$totals['total']}}" placeholder="00" aria-describedby="totals-error" readonly="">
		                            <em id="totals-error" class="error invalid-feedback">
		                              Please enter a totals
		                            </em>
		                        </div>
		                    @endforeach
		                    </div>
							<div style="width: 10%">
							@foreach($order->packaging as $packagings)
			                    <div style="width: 100%;">
			                        <label class="col-form-label" >*Packaging (Kg)</label>
			                        <input id="packaging" value="{{$packagings['packaging']}}" name="packaging[]" class="form-control form-control-sm" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotal()" readonly="">
			                    </div>
                    		@endforeach
                    		</div>
	                        <div style="width: 4%">
                    		@foreach($order->amount as $amounts)
		                        <div style="width: 100%;">
		                          <label class="col-form-label" >Amount</label>
		                          <input class="form-control form-control-sm" value="{{$amounts['amount']}}" type="text" name="amount[]" id="amount" placeholder="00" readonly/>
		                        </div>
		                    @endforeach
		                    </div>
		                    @foreach($order->package as $packages)
		                    <div class="col-md-2">
		                        <div style="width: 100%;">
		                          	<label class="col-form-label" >*Package</label>
		                          	<select id="package" name="package[]" class="form-control form-control-sm" style="width: 100% !important;" aria-describedby="package-error" required>
	                              		<option value=""></option>
							            <option value="drum" >Drum</option>
							            <option value="Jerigen">Jerigen</option>  
							            <option value="Aluminium">Aluminium</option>  
							            <option value="Plastik">Plastik</option>
	                          		</select>
	                        		<em id="package-error" class="error invalid-feedback">Please select package</em>
	                        	</div>
		                    </div>
		                    @endforeach
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Realisasi (Kg)</label>
		                          <input class="form-control form-control-sm" type="text" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error" required="" />
		                        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Stock Kapuk</label>
		                          <input class="form-control form-control-sm" type="text" name="stockk[]" id="stockk" aria-describedby="stockk-error" required="" />
		                        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Pending SO</label>
		                          <input class="form-control form-control-sm" type="text" name="pending[]" id="pending" aria-describedby="pending-error" required="" />
		                        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Balance Stock</label>
		                          <input class="form-control form-control-sm" type="text" name="balance[]" id="balance" aria-describedby="balance-error" required="" />
		                        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Pending PR</label>
		                          <input class="form-control form-control-sm" type="text" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error" required="" />
		                        <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
		                        </div>
		                    </div>
						</div>
					</div>
					<div class="option-card1">
					</div>
					</div>
					</div>
					</div>
				</div>
			</div>
		<div class="col-md-2"></div>
			<div class="col-md-8">
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
										<label class="col-form-label" for="catatan">*Catatan</label>
										<textarea type="text" rows="5" class="form-control" id="catatan" name="catatan" placeholder="Catatan" aria-describedby="catatan-error" required=""></textarea>
										<em id="catatan-error" class="error invalid-feedback">Please enter a name user</em>
									</div>
									</div>
									<div class="col-md-12" style="display: none;">
									<div class="form-group">
										<label class="col-form-label" for="status">*Status</label>
										<input type="text" rows="5" class="form-control" id="status" name="status" >
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group ">
										<label class="col-form-label" for="tunggu">*Stok tunggu dari bekasi</label>
										<select id="tunggu" class="form-control" style="width: 100% !important;" name="tunggu" aria-describedby="tunggu-error">
											<option value=""></option>
											<option value="Ada">Ada</option>
											<option value="Tidak Ada">Tidak Ada</option>
										</select>
										<em id="tunggu-error" class="error invalid-feedback">Please select a status</em>
									</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label class="col-form-label" for="check">*Dicheck Oleh,</label>
										<select id="check" class="form-control" style="width: 100% !important;" name="check" aria-describedby="check-error">
											<option value=""></option>
										@foreach($user as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
										<em id="check-error" class="error invalid-feedback">Please select a check</em>
									</div>
									<div class="form-group col-md-6">
										<label class="col-form-label" for="produksi">*Diproduksi Oleh,</label>
										<select id="produksi" class="form-control" style="width: 100% !important;" name="produksi" aria-describedby="produksi-error">
											<option value=""></option>
										@foreach($users as $users)
											<option value="{{$users->id}}">{{$users->name}}</option>
										@endforeach
										</select>
										<em id="produksi-error" class="error invalid-feedback">Please select a produksi</em>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<p>
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					    <button type="submit" id="save" class="btn btn-success">Save</button>&nbsp;
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
@include('panel.transaction-management.production.fade-form-edit')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.transaction-management.production.form-edit-js')
@endsection