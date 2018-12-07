@extends('master')
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('production.store') }}" enctype="multipart/form-data">
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
        <i class="fa fa-align-justify"></i> Production
        <small>Order</small>
      </div>
      <div class="card-body">
        <div class="form-group">
          <div class="option-card">
            <div class="form-group">
							<input type="hidden" name="id" value="{{$id}}">
							<input type="hidden" name="index" value="{{$index}}">
              <label class="col-form-label" for="product">Product</label>
              <input type="text" class="form-control" id="product" name="product_name" value="{{$product_name}}" readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label">Package</label>
              <input type="text" class="form-control" id="package" name="package" value="{{$package}}" readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label">Quantity</label>
              <input type="text" class="form-control" id="quantity" name="quantity" value="{{$quantity}}" readonly>
            </div>
            <div class="form-group">
              <label class="col-form-label">Weight</label>
							<div class="input-group">
              	<input type="text" class="form-control" id="weight" name="weight" value="{{$weight}}" readonly>
								<span class="input-group-text">Kg</span>
							</div>
            </div>
						<div class="form-group">
							<label class="col-form-label">Total</label>
							<div class="input-group">
              	<input type="text" class="form-control" id="total" name="total" value="{{$total}}" readonly>
								<span class="input-group-text">Kg</span>
							</div>
            </div>
						<div class="form-group">
							<label class="col-form-label">Realisasi</label>
							<div class="input-group">
              	<input type="text" class="form-control" id="realisasi" name="realisasi" value="">
								<span class="input-group-text">Kg</span>
							</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
              </button>
              <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/medivh.js') }}"></script>
<script>
$(function(){
	$('#realisasi').keypress(validateNumber);
})
</script>
@endsection
