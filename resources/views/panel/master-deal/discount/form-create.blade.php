<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('discount.index') }}">

	<div class="modal-header"><h4 class="modal-title">Create New Discount</h4>
	</div>
	<div class="modal-body">
		{{ csrf_field() }}
		
		<div class="form-group">
			<label class="col-form-label" for="name">*Code</label>
			<input type="text" class="form-control" id="code" name="code" placeholder="code product" aria-describedby="name-error">
			<em id="name-error" class="error invalid-feedback">Please enter a code of product</em>
		</div>
		<div class="col-md-6">
            <div class="form-group">
            <label class="col-form-label" >*Price</label>
            <input class="form-control" type="text" name="price" id="total" readonly/>
            </div>
        </div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Discount</label>
			<input type="text" class="form-control" id="discount" name="discount" placeholder="discount" aria-describedby="slug-error">
			<em id="slug-error" class="error invalid-feedback">Please enter the discount</em>
		</div>
		<div class="form-group">
			<label class="col-form-label" for="name">*Time</label>
			<input type="text" class="form-control" id="time" name="time" placeholder="" aria-describedby="slug-error">
			<em id="slug-error" class="error invalid-feedback">Please enter a time</em>
		</div>
		<div class="col-md-6">
            <div class="form-group">
            <label class="col-form-label" >*Price After Discount</label>
            <input class="form-control" type="text" name="priceafter" id="priceafter" readonly/>
            </div>
        </div>
	</div>
	<br>
	<div class="modal-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
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