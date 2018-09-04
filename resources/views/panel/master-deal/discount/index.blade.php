@extends('master') @section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-sm-6">
                <p>
                    <button type="button" class="btn btn-primary" onclick="refresh()">
                        <i class="fa fa-refresh"></i>
                    </button>
                    <a class="btn btn-primary" href="{{route('promo.create')}}">
                        <i class="fa fa-plus"></i>&nbsp; New Promo
                    </a>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Promo Table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Promo :</th>
                                        <th class="text-nowrap">Value :</th>
                                        <th class="text-nowrap">Costumer</th>
                                        <th class="text-nowrap">Tipe Promosi</th>
                                        <th class="text-nowrap">Unique Modifier :</th>
                                        <th class="text-nowrap">Start Date :</th>
                                        <th class="text-nowrap">Expired Date :</th>
                                        <th class="text-nowrap">Date registered :</th>
                                        <th class="text-nowrap">Status :</th>
                                        <th class="text-nowrap"></th>
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
        ajax: '{{ route("promo.index")}}/list-data',
        columns: [
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'value_set',
                name: 'value_set'
            },
            {
                data: 'members.[0].display_name',
                name: 'value_set'
            },
            {
                data: 'tipe_promosi.[0].name',
                name: 'value_set'
            },
            {
                data: 'unique_modifier',
                name: 'unique_modifier'
            },
            {
                data: 'start_date',
                name: 'expired_date'
            },
            {
                data: 'expired_date',
                name: 'expired_date'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status_set',
                name: 'status_set'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            }
        ],
        columnDefs: [{
                responsivePriority: 1,
                targets: 0,
            },
            {
                targets: 8,
                className: "text-center"
            },
            {
                responsivePriority: 4,
                targets: 9,
                className: "text-center"
            }
        ],
        "order": [
            [7, 'desc']
        ]
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');

    function discountSetting(elm){
        swal({
            title: "Are you sure want to change status discount?",
            text: "Please make sure discount you want set..",
            buttons: true,
        }).then((confirm) => {
            if(confirm){
                var action = elm.is(":checked");
                var id = elm.attr('data-id');
                $.ajax({
                    url: '{{ route("promo.index")}}/discount-setting',
                    type: 'GET',
                    data:{action:action, id:id},
                    success: function (response) {
                        if(response == 'success'){
                            swal({
                                title: "Discount set successfuly.",
                            });
                            toastr.success('Successful set discount status..', 'An discount has been set.');
                        }else{
                            swal({
                                title: "Process invalid",
                                text: "Please contact technical support.",
                                dangerMode: true,
                            });
                            refresh();
                        }
                    },
                    error: function (e) {
                        swal({
                            title: "Process invalid",
                            text: "Please contact technical support.",
                            dangerMode: true,
                        });
                        refresh();
                    }
                });
            }else{
                //refresh datatables
                refresh();
            }
        });
    }
</script>

@endsection