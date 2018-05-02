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
												<label class="col-form-label" for="sono">SO NO</label>
												<div class="input-group">
													<input type="text" class="form-control " id="sono" name="sono" value="{{$order->sono}}" readonly="">
												</div>
												<label class="col-form-label" for="type">SO Date</label>
												<div class="input-group">
													<input type="text" class="form-control " id="date" name="date" value="{{$order->date}}" readonly>
												</div>
												<label class="col-form-label" for="phone">Client</label>
												<div class="input-group">
													<input type="text" class="form-control " id="client" name="client" value="{{$order->client}}" readonly="">
												</div>
												<label class="col-form-label" for="sales">Sales</label>
												<div class="input-group">
													@foreach($order->sales as $sales)
													<input type="hidden" id="saless" class="form-control" value="{{$sales['_id']}}" placeholder="{{$sales['name']}}" name="sales" aria-describedby="sales-error">
													<input class="form-control" placeholder="{{$sales['name']}}" aria-describedby="sales-error" readonly="">
													@endforeach
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
					    @foreach ($order->productattr as $product)
						<div class="row">
							<div class="col-md-4">
								<label class="col-form-label" for="name">Name Product</label>
									<input type="hidden" id="product" value="{{$product['id']}}" name="product[]" class="form-control form-control-sm" aria-describedby="product-error">
									<input placeholder="{{$product['code']}}-{{$product['type']}}-{{$product['name']}}" class="form-control" aria-describedby="product-error" readonly="">
							</div>
							<div class="col-md-2">
	                          	<label class="col-form-label" for="total">Total(Kg)</label>
	                          		<input type="number" class="form-control" id="total" name="total[]" value="{{$product['total']}}" placeholder="00" aria-describedby="totals-error" readonly="">
		                    </div>
							<div class="col-md-4">
			                    <label class="col-form-label" >Packaging (Kg)</label>
			                        <input type="number" id="packaging" name="packaging[]" class="form-control" aria-describedby="packaging-error" value="{{$product['packaging']}}" placeholder="{{$product['packaging']}} - {{$product['package']}}" readonly="">
                    		</div>
	                        <div class="col-md-2">
		                          <label class="col-form-label" >Amount</label>
		                          <input class="form-control" placeholder="{{$product['amount']}}" value="{{$product['amount']}}" type="text" name="amount[]" id="amount" placeholder="00" readonly/>
		                    </div>
		                    <div class="col-md-4" style="display: none;">
							<label class="col-form-label" for="type">*Package</label>
								<input type="text" value="{{$product['package']}}" class="form-control packages" name="package[]" readonly>
							</div>
		                    <div class="col-md-3">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Realisasi (Kg)</label>
		                          <input class="form-control number" type="text" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error" required="" />
		                        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
		                        </div>
		                    </div>
		                    <div class="col-md-3">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Stock Kapuk</label>
		                          <input class="form-control number" type="text" name="stockk[]" id="stockk" aria-describedby="stockk-error" required="" />
		                        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Pending SO</label>
		                          <input class="form-control number" type="text" name="pending[]" id="pending" aria-describedby="pending-error" required="" />
		                        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Balance Stock</label>
		                          <input class="form-control number" type="text" name="balance[]" id="balance" aria-describedby="balance-error" required="" />
		                        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <div class="form-group">
		                          <label class="col-form-label" >*Pending PR</label>
		                          <input class="form-control number" type="text" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error" required="" />
		                        <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
		                        </div>
		                    </div>
						</div>
						<hr style="border-top: 4px solid #20a8d8; ">
						@endforeach
					</div>
					<div class="option-card1">
					</div>
					</div>
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
										<label class="col-form-label" for="catatan">Catatan</label>
										<textarea type="text" rows="5" class="form-control" id="catatan" name="catatan" placeholder="Catatan" value="{{$order->catatan}}" aria-describedby="catatan-error" readonly=""> {{$order->catatan}}</textarea>
									</div>
									</div>
									<div class="col-md-12" style="display: none;">
									<div class="form-group">
										<label class="col-form-label" for="status">*Status</label>
										<input class="form-control" type="hidden" value="2" name="status" >
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
			</div>
			<div class="col-md-12">
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