@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
						<i class="fa fa-align-justify"></i> Add
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
									role="tab" aria-controls="home" aria-selected="false">Role & Permission</a>
							</li>
						</ul>
						<div class="tab-content" id="myTab1Content">
						<!-- TAB CONTENT -->
							
							<div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm1" novalidate="novalidate" method="POST" action="/">
											{{ csrf_field() }}
											<div class="form-group">
												<label class="col-form-label" for="name">*Name</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Name"
													aria-describedby="name-error">
												<em id="name-error" class="error invalid-feedback">Please enter a name user</em>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="email">*Email</label>
												<input type="text" class="form-control" id="email" name="email" placeholder="Email"
													aria-describedby="email-error">
												<em id="email-error" class="error invalid-feedback">Please enter a valid email address</em>
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
										</form>
									</div>
								</div>
							</div>
							<!-- end tab 1 -->
							
							<div class="tab-pane fade" id="rp" role="tabpanel" aria-labelledby="rp-tab">
								<div class="row">
									<div class="col-md-12">
										<form id="jxForm2" novalidate="novalidate" method="POST">
											{{ csrf_field() }}
											<div class="form-group">
												<label class="col-form-label" for="name">Role</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="Name"
													aria-describedby="name-error">
												<em id="name-error" class="error invalid-feedback">Please enter a name user</em>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="email">Access Permission</label>
												<div class="col-md-12 col-form-label">
													<div class="form-check form-check-inline mr-1">
													<input class="form-check-input" type="checkbox" id="inline-checkbox1" value="check1">
													<label class="form-check-label" for="inline-checkbox1">One</label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-form-label" for="email">Menu Permission</label>
												<div class="col-md-12 col-form-label">
													<div class="form-check form-check-inline mr-1">
													<input class="form-check-input" type="checkbox" id="inline-checkbox1" value="check1">
													<label class="form-check-label" for="inline-checkbox1">One</label>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end tab 2 -->
							
							<hr>
							<p>
								<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<button type="button" class="btn btn-success">Save and Continue</button>
									<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false"></button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#">Save and Add New</a>
										<a class="dropdown-item" href="#">Save and Exit</a>
									</div>
								</div>
								<button type="button" class="btn btn-secondary" onclick="window.history.back()">
									<i class="fa fa-times-rectangle"></i>&nbsp; Cancel
								</button>
							</p>
							
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