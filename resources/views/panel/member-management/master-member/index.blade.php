@extends('master') @section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
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
                    <a class="btn btn-success ladda-button" href="{{url('master-client/import')}}">
                        <span class="ladda-label">
                            <i class="fa fa-cloud-download">
                            </i>
                            Import Client
                        </span>
                    </a>
                    <a class="btn btn-success ladda-button" href="{{url('master-client/export')}}">
                        <span class="ladda-label">
                            <i class="fa fa-file-excel-o">
                            </i>
                            Export All Client
                        </span>
                    </a>
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
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
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
        responsive: true,
        autoWidth: false,
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
        columnDefs: [
            {
                responsivePriority: 1,
                targets: 0,
            },
            {
                responsivePriority: 4,
                targets: 6,
                className: "text-center"
            }
        ],
        "order": [
            [5, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>
@endsection