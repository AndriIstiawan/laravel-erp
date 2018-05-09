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
													<select class="form-control" id="title" name="title" placeholder="Phone" aria-describedby="title-error">
														<option value=""></option>
														<option value="Bapak" {{($member->title == 'Bapak'?'selected':'')}}>Bapak</option>
														<option value="Ibu" {{($member->title == 'Ibu'?'selected':'')}}>Ibu</option>
													</select> 
													<em id="title-error" class="error invalid-feedback">Please select a title</em>
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
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Sub
						<small>Division management</small>
					</div>
					<div class="card-body">
						<div class="option-card1">
							@foreach ($member->subDivision as $attr)
	        				<div class="optts">
								<div class="row">
									<p class="col-md-4">
										<input type="text" id="nameSub" class="form-control" name="nameSub[]" aria-describedby="nameSub-error" value="{{$attr['nameSub']}}" placeholder="Name Sub" required>
										<em id="nameSub-error" class="error invalid-feedback">Please enter a new name</em>
									</p>
									<p class="col-md-4">
								        <select name="type[]" class="form-control type" aria-describedby="type-error" required>
								        	<option value=""></option>
								          	<option value="{{$attr['proId']}}" selected="">{{$attr['type']}}</option>
								        @foreach ($product as $product)
								          	<option value="{{$product['_id']}}" >{{$product['type']}}</option>
								        @endforeach
								        </select>
								      	<em id="type-error" class="error invalid-feedback">Please select a type</em>
								  	</p>
									<p class="col-md-3">
				                        	<select name="sales[]" class="form-control sales" aria-describedby="sales-error" required>
				                          		<option value="{{$attr['salId']}}" selected>{{$attr['sales']}}</option>
				                        	@foreach ($modUser as $modUser)
				                          		<option value="{{$modUser['_id']}}">{{$modUser['name']}}</option>
				                        	@endforeach
				                        	</select>
				                      <em id="sales-error" class="error invalid-feedback">Please enter a new sales</em>
				                  	</p>
				                  	<p class="col-md-1">
							            <button class="btn btn-danger rounded pull-right" id="minmore" onclick="$(this).closest('.option-card1 .optts').remove()">
							                <i class="fa fa-trash"></i>
							            </button>
								    </p>
								</div>
							</div>
							@endforeach
						</div>
						<div class="option-card2">
						</div>
						<button  type="button" class="btn btn-primary pull-right" id="addMe" onclick="$('.option-card2').append($('.optt').html());refProductChange();"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub</button>
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
@include('panel.member-management.master-member.fade-form-edit')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.member-management.master-member.form-edit-js')
@endsection