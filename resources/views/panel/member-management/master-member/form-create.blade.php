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
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('master-client.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-md-7">
				<!--start card -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Client
						<small>new management </small>
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
												<div class="col-md-6">
												<div class="form-group">
													<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error">
													<em id="name-error" class="error invalid-feedback">Please enter a name site</em>
												</div>
												<div class="form-group">
													<input type="text" class="form-control" id="email" name="email" placeholder="Email" aria-describedby="email-error">
													<em id="email-error" class="error invalid-feedback">Please enter a valid email address</em>
												</div>
												<div class="form-group">
													<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone" aria-describedby="phone-error">
													<em id="phone-error" class="error invalid-feedback">Please enter a valid phone</em>
												</div>
												<!-- <div class="form-group">
													<label class="col-form-label" for="point">*Point</label>
													<input type="number" class="form-control" name="point" placeholder="0" aria-describedby="point-error" readonly>
												</div>
												<div class="form-group">
													<label class="col-form-label" for="level">*Level</label>
													<input type="hidden" name="level" value="{{$level['_id']}}">
													<input type="number" class="form-control" placeholder="{{$level['name']}}" readonly>
												</div> --><!-- 
												<div class="form-group">
									              	<label class="col-form-label" for="status">*Status</label> <p>
									                	<label class="switch switch-text switch-pill switch-info">
									                	<input type="checkbox" class="switch-input" id="status" name="status" >
									                	<span class="switch-label" data-on="On" data-off="Off"></span>
									                	<span class="switch-handle"></span>
									                </label>
									            </div> -->
												</div>
												<div class="col-md-6">
												<div class="text-center">
													<img class="rounded picturePrev" src="{{ asset('img/fiture-logo.png') }}" 
														style="width: 150px; height: 150px;">
												</div>
												<div class="form-group">
													<label class="col-form-label" for="name">Picture (150x150)</label>
													<input type="file" class="form-control" id="picture" name="picture" placeholder="picture" accept="image/jpg, image/jpeg">
												</div>
												</div>
											</div>
											<!-- <div class="row">
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
											</div> -->
									</div>
								</div>
							</div>
							<!-- end tab 1 -->
							
						</div>
					</div>
				</div>
				<!--end card -->
			</div>
			<div class="col-md-12">
				<!-- <div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Saldo
						<small>management </small>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="form-group col-md-12">
		                      	<i class="fa fa fa-money"></i> <label class="col-form-label" for="dompet">Dompet</label>
		                        	<div class="input-group">
				                          	<span class="input-group-text">Rp.</span>
				                          	<input type="number" class="form-control idr-currency" id="dompet" name="dompet" placeholder="00" aria-describedby="dompet-error">
				                      <em id="dompet-error" class="error invalid-feedback">Please enter a dompet</em>
				                  	</div>
		                      	<i class="fa fa fa-copyright"></i> <label class="col-form-label" for="koin">Koin</label>
		                        	<div class="input-group">
				                          	<span class="input-group-text">Rp.</span>
				                          	<input type="number" class="form-control idr-currency" id="koin" name="koin" placeholder="00" aria-describedby="koin-error">
				                      <em id="koin-error" class="error invalid-feedback">Please enter a koin</em>
				                  	</div>
		                  	</div>
						</div>
					</div>
				</div> -->
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Sub
						<small>Division management </small>
					</div>
					<div class="card-body">
						<div class="option-card1">
						</div>
					<button  type="button" class="btn btn-primary pull-right" id="addMe" onclick="$('.option-card1').append($('.optt').html());refProductChange();"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sub</button>
					</div>
				</div>
			</div>
		</div>
		<!--/.row-->
		<div class="row">
			<div class="attr-multiselect attr-dropdown form-group col-md-12">
				<div class="card">
					<div class="card-body">
                            <!-- <button class="btn btn-primary add_field_btn-primary" >Add Address</button>
						<hr> -->
						<div class="option-card">
							<div class="form-group input_fields_wrap">
								<div class="option-card">
									<div class="form-group">
										<div id="address" class="control-group input-group" style="margin-top:10px">
											<textarea type="text" rows="3" name="address[]" class="form-control" placeholder="Address" aria-describedby="address-error" required></textarea>
											<em id="address-error" class="error invalid-feedback">Please enter a address</em>
										</div>
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
<!-- <div class="fade">
  <div class="opt">
    <div class="form-group">
		<label class="col-form-label" for="address">*Address</label>
    	<div class="input-group">
        	<input type="text" name="address[]" id="address" class="form-control" placeholder="Address" aria-describedby="address-error" required>
        	<span class="input-group-append">
          		<button type="button" class="btn btn-danger" onclick="$(this).closest('.form-group').remove()">
            		<i class="fa fa-close"></i>
          		</button>
        	</span>
        	<em id="address-error" class="error invalid-feedback">Please enter a address</em>
      	</div>
    </div>
  </div>
</div> -->
</form>
@include('panel.member-management.master-member.fade-form-create')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.member-management.master-member.form-create-js')
@endsection