@extends('master')
@section('content')
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
        <!--start card -->
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Branch
            <small></small>
          </div>
          <div class="card-body">
            
            <div class="tab-content" id="myTab1Content">
            <!-- TAB CONTENT -->
              
              <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                  <div class="col-md-12">
                    <form id="jxForm1" onsubmit="return false;" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" class="id" name="id">
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label" for="name">*Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="name brand" aria-describedby="name-error">
                          <em id="name-error" class="error invalid-feedback">Please enter a name of brand</em>
                        </div>
                        <div class="text-center">
                            <img class="rounded picturePrev" src="{{ asset('img/fiture-logo.png') }}" 
                              style="width: 150px; height: 150px;">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label" for="name">Picture (150x150)</label>
                          <input type="file" class="form-control" id="picture" name="picture" placeholder="picture">
                          </div>
                        </div>
                      </div>
                      <hr>
                      <p>
                        <button type="button" class="btn btn-success" onclick="save('#jxForm1','','exit')"> &nbsp; Save</button>
                        
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                          <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                        </button>
                      </p>
                    </form>
                  </div>
                </div>
              </div>
              <!-- end tab 1 -->
              
            </div>
          </div>
        </div>
        <!--end card -->
      </div>
    </div>
  </div>
</div>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
  var progressStat = false;

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e){ $('.picturePrev').attr('src', e.target.result); }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#picture").change(function (){ readURL(this); });
  
  $("#jxForm1").validate({
    rules:{
      name:{required:true,minlength:1},
      slug:{required:true,minlength:1},
    },
    messages:{
      name:{
        required:'Please enter a name of branch',
        minlength:'fill the blank'
      },
      
      slug:{
        required:'Please enter a slug of brand',
        minlength:'fill the blank'
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
  
  function save(formAct1,formAct2,action){
    var sendForm = ( formAct1 != '' ? formAct1 : formAct2 );
    
    //check form Tab 1 GENERAL
    if(formAct1 != ''){
      $('#general-tab').click();
      setTimeout(function(){
        if($("#jxForm1").valid()){
          postData(formAct1,formAct2,action,sendForm);
        }
      }, 400);
    }
    
    
  }
  
  function postData(formAct1,formAct2,action,sendForm){
    if(!progressStat){
      $('.showProgress').click();
      progressStat = true;
    }
    
    $.ajax({
      url : "{{ route('warehouse-branch.index') }}",
      type: 'POST',
      processData: false,
          contentType: false,
      data : new FormData($(sendForm)[0]),
      success : function(response){
        if($('.id').val() == ''){
          $('.id').val(response);
        }
        
        if(formAct1 != '' && formAct2 != ''){
          save('',formAct2,action);
        }else{
          setTimeout(function(){
            progressStat = false;
            $('#progressModal').modal('toggle');
            act(action);
          }, {{env('SET_TIMEOUT', '300')}});
        }
      },
      error : function(e){
        setTimeout(function(){
          progressStat = false;
          $('#progressModal').modal('toggle'); 
          alert(' Error : ' + e.statusText);
        }, {{env('SET_TIMEOUT', '300')}});
      }
    });
  }
  
  function act(action){
    switch(action) {
        case 'exit':
            window.open("{{ route('warehouse-branch.index') }}/?new=branch", "_self");
    }
  }
  
</script>
@endsection