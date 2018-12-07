<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('discount.index') }}">

	<div class="modal-header"><h4 class="modal-title">Create New Discount</h4>
	</div>
	<div class="card-body table-responsive-sm" style="width: 100%;">
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-bordered table-striped table-sm datatable" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total/kg</th>
                                        <th>Packaging/kg</th>
                                        <th>Amount</th>
                                        <th>Catatan</th>
                                        <th>Commiter</th>
                                        <th>Date registered</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
	<br>
	<div class="modal-footer">
		<div class="form-group">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>
<script>
	function findTotal(){
	    // var arr = document.getElementsByName('price');
	    // var tot=0;
	    // for(var i=0;i<arr.length;i++){
	    //     if(parseInt(arr[i].value))
	    //         tot += parseInt(arr[i].value);
	    // }
	    // document.getElementById('total').value = tot;
	    var value = $('#tax option:selected').attr('data-value');
	    var price = parseInt($('#price').val())+($('#price').val()*value/100);
	    $('#total').val(price);

    }
	$('#jxForm').validate({
		rules:{
			code:{required:true,minlength:1},
			discount:{required:true,minlength:1},
			time:{required:true,minlength:1},
		},
		messages:{
			code:{
				required:'Please enter a code of product',
				minlength:'fill the blank'
			},
			discount:{
				required:'Please enter a discount',
				minlength:'fill the discount'
			},
			time:{
				required:'Please enter a time',
				minlength:'fill the time'
			}
		},
		errorElement:'em',
		errorPlacement:function(error,element){
			error.addClass('invalid-feedback');
		},
		highlight:function(element,errorClass,validClass){
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight:function(element,errorClass,validClass){
			$(element).addClass('is-valid').removeClass('is-invalid');
		}
	});
</script>