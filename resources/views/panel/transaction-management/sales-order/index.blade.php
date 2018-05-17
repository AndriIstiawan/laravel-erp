@extends('master') @section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <p>
                    <button type="button" class="btn btn-primary" onclick="refresh()">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <a href="{{ route('sales-order.create') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                        <span class="ladda-label">
                            <i class="fa fa-plus">
                            </i>
                            New Order
                        </span>
                    </a>
                    <a class="btn btn-success ladda-button" href="{{url('sales-order/export')}}">
                        <span class="ladda-label">
                            <i class="fa fa-cloud-download">
                            </i>
                            Export Sales Order
                        </span>
                    </a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Sales Order Table

                    </div>
                    <div class="card-body table-responsive-sm" style="width: 100%;">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SO Code</th>
                                        <th>Client</th>
                                        <th>Sales</th>
                                        <th>Total Kg</th>
                                        <th>TOP</th>
                                        <th>Notes</th>
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

        <div class="modal" id="modal-exim" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Export Sales Order</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <form method="get" action="" novalidate="novalidate">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>From</label>
                                        <input type="date" name="from" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label>To</label>
                                        <input type="date" name="to" id="EndDate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">Export</button>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </form>
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
    //DATATABLES
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("sales-order.index") }}/list-data',
        columns: [
            {
                data: 'code',
                name: 'code'
            },
            {
                data: 'client.[].display_name',
                name: 'client'
            },
            {
                data: 'sales.[].name',
                name: 'sales'
            },
            {
                data: 'conv_total_kg',
                name: 'conv_total_kg'
            },
            {
                data: 'TOP',
                name: 'TOP'
            },
            {
                data: 'notes',
                name: 'notes'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            }
        ],
        "columnDefs": [
            {
                "targets": 3,
                "className": "text-center"
            },
            {
                "targets": 4,
                "className": "text-center"
            },
            {
                "targets": 8,
                "className": "text-center"
            },
            {
                "targets": 7,
                "className": "text-center"
            },
        ],
        "order": [
            [6, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>

@endsection