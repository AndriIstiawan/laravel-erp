@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('segment-attributes.store') }}" enctype="multipart/form-data">
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

        <div class="card">
          {{ csrf_field() }}
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Add
            <small>new attributes </small>
          </div>
          <div class="card-body">
            {{ csrf_field() }}
              <div class="form-group">
                <label class="col-form-label" for="name">*Name
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Name attribute"></i>
                </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" onkeyup="$('#slug').val(convertToSlug($(this).val()));$('#slug').valid();">
                <em id="name-error" class="error invalid-feedback">Please enter a name attributes</em>
              </div>
              <div class="form-group">
                  <label class="col-form-label" for="name">*Slug
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Slug attribute"></i>
                  </label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" aria-describedby="slug-error">
                  <em id="slug-error" class="error invalid-feedback">Please enter a slug</em>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="type">*Type</label>
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Define attribute type"></i>
                </label>
                <select id="type" name="type" class="form-control" style="width: 100%;" aria-describedby="type-error" required>
                  <option value=""></option>
                  <option value="URL">Url</option>
                  <option value="Icon">Icon</option>
                  <option value="TextArea">Text Area</option>
                  <option value="Media">Media</option>
                </select>
                <em id="type-error" class="error invalid-feedback">Please enter a type</em>
              </div>
                <div class="URL box">
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="url">
                      <strong>Url</strong>
                    </label>
                    <input type="text" id="url" name="url" aria-describedby="url-error" class="form-control" placeholder="Https://Url.com">
                  <em id="url-error" class="error invalid-feedback">Please enter a url</em>
                  </div>
                </div>
                <div class="Icon box">
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="icon">
                      <strong>Icon</strong>
                    </label>
                    <input type="text" id="icon" name="icon" aria-describedby="icon-error" class="form-control" placeholder="fa fa-list" onkeyup="$('#iconpreview').attr('class', $(this).val())">
                  <em id="icon-error" class="error invalid-feedback">Please enter a icon</em>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="icon">
                      <strong>Preview icon</strong>
                    </label><br>
                    <i id="iconpreview" class="fa fa"></i>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="urlicon">
                      <strong>Url</strong>
                    </label>
                    <input type="text" id="urlicon" name="urlicon" aria-describedby="urlicon-error" class="form-control" placeholder="Https://Url.com">
                  <em id="urlicon-error" class="error invalid-feedback">Please enter a url</em>
                  </div>
                </div>
                <div class="TextArea box">
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="textArea">
                      <strong>Default Text Area</strong>
                    </label>
                    <textarea id="textArea" name="textArea" aria-describedby="textArea-error" class="form-control" placeholder="Default text area"></textarea>
                    <em id="textArea-error" class="error invalid-feedback">Please enter a text</em>
                  </div>
                </div>
                <div class="Media box">
                  <div class="form-group col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-group">
                          <div class="text-center">
                            <img class="rounded mediaPrev" src="{{ asset('img/fiture-logo.png') }}" style="width: 200px; height: 200px;">
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="file" class="form-control" aria-describedby="media-error" id="media" name="media" accept="image/jpg, image/jpeg, image/png">
                          <small class="text-muted">Available media image</small>
                          <em id="media-error" class="error invalid-feedback">Please enter a picture</em>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-form-label" for="url">
                      <strong>Url</strong>
                    </label>
                    <input type="text" id="url" name="urlmedia" aria-describedby="url-error" class="form-control" placeholder="Url">
                    <em id="url-error" class="error invalid-feedback">Please enter a url</em>
                  </div>
                </div>
          </div>
          <div class="card-footer">
            <div class="btn-group">
              <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <button type="submit" class="btn btn-success" name="signup" value="Sign up">Save</button>
            </div>
            <a class="btn btn-secondary" href="{{route('segment-attributes.index')}}">
              <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@endsection

<!-- section myscript dijalankan diakhir script setelah reload main script -->
@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
  $('#type').select2({theme: "bootstrap",placeholder: 'Please select'});
    $('#type').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
    });
  $("#media").change(function (){ readURL(this); });

  $(document).ready(function(){
  $("select").change(function(){
      $(this).find("option:selected").each(function(){
          if($(this).attr("value")=="TextArea"){
              $(".box").not(".TextArea").hide();
              $(".TextArea").show();
          }else if($(this).attr("value")=="URL"){
              $(".box").not(".URL").hide();
              $(".URL").show();
          }else if($(this).attr("value")=="Icon"){
              $(".box").not(".Icon").hide();
              $(".Icon").show();
          }else if($(this).attr("value")=="Media"){
              $(".box").not(".Media").hide();
              $(".Media").show();
          }else{
              $(".box").hide();
          }
      });
  }).change();
  });

  //Read media view
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e){ $('.mediaPrev').attr('src', e.target.result); }
      reader.readAsDataURL(input.files[0]);
    }
  }

  //Validation form
  $("#jxForm1").validate({
    rules:{
      name:{required:true,minlength:2},
      url:{required:true},
      type:{required:true},
      textArea:{required:true},
      media:{required:true},
      icon:{required:true},
      slug: {
        required: true,
        remote:{
          url: "{{ route('segment-attributes.index') }}/find",
          type: "post",
          data:{
            _token:'{{ csrf_token() }}',
            slug: function(){
              return $('#jxForm1 :input[name="slug"]').val();
            }
          }
        }
      }
    },
    messages:{
      name:{
        required:'Please enter a name attributes',
        minlength:'Name must consist of at least 2 characters'
      },
      address:{
        required:'Please enter a name site',
        minlength:'Name must consist of at least 2 characters'
      },
      type:{ required:'Please select a type attributes' 
      },
      url:{ required:'Please enter a url' 
      },
      icon:{ required:'Please enter a icon' 
      },
      textArea:{ required:'Please enter a text' 
      },
      media:{ required:'Please enter a picture' 
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

  //save data
</script>
@endsection