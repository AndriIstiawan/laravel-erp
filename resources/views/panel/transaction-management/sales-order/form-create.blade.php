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
						<div class="tab-content" id="myTab1Content">
						<!-- TAB CONTENT -->
							
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
											<input type="hidden" class="id" name="id">
											<div class="row">
												<div class="col-md-12">
												<label class="col-form-label" for="type">*Date</label>
												<div class="input-group">
													<input type="text" class="form-control" id="date" name="date" value="{{ date('Y-m-d H:i:s') }}"readonly>
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
													<select id="product" name="product[]" class="form-control" aria-describedby="product-error" required>
						                        		<option value=""></option>
								                        @foreach ($product as $product)
								                          		<option data-code="{{$product->code}}" data-type="{{$product->type}}" value="{{$product->id}}" >{{$product->name}}</option>
								                        @endforeach
								                        	</select>
								                        <em id="member-error" class="error invalid-feedback">Please select product</em>

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
                          <label class="col-form-label" >*Tax</label>
                          <select id="tax" name="tax" class="form-control" style="width: 100% !important;" aria-describedby="tax-error" onchange="findTotal()" required>
                              <option value=""></option>
						                <option value="0,25" data-value="0,25" id="0,25">250 gram</option>
						                <option value="0,5">500 gram</option>  
						                <option value="1">1 kg</option>  
						                <option value="5">5 kg</option>  
						                <option value="25">25 kg</option>
						                <option value="30">30 kg</option>
                          </select>
                          <em id="tax-error" class="error invalid-feedback">Please select tax</em>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label" for="price">*Price Rp.</label>
                          <input type="number" onkeyup="findTotal()" class="form-control" id="price" name="price"  aria-describedby="price-error">
                            <em id="price-error" class="error invalid-feedback">
                              Please enter a new price
                            </em>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label" >*Price with Tax</label>
                          <input class="form-control" type="text" name="total" id="total" readonly/>
                        </div>
                        </div>
								<div class="col-md-12">
								
								<div class="form-group">
									<label class="col-form-label" for="total">*Total (Kg)</label>
									<input type="text" class="form-control" id="total" name="total" onchange="findTotal()" placeholder="Total" aria-describedby="name_product-error">
									<em id="name_product-error" class="error invalid-feedback">Please enter a total</em>
								</div>
								<div class="form-group">
								<label class="col-form-label" for="packaging">*Packaging Option</label>
									<select id="packaging" name="packaging"  onkeyup="findTotal()" class="form-control" aria-describedby="packaging-error" required>
						                <option value=""></option>
						                <option value="0,25" data-value="0,25" id="0,25">250 gram</option>
						                <option value="0,5">500 gram</option>  
						                <option value="1">1 kg</option>  
						                <option value="5">5 kg</option>  
						                <option value="25">25 kg</option>
						                <option value="30">30 kg</option>              
						            </select>
								</div>
								<div class="form-group">
									<label class="col-form-label" for="quantity_product">*Amount of Packaging</label>
									<input class="form-control" type="text" name="totall" id="totall" readonly/>
									<em id="quantity_product-error" class="error invalid-feedback">Please enter a quantity product</em>
								</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->
		<!-- <div class="row">
			<div class="attr-multiselect attr-dropdown form-group col-md-12">
				<div class="card">
					<div class="card-body">
                            <label class="col-form-label" for="comment">*Comment</label>
						<hr>
						<div class="option-card">
							<div class="form-group input_fields_wrap">
								<div class="option-card">
									<div class="form-group">
										<div id="comment" class="control-group input-group" style="margin-top:10px">
											<textarea id="comment" name="comment" class="form-control" placeholder="Default text area" aria-describedby="comment-error" required></textarea>
											<em id="comment-error" class="error invalid-feedback">Please enter a comment</em>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div> -->
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
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
	}
	function findTotal(){
    // var arr = document.getElementsByName('price');
    // var tot=0;
    // for(var i=0;i<arr.length;i++){
    //     if(parseInt(arr[i].value))
    //         tot += parseInt(arr[i].value);
    // }
    // document.getElementById('total').value = tot;
    var value = $('#tax option:selected').attr('data-value');
    var price = parseInt($('#price').val())+($('#price').val()*value/100);
    $('#total').val(price);

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