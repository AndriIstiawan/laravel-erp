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
                    <a href="{{ route('product.create') }}" class="btn btn-primary ladda-button" data-style="zoom-in">
                        <span class="ladda-label">
                            <i class="fa fa-plus">
                            </i>
                            New Products
                        </span>
                    </a>
                    <button class="btn btn-success ladda-button" data-toggle="modal" data-target="#modal-exim">
                        <span class="ladda-label">
                            <i class="fa fa-cloud-download">
                            </i>
                            Import Products
                        </span>
                    </button>
                    <a href="{{route('product.export')}}" class="btn btn-success ladda-button" data-style="zoom-in">
                        <span class="ladda-label">
                            <i class="fa fa-file-excel-o">
                            </i>
                            Export Products
                        </span>
                    </a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Products Table
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm datatable">
                                <thead>
                                    <!-- <tr>
                                        <th rowspan="2" class="text-nowrap">Code</th>
                                        <th rowspan="2" class="text-nowrap">Name</th>
                                        <th rowspan="2" class="text-nowrap">Type</th>
                                        <th rowspan="2" class="text-nowrap">Stock</th>
                                        <th colspan="6" class="text-nowrap">Value</th>
                                        <th rowspan="2" class="text-nowrap">Currency</th>
                                        <th rowspan="2" class="text-nowrap">Date registered</th>
                                        <th rowspan="2" class="text-nowrap"></th>
                                    </tr> -->
                                    <tr>
                                        <th class="text-nowrap">Code</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">Type</th>
                                        <!-- <th class="text-nowrap">Stock</th> -->
                                        
                                        <th class="text-nowrap">Date registered</th>
                                        <th class="text-nowrap"></th>
                                    </tr>

                                    <!-- <tr>
                                        <th class="text-nowrap">250 Gr&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">500 Gr&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">1 Kg&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">5 Kg&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">25 Kg&nbsp;&nbsp;</th>
                                        <th class="text-nowrap">30 Kg&nbsp;&nbsp;</th>
                                    </tr> -->
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
<div class="modal" id="modal-exim" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="{{route('product.import')}}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h3 class="modal-title">Import Product</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-3 " for="name">*Files
                            <a class="btn btn-primary" href="{{route('product.index')}}/download-import-form">
                                <i class="fa fa-download"></i>&nbsp; Download Form
                            </a>
                            <small class="text-muted">Please download form file before import product data.</small>
                        </label>
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
        ajax: "{{ route('product.index') }}/list-data",
        columns: [{
                data: 'code',
                name: 'code'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'type',
                name: 'type'
            },
            // {
            //     data: 'stock',
            //     name: 'stock'
            // },
            // {
            //     data: 'satu',
            //     name: 'satu'
            // },
            // {
            //     data: 'dua',
            //     name: 'dua'
            // },
            // {
            //     data: 'tiga',
            //     name: 'tiga'
            // },
            // {
            //     data: 'empat',
            //     name: 'empat'
            // },
            // {
            //     data: 'lima',
            //     name: 'lima'
            // },
            // {
            //     data: 'enam',
            //     name: 'enam'
            // },
            // {
            //     data: 'currency',
            //     name: 'currency'
            // },
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
        "columnDefs": [
            {"targets": 3,"className": "text-center"}
        ],
        "order": [
            [2, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>
<script type="text/javascript">
    function eximForm() {
        $('#modal-exim').modal('show');
        $('#modal-exim form')[0].reset();
    }
</script>
@endsection