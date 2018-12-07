@extends('master') @section('content')
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/daterangepicker/daterangepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/datatables/responsive.dataTables.min.css') }}" rel="stylesheet">
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
                            Export All Sales Order
                        </span>
                    </a>
                    <button type="button" class="btn btn-success ladda-button" onclick="downloadSelected()">
                        <span class="ladda-label">
                            <i class="fa fa-file-excel-o">
                            </i>
                            &nbsp;Export Selected
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-7">
                                        <div class="input-group">
                                            <input type="text" id="date-filter" class="form-control" name="daterange">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" onclick="filter()">
                                                    <i class="fa fa-filter"></i>&nbsp;Filter Date</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table _fordragclass="table-responsive-sm" class="table table-bordered table-striped table-sm display responsive datatable"
                                    cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="padding:0 10px 5px 10px;">
                                            <input name="select_all" value="1" id="example-select-all" type="checkbox" />
                                        </th>
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
    </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('fiture-style/datatables/dataTables.responsive.min.js') }}"></script>
<!-- date range picker -->
<script src="{{ asset('fiture-style/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('fiture-style/daterangepicker/daterangepicker.js') }}"></script>
<script>
    var dateStart = "";
    var dateEnd = "";
    var arrList = [];
    $('#date-filter').daterangepicker({
        opens: 'right',
        ranges: {
            Today: [moment(), moment()],
            Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }).change(function () {
        var daterange = $(this).val().split(' - ');
        dateStart = daterange[0];
        dateEnd = daterange[1];
    });

    //DATATABLES
    var table = $('.datatable').DataTable({
        serverSide: true,
        processing: true,
        serverSide: true,
        iDisplayLength: 10,
        pagingType: "full_numbers",
        ajax: '{{ route("sales-order.index") }}/list-data?dateStart=' + dateStart + '&dateEnd=' + dateEnd,
        columns: [{
                data: 'checkbox',
                name: 'checkbox'
            },
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
        "columnDefs": [{
                "targets": 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center text-center',
            },
            {
                "targets": 4,
                "className": "text-center"
            },
            {
                "targets": 5,
                "className": "text-center"
            },
            {
                "targets": 7,
                "className": "text-center"
            },
            {
                "targets": 8,
                "className": "text-center"
            },
            {
                "targets": 9,
                "className": "text-center"
            },
        ],
        "order": [
            [7, 'desc']
        ],
        "drawCallback": function (settings) {
            $('#example-select-all').prop('checked',true);
            var status = $('.data-list').map(function(){
                if($.inArray(this.value, arrList) != -1){
                    $(this).prop('checked',true);
                }else{
                    $('#example-select-all').prop('checked',false);
                }
            });
        }
    });
    $('.datatable').attr('style', 'border-collapse: collapse !important');

    // Handle click on "Select all" control
    $('#example-select-all').on('click', function () {
        // Check/uncheck all checkboxes in the table
        var rows = table.rows({
            'search': 'applied'
        }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        if(this.checked === true){
            $('.data-list').map(function(){ 
                var data = $(this).attr('id');
                if($.inArray(data, arrList) == -1){
                    arrList.push(data);
                }
            });
        }else{
            $('.data-list').map(function(){ 
                var data = $(this).attr('id');
                arrList.splice( $.inArray(data, arrList), 1 );
            });
        }
        console.log(arrList);
    });

    var daterange = $('#date-filter').val().split(' - ');
    dateStart = daterange[0];
    dateEnd = daterange[1];

    function filter() {
        if (dateStart != "") {
            $('.datatable').DataTable().ajax.url('{{ route("sales-order.index") }}/list-data?dateStart=' + dateStart +
                '&dateEnd=' + dateEnd).load();
        }
    }

    function selected(elm){
        if(elm.checked === true){
            arrList.push(elm.value);
        }else{
            arrList.splice( $.inArray(elm.value, arrList), 1 );
        }

        $('#example-select-all').prop('checked',true);
        var status = $('.data-list').map(function(){ 
            if(this.checked === false){
                $('#example-select-all').prop('checked',false);
            }
        });
    }

    function downloadSelected(){
        if(arrList.length > 0){
            $.ajax({
            	url : "{{url('sales-order/export')}}",
            	type: 'GET',
            	data : {arrList: arrList},
            	success : function(response){
                    window.open("{{url('/download-storage')}}/true/"+response, "_self");
            	},
            	error : function(e){
                    toastr.warning('Error processing export, please report technical..', 'Export selected failed..');
            	}
            });
        }else{
            toastr.warning('No data selected, please select data..', 'Export selected failed..');
        }
    }
</script>

@endsection