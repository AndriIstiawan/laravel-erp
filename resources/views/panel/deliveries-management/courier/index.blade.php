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
					<button type="button" class="btn btn-primary new">
					<i class="fa fa-plus"></i>&nbsp; New Courier
					</button>
					</p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<i class="fa fa-align-justify"></i> Courier Table
						</div>
						<div class="card-body">
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Currency</th>
										<th>Prices</th>
										<th>Status</th>
										<th>Date registered</th>
										<th>Action</th>
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
	<div class="modal fade" id="primaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form enctype="multipart/form-data" id="jxForm" novalidate="novalidate" role="form" method="POST" action="{{ route('courier.store') }}">
		    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    			<div class="modal-header" style="background-color:#20a8d8;">
						<h4 style="color:white !important;">New Courier</h4>
		       				<button type="button" class="close" data-dismiss="modal" >
		       					<span aria-hidden="true">&times;</span>
		       					<span class="sr-only">Close</span>
		       				</button>
		       			</div>
		        			<div class="modal-body">
		          				<div class="form-group">
		            				<div class="col-sm-9">
		              					<input type="hidden" class="form-control" name="id">
		            				</div>
		          				</div>
									<div class="form-group">
			          					<label class="col-form-label" for="name">*Name
									        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Name"></i>
										</label>
			          					<input type="text" class="form-control" id="name" name="name" placeholder="Name"
			          					aria-describedby="name-error">
			          					<em id="name-error" class="error invalid-feedback">Please enter a name carriers</em>
								    </div>
									<div class="form-group">
						                <label class="col-form-label" for="code">*Currency (optional)
						                	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Currency"></i>
						            	</label>
						                	<select id="currency" name="currency" style="width:100%; height:50%;">
												<option value=""></option>
						                  	@foreach(app('currency')->options() as $option)
						                  		<option value="{{ $option->label }}">{{ $option->label }}</option>
						                  	@endforeach
						                	</select>
						              	<em id="currency-error" class="error invalid-feedback">Please enter a valid currency</em>
						            </div>
									<div class="form-group">
			          					<label class="col-form-label" for="price">*Prices (optional)
									      	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Price"></i>
										</label>
			          					<input type="text" class="form-control idr-currency" name="price" placeholder="0">
			        				</div>
			        				<div class="form-group">
			          					<label class="col-form-label" for="status">*Status
									        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Status"></i>
										</label><p>
			            				<label class="switch switch-text switch-pill switch-info">
			              					<input type="checkbox" class="switch-input" name="status" >
			              					<span class="switch-label" data-on="On" data-off="Off"></span>
			              					<span class="switch-handle"></span>
										</label></p>
			          				</div>
			        			</div>
		        				<div class="modal-footer">
		          					<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-chevron-left"></i> Cancel</button>
		          					<button type="submit" id="saving" class="btn btn-primary saving"><i class="fa fa-save"></i> Save</button>
		        				</div>
		      			</form>s
					</div>
						<!-- /.modal-content -->
			</div>
			      	<!-- /.modal-dialog -->
		</div>
			    <!-- /.modal -->
	@endsection
	<!-- /.container-fluid -->
	@section('css')
	<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fiture-style/toastr/toastr.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fiture-style/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
	<style>
	.AlignR{
		text-align: right;
	}
	</style>
	@endsection
	@section('myscript')
	<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('fiture-style/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>
	<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
	<script src="{{ asset('js/medivh.js') }}"></script>
	<script src="{{ asset('fiture-style/datatables/dataTables.min.js') }}"></script>
	<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('fiture-style/datatables/dataTables.responsive.min.js') }}"></script>
	<script>
	$(function(){
		var table;
		$.ajaxSetup({
    	headers: {
      	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
  	});
		$('#currency').select2({theme:"bootstrap",placeholder:'Please select'});
		$('#currency').on('change', function(){
		    $(this).addClass('is-valid').removeClass('is-invalid');
		  });
		$(document).off('click', '.new').on('click', '.new', function(e){
			modalShow();
		});
		$(document).off('click', '.edit').on('click', '.edit', function(e){
			var id = $(this).attr('idt');
  		$.ajax({
  			url: 'courier/'+id+'/edit',
  			type: 'get',
  			dataType: "JSON",
  			data: {

  			},
  			success: function (response){
  			$("[name='id']").val(response._id);
  			$("[name='name']").val(response.name);
				$('#currency').val(response.currency).trigger('change');
				$("[name='price']").val(response.price);

				if(response.status == "on"){
					$("[name='status']").prop('checked', true);
				}else{
					$("[name='status']").prop('checked', false);
				}
				//$('#currency option[value="'+response.currency+'"]').prop('selected', true);
  			modalShow();
  			}
  		});
		});
		//refreshing modal form field
		$(document).off('hidden.bs.modal','#primaryModal').on('hidden.bs.modal','#primaryModal', function (e) {
	    $(this)
	    .find("input,textarea,select")
	    .val('')
	    .end()
	    .find("input[type=checkbox], input[type=radio]")
	    .prop("checked", "")
	    .end();
	  	});

		$('.idr-currency').keypress(validateNumber);
	  	$('.idr-currency').priceFormat({
	         prefix:'',
	         centsSeparator:'',
	         centsLimit:'',
	         clearPrefix:true,
	         thousandsSeparator:'.'
	     });
		//DATATABLES
		getData();

			$('#jxForm').validate({
			  rules:{
			    name:{required:true},
			  },
			  messages:{
			    name:{
			      required:'Please enter a name',
			    },
			  },
			  errorElement:'em',
			  errorPlacement:function(error,element){
			    error.addClass('invalid-feedback');
			  },
			  highlight:function(element,errorClass,validClass){
			    $(element).addClass('is-invalid').removeClass('is-valid');
			  },
			  unhighlight:function(element,errorClass,validClass){
			    $(element).addClass('is-valid').removeClass('is-invalid');
			  }
			});

	});
	function modalShow(){
		$('#primaryModal').modal('show');
	}
	function modalHide(){
		$('#primaryModal').modal('hide');
	}

	function getData(){
		table = $('.datatable').DataTable({
			processing: true,
					serverSide: true,
					ajax: '{!! url()->current() !!}/data',
					columns: [
							{data: 'nomor',name: 'nomor',orderable: false, searchable: false, render: function(data, type, row, meta) {  return meta.row + meta.settings._iDisplayStart + 1; }},
							{data: 'name', name: 'name'},
							{data: 'currency', name: 'currency'},
							{data: 'price', name: 'price',sClass: "AlignR"},
							{data: 'status', name: 'status'},
							{data: 'created_at', name: 'created_at'},
							{data: 'action', name: 'action', orderable: false, searchable: false, width:'20%'}
					],
			"columnDefs": [
				{"targets": 3,"className": "text-center"}
			],
			"order":[[2, 'desc']]
		});
		$('.datatable').attr('style','border-collapse: collapse !important');
	}
	</script>
	@endsection
