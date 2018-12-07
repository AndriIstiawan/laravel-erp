@extends('master')
@section('content')

<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('packaging.update',['id' => $packaging->id]) }}">
  {{ method_field('PUT') }}
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

            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="option-card">
                  <div class="form-group">

                    <input type="hidden" name="id" class="id" value="{{$packaging->id}}">
                    <label class="col-form-label" for="code">*Packaging Code
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="PKG-1"></i>
                    </label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="PKG01" aria-describedby="code-error" value="{{$packaging->code}}" readonly>
                    <em id="code-error" class="error invalid-feedback">Please enter a valid code</em>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="code">*Name
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Name"></i>
                    </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error" value="{{$packaging->name}}">
                    <em id="name-error" class="error invalid-feedback">Please enter a valid name</em>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="code">*Description
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Description"></i>
                    </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" aria-describedby="description-error" value="{{$packaging->description}}">
                    <em id="description-error" class="error invalid-feedback">Please enter a valid description</em>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="code">*Currency
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Price"></i>
                    </label>
                      <select id="currency" name="currency" style="width:100%">
                        <option value=""></option>
                        @foreach(app('currency')->options() as $option)
                        @if($packaging->currency == $option->label)
                        <option value="{{ $option->label }}" selected>{{ $option->label }}</option>
                        @else
                        <option value="{{ $option->label }}">{{ $option->label }}</option>
                        @endif
                        @endforeach
                      </select>
                    <em id="currency-error" class="error invalid-feedback">Please enter a valid currency</em>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="code">*Price
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Price"></i>
                    </label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="" aria-describedby="price-error" value="{{$packaging->price}}">
                    <em id="price-error" class="error invalid-feedback">Please enter a valid price</em>
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
      </div>
    </div>
  </div>
</form>

@endsection
@section('css')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
@endsection
@section('myscript')
<script src="{{ asset('js/medivh.js') }}"></script>
<script src="{{ asset('js/master/packaging/createform.js') }}"></script>
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
$('#jxForm').validate({
  rules:{
    name:{required:true},
    description:{required:true},
    code:{
      required:true,
      remote:{
        url: '{{ route('packaging.index') }}/find',
        type: "post",
        data:{
          _token:'{{ csrf_token() }}',
          code: function(){
            return $('#jxForm :input[name="code"]').val();
          }
        }
      }
    }
  },
  messages:{
    code:{
      required:'Please enter a code',
      remote:'Code already in use. Please use other code.'
    },
    name:{
      required:'Please select a name',
    },
    description:{
      required:'Please enter a description'
    }
    /*price:{
      required:'Please enter a price'
    }*/
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
@endsection
