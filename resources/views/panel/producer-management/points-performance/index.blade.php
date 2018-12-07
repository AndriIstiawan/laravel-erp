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
                    <!-- <a class="btn btn-primary" href="{{route('productions-staff.create')}}">
                        <i class="fa fa-user-plus"></i>&nbsp; New Producer
                    </a> -->
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Points Performance Table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <!-- <th>Username</th> -->
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Point</th>
                                        <!-- <th>Date registered</th> -->
<!--                                         <th></th> -->
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
        ajax: '{{route("points-performance.index")}}/list-data',
        columns: [{
                data: 'name',
                name: 'name'
            },
/*            {
                data: 'username',
                name: 'username'
            },*/
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'role.[].name',
                name: 'status',
            },
            {
                data: 'points',
                name: 'points',
            },/*
            {
                data: 'created_at',
                name: 'created_at'
            },*/
/*            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '20%'
            }*/
        ],
        columnDefs: [
            {
                responsivePriority: 1,
                targets: 0,
            },
            {
                responsivePriority: 2,
                targets: 3,
                className: "text-center"
            }
        ],
        "order": [
            [3, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');
</script>
@endsection