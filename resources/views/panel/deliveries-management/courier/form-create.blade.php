
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('courier.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New</h4>
  </div>
  <div class="modal-body">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="col-form-label" for="name">*Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Name"
          aria-describedby="name-error">
          <em id="name-error" class="error invalid-feedback">Please enter a name carriers</em>
        </div>
        <div class="form-group">
          <label class="col-form-label" for="price">Prices (optional)</label>
          <input type="text" class="form-control idr-currency" name="price" placeholder="0" value="0">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="status">Status</label> <p>
            <label class="switch switch-text switch-pill switch-info">
              <input type="checkbox" class="switch-input" name="status" >
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Add New</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </form>
  @section('myscript')
  <script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>

  <script>
  $('.idr-currency').on('change', function(){
    var number = $(this).val();
    number = number.replace('.',''); number = number.replace(',','.');
    if(parseFloat(number)){
      number = parseFloat(number);
    }else{
      number = parseFloat("0");
    }
    if(number == '0'){
      number = '';
    }else{
      number = number.toLocaleString('id-ID')
    }
    $(this).val(number);
  });

  $('#type').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#type').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  });
  $('#jxForm').validate({
    rules:{
      name:{required:true,minlength:2},
      type:{required:true},
      to:{required:true,minlength:2},
      api:{required:true},
    },
    messages:{
      name:{
        required:'Please enter a name carriers',
        minlength:'Name must consist of at least 2 characters'
      },
      to:{
        required:'Please enter a to',
        minlength:'Name must consist of at least 2 characters'
      },
      type:{
        required:'Please select a type'
      },
      api:{
        required:'Please select a api'
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
@endsection
