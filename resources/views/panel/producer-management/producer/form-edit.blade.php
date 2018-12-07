@extends('master')
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<p>
				<button type="button" class="btn btn-primary" onclick="window.history.back()">
					<i class="fa fa-backward"></i>&nbsp; Back to List
				</button>
				<button type="button" class="btn btn-success" onclick="save('#jxForm1','#jxForm2','exit')">
					&nbsp; Save all and Exit
				</button>
				</p>
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Producer
						<small>new management and setting</small>
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab1" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" 
									role="tab" aria-controls="home" aria-selected="false">General Setting</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="rp-tab" data-toggle="tab" href="#rp" 
									role="tab" aria-controls="home" aria-selected="false">Permissions</a>
							</li>
						</ul>
						<div class="tab-content" id="myTab1Content">
						<!-- TAB CONTENT -->
							
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm1" onsubmit="return false;" enctype="multipart/form-data">
											{{ csrf_field() }}
											<input type="hidden" class="id" name="id" value="{{$user->id}}">
											<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="col-form-label" for="name">*Name</label>
													<input type="text" class="form-control" id="name" name="name" placeholder="Name"
														aria-describedby="name-error" value="{{$user->name}}">
													<em id="name-error" class="error invalid-feedback">Please enter a name user</em>
												</div>
												<div class="form-group">
													<label class="col-form-label" for="username">*Username</label>
													<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$user->username}}"
														aria-describedby="username-error">
													<em id="username-error" class="error invalid-feedback">Please enter a username</em>
												</div>
												<div class="form-group">
													<label class="col-form-label" for="email">*Email</label>
													<input type="text" class="form-control" id="email" name="email" placeholder="Email"
														aria-describedby="email-error" value="{{$user->email}}">
													<em id="email-error" class="error invalid-feedback">Please enter a valid email address</em>
												</div>
												<div class="form-group">
													<label class="col-form-label" for="role">*Role</label>
													<select id="role" class="form-control" style="width: 100% !important;" name="role"
														aria-describedby="role-error">
														<option value=""></option>
														<option value="{{$user->role[0]['_id']}}" selected>{{$user->role[0]['name']}}</option>
														@foreach($roles as $role)
														<option value="{{$role->id}}" >{{$role->name}}</option>
														@endforeach
													</select>
													<em id="role-error" class="error invalid-feedback">Please select role</em>
												</div>
												</div>
												<div class="col-md-6">
												<div class="text-center">
													<img class="rounded picturePrev" 
														src="{{(isset($user->picture)?asset('img/avatars/'.$user->picture):asset('img/fiture-logo.png'))}}" 
														style="width: 150px; height: 150px;">
												</div>
												<div class="form-group">
													<label class="col-form-label" for="name">Picture (150x150)</label>
													<input type="file" class="form-control" id="picture" name="picture" placeholder="picture">
												</div>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-md-6">
													<label class="col-form-label" for="password">*Password</label>
													<input type="password" class="form-control" id="password" name="password"
														placeholder="Password" aria-describedby="password-error">
													<em id="password-error" class="error invalid-feedback">Please provide a password</em>
												</div>
												<div class="form-group col-md-6">
													<label class="col-form-label" for="confirm_password">*Confirm password</label>
													<input type="password" class="form-control" id="confirm_password" name="confirm_password"
														placeholder="Confirm password" aria-describedby="confirm_password-error">
													<em id="confirm_password-error" class="error invalid-feedback">Please provide a password</em>
												</div>
											</div>
											<hr>
											<p>
												<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<button type="button" class="btn btn-success" 
														onclick="save('#jxForm1','','continue')">Save and Continue</button>
													<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
														data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)"
															onclick="save('#jxForm1','','new')">Save and Add New</a>
														<a class="dropdown-item" href="javascript:void(0)"
															onclick="save('#jxForm1','','exit')">Save and Exit</a>
													</div>
												</div>
												<button type="button" class="btn btn-secondary" onclick="window.history.back()">
													<i class="fa fa-times-rectangle"></i>&nbsp; Cancel
												</button>
											</p>
										</form>
									</div>
								</div>
							</div>
							<!-- end tab 1 -->
							
							<div class="tab-pane fade" id="rp" role="tabpanel" aria-labelledby="rp-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm2" onsubmit="return false;">
											{{ csrf_field() }}
											<input type="hidden" class="id" name="id" value="{{$user->id}}">
											<div class="form-group">
												<label class="col-form-label" for="email">Access Permission</label>
												<div class="col-md-12 col-form-label">
													@foreach ($list_ap as $lap)
													<div class="form-check form-check-inline mr-1">
													<input class="form-check-input" type="checkbox" value="{{$lap['_id']}}" name="access[]" 
														{{ (isset($lap['checked'])?'checked':'') }}>
													<label class="form-check-label" for="inline-checkbox1">{{$lap['name']}}</label>
													</div>
													@endforeach
												</div>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="email">Menu Permission</label>
												<div class="col-md-12 col-form-label">
												
												<div class="row">
													@foreach ($list_mp as $lmp)
													<div class="col-md-6">
													<div class="form-check form-check-inline mr-1">
													<input class="form-check-input" type="checkbox" value="{{$lmp['_id']}}" name="module[]"
														{{ (isset($lmp['checked'])?'checked':'') }} data-count="0" onchange="checklistParent($(this))">
													<label class="form-check-label" for="inline-checkbox1">{{$lmp['name']}}</label>
													</div>
													<div class="col-md-12 col-form-label">
														@foreach($lmp['child'] as $lmp2)
														<div class="form-check form-check-inline mr-1">
														<input class="form-check-input pm-{{$lmp['_id']}}" type="checkbox" value="{{$lmp2['_id']}}" name="module[]"
															{{ (isset($lmp2['checked'])?'checked':'') }}
														data-parent="{{$lmp['_id']}}" onchange="checklist($(this))">
														<label class="form-check-label" for="inline-checkbox1">{{$lmp2['name']}}</label>
														</div>
														@endforeach
													</div>
													</div>
													@endforeach
												</div>
												
												</div>
											</div>
											<hr>
											<p>
												<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<button type="button" class="btn btn-success" 
														onclick="save('','#jxForm2','continue')">Save and Continue</button>
													<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split"
														data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)"
															onclick="save('','#jxForm2','new')">Save and Add New</a>
														<a class="dropdown-item" href="javascript:void(0)"
															onclick="save('','#jxForm2','exit')">Save and Exit</a>
													</div>
												</div>
												<button type="button" class="btn btn-secondary" onclick="window.history.back()">
													<i class="fa fa-times-rectangle"></i>&nbsp; Cancel
												</button>
											</p>
										</form>
									</div>
								</div>
							</div>
							<!-- end tab 2 -->
							
						</div>
					</div>
				</div>
				<!--end card -->
			</div>
		</div>
	</div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
	var progressStat = false;
	
	$('#role').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#role').on('change', function(){
		$(this).addClass('is-valid').removeClass('is-invalid');
	});
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#picture").change(function (){ readURL(this); });

	function checklistParent(elm){
    	var pmChild = $('input[data-parent="'+elm.val()+'"]');

    	if(elm.is(':checked')){
    		elm.attr('data-count',pmChild.length);
    		pmChild.prop('checked', true);
    	}else{
    		elm.attr('data-count',0);
    		pmChild.prop('checked', false);
    	}
    }

    function checklist(elm){
    	var pmParent = $('.pm-' + elm.attr('data-parent'));
    	var pmCounter =  parseInt(pmParent.attr('data-count'));

    	if(elm.is(':checked')){
    		pmCounter++;
    	}else{
    		pmCounter--;
    	}

    	if(pmCounter > 0){
    		pmParent.prop('checked', true);
    	}else{
    		pmParent.prop('checked', false);
    	}
    	pmParent.attr('data-count',pmCounter);
    }
	
	$("#jxForm1").validate({
		rules:{
			name:{required:true,minlength:2},
			username:{required:true,minlength:2},
			role:{required:true},
			password:{minlength:5},
			confirm_password:{equalTo:'#password'},
			email:{
				required:true,
				email:true,
				remote:{
					url: '{{ route('productions-staff.index') }}/find',
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
				required:'Please enter a name producer',
				minlength:'Name must consist of at least 2 characters'
			},
			username:{
				required:'Please enter a username',
				minlength:'Username must consist of at least 2 characters'
			},
			role:{ required:'Please select role' },
			password:{
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
	
	function save(formAct1,formAct2,action){
		var sendForm = ( formAct1 != '' ? formAct1 : formAct2 );
		
		//check form Tab 1 GENERAL
		if(formAct1 != ''){
			$('#general-tab').click();
			setTimeout(function(){
				if($("#jxForm1").valid()){
					postData(formAct1,formAct2,action,sendForm);
				}
			}, {{env('SET_TIMEOUT', '500')}});
		}
		
		//check form Tab 2 Permisssion
		if(formAct2 != '' && formAct1 == ''){
			$('#rp-tab').click();
			if($('.id').val() == ''){
				$('#general-tab').click();
			}else{
				postData(formAct1,formAct2,action,sendForm);
			}
		}	
	}
	
	function postData(formAct1,formAct2,action,sendForm){
		if(!progressStat){
			$('.showProgress').click();
			progressStat = true;
		}
		
		$.ajax({
			url : "{{ route('productions-staff.index') }}",
			type: 'POST',
			processData: false,
        	contentType: false,
			data : new FormData($(sendForm)[0]),
			success : function(response){
				if($('.id').val() == ''){
					$('.id').val(response);
				}
				
				if(formAct1 != '' && formAct2 != ''){
					save('',formAct2,action);
				}else{
					setTimeout(function(){
						progressStat = false;
						$('#progressModal').modal('toggle');
						act(action);
					}, {{env('SET_TIMEOUT', '500')}});
				}
			},
			error : function(e){
				setTimeout(function(){
					progressStat = false;
					$('#progressModal').modal('toggle'); 
					alert(' Error : ' + e.statusText);
				}, {{env('SET_TIMEOUT', '500')}});
			}
		});
	}
	
	function act(action){
		switch(action) {
		    case 'continue':
		        toastr.success('Successfully saved..', '');
		        break;
		    case 'new':
		        window.open("{{ route('productions-staff.create') }}/?edit=productions-staff", "_self");
		        break;
		    case 'exit':
		        window.open("{{ route('productions-staff.index') }}/?edit=productions-staff", "_self");
		}
	}
	
</script>
@endsection