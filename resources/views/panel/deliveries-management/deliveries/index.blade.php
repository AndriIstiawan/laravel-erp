@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/toastr/toastr.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-sm-6">
				<p>
				<button type="button" class="btn btn-primary" onclick="refresh()">
					<i class="fa fa-refresh"></i>
				</button>
				<!-- <a href="{{ route('deliveries.create') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
					<span class="ladda-label">
						<i class="fa fa-search">
						</i>
							View Deliveries
					</span>
				</a> -->
				</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Deliveries Table
					</div>
					<div class="card-body">
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Deliveries ID</th>
									<th>Name</th>
									<th>Status</th>
									<th>Date registered</th>
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
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.responsive.min.js') }}"></script>

<script>
	//DATATABLES
		$('.datatable').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: '{!! url()->current() !!}/data',
	        columns: [
	            {data: 'code', name: '_id'},
	            {data: 'delivery.[].name', name: 'type'},
	            {data: 'status', name: 'status'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false, width:'20%'}
	        ],
			"columnDefs": [
				{"targets": 4,"className": "text-center"}
			],
			"order":[[3, 'desc']]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
		
</script>
@endsection