<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('archievement.index') }}">
  <div class="modal-header"><h4 class="modal-title">Create New Archievement</h4>
  </div>
  <div class="modal-body">
      {{ csrf_field() }}
        <div class="form-group">
            <label class="col-form-label" for="name">*Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" 
              aria-describedby="name-error">
            <em id="name-error" class="error invalid-feedback">Please enter a name level</em>
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group">
              <label class="col-form-label" for="point">*Point</label>
                  <input type="number" class="form-control idr-curency" id="point" name="point" placeholder="Point" 
                aria-describedby="point-error">
              <em id="point-error" class="error invalid-feedback">Please enter a point</em>
          </div>
          </div>
        </div>
        <!-- 
        <div class="form-group">
          <label class="col-form-label" for="type">*Type</label>
          <select id="type" name="type" class="form-control" style="width: 100%;" aria-describedby="type-error" required>
            <option value=""></option>
            <option value="Pcs">Order/pcs</option>
            <option value="Price"> Order/price</option>
          </select>
          <em id="type-error" class="error invalid-feedback">Please enter a type</em>
        </div>
          <div class="Pcs box">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                  <label class="col-form-label" for="frompcs">*From</label>
                      <input type="number" class="form-control" id="frompcs" name="frompcs" placeholder="From" 
                    aria-describedby="frompcs-error">
                  <em id="frompcs-error" class="error invalid-feedback">Please enter a from</em>
              </div>
              </div>
              <div class="col-md-6">
                  <label class="col-form-label" for="topcs">*To</label>
              <div class="input-group">
                      <input type="number" class="form-control" id="topcs" name="topcs" placeholder="To" 
                    aria-describedby="to-error">
                  <em id="topcs-error" class="error invalid-feedback">Please enter a to</em>
              </div>
              </div>
            </div>
          </div>
          <div class="Price box">
            <div class="row">
              <div class="col-md-6">
                  <label class="col-form-label" for="from">*From</label>
              <div class="input-group">
                      <span class="input-group-text">Rp</span>
                      <input type="number" class="form-control currency" id="from" name="from" placeholder="00" 
                    aria-describedby="from-error">
                  <em id="from-error" class="error invalid-feedback">Please enter a from</em>
              </div>
              </div>
              <div class="col-md-6">
                  <label class="col-form-label" for="to">*To</label>
              <div class="input-group">
                      <span class="input-group-text">Rp</span>
                      <input type="number" class="form-control currency" id="to" name="to" placeholder="To" 
                    aria-describedby="to-error">
                  <em id="to-error" class="error invalid-feedback">Please enter a to</em>
              </div>
              </div>
            </div>
          </div> -->
        <div class="form-group">
          <label class="col-form-label" for="level">*Level</label>
          <select id="level" class="form-control" style="width: 100%;" name="level[]" aria-describedby="level-error" required>
            <option value=""></option>
            @foreach ($level as $level)
            <option value="{{$level->_id}}">{{$level->name}}</option>
            <option value=></option>
            @endforeach
          </select>
          <em id="level-error" class="error invalid-feedback">Please select level</em>
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
  $('#level').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#level').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  $('#type').select2({theme:"bootstrap", placeholder:'Please select'});
  $('#type').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  $('#jxForm').validate({
    rules:{
      name:{required:true},
      start:{required:true},
      to:{required:true},
      level:{required:true}
    },
    messages:{
      name:{
        required:'Please enter a name archievement'
      },
      start:{
        required:'Please enter a start'
      },
      to:{
        required:'Please enter a to'
      },
      level:{
        required:'Please enter a level'
      },
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
        }else if($(this).attr("value")=="Pcs"){
            $(".box").not(".Pcs").hide();
            $(".Pcs").show();
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