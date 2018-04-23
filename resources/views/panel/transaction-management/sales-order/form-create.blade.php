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
												<label class="col-form-label" for="sono">*SO NO</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="sono" name="sono" placeholder="NO1029ON" aria-describedby="sono-error">
													<em id="sono-error" class="error invalid-feedback">Please enter a SO NO</em>
												</div>
												<label class="col-form-label" for="type">*SO Date</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="date" name="date" value="{{ date('Y-m-d H:i:s') }}" readonly>
												</div>
												<label class="col-form-label" for="phone">*Client</label>
												<div class="input-group">
													<input type="text" class="form-control form-control-sm" id="client" name="client" aria-describedby="client-error" placeholder="Member">
													<em id="client-error" class="error invalid-feedback">Please enter a client</em>
												</div>
												<label class="col-form-label" for="sales">*Sales</label>
												<div class="input-group">
													<select id="saless" class="form-control form-control-sm" style="width: 100% !important;" name="sales" aria-describedby="sales-error">
														<option value=""></option>
													@foreach($modUser as $modUser)
														<option value="{{$modUser->id}}">{{$modUser->name}}</option>
													@endforeach
													</select>
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
	                	<div class="form-group input_">
								<div class="row">
									<div class="col-md-2">
										<label class="col-form-label" for="name">*Name Product</label>
											<select name="product[]" style="width: 100% !important;" class="form-control form-control-sm products" aria-describedby="product[]-error" required>
		                        				<option value=""></option>
						                        @foreach ($product as $product)
						                          	<option data-code="{{$product->code}}" data-type="{{$product->type}}" value="{{$product->id}}">{{$product->name}}</option>
						                        @endforeach
				                        	</select>
				                        <em id="product[]-error" class="error invalid-feedback">Please select product</em>
									</div>
									<div class="col-md-2">
									<label class="col-form-label" for="type">*Type</label>
										<input type="text" class="form-control form-control-sm product-type" name="type[]" readonly>
									</div>
									<div class="col-md-2">
										<label class="col-form-label" for="code">*Code</label>
										<input type="text" class="form-control form-control-sm" name="code[]" id="product-code" readonly>
									</div>
									<div class="col-md-2">
			                            <label class="col-form-label" for="total">*Total (Kg)</label>
			                            <input type="number" onkeyup="findTotal()" class="form-control form-control-sm total" id="total" name="total[]" placeholder="00" aria-describedby="total-error" required="">
			                            <em id="total-error" class="error invalid-feedback">
			                              Please enter a total
			                            </em>
				                    </div>
									<div class="col-md-2">
				                        <label class="col-form-label" >*Packaging Option</label>
				                        <select id="packaging" name="packaging[]" class="form-control form-control-sm packaging" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotal()" required>
					                        <option value=""></option>
											<option value="0.25" >250 gram</option>
											<option value="0.5">500 gram</option>  
											<option value="1">1 kg</option>  
											<option value="5">5 kg</option>  
											<option value="25">25 kg</option>
											<option value="30">30 kg</option>
				                        </select>
				                        <em id="packaging-error" class="error invalid-feedback">Please select packaging</em>
		                    		</div>
			                        <div class="col-md-2">
				                        <label class="col-form-label" >*Amount</label>
				                        <div class="control-group input-group">
				                        <input class="form-control form-control-sm" type="text" name="amount[]" id="amount" placeholder="00" readonly/>
				                    	</div>
				                    </div>
				                    <div style="display: none;" class="col-md-4">
				                        <div class="form-group">
				                          	<label class="col-form-label" >*Package</label>
				                          	<select id="package" name="package[]" class="form-control" style="width: 100% !important;" aria-describedby="package-error" required>
			                              		<option value=""></option>
									            <option value="drum" selected>Drum</option>
									            <option value="Jerigen">Jerigen</option>  
									            <option value="Aluminium">Aluminium</option>  
									            <option value="Plastik">Plastik</option>
			                          		</select>
			                        		<em id="package-error" class="error invalid-feedback">Please select package</em>
			                        	</div>
				                    </div>
				                    <div class="col-md-4" style="display: none;"> 
				                        <div class="form-group">
				                          <label class="col-form-label" >*Realisasi (Kg)</label>
				                          <input class="form-control" type="text" value="1" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error" required="" />
				                        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Stock Kapuk</label>
				                          <input class="form-control" type="text" value="1" name="stockk[]" id="stockk" aria-describedby="stockk-error" required="" />
				                        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Pending SO</label>
				                          <input class="form-control" type="text" value="1" name="pending[]" id="pending" aria-describedby="pending-error" required="" />
				                        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Balance Stock</label>
				                          <input class="form-control" type="text" value="1" name="balance[]" id="balance" aria-describedby="balance-error" required="" />
				                        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
				                        </div>
				                    </div>
				                    <div class="col-md-4" style="display: none;">
				                        <div class="form-group">
				                          <label class="col-form-label" >*Pending PR</label>
				                          <input class="form-control" type="text" value="1" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error" required="" />
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
										<label class="col-form-label" for="catatan">*Catatan</label>
										<textarea type="text" rows="5" class="form-control" id="catatan" name="catatan" placeholder="Catatan" aria-describedby="catatan-error" required=""></textarea>
										<em id="catatan-error" class="error invalid-feedback">Please enter a name user</em>
									</div>
									</div>
										<input class="form-control" type="hidden" value="1" name="status" >
									<!-- <div class="col-md-6">
									<div class="form-group ">
										<label class="col-form-label" for="tunggu">*Stok tunggu dari bekasi</label>
										<select id="tunggu" class="form-control" style="width: 100% !important;" name="tunggu" aria-describedby="tunggu-error">
											<option value=""></option>
											<option value="Ada">Ada</option>
											<option value="Tidak Ada">Tidak Ada</option>
										</select>
										<em id="tunggu-error" class="error invalid-feedback">Please select a status</em>
									</div>
									</div> -->
								</div>
								<!-- <div class="row">
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
								</div>	 -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<p>
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					    <button type="submit" name="signup" id="code" class="btn btn-success">Save</button>&nbsp;
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