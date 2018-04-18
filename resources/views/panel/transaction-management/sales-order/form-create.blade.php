@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  	<p>
		<button type="button" class="btn btn-primary" onclick="window.history.back()">
  			<i class="fa fa-backward"></i>&nbsp; Back to List
		</button>
	</p>
</div>
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('sales-order.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-md-5">
				<!--start card -->
				
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Product
						<small>data </small>
					</div>
					<div class="card-body">
						<!-- <ul class="nav nav-tabs" id="myTab1" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" 
									role="tab" aria-controls="home" aria-selected="false">General Setting</a>
							</li>
						</ul> -->
						<!-- TAB CONTENT -->
							
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
											<input type="hidden" class="id" name="id">
											<div class="row">
												<div class="col-md-12">
												<label class="col-form-label" for="sono">*SO NO</label>
												<div class="input-group">
													<input type="text" class="form-control" id="sono" name="sono" placeholder="NO1029ON" aria-describedby="sono-error">
													<em id="sono-error" class="error invalid-feedback">Please enter a SO NO</em>
												</div>
												<label class="col-form-label" for="type">*SO Date</label>
												<div class="input-group">
													<input type="text" class="form-control" id="date" name="date" value="{{ date('Y-m-d H:i:s') }}" readonly>
												</div>
												<label class="col-form-label" for="phone">*Client</label>
												<div class="input-group">
													<input type="text" class="form-control" id="client" name="client" aria-describedby="client-error" placeholder="Member">
													<em id="client-error" class="error invalid-feedback">Please enter a client</em>
												</div>
												<label class="col-form-label" for="sales">*Sales</label>
												<div class="input-group">
													<select id="sales" class="form-control" style="width: 100% !important;" name="sales" aria-describedby="sales-error">
														<option value=""></option>
													@foreach($modUser as $modUser)
														<option value="{{$modUser->id}}">{{$modUser->name}}</option>
													@endforeach
													</select>
													<em id="sales-error" class="error invalid-feedback">Please select a sales</em>
												</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
												<div class="form-group">
													<label class="col-form-label" for="name">*Name Product</label>
													<select id="product" name="product" class="form-control" aria-describedby="product-error" required>
						                        		<option value=""></option>
								                        @foreach ($product as $product)
								                          		<option data-code="{{$product->code}}" data-type="{{$product->type}}" value="{{$product->id}}" >{{$product->name}}</option>
								                        @endforeach
								                        	</select>
								                        <em id="product-error" class="error invalid-feedback">Please select product</em>

														<label class="col-form-label" for="email">*Type</label>
														<div class="input-group">
															<input type="text" class="form-control" id="product-type" readonly>
														</div>
														<label class="col-form-label" for="phone">*Code</label>
														<div class="input-group">
													<input type="text" class="form-control" id="product-code" readonly>
													</div>
												</div>
												</div>
											</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				<!--end card -->
			</div>
			<div class="col-md-7">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Packaging
						<small>Product </small>
					</div>
					<div class="card-body">
						<div class="row">
						<div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label" for="total">*Total (Kg)</label>
                          <input type="text" onkeyup="findTotal()" class="form-control number" id="total" name="total"  aria-describedby="total-error" placeholder="00">
                            <em id="total-error" class="error invalid-feedback">
                              Please enter a total
                            </em>
                        </div>
                        </div>
						<div class="col-md-6">
                        <div class="form-group">
                          	<label class="col-form-label" >*Packaging Option</label>
                          	<select id="packaging" name="packaging" class="form-control" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotal()" required>
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
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label" >*Amount</label>
                          <input class="form-control" type="text" name="totall" id="totall" readonly/>
                        </div>
                        </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
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
										<textarea type="text" class="form-control" id="catatan" name="catatan" placeholder="Catatan" aria-describedby="catatan-error" required=""></textarea>
										<em id="catatan-error" class="error invalid-feedback">Please enter a name user</em>
									</div>
									<div class="form-group">
										<label class="col-form-label" for="tunggu">*Stok tunggu dari bekasi</label>
										<select id="tunggu" class="form-control" style="width: 48.5% !important;" name="tunggu" aria-describedby="tunggu-error">
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
		</div>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="card">
					<p>
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			          	<button type="submit" class="btn btn-success">Save</button>&nbsp;
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
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>	
	$('#product').select2({theme:"bootstrap", placeholder:'Please select'})
		.change(function(){
			var element= $(this).find('option:selected');
			$('#product-type').val(element.attr('data-type'));
			$('#product-code').val(element.attr('data-code'));
		});


	$('#tunggu').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#packaging').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#check').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#produksi').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#sales').select2({theme:"bootstrap", placeholder:'Please select'});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
	}
	function findTotal(){
	    var value = $('#packaging option:selected').attr('value');
	    var tot = parseInt($('#total').val())/value;
	    $('#totall').val(tot);

    }

	$("#picture").change(function (){ readURL(this); });

  	$('#tunggu').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#packaging').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#sales').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#produksi').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#check').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

	$("#jxForm1").validate({
		rules:{
			sono:{required:true,minlength:2},
			client:{required:true,minlength:2},
			sales:{required:true},
			product:{required:true},
			total:{required:true},
			packaging:{required:true},
			tunggu:{required:true},
			check:{required:true},
			produksi:{required:true}
		},
		messages:{
			sono:{
				required:'Please enter a SO NO',
				minlength:'SO NO must consist of at least 2 characters'
			},
			client:{
				required:'Please enter a client',
				minlength:'name client must consist of at least 2 characters'
			},
			sales:{
				required:'Please select a sales'
			},
			product:{
				required:'Please select a product'
			},
			total:{
				required:'Please enter a total'
			},
			packaging:{ required:'Please select a packaging' 
			},
			tunggu:{ required:'Please select a status' 
			},
			check:{ required:'Please select a checked' 
			},
			produksi:{ required:'Please select a produksi' 
			}
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
		},
		highlight:function(element,errorClass,validClass){
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
	});
	
</script>
@endsection