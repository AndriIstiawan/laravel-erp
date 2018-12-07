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
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('custompo.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-md-5">
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Member
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
												<div class="form-group">
													<label class="col-form-label" for="member">*Name</label>
													<select id="member" name="member[]" class="form-control" aria-describedby="member-error" required>
						                        		<option value=""></option>
						                        @foreach ($member as $member)
						                          		<option data-phone="{{$member->phone}}" data-point="{{$member->point}}" data-email="{{$member->email}}" value="{{$member->id}}" >{{$member->name}}</option>
						                        @endforeach
						                        	</select>
						                        <em id="member-error" class="error invalid-feedback">Please select member</em>
												</div>
												<label class="col-form-label" for="email">*Email</label>
												<div class="input-group">
													<span class="input-group-text"><i class="fa fa-envelope" ></i></span>
													<input type="text" class="form-control" id="member-email" readonly>
												</div>
												<label class="col-form-label" for="phone">*Phone</label>
												<div class="input-group">
													<span class="input-group-text"><i class="fa fa-phone" ></i></span>
													<input type="text" class="form-control" id="member-phone" readonly>
												</div>
													<label class="col-form-label" for="point">*Point</label>
												<div class="input-group">
													<span class="input-group-text"><i class="fa fa-envelope" ></i></span>
													<input type="text" class="form-control" id="member-point" readonly>
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
						<i class="fa fa-align-justify"></i> Product
						<small>PO </small>
					</div>
					<div class="card-body">
						<div class="row">
								<div class="col-md-12">
								<div class="text-center">
									<img class="rounded picturePrev" src="{{ asset('img/fiture-logo.png') }}" 
										style="width: 150px; height: 150px;">
								</div>
								<div class="form-group">
									<label class="col-form-label" for="name">Picture (150x150)</label>
									<input type="file" class="form-control" id="picture" name="picture" placeholder="picture" accept="image/jpg, image/jpeg" required=""e>
								</div>
								<div class="form-group">
									<label class="col-form-label" for="name_product">*Name</label>
									<input type="text" class="form-control" id="name_product" name="name_product" placeholder="Name" aria-describedby="name_product-error">
									<em id="name_product-error" class="error invalid-feedback">Please enter a name_product</em>
								</div>
								<div class="form-group">
									<label class="col-form-label" for="name">*Description</label>
									<textarea id="description_product" name="description_product" class="form-control" placeholder="Default text area" aria-describedby="description_product-error" required></textarea>
									<em id="description_product-error" class="error invalid-feedback">Please enter a description_product</em>
								</div>
								<div class="form-group">
									<label class="col-form-label" for="quantity_product">*Quantity</label>
									<input type="number" class="form-control" id="quantity_product" name="quantity_product" placeholder="100" aria-describedby="quantity_product-error">
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
	$('#member').select2({theme:"bootstrap", placeholder:'Please select'})
		.change(function(){
			var element= $(this).find('option:selected');
			$('#member-phone').val(element.attr('data-phone'));
			$('#member-email').val(element.attr('data-email'));
			$('#member-point').val(element.attr('data-point'));
		});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
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