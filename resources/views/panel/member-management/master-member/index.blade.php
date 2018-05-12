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
                    <a class="btn btn-primary" href="{{route('master-client.create')}}">
                        <i class="fa fa-plus"></i>&nbsp; New Client
                    </a>
                    <button class="btn btn-success ladda-button" data-toggle="modal" data-target="#modal-exim1">
                        <span class="ladda-label">
                            <i class="fa fa-cloud-download">
                            </i>
                            Import Products
                        </span>
                    </button>
                    <button class="btn btn-success ladda-button" data-toggle="modal" data-target="#modal-exim">
                        <span class="ladda-label">
                            <i class="fa fa-file-excel-o">
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
                        <i class="fa fa-align-justify"></i> Master Client Table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Code</th>
                                        <th class="text-nowrap">Display Name&nbsp;&nbsp;</th>
                                        <th>Mobile&nbsp;&nbsp;</th>
                                        <th>Sales&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">Billing Address&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">Date registered&nbsp;&nbsp;</th>
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
                    <form method="get" action="{{route('client.export')}}" novalidate="novalidate">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- <div class="row">
                                    <div class="col-md-5">
                                        <label>From</label>
                                        <input type="date" name="from" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label>To</label>
                                        <input type="date" name="to" id="EndDate" class="form-control" required>
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">Export</button><br>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-exim1" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('client.import')}}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Import Product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <!-- <label class="col-md-3 " for="name">*Files
                            <a class="btn btn-primary" href="{{route('product.index')}}/download-import-form">
                                <i class="fa fa-download"></i>&nbsp; Download Form
                            </a>
                            <small class="text-muted">Please download form file before import product data.</small>
                        </label> -->    
                        <div class="col-md-6">
                            <input type="file" id="file" name="file" class="form-control" accept=".xlsx" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
        ajax: '{{route("master-client.index")}}/list-data',
        columns: [{
                data: 'code',
                name: 'code'
            },
            {
                data: 'display_name',
                name: 'display_name'
            },
            {
                data: 'mobile.[ / ].number',
                name: 'mobile'
            },
            {
                data: 'sales.[0].name',
                name: 'sales'
            },
            {
                data: 'billing_address',
                name: 'billing_address'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'created_at',
                name: 'created_at'
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
            "targets": 5,
            "className": "text-center"
            },
            {
            "targets": 6,
            "className": "text-center text-nowarp"
            },
        ],
        "order": [
            [5, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>
@endsection