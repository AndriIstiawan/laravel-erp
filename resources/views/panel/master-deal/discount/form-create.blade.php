@extends('master')
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('discount.store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
        <div class="col-lg-2"></div>
			<div class="col-md-8">
			<p>
            <button type="button" class="btn btn-primary" onclick="window.history.back()">
              <i class="fa fa-backward"></i>&nbsp; Back to List
            </button>
          	</p>
				<div class="card">
					<div class="card-header">
					<i class="fa fa-align-justify"></i> Add
					<small>new Discount</small>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="option-card">
								<div class="form-group">
									<label class="col-form-label" for="kode">*Kode Discount
										<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="DN202IH"></i>
									</label>
									<input type="text" class="form-control" id="kode" name="kode" placeholder="DN202IH" aria-describedby="kode-error">
									<em id="kode-error" class="error invalid-feedback">Please enter a valid kode</em>
								</div>
								<label class="col-form-label" for="value">*Value</label>
								<div class="input-group">
									<input type="text" class="form-control idr-currency value" name="value" placeholder="00" aria-describedby="value-error">
									<span class="input-group-text">
										<select name="type" aria-describedby="type-error" required>
											<option value=""></option>
											<option value="Percent">Percent</option>
											<option value="Price">Price</option>
										</select>
									</span>
									<em id="value-error" class="error invalid-feedback">Please enter a value</em>
									<em id="type-error" class="error invalid-feedback">Please enter a type</em>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header">
								<i class="fa fa-align-justify"></i> Unique
								<small>Modifier</small>
							</div>
							<div class="form-group">
								<div class="option-card">
									<div class="col-md-12">
									<label class="col-form-label" for="category">*Category Product</label>
									<select id="category" name="category[]" style="width: 100%;" class="form-control" multiple aria-describedby="category-error">
									@foreach ($category as $category)
		                          		<option value="{{$category->id}}" >{{$category->name}}</option>
		                        	@endforeach
									</select>
									<input type="button" id="select_all" name="select_all" value="Select All">
									<input type="button" id="deselect" name="deselect" value="Deselect All">
									</div>
									<!-- <div class="col-md-12">
									<label class="col-form-label" for="level">*Level Member</label>
									<select id="level" name="level[]" style="width: 100%;" class="form-control" multiple="" aria-describedby="level-error">
									@foreach ($level as $level)
		                          		<option value="{{$level->id}}" >{{$level->name}}</option>
		                        	@endforeach
									</select>
									<input type="button" id="select_all1" name="select_all1" value="Select All">
									<input type="button" id="deselect1" name="deselect1" value="Deselect All">
									</div> -->
									<div class="col-md-12">
									<label class="col-form-label" for="member">*Unique Member</label>
									<select id="member" name="member[]" style="width: 100%;" class="form-control" multiple="" aria-describedby="member-error">
									@foreach ($member as $member)
		                          		<option value="{{$member->id}}" >{{$member->display_name}}</option>
		                        	@endforeach
									</select>
									<input type="button" id="select_all2" name="select_all2" value="Select All">
									<input type="button" id="deselect2" name="deselect2" value="Deselect All">
									</div>
									<div class="col-md-12">
									<label class="col-form-label" for="product">*Name Product</label>
									<select id="product" name="product[]" style="width: 100%;" class="form-control" multiple="" aria-describedby="product-error">
									@foreach ($product as $product)
		                          		<option value="{{$product->id}}" >{{$product->name}}</option>
		                        	@endforeach
									</select>
									<input type="button" id="select_all3" name="select_all3" value="Select All">
									<input type="button" id="deselect3" name="deselect3" value="Deselect All">
									</div>
								</div>
							</div>
						</div>
						<label class="col-form-label" for="odExpire">*Discount Expire
							<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="discount expire"></i>
						</label>
						<div class="input-group">
							<input type="text" id="odExpire" name="disExpire" class="form-control text-right input-number" placeholder="00" required>
							<div class="input-group-append">
								<span class="input-group-text">Hours</span>
							</div>
							<em id="odExpire-error" class="invalid-feedback">Please set discount expire</em>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
						<button type="button" class="btn btn-secondary" onclick="window.history.back()">
							<i class="fa fa-times-rectangle"></i>&nbsp; Cancel
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
@endsection

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>


	$('#select_all').click( function() {
    $('#category option').attr('selected', 'selected');
	});

	$('#deselect').click( function() {
	$("#category option:selected").removeAttr("selected");
	});

	$('#select_all1').click( function() {
    $('#level option').attr('selected', 'selected');
	});

	$('#deselect1').click( function() {
	$("#level option:selected").removeAttr("selected");
	});

	$('#select_all2').click( function() {
    $('#member option').attr('selected', 'selected');
	});

	$('#deselect2').click( function() {
	$("#member option:selected").removeAttr("selected");
	});

	$('#select_all3').click( function() {
    $('#product option').attr('selected', 'selected');
	});

	$('#deselect3').click( function() {
	$("#product option:selected").removeAttr("selected");
	});


	$('#type').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#type').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
	  });

	$('#category').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#category').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
	  });
	  
	  $('#level').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#level').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
	  });

	  $('#product').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#product').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
	  });
	  
	  $('#member').select2({theme:"bootstrap", placeholder:'Please select'});
	$('#member').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  	});
	
	$('#jxForm').validate({
		rules:{
			type:{required:true},
			value:{required:true},
			kode:{
				required:true,
				remote:{
					url: '{{ route('discount.index') }}/find',
					type: "post",
					data:{
						_token:'{{ csrf_token() }}',
						kode: function(){
							return $('#jxForm :input[name="kode"]').val();
						}
					}
				}
			}
		},
		messages:{
			kode:{
				required:'Please enter a kode',
				remote:'Kode already in use. Please use other kode.'
			},
			type:{
				required:'Please select a type',
			},
			value:{
				required:'Please enter a value'
			},
			price:{
				required:'Please enter a price'
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
        if($(this).attr("value")=="Price"){
            $(".box").not(".Price").hide();
            $(".Price").show();
        }else if($(this).attr("value")=="Percent"){
            $(".box").not(".Percent").hide();
            $(".Percent").show();
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
@endsection