@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('sales-order.update',['id' => $order->id]) }}" enctype="multipart/form-data">
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
												<label class="col-form-label" for="sono">*SO NO</label>
												<div class="input-group">
													<input type="text" class="form-control" id="sono" name="sono" placeholder="NO1029ON" aria-describedby="sono-error" value="{{$order->sono}}" readonly="">
													<em id="sono-error" class="error invalid-feedback">Please enter a SO NO</em>
												</div>
												<label class="col-form-label" for="type">*SO Date</label>
												<div class="input-group">
													<input type="text" class="form-control" id="date" name="date" value="{{$order->date}}" readonly>
												</div>
												<label class="col-form-label" for="phone">*Client</label>
												<div class="input-group">
													<input type="text" class="form-control" id="client" name="client" aria-describedby="client-error" value="{{$order->client}}" placeholder="Member" >
													<em id="client-error" class="error invalid-feedback">Please enter a client</em>
												</div>
												<label class="col-form-label" for="sales">*Sales</label>
												<div class="input-group">
													<select id="saless" class="form-control form-control-sm" style="width: 100% !important;" name="sales" aria-describedby="sales-error">
														<option value=""></option>
													@foreach($modUser as $modUser)
														<option value="{{$modUser->id}}">{{$modUser->name}}</option>
													@endforeach
													@foreach($order->sales as $sales)
														<option value="{{$sales['_id']}}" selected="">{{$sales['name']}}</option>
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
              			<div type="hidden" id="theCount" value="0"></div>
              		<div class="option-card type-attr_3">
                	<div class="form-group input_">
                  	<div class="option-card">
					    @foreach ($order->productattr as $productsss)
					    <div class="option-card1">
					    <div class="optts">
						<div class="row product-list">
							<div class="col-md-4">
								<label class="col-form-label" for="name">Name Product</label>
								<select name="product[]" style="width: 100% !important;" class="form-control form-control-sm products" aria-describedby="product[]-error">
									<option value=""></option>
									<option value="{{$productsss['id']}}" data-code="{{$productsss['code']}}" data-type="{{$productsss['type']}}" selected="">{{$productsss['code']}}-{{$productsss['type']}}-{{$productsss['name']}}</option>
									@foreach ($product as $produ)
					                  <option data-code="{{$produ->code}}" data-type="{{$produ->type}}" value="{{$produ->id}}">{{$produ->name}}</option>
					              	@endforeach
								</select>
          					<em id="product[]-error" class="error invalid-feedback">Please select product</em>
							</div><!-- 
							<div class="col-md-2">
							<label class="col-form-label" for="type">Type</label> -->
									<input type="hidden" class="form-control" value="{{$productsss['type']}}" name="type[]" id="product-type" readonly>
							<!-- </div>
							<div class="col-md-2">
								<label class="col-form-label" for="code">Code</label> -->
								<input type="hidden" value="{{$productsss['code']}}" class="form-control" name="code[]" id="product-code" readonly><!-- 
							</div> -->
							<div class="col-md-2">
		                          <label class="col-form-label" for="total">Total(Kg)</label>
		                          <input type="number" onkeyup="findTotal()" class="form-control" id="total" name="total[]" value="{{$productsss['total']}}" placeholder="00" aria-describedby="totals-error" >
		                            <em id="totals-error" class="error invalid-feedback">
		                              Please enter a totals
		                            </em>
		                        </div>
							<div class="col-md-4">
			                        <label class="col-form-label" >*Packaging (Kg)</label>
			                        <select name="packaging[]" class="form-control packaging" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotal($(this))">
				                        <option value=""></option>
										<option data-package="Plastik" value="0.25" {{($productsss['packaging'] == '0.25' && $productsss['package'] == 'Plastik'?'selected':'')}} >250 gram - Plastik</option>
										<option data-package="Plastik" value="0.5" {{($productsss['packaging'] == '0.5' && $productsss['package'] == 'Plastik'?'selected':'')}}>500 gram - Plastik</option>  
										<option data-package="Plastik" value="1" {{($productsss['packaging'] == '1' && $productsss['package'] == 'Plastik'?'selected':'')}}>1 kg - Plastik</option> 
										<option data-package="Aluminium" value="0.25" {{($productsss['packaging'] == '0.25' && $productsss['package'] == 'Aluminium'?'selected':'')}}>250 gram - Aluminium</option>
										<option data-package="Aluminium" value="0.5" {{($productsss['packaging'] == '0.25' && $productsss['package'] == 'Plastik'?'selected':'')}}>500 gram - Aluminium</option>  
										<option data-package="Aluminium" value="1" {{($productsss['packaging'] == '1' && $productsss['package'] == 'Aluminium'?'selected':'')}}>1 kg - Aluminium</option>   
										<option data-package="Jerigen" value="5" {{($productsss['packaging'] == '5' && $productsss['package'] == 'Jerigen'?'selected':'')}}>5 kg - Jerigen</option>  
										<option data-package="Jerigen" value="25" {{($productsss['packaging'] == '25' && $productsss['package'] == 'Jerigen'?'selected':'')}}>25 kg - Jerigen</option>
										<option data-package="Jerigen" value="30" {{($productsss['packaging'] == '30' && $productsss['package'] == 'Jerigen'?'selected':'')}}>30 kg - Jerigen</option>
										<option data-package="Drum" value="25" {{($productsss['packaging'] == '25' || $productsss['package'] == 'Drum'?'selected':'')}}>25 kg - Drum</option>
				                    </select>
			                    </div>
							<div class="col-md-2">
		                        <label class="col-form-label" >Amount</label>
            					<div class="control-group input-group">
		                        	<input class="form-control" id="amount" value="{{$productsss['amount']}}" min="1" type="number" name="amount[]" placeholder="00" aria-describedby="amount-error" required=""  readonly/>
	         						<span class="input-group-append">
	         						 	<button class="btn btn-danger rounded pull-right" id="minmore" onclick="$(this).closest('.option-card1 .optts').remove()"><i class="fa fa-trash"></i>
	            						</button>
	            					</span>
		                        </div>
            					<em id="amount-error" class="error invalid-feedback"></em>
		                    </div>
		                    <div class="col-md-4" style="display: none;">
								<label class="col-form-label" for="type">*Package</label>
									<input type="text" value="{{$productsss['package']}}" class="form-control packages" name="package[]" readonly>
							</div>
		                    <div class="col-md-4" style="display: none;"> 
		                        <div class="form-group">
		                          <label class="col-form-label" >*Realisasi (Kg)</label>
		                          <input class="form-control" type="text" value="1" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error"/>
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
						</div>
						</div>
		                    @endforeach

					<div class="option-card2">
					</div>
		                    <button  type="button" class="btn btn-primary pull-right" id="addMe" onclick="$('.input_ .option-card2').append($('.optt').html());refProductChange();"> Add More</button>
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
										<label class="col-form-label" for="catatan">Catatan(optional)</label>
										<textarea type="text" rows="5" class="form-control" id="catatan" name="catatan" placeholder="Catatan" aria-describedby="catatan-error">{{$order->catatan}}</textarea>
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
@include('panel.transaction-management.sales-order.fade-form-edit')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.transaction-management.sales-order.form-edit-js')
@endsection