@extends('master')
@section('content')
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
			<div class="col-sm-6">
				<p>
					<button type="button" class="btn btn-primary" onclick="refresh()">
						<i class="fa fa-refresh"></i>
					</button>
					<a class="btn btn-primary" href="{{route('packaging.create')}}">
						 <i class="fa fa-plus"></i>&nbsp; New Packaging
					</a>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-align-justify"></i> {{$title}}
					</div>
					<div class="card-body" style="width: 100%;">
						<div class="table-responsive">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" style="width: 100%;">
								<thead>
									<tr>
                    <th>#</th>
										<th style="text-align:center">Code</th>
										<th style="text-align:center">Name</th>
										<th style="text-align:center">Description</th>
										<th style="text-align:center">Currency</th>
                    <th style="text-align:center">Price</th>
										<th style="text-align:center">Action</th>
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
@section('css')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
.AlignR{
	text-align: right;
}
.AlignC{
	text-align: center;
}
</style>
@endsection
@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
   var path = 'packaging';
   var table;
</script>
<script src="{{ asset('js/master/packaging/packaging.js') }}"></script>
@endsection
