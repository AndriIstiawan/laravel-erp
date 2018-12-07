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
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"> </i>Quality Control
                    </div>
                    <div class="card-body" style="width: 100%;">
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>SO Code</th>
                                        <th style="width:50%">Product</th>
                                        <th>White Label</th>
                                        <th>Date registered</th>
                                        <th>Package</th>
                                        <th>Qty</th>
                                        <th>W/Pkg</th>
                                        <th>Total</th>
                                        <th>Realisasi</th>
                                        <th>Tgl Pass</th>
                                        <th>Tgl Reject</th>
                                        <th>Status QC</th>
                                        <th style="width:50%; text-align:center;">Action</th>
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

    $('.datatable').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        destroy: true,
        bFilter:true,
        searching: true,
        order: [],
        ajax: 'qc/show',
        columns: [
          {data: 'so', name: 'so', orderable: true, searchable: true},
          {data: 'product_name', name: 'product_name', orderable: true, searchable: true},
          {data: 'white_label', name: 'white_label', orderable: true, searchable: true},
          {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
          {data: 'package', name: 'package', orderable: true, searchable: true},
          {data: 'quantity', name: 'quantity', orderable: true, searchable: true},
          {data: 'weight', name: 'weight', orderable: true, searchable: true},
          {data: 'total', name: 'total', orderable: true, searchable: false},
          {data: 'realisasi', name: 'realisasi', orderable: true, searchable: false},
          {data: 'tgl_pass', name: 'tgl_pass', orderable: false, searchable: false},
          {data: 'tgl_reject', name: 'tgl_reject', orderable: false, searchable: false},
          {data: 'status', name: 'status', orderable: false, searchable: true},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
      });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>

@endsection
