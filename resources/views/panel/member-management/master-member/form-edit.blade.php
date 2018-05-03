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
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('master-client.update',['id' => $member->id]) }}"" enctype="multipart/form-data">			
{{ method_field('PUT') }}
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-lg-7">
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Client
						<small>edit management</small>
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
											<input type="hidden" class="id" name="id" value="{{$member->id}}">
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" id="name" name="name" placeholder="Name"
														aria-describedby="name-error" value="{{$member->name}}">
													<em id="name-error" class="error invalid-feedback">Please enter a name site title</em>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$member->email}}" aria-describedby="email-error">
													<em id="email-error" class="error invalid-feedback">Please enter a valid email address</em>
												</div>
												<div class="form-group">
													<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$member->phone}}" aria-describedby="phone-error">
													<em id="phone-error" class="error invalid-feedback">Please enter a valid phone</em>
												</div><!-- 
												
												<div class="form-group">
									              	<label class="col-form-label" for="status">*Status</label> <p>
									                	<label class="switch switch-text switch-pill switch-info">
									                	<input type="checkbox" class="switch-input" id="status" name="status" {{($member->status? 'checked': '')}} tabindex="-1">
									                	<span class="switch-label" data-on="On" data-off="Off"></span>
									                	<span class="switch-handle"></span>
									                </label>
									            </div> -->
												</div>
												<div class="col-md-6">
												<div class="text-center">
													<img class="rounded picturePrev" 
														src="{{(isset($member->picture)?asset('img/avatars/'.$member->picture):asset('img/fiture-logo.png'))}}" 
														style="width: 150px; height: 150px;">
												</div>
												<div class="form-group">
													<label class="col-form-label" for="name">Picture (150x150)</label>
													<input type="file" class="form-control" id="picture" name="picture" placeholder="picture" accept="image/jpg, image/jpeg">
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
			<div class="col-lg-5">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Sales Member
						<small>Data</small>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-12">
		                      	<label class="col-form-label" for="sales">*Sales</label>
		                        	<select id="sales" name="sales[]" class="form-control" aria-describedby="sales-error" required>
		                        	@foreach ($member->sales as $atts)
		                          		<option data-name="{{$atts['name']}}" data-email="{{$atts['email']}}" value="{{$atts['_id']}}" selected>{{$atts['name']}}</option>
		                        	@endforeach
		                        	@foreach ($modUser as $modUser)
		                          		<option data-name="{{$modUser->name}}" data-email="{{$modUser->email}}" value="{{$modUser->id}}">{{$modUser->name}}</option>
		                        	@endforeach
		                        	</select>
		                      <em id="sales-error" class="error invalid-feedback">Please enter a new sales</em>
		                  	</div>
		                    <div class="input-group col-md-12">
								<span class="input-group-text"><i class="fa fa-user-circle-o" ></i></span>
									<input type="text" class="form-control" value="{{$atts['name']}}" id="sales-name" readonly>
							</div>
							<div class="input-group col-md-12" style="padding-top: 16px">
								<span class="input-group-text"><i class="fa fa-envelope" ></i></span>
									<input type="text" class="form-control" id="sales-email" value="{{$atts['email']}}" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>

		
		<!--/.row-->
		<div class="row">
			<div class="attr-multiselect attr-dropdown form-group col-md-12">
				<div class="card">
					<div class="card-body"><!-- 
							<button class="btn btn-primary add_field_btn-primary" >Add Address</button>
						<hr> -->
						<div class="option-card">	
							@foreach($member->address as $address)
								<div class="form-group">
						        	<textarea type="text" name="address[]" id="address" class="form-control" placeholder="Address" rows="3" value="{{$address}}" aria-describedby="address-error" required>{{$address}}</textarea>
						        	<em id="address-error" class="error invalid-feedback">Please enter a address</em>
						      	</div>
						    @endforeach
							<div class="form-group input_fields_wrap">
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
					<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
	$('#level').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#sales').select2({theme:"bootstrap", placeholder:'Please select'})
		.change(function(){
			var element= $(this).find('option:selected');
			$('#sales-name').val(element.attr('data-name'));
			$('#sales-email').val(element.attr('data-email'));
		});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#picture").change(function (){ readURL(this); });

	$('#level').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

	$('#status').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

  	$('#sales').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});

	$("#jxForm1").validate({
		rules:{
			name:{required:true,minlength:2},
			address:{required:true,minlength:2},
			sales:{required:true},
			phone:{required:true},
			level:{required:true},
			status:{required:true},
			password:{required:true,minlength:5},
			confirm_password:{required:true,equalTo:'#password'},
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
			name:{
				required:'Please enter a name site',
				minlength:'Name must consist of at least 2 characters'
			},
			address:{
				required:'Please enter a name site',
				minlength:'Name must consist of at least 2 characters'
			},
			phone:{ required:'Please enter a phone number' 
			},
			sales:{ required:'Please select sales' 
			},
			level:{ required:'Please select level' 
			},
			status:{ required:'Please select status' 
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

	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_btn-primary"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="option-card"><div class="form-group"><label class="col-form-label" for="address">*Address</label><div id="address" class="control-group input-group" style="margin-top:10px"><input type="text" name="address[]" class="form-control" placeholder="Address" aria-describedby="address-error" required><div class="input-group-btn"><button class="btn btn-danger remove" type="button"><i class="fa fa-close"></i></button></div><em id="address-error" class="error invalid-feedback">Please enter a address</em></div></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
	$(document).ready(function() {
  //here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).closest('.form-group').remove();
      });
  });
	
</script>
@endsection