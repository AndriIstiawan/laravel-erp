<link href="{{ asset('fiture-style/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('attribute-sets.update',['id' => $attributeSets->id]) }}">
  <div class="modal-header"><h4 class="modal-title">Edit New Attributes Sets</h4>
  </div>
      <div class="modal-body">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
          <div class="form-group">
            <label class="col-form-label" for="name">*Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{ $attributeSets->name }}">{{ $attributeSets->name }}  
              <em id="name-error" class="error invalid-feedback">Please enter a name attributes sets</em>
          </div>
          <div class="form-group">
            <label class="col-form-label">*Attributes</label>
              <select id="attribute" class="form-control" style="width: 100% !important;" name="attribute[]"  aria-describedby="attribute-error" multiple="" selected="" required>
                @foreach ($attributeSets->attributes as $atts)
                  <option value="{{$atts['_id']}}" selected>{{$atts['name']}}</option>
                @endforeach
                
              </select>
              <p class="help-block">You can select one or more attributes where the product will be displayed</p>
          </div>
      </div>
      <div class="modal-footer">
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add New</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
</form>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

<script>
  $('#attribute').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#jxForm').validate({
    rules:{
      name:{required:true,minlength:2},
      attributes:{required:true},
    },
    messages:{
      name:{
        required:'Please enter a name taxes',
        minlength:'Name must consist of at least 2 characters'
      },
      attributes:{
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
  $(document).ready(function() {
    $("submit").click(function(){
        var attributes = [];
        $.each($(".attribute option:selected"), function(){            
            attributes.push($(this).val());
        });
        alert("You have selected the country - " + attributes.join(", "));
    });
});
</script>