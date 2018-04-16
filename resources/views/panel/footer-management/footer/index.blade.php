@extends('master')
@section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-sm-6">
				<p>
				<button type="button" class="btn btn-primary" onclick="refresh()">
					<i class="fa fa-refresh"></i>
				</button>
				<a href="{{route('footer.create')}}" class="btn btn-primary ladda-button" data-style="zoom-in">
					<span class="ladda-label">
						<i class="fa fa-plus">
						</i>&nbsp;
							New Footer
					</span>
				</a>
				<!-- <a class="btn btn-primary" href="{{url('footer/reorder')}}">
					 <i class="fa fa-random"></i>&nbsp; Reorder Categories
				</a> -->
				</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Categories Table
					</div>
					<div class="card-body">
						<table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
							<thead>
								<tr>
									<th>Left</th>
									<th>Middle</th>
									<th>Contacs Us</th>
									<th>Mitra Pembayaran</th>
									<th>Copyright</th>
									<th>Date Registered</th>
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
	    <!-- /.modal -->
		
	</div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

<script>
	//DATATABLES
		$('.datatable').DataTable({
			processing: true,
	        serverSide: true,
	        ajax: '{{route('footer.index')}}/list-data',
	        columns: [
	            {data: 'left.[<br>].name', name: 'name'},
	            {data: 'address', name: 'address'},
	            {data: 'middle.[<br>].value', name: 'value'},
	            {
                data: "mitra.[<br>].filename",
                render: function ( file_id ) {
                    return file_id ?
                        '<center><img class="rounded" src="{{ asset("img/avatars")}}/'+file_id+'" style="width: 80px; height: 75px;"/></center>' :
                        null;
                },
                defaultContent: "No image",
                title: "Mitra",
                orderable: false, 
                searchable: false
            	},
	            {data: 'copyright', name: 'copyright'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'action', name: 'action', orderable: false, searchable: false, width:'20%'}
	        ],
			"columnDefs": [
				{"targets": 6,"className": "text-center"}
			],
			"order":[[5, 'desc']]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
		
</script>
@endsection