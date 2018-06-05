$(function(){
  getData();
});

function getData(){
    table = $('table').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        destroy: true,
        bFilter:true,
        searching: true,
        order: [],
        ajax: path+'/show',

        columns: [
            {data: 'nomor',name: 'nomor',orderable: false, searchable: false, render: function(data, type, row, meta) {  return meta.row + meta.settings._iDisplayStart + 1; }},
            {data: 'code', name: 'code', orderable: true, searchable: true},
            {data: 'name', name: 'name', orderable: true, searchable: false},
            {data: 'description', name: 'description', orderable: true, searchable: false},
            {data: 'currency', name: 'currency', orderable: true, searchable: false, sClass: "AlignC"},
            {data: 'price', name: 'price', orderable: true, searchable: false, sClass: "AlignR"},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });
}
