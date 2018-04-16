<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('courier.update',['id' => $carriers->id]) }}">
	<div class="modal-header"><h4 class="modal-title">Edit New</h4>
	</div>
	<div class="modal-body">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="row">
          	<div class="col-md-12">
            	<div class="form-group">
              		<label class="col-form-label" for="type">*Type</label>
              		<select id="type" name="type" class="form-control" style="width: 100%;" aria-describedby="type-error" required>
                		<option value=""></option>
                		<option value="COD" {{($carriers->type == 'COD'?'selected':'')}}>COD</option>
                		<option value="Courier" {{($carriers->type == 'Courier'?'selected':'')}}> Courier</option>
              		</select>
              		<em id="type-error" class="error invalid-feedback">Please enter a new type</em>
            	</div>
              	<div class="COD box">
                	<div class="row">
                  		<div class="col-md-6">
                  			<div class="form-group">
                      			<label class="col-form-label" for="to">*To</label>
                          			<input type="to" class="form-control" id="to" name="to" value="{{$carriers['to']}}" placeholder="JAKARTA" 
                        			aria-describedby="name-error">
                      			<em id="to-error" class="error invalid-feedback">Please enter a to</em>
                  			</div>
                  		</div>
                  		<div class="col-md-6">
                      		<label class="col-form-label" for="price">*Price</label>
                  			<div class="input-group">
                          		<span class="input-group-text">Rp</span>
                          		<input type="number" class="form-control" id="price" name="price" value="{{$carriers['price']}}" placeholder="Price" 
                        		aria-describedby="api-error">
                      			<em id="api-error" class="error invalid-feedback">Please enter a api</em>
                  			</div>
                  		</div>
                	</div>
              	</div>
              	<div class="Courier box">
                	<div class="row">
                  		<div class="col-md-6">
                  			<div class="form-group">
					            <label class="col-form-label" for="name">*Name</label>
					                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$carriers['name']}}" aria-describedby="name-error">
					            <em id="name-error" class="error invalid-feedback">Please enter a name courier</em>
					        </div>
                  		</div>
	                  	<div class="col-md-6">
		                  	<div class="form-group">
					            <label class="col-form-label" for="api">*API Key</label>
					                <input type="text" class="form-control" id="api" name="api" placeholder="API" value="{{$carriers['api']}}" aria-describedby="api-error">
					            <em id="api-error" class="error invalid-feedback">Please enter a api</em>
					        </div>
	                  	</div>
                	</div>
              	</div>
            <div class="form-group">
              <label class="col-form-label" for="status">*Status</label> <p>
                <label class="switch switch-text switch-pill switch-info">
                <input type="checkbox" class="switch-input" id="status" name="status" {{($carriers->status? 'checked': '')}} tabindex="-1">
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
            </div>
          	</div>
        </div>
        <!-- <div class="form-group">
            <label class="col-form-label" for="prices">*Prices</label>
                <input type="number" class="form-control" id="prices" name="price" value="{{$carriers['price']}}" aria-describedby="prices-error">
            <em id="prices-error" class="error invalid-feedback">Please enter a prices</em>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="delivery">*Delivery Text</label>
                <input type="text" class="form-control" id="delivery" name="delivery"  value="{{$carriers['delivery']}}"  aria-describedby="delivery-error">
            <em id="delivery-error" class="error invalid-feedback">Please enter a delivery text</em>
        </div> -->
	</div>
	<div class="modal-footer">
		<div class="form-group">
			<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
</form>

<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

<script>
	$('#type').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#type').on('change', function(){
	   $(this).addClass('is-valid').removeClass('is-invalid');
	});
	$('#jxForm').validate({
		rules:{
			name:{required:true,minlength:2},
			delivery:{required:true,minlength:2},
			prices:{required:true,number:true},
			api:{required:true},
		},
		messages:{
			name:{
				required:'Please enter a name courier',
				minlength:'Name must consist of at least 2 characters'
			},
			delivery:{
				required:'Please enter a delivery text',
				minlength:'Name must consist of at least 2 characters'
			},
			api:{
				required:'Please enter a api'
			},
			prices:{
				required:'Please enter a value',
				minlength:'Name must consist of at least 2 characters'
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
$(document).ready(function(){
$("select").change(function(){
    $(this).find("option:selected").each(function(){
        if($(this).attr("value")=="Courier"){
            $(".box").not(".Courier").hide();
            $(".Courier").show();
        }else if($(this).attr("value")=="COD"){
            $(".box").not(".COD").hide();
            $(".COD").show();
        }else if($(this).attr("value")=="multiselect"){
            $(".box").not(".multiselect").hide();
            $(".multiselect").show();
        }else{
            $(".box").hide();
        }
    });
}).change();
});
</script>