<div class="fade" style="display:none">
  <div class="opt">
    <hr>
    <div class="row">
      <div class="pull-left col-md-4">
        <div class="text-center">
          <a class="btn vars-btn" style="cursor:default;margin:0 auto;padding:0;">
            <img class="rounded mediaPrev" src="{{ asset('img/add-photo.png') }}" style="width: 110px; height: 110px;">
          </a>
          <br>
          <a class="btn btn-warning btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').click()">
              <i class="fa fa-pencil"></i>
          </a>
          <a class="btn btn-danger btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').val('');$(this).siblings('.vars-btn').find('.mediaPrev').attr('src','{{ asset('img/add-photo.png') }}');">
              <i class="fa fa-trash"></i>
          </a>
          <input class="fade media" type="file" name="image[]" onchange="readURL(this)" accept="image/jpg, image/jpeg, image/png" aria-describedby="image-error" style="width: 110px; height: 1px;">
          <em id="image-error" class="error invalid-feedback">Please enter a image</em>
        </div>
      </div>
      <div class="form-group col-md-8">
        <label class="col-form-label" for="linkimg">*Link</label>
        <div class="input-group">
          <input type="text" name="linkimg[]" class="form-control" placeholder="Ex Option value">
          <span class="input-group-append">
            <button type="button" class="btn btn-danger" onclick="$(this).closest('.row').remove()">
              <i class="fa fa-close"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="optt">
    <hr>
    <div class="row">
      <div class="form-group col-md-4">
        <label class="col-form-label" for="icon">*Icon</label>
        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="fa fa-envelope, fa fa-phone, fa fa-facebook-square, fa fa-google-plus-square, fa fa-instagram, fa fa-twitter-square, fa fa-whatsapp, fa fa-youtube-square"></i>
        <div id="icon" class="control-group input-group" style="margin-top:10px">
          <input type="text" id="icon" name="icon[]" aria-describedby="icon-error" class="form-control" placeholder="Ex fa fa-list" required=""> 
          <em id="icon-error" class="error invalid-feedback">Please enter a icon</em>
        </div>
      </div>
      <div class="form-group col-md-8">
        <label class="col-form-label" for="value">*Value</label>
        <div id="value" class="control-group input-group" style="margin-top:10px">
          <input type="text" name="value[]" class="form-control" placeholder="Ex 067173636" aria-describedby="value-error" required>
          <span class="input-group-append">
            <button type="button" class="btn btn-danger" onclick="$(this).closest('.row').remove()">
              <i class="fa fa-close"></i>
            </button>
          </span>
          <em id="value-error" class="error invalid-feedback">Please enter a value</em>
        </div>
      </div>
    </div>
  </div>
</div>