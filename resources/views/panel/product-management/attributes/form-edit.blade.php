@extends('master')
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  	<div class="animate fadeIn">
    	<div class="row">
      	<div class="col-lg-2"></div>
      	<div class="col-lg-8">
        	<p>
        	<button type="button" class="btn btn-primary" onclick="window.history.back()">
          		<i class="fa fa-backward"></i>&nbsp; Back to List
        	</button>
        	</p>
        	<form id="jxForm" novalidate="novalidate" method="POST" 
        		action="{{ route('attributes.update',['id' => $attributes->id]) }}">
          	<div class="card">
            	{{ method_field('PUT') }}
				      {{ csrf_field() }}
              	<div class="card-header">
                	<i class="fa fa-align-justify"></i> Add
                	<small>new attributes </small>
              	</div>
            	<div class="card-body">
              	<div class="form-group">
                		<label class="col-form-label" for="name">*Name</label>
                		<input type="text" class="form-control" id="name" name="name" placeholder="Name" 
                			aria-describedby="name-error" value="{{$attributes->name}}">
                		<em id="name-error" class="error invalid-feedback">Please enter a name attributes</em>
              	</div>
            		<div class="form-group">
              			<label class="col-form-label" for="type">*Type</label>
              			<select id="tax" name="type" class="form-control" id="type" aria-describedby="type-error" 
              				required>
                			<option value="{{$attributes->type}}">{{$attributes->type}}</option>
              			</select>
              			<em id="type-error" class="error invalid-feedback">Please enter a new type</em>
            		</div>
            		<div class="multiselect box">
              			<div class="input_fields_wrap">
                			<button class="btn btn-primary add_field_btn-primary" >Add More Fields</button>
              			</div>
              			@foreach($attributes->subtype as $attrSub)
              			<div class="control-group input-group" style="margin-top:10px">
              				<input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here"
              					value="{{$attrSub}}">
                			<div class="input-group-btn">
                    			<button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button>
               				</div>
              			</div>
              			@endforeach
            		</div>
            		<hr>
              		<p>
                		<div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  			<button type="submit" class="btn btn-success">Save and Continue</button>
                		</div>
                		<button type="button" class="btn btn-secondary" onclick="window.history.back()">
                			<i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                		</button>
              		</p>
				      </div>
        	  </div>
      	</form>
    </div>
    </div>
  	</div>
</div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

<script>
  $('#tax').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#jxForm').validate({
    rules:{
      name:{required:true,minlength:2},
      type:{required:true},
      subtype:{required:true,minlength:2}
    },
    messages:{
      name:{
        required:'Please enter a name category',
        minlength:'Name must consist of at least 2 characters'
      },
      type:{
        required:'Please enter a description',
        minlength:'Name must consist of at least 2 characters'
      },
      subtype:{
        required:'Please enter a text',
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
</script>
<script type="text/javascript">
  $(document).ready(function(){
$("select").change(function(){
    $(this).find("option:selected").each(function(){
        if($(this).attr("value")=="text"){
            $(".box").not(".text").hide();
            $(".text").show();
        }else if($(this).attr("value")=="dropdown"){
            $(".box").not(".dropdown").hide();
            $(".dropdown").show();
        }else if($(this).attr("value")=="multiselect"){
            $(".box").not(".multiselect").hide();
            $(".multiselect").show();
        }else{
            $(".box").hide();
        }
    });
}).change();
});
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_btn-primary"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="control-group input-group" style="margin-top:10px"><input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here"><div class="input-group-btn"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus"></i></button></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

  $(document).ready(function() {
//here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
</script>
@endsection