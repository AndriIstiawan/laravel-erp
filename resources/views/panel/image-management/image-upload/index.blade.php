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
				<a class="btn btn-primary" href="{{route('image-upload.create')}}">
					 <i class="fa fa-object-group"></i>&nbsp; New Upload Image
				</a>
				</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> Image Table
					</div>
					<div class="card-body">
						<table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
							<thead>
								<tr>
									<th class="text-center">Image</th>
									<th>filename</th>
									<th>size</th>
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
		
	    <div class="modal fade" id="primaryModal">
			<div class="modal-dialog modal-primary" role="document">
				<div class="modal-content">
					<div class="modal-body"><i class="fa fa-gear fa-spin"></i></div>
				</div>
				<!-- /.modal-content -->
			</div>
	      	<!-- /.modal-dialog -->
		</div>
	    <!-- /.modal -->
		
	</div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	//$('#select2-1, .select2-2, #select2-4').select2({theme:"bootstrap"});
	//DATATABLES
	$('.datatable').DataTable({
		processing: true,
	    serverSide: true,
		ajax: '{{route('image-upload.index')}}/list-data',
		columns: [
			{
                data: "filename",
                render: function ( file_id ) {
                    return file_id ?
                        '<center><img class="rounded" src="{{asset("img/storage")}}/'+file_id+'" style="width: 80px; height: 75px;"/></center>' :
                        null;
                },
                defaultContent: "No image",
                title: "Image",
                orderable: false, 
                searchable: false
            },
			{
                data: "filename",
                render: function ( file_id ) {
                    return file_id ?
                        '<a target="_blank" href="{{asset("img/storage")}}/'+file_id+'">'+file_id+'</a>' :
                        null;
                },
                defaultContent: "No image",
                title: "ImageLink"
            },
			{data: 'fileSize', name: 'fileSize'},
			{data: 'created_at', name: 'created_at'},
			{data: 'action', name: 'action', orderable: false, searchable: false}
		],
		"columnDefs": [
			{"targets": 4,"className": "text-center"}
		],
		"order":[[3, 'desc']]
	});
	$('.datatable').attr('style','border-collapse: collapse !important');
		
</script>
@endsection