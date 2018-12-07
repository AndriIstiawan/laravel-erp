function funcModal(elm){
    $(".modal-content").html('<div class="modal-body"><i class="fa fa-gear fa-spin"></i></div>');
    $.ajax({
        url: elm.attr('data-link'), 
        success: function(result){
            $(".modal-content").html(result);
        }
    });
}
function refresh(){ $('.datatable').DataTable().ajax.reload(); }