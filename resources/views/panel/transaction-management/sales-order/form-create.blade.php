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
						<div class="tab-content">
						<!-- TAB CONTENT -->
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<input type="hidden" class="id" name="id">
											<div class="row">
												<div class="col-md-12">
												<label class="col-form-label" for="type">*Date</label>
													<div class="input-group">
														<input type="text" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}"readonly>
													</div>
													<label class="col-form-label" for="phone">*Client</label>
													<div class="input-group">
														<input type="text" class="form-control" id="client" name="client" >
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
										                          	<option data-code="{{$product->code}}" data-type="{{$product->type}}" value="{{$product->name}}" >{{$product->name}}</option>
										                        @endforeach
								                        	</select>
								                        <em id="member-error" class="error invalid-feedback">Please select product</em>

														<label class="col-form-label" for="type">*Type</label>
														<div class="input-group">
															<input type="text" class="form-control" name="type" id="product-type" readonly>
														</div>
															<label class="col-form-label" for="code">*Code</label>
														<div class="input-group">
															<input type="text" class="form-control" name="code" id="product-code" readonly>
														</div>
													</div>
												</div>
											</div>
									</div>
								</div>
							</div>
							<!-- end tab 1 -->
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
		                          <input type="text" onkeyup="findTotal()" class="form-control" id="total" name="total"  aria-describedby="total-error">
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
			                          <input class="form-control" type="text" name="amount" id="amount" readonly/>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          	<label class="col-form-label" >*Package</label>
			                          	<select id="package" name="package" class="form-control" style="width: 100% !important;" aria-describedby="package-error" required>
		                              		<option value=""></option>
								            <option value="drum" >Drum</option>
								            <option value="Jerigen">Jerigen</option>  
								            <option value="Aluminium">Aluminium</option>  
								            <option value="Plastik">Plastik</option>
		                          		</select>
		                        		<em id="package-error" class="error invalid-feedback">Please select package</em>
		                        	</div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          <label class="col-form-label" >*Realisasi (Kg)</label>
			                          <input class="form-control" type="text" name="realisasi" id="realisasi"/>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          <label class="col-form-label" >*Stock Kapuk</label>
			                          <input class="form-control" type="text" name="stockk" id="stockk"/>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          <label class="col-form-label" >*Pending SO</label>
			                          <input class="form-control" type="text" name="pending" id="pending"/>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          <label class="col-form-label" >*Balance Stock</label>
			                          <input class="form-control" type="text" name="balance" id="balance"/>
			                        </div>
			                    </div>
			                    <div class="col-md-6">
			                        <div class="form-group">
			                          <label class="col-form-label" >*Pending PR</label>
			                          <input class="form-control" type="text" name="pendingpr" id="pendingpr"/>
			                        </div>
			                    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
                <div class="card-header">
                        <i class="fa fa-align-justify"></i> Note
                </div>
                <div class="card-body">
		            <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="note">*Note
                            <br>
                            <small class="text-muted"></small>
                        </label>
	                    <div class="col-md-9">
	                        <textarea rows="6" name="note" class="form-control" aria-describedby="note-error"></textarea>
	                            <em id="note-error" class="error invalid-feedback">fill the note</em>
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
	
	
	function findTotal(){
	    var value = $('#packaging option:selected').attr('value');
	    var tot = parseInt($('#total').val())/value;
	    $('#amount').val(tot);

    }

	$("#picture").change(function (){ readURL(this); });

  	$('#member').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

	$("#jxForm1").validate({
		rules:{
			name_product:{required:true,minlength:2},
			description_product:{required:true,minlength:2},
			quantity_product:{required:true},
			comment:{required:true,minlength:2},
			member:{required:true},
			email:{
				required:true,
				email:true,
				remote:{
					url: '{{ route('master-user.index') }}/find',
					type: "post",
					data:{
						_token:'{{ csrf_token() }}',
						id: $('.id').val(),
						email: function(){
							return $('#jxForm1 :input[name="email"]').val();
						}
					}
				}
			}
		},
		messages:{
			name_product:{
				required:'Please enter a name product',
				minlength:'Name must consist of at least 2 characters'
			},
			description_product:{
				required:'Please enter a description product',
				minlength:'Name must consist of at least 2 characters'
			},
			phone:{ required:'Please enter a phone number' 
			},
			quantity_product:{ required:'Please enter a quantity_product' 
			},
			comment:{ 
				required:'Please enter a comment',
				minlength:'Name must consist of at least 2 characters'
			},
			member:{ required:'Please select member' 
			},
			password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long'
			},
			confirm_password:{
				required:'Please provide a password',
				minlength:'Password must be at least 5 characters long',
				equalTo:'Please enter the same password'
			},
			email: {
				email:'Please enter a valid email address',
				remote:'Email address already in use. Please use other email.'
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