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
                    <button class="btn btn-success ladda-button" data-toggle="modal" data-target="#modal-exim">
                        <span class="ladda-label">
                            <i class="fa fa-cloud-download">
                            </i>
                            Export Sales Order
                        </span>
                    </button>
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
                                        <th>SO No</th>
                                        <th>Client</th>
                                        <th>Product</th>
                                        <th>Total/kg</th>
                                        <th>Packaging/kg</th>
                                        <th>Amount</th>
                                        <th>Catatan</th>
                                        <th>Commiter</th>
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

        <div class="modal" id="modal-exim" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Export Sales Order</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times; </span>
                            </button>
                        </div>
                    <form method="get" action="{{route('sales-order.export')}}" novalidate="novalidate">
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
                                    <button type="submit" class="btn btn-success pull-right">Export</button><br>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- <div class="modal" id="modal-show" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h3 class="modal-title">Export Sales Order</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times; </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            

                            <div class="card-body table-responsive-sm" style="width: 100%;">
                            <div class="table-responsive">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm datatable" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total/kg</th>
                                        <th>Packaging/kg</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>

<!-- <script type="text/javascript">
        $("#StarDate").datepicker({
            changeMonth: true,
            changeMonth: true,
            changeYear: true,
            yearRange: '2017:+0',
            dateFormat: 'yy/mm/dd',
            onSelect: function(dateText){
                var DateRegistered = $('#StarDate').val();
                var EndDate = $('#EndDate').val();
                listOrder(DateRegistered,EndDate);
            }

        });
        $("#EndDate").datepicker({
            changeMonth: true,
            changeMonth: true,
            changeYear: true,
            yearRange: '2017:+0',
            dateFormat: 'yy/mm/dd',
            onSelect: function(dateText){
                var DateRegistered = $('#StarDate').val();
                var EndDate = $('#EndDate').val();
                listOrder(DateRegistered,EndDate);
            }

        });

</script>
 -->

<script>
    //DATATABLES
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("sales-order.index") }}/list-data',
        columns: [
            { data: 'sono', name: 'sono'},
            { data: 'client.[].name', name: 'client'},
            { data: 'productattr.[<br>].name', name: 'name'},
            { data: 'productattr.[<br>].total', name: 'total'},
            { data: 'productattr.[<br>].packaging', name: 'packaging'},
            { data: 'productattr.[<br>].amount', name: 'amount'},
            { data: 'catatan', name: 'catatan'},
            { data: 'status',name: 'status',orderable: false},
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false, width: '20%' }
        ],
        "columnDefs": [{
                "targets": 9,
                "className": "text-center"
            }
        ],
        "order": [
            [8, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>

@endsection