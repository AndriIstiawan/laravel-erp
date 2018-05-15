@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/toastr/toastr.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-sm-6">
				<p>
					<button type="button" class="btn btn-primary" onclick="refresh()">
						<i class="fa fa-refresh"></i>
					</button>
					<a class="btn btn-primary" href="{{route('discount.create')}}"				 >
						 <i class="fa fa-plus"></i>&nbsp; New Discount
					</a>
				</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Products Table
					</div>
					<div class="card-body">
						<table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Type</th>
									<th>Value</th>
									<th>Category</th>
									<!-- <th>Levels</th> -->
									<th>Members</th>
									<th>Products</th>
									<th>DisExpired/Hours</th>
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
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>

<script>
	//DATATABLES
		$('.datatable').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: '{{ route('discount.index')}}/list-data',
	        columns: [
	            {data: 'kode', name: 'kode'},
	            {data: 'type', name: 'type'},
	            {data: 'value', name: 'value'},
	            {data: 'type_product.[<br>].name', name: 'category'},/*
	            {data: 'level.[<br>].name', name: 'level'},*/
	            {data: 'client.[<br>].display_name', name: 'member'},
	            {data: 'product.[<br>].name', name: 'product'},
	            {data: 'disExpire', name: 'disExpire'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false, width:'20%'}
	        ],
			"columnDefs": [
				{"targets": 8,"className": "text-center"}
			],
			"order":[[7, 'desc']]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
		
</script>

@endsection

