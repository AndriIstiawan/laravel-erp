@extends('master') @section('content')
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

        <div class="card">
          {{ csrf_field() }}
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Add
            <small>new attributes </small>
          </div>
          <div class="card-body">
            <form id="jxForm" onsubmit="return false;" enctype="multipart/form-data">
            {{ csrf_field() }}
              <div class="form-group">
                <label class="col-form-label" for="name">*Name
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Name attribute"></i>
                </label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-error">
                <em id="name-error" class="error invalid-feedback">Please enter a name attributes</em>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="type">*Type
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Define attribute type"></i>
                </label>
                <select id="type" name="type" class="form-control" aria-describedby="type-error" required>
                  <option value=""></option>
                  <option value="attr-textbox">Text</option>
                  <option value="attr-textarea">Text Area</option>
                  <option value="attr-date">Date</option>
                  <option value="attr-multiselect">Multi Select</option>
                  <option value="attr-dropdown">Dropdown</option>
                  <option value="attr-media">Media</option>
                </select>
                <em id="type-error" class="error invalid-feedback">Please enter a new type</em>
              </div>
              <!-- load type attribute -->
              <div class="type-attr"></div>
              <!-- load type attribute -->
            </form>
          </div>
          <div class="card-footer">
            <div class="btn-group">
              <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <button type="button" class="btn btn-success" onclick="save()">Save and Continue</button>
            </div>
            <a class="btn btn-secondary" href="{{route('attributes.index')}}">
              <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- attribute type -->
<div class="fade">
  <!-- textbox -->
  <div class="attr-textbox">
    <div class="form-group col-md-12">
      <label class="col-form-label" for="textField">
        <strong>Default Text</strong>
      </label>
      <input type="text" name="textField" class="form-control" placeholder="Default text">
    </div>
  </div>
  <!-- textarea -->
  <div class="attr-textarea">
    <div class="form-group col-md-12">
      <label class="col-form-label" for="textArea">
        <strong>Default Text Area</strong>
      </label>
      <textarea name="textArea" class="form-control" placeholder="Default text area"></textarea>
    </div>
  </div>
  <!-- Date -->
  <div class="attr-date">
    <div class="form-group col-md-6">
      <label>Date input</label>
      <div class="input-group">
        <span class="input-group-prepend">
          <span class="input-group-text">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
        <input id="date" type="date" name="date" class="form-control" aria-describedby="date-error">
      </div>
      <em id="date-error" class="error invalid-feedback">Please input date</em>
    </div>
  </div>
  <!-- Multiselect / Dropdown -->
  <div class="attr-multiselect attr-dropdown">
    <div class="form-group col-md-12">
      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-link" onclick="$('.type-attr .option-card').append($('.opt').html())">
            <i class="fa fa-plus"></i>&nbsp; Add Option</button>
          <hr>
          <div class="option-card">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Option -->
  <div class="opt">
    <div class="form-group">
      <div class="input-group">
        <input type="text" name="option[]" class="form-control" placeholder="Option value">
        <span class="input-group-append">
          <button type="button" class="btn btn-danger" onclick="$(this).closest('.form-group').remove()">
            <i class="fa fa-close"></i>
          </button>
        </span>
      </div>
    </div>
  </div>
  <!-- Media -->
  <div class="attr-media">
    <div class="form-group col-md-12">
      <div class="card">
        <div class="card-body">
        <div class="form-group">
          <div class="text-center">
            <img class="rounded mediaPrev" src="{{ asset('img/fiture-logo.png') }}" style="width: 200px; height: 200px;">
          </div>
          </div>
          <div class="form-group">
            <input type="file" class="form-control" id="media" name="media" accept="image/jpg, image/jpeg, image/png">
            <small class="text-muted">Available media image</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<!-- section myscript dijalankan diakhir script setelah reload main script -->
@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>
  $('#type').select2({
    theme: "bootstrap",
    placeholder: 'Please select'
  }).on('change', function () {
    $('.type-attr').html($('.' + $(this).val()).html());
    $('#jxForm').valid();
    $("#media").change(function (){ readURL(this); });
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
  $('#jxForm').validate({
    rules: {
      name: {
        required: true,
        minlength: 2
      },
      type: {
        required: true
      },
      date: {
        required: true
      }
    },
    messages: {
      name: {
        required: 'Please enter a name attribute',
        minlength: 'Name must consist of at least 2 characters'
      },
      type: {
        required: 'Please select type'
      },
      date: {
        required: 'Please input date'
      }
    },
    errorElement: 'em',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  });

  //save data
  function save() {
    if ($('#jxForm').valid()) {
      $('.showProgress').click();
			$.ajax({
				xhr: function () {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							console.log(percentComplete);
							$('.progress-bar').css({
								width: percentComplete * 100 + '%'
							});
							if (percentComplete === 1) {
							}
						}
					}, false);
					xhr.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							console.log(percentComplete);
							$('.progress-bar').css({
								width: percentComplete * 100 + '%'
							});
						}
					}, false);
					return xhr;
				},
				url: "{{ route('attributes.index') }}",
				type: 'POST',
				processData: false,
				contentType: false,
				data: new FormData($('#jxForm')[0]),
				success: function (response) {
					setTimeout(function(){
						$('#progressModal').modal('toggle');
						toastr.success('successfully saved..', 'Setting');
					}, {{env('SET_TIMEOUT', '500')}});
				},
				error: function (e) {

				}
			});
    }
  }
</script>
@endsection