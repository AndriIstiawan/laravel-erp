<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('segment.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Segment</h4>
  </div>
  <div class="modal-body">
      {{ csrf_field() }}
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label class="col-form-label" for="name">*Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" onkeyup="$('#slug').val(convertToSlug($(this).val()));$('#slug').valid();">
                <em id="name-error" class="error invalid-feedback">Please enter a name carriers</em>
            </div>
            <div class="form-group">
                <label class="col-form-label" for="name">*Slug
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Slug attribute"></i>
                </label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error">
                <em id="slug-error" class="error invalid-feedback">Please enter a slug</em>
            </div>
            <div class="form-group">
              <label class="col-form-label">*Attributes</label>
                <select id="attribute" class="form-control" style="width: 100% !important;" name="attribute[]" aria-describedby="attribute-error" multiple="multiple" required>
                  @foreach ($attr as $attr)
                    <option value="{{ $attr->id }}" > {{ $attr->name }} | {{ $attr->type }}</option>
                  @endforeach
                </select>
                <small class="text-muted">
                  You can select one or more attributes where the segment will be displayed
                </small>
                <em id="attribute-error" class="error invalid-feedback">Please enter a name attribute</em>
            </div>
            <!-- <div class="form-group">
              <label class="col-form-label" for="type">*Type</label>
              <select id="type" name="type" class="form-control" style="width: 100%;" aria-describedby="type-error" required>
                <option value=""></option>
                <option value="COD">COD</option>
                <option value="Courier"> Courier</option>
              </select>
              <em id="type-error" class="error invalid-feedback">Please enter a type</em>
            </div>
              <div class="COD box">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-form-label" for="to">*To</label>
                          <input type="to" class="form-control" id="to" name="to" placeholder="JAKARTA" 
                        aria-describedby="name-error">
                      <em id="to-error" class="error invalid-feedback">Please enter a to</em>
                  </div>
                  </div>
                  <div class="col-md-6">
                      <label class="col-form-label" for="price">*Price</label>
                  <div class="input-group">
                          <span class="input-group-text">Rp</span>
                          <input type="number" class="form-control" id="price" name="price" placeholder="Price" 
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
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" 
                        aria-describedby="name-error">
                      <em id="name-error" class="error invalid-feedback">Please enter a name carriers</em>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label class="col-form-label" for="api">*API Key</label>
                          <input type="text" class="form-control" id="api" name="api" placeholder="API" 
                        aria-describedby="api-error">
                      <em id="api-error" class="error invalid-feedback">Please enter a api</em>
                  </div>
                  </div>
                </div>
              </div> -->
            <!-- <div class="form-group">
              <label class="col-form-label" for="status">*Status</label> <p>
                <label class="switch switch-text switch-pill switch-info">
                <input type="checkbox" class="switch-input" id="status" name="status" >
                <span class="switch-label" data-on="On" data-off="Off"></span>
                <span class="switch-handle"></span>
                </label>
            </div> -->
          </div>
        </div>
        <!-- <div class="form-group">
            <label class="col-form-label" for="prices">*Prices</label>
                <input type="number" class="form-control" id="prices" name="price" aria-describedby="prices-error" required>
            <em id="prices-error" class="error invalid-feedback">Please enter a prices</em>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="delivery">*Delivery Text</label>
                <input type="text" class="form-control" id="delivery" name="delivery"  
              aria-describedby="delivery-error">
            <em id="delivery-error" class="error invalid-feedback">Please enter a delivery text</em>
        </div> -->
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

  $('#attribute').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#jxForm').validate({
    rules:{
      name:{required:true,minlength:2},
      attribute:{required:true},
      slug: {
        required: true,
        remote:{
          url: "{{ route('segment.index') }}/find",
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            slug: function(){
              return $('#jxForm :input[name="slug"]').val();
            }
          }
        }
      }
    },
    messages:{
      name:{
        required:'Please enter a name segment',
        minlength:'Name must consist of at least 2 characters'
      },
      attribute:{
        required:'Please enter a value'
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