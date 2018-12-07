@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-sm-6">
				<p>
				<button type="button" class="btn btn-primary" onclick="refresh()">
					<i class="fa fa-refresh"></i>
				</button>
				<a class="btn btn-primary collapsed" href="{{url('user-management/create')}}">
					 <i class="fa fa-gear"></i>&nbsp; New user manage
				</a>
				</p>
				<div class="collapse" id="collapseExample" style="">
				<div class="card card-body">
				Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
				</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> User Management Table
					</div>
					<div class="card-body">
						<table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Date registered</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.datatable').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: '{{route('user-management.index')}}/list-data',
	        columns: [
	            {data: 'name', name: 'name'},
	            {data: 'email', name: 'email'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'status', name: 'status'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	        ],
			"columnDefs": [
				{"targets": 4,"className": "text-center"}
			]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
	});
</script>
<script>
	//refresh
	function refresh(){ $('.datatable').DataTable().ajax.reload(); }
</script>
@endsection