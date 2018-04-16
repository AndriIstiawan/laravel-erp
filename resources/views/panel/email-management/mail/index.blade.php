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
				<a class="btn btn-primary" href="{{route('mail.create')}}">
					 <i class="fa fa-user-plus"></i>&nbsp; New Blast
				</a>
				</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Blast Table
					</div>
					<div class="card-body">
						<table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
							<thead>
								<tr>
									<th>adminId</th>
									<th>memberEmail</th>
									<th>subject</th>
									<th>content</th>
									<th>comment</th>
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
	        ajax: '{{ route('mail.index')}}/list-data',
	        columns: [
	            {data: 'adminId', name: 'adminId'},
	            {data: 'memberEmail', name: 'memberEmail'},
	            {data: 'subject', name: 'subject'},
	            {data: 'content', name: 'content'},
	            {data: 'comment', name: 'comment'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false, width:'20%'}
	        ],
			"columnDefs": [
				{"targets": 5,"className": "text-center"}
			],
			"order":[[2, 'desc']]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
		
</script>

@endsection

