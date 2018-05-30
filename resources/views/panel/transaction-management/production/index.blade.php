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
                                        <th>Product</th>
                                        <th>White_label</th>
                                        <th>Produser</th>
                                        <th>Status</th>
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
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>

<script>
    //DATATABLES
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("production.index") }}/list-data',
        columns: [{
                data: 'code',
                name: 'code'
            },
            {
                data: 'products.[<br>].name',
                name: 'name'
            },
            {
                data: 'white_label',
                name: 'white_label'
            },
            {
                data: 'products.[<br>].produksi',
                name: 'produksi'
            },
            {
                data: 'status',
                name: 'status',
                orderable: false
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
                width: '20%'
            }
        ],
        "columnDefs": [{
                "targets": 6,
                "className": "text-center"
            },
            {
                "targets": 4,
                "className": "text-center"
            }
        ],
        "order": [
            [5, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>

@endsection