<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('point.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Point</h4>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    <div class="form-group">
        <label class="col-form-label" for="product">*Product</label>
        <select id="product" class="form-control" style="width: 100%;" name="product[]" aria-describedby="product-error" required>
        <option value=""></option>
        @foreach ($product as $product)
        <option value="{{$product->_id}}">{{$product->name}}</option>
        <option value=></option>
        @endforeach
        </select>
        <em id="product-error" class="error invalid-feedback">Please select product</em>
    </div>
    <div class="form-group">
      <label class="col-form-label" for="point">*Point</label>
      <input type="number" class="form-control idr-currency" id="point" name="point" placeholder="00" aria-describedby="point-error">
      <em id="point-error" class="error invalid-feedback">Please enter a new point</em>
    </div>
  </div>
  <div class="modal-footer">
    <div class="form-group">
      <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add New</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</form>

<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
  $('#product').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#product').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  $('#jxForm').validate({
    rules:{
      product:{required:true},
      point:{required:true},
    },
    messages:{
        point:{
        required:'Please enter a point'
      },
      product:{
        required:'Please enter a level'
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