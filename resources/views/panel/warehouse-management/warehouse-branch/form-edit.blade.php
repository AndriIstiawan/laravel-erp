@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
				</p>
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Slider
						<small></small>
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab1" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" 
									role="tab" aria-controls="home" aria-selected="false">General Setting</a>
							</li>
						</ul>
						<div class="tab-content" id="myTab1Content">
						<!-- TAB CONTENT -->
							
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm1" onsubmit="return false;" enctype="multipart/form-data">
											{{ method_field('PUT') }}
											{{ csrf_field() }}
											<input type="hidden" class="id" name="id" value="{{ $segment->id }}">
											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-form-label" for="name">*Name</label>
													<input type="text" class="form-control" id="name" name="name" placeholder="name brand" aria-describedby="name-error" value="{{ $segment->name }}">
													<em id="name-error" class="error invalid-feedback">Please enter a name of brand</em>
												</div>
												<div class="text-center">
													<img class="rounded picturePrev" 
														src="{{(isset($segment->picture)?asset('img/avatars/'.$segment->picture):asset('img/fiture-logo.png'))}}" 
														style="width: 150px; height: 150px;">
												</div>
												<div class="form-group">
													<label class="col-form-label" for="name">Picture (150x150)</label>
													<input type="file" class="form-control" id="picture" name="picture" placeholder="picture">
												</div>
											</div></div>
											<hr>
											<p>
												<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<button type="button" class="btn btn-success" 
														onclick="save('#jxForm1','','exit')">Save and Continue</button>
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
	
	$("#jxForm1").validate({
		rules:{
			name:{required:true},
			slug:{required:true},
		},
		messages:{
			name:{
				required:'Please enter a name'
				
			},
			slug:{
				required:'Please enter a slug'
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
			}, 400);
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
			url : "{{ route('warehouse-branch.update',['id' => $segment->id]) }}",
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
					}, {{env('SET_TIMEOUT', '300')}});
				}
			},
			error : function(e){
				setTimeout(function(){
					progressStat = false;
					$('#progressModal').modal('toggle'); 
					alert(' Error : ' + e.statusText);
				}, {{env('SET_TIMEOUT', '300')}});
			}
		});
	}
	
	function act(action){
		switch(action) {
		    case 'continue':
		        toastr.success('Successfully saved..', '');
		        break;
		    case 'new':
		        window.open("{{ route('warehouse-branch.create') }}/?edit=branch", "_self");
		        break;
		    case 'exit':
		        window.open("{{ route('warehouse-branch.index') }}/?edit=branch", "_self");
		}
	}
	
</script>
@endsection