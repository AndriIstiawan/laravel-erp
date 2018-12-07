@extends('master') 
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('footer.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
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
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Add
              <small>new Left Footer</small>
            </div>
            <div class="card-body">
                <button class="btn btn-primary add_field_btn-primary" >Add More</button>
              <hr>
              <div class="option-card">
                <div class="form-group input_fields_wrap">
                  <div class="option-card">
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label class="col-form-label" for="name">*Name</label>
                      <div id="name" class="control-group input-group" style="margin-top:10px">
                        <input type="text" name="name[]" class="form-control" placeholder="Ex About Us" aria-describedby="name-error" required>
                        <em id="name-error" class="error invalid-feedback">Please enter a name</em>
                      </div>
                    </div>
                    <div class="form-group col-md-8">
                      <label class="col-form-label" for="link">*Link</label>
                      <div id="link" class="control-group input-group" style="margin-top:10px">
                        <input type="text" name="link[]" class="form-control" placeholder="Ex Https://hoky/aboutus" aria-describedby="link-error" required>
                        <em id="link-error" class="error invalid-feedback">Please enter a link</em>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Add
              <small>new Middle Footer</small>
            </div>
            <div class="card-body">
              <label class="col-form-label" for="address">*Address</label>
              <div class="option-card">
                <div class="form-group">
                  <div class="option-card">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <div id="address" class="control-group input-group" style="margin-top:10px">
                        <textarea type="text" rows="5" id="address" name="address" class="form-control" placeholder="Ex Jl Bedugul Blok 1A NO 14" aria-describedby="address-error" required></textarea>
                        <em id="address-error" class="error invalid-feedback">Please enter a address</em>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
              <label class="col-form-label" for="days">*Opening Days</label>
              <div class="option-card">
                <div class="form-group">
                  <div class="option-card">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <div id="address" class="control-group input-group" style="margin-top:10px">
                        <select id="fromdays" class="form-control" style="width: 47%;" name="fromdays" aria-describedby="fromdays-error" required>
                          <option value=""></option>
                          <option value="Sunday">Sunday</option>
                          <option value="Monday">Monday</option>
                          <option value="Tuesday">Tuesday</option>
                          <option value="Wednesday">Wednesday</option>
                          <option value="Thursday">Thursday</option>
                          <option value="Friday">Friday</option>
                          <option value="Saturday">Saturday</option>
                        </select>
                        <span class="col-form-label" for="days">&nbsp;&nbsp;&nbsp;To&nbsp;&nbsp;&nbsp;</span>
                        <select id="todays" class="form-control" style="width: 47%;" name="todays" aria-describedby="todays-error" required>
                          <option value=""></option>
                          <option value="Sunday">Sunday</option>
                          <option value="Monday">Monday</option>
                          <option value="Tuesday">Tuesday</option>
                          <option value="Wednesday">Wednesday</option>
                          <option value="Thursday">Thursday</option>
                          <option value="Friday">Friday</option>
                          <option value="Saturday">Saturday</option>
                        </select>
                        <em id="todays-error" class="error invalid-feedback">Please enter a address</em>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
              <label class="col-form-label" for="time">*Opening Hours</label>
              <div class="option-card">
                <div class="form-group">
                  <div class="option-card">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <div id="address" class="control-group input-group" style="margin-top:10px">
                        <input type="time" id="from" name="from" class="form-control" aria-describedby="address-error" required>
                        <span class="input-group-text">To</span>
                        <input type="time" id="to" name="to" class="form-control" aria-describedby="address-error" required>
                        <em id="address-error" class="error invalid-feedback">Please enter a address</em>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Add
              <small>new Contact Us Footer</small>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" onclick="$('.type-attr_3 .option-card').append($('.optt').html())"> Add More</button>
              <hr>
              <div class="option-card type-attr_3">
                <div class="form-group input_">
                  <div class="option-card">
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
                          <input type="text"  id="value" name="value[]" class="form-control" placeholder="Ex 067173636" aria-describedby="value-error" required>
                          <em id="value-error" class="error invalid-feedback">Please enter a value</em>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Add
              <small>new Mitra Pembayaran Footer</small>
            </div>
            <div class="card-body">
              <div class="type-attr_111">
                <button type="button" class="btn btn-primary" onclick="$('.type-attr_1 .option-card').append($('.opt').html())"> Add More</button>
                <hr>
              <div class="option-card type-attr_1">
                <div class="form-group">
                  <div class="option-card">
                    <div class="row">
                      <div class="form-group col-md-4">
                        <div class="text-center">
                          <a class="btn vars-btn" style="cursor:default;margin:0 auto;padding:0;">
                            <img class="rounded mediaPrev" src="{{ asset('img/add-photo.png') }}" style="width: 110px; height: 110px;" required="">
                          </a>
                          <br>
                          <a class="btn btn-warning btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').click()" required="">
                              <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-danger btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').val('');$(this).siblings('.vars-btn').find('.mediaPrev').attr('src','{{ asset('img/add-photo.png') }}');">
                              <i class="fa fa-trash"></i>
                          </a>
                          <input class="fade media" id="image" type="file" name="image[]" onchange="readURL(this)" accept="image/jpg, image/jpeg, image/png" aria-describedby="image-error"
                              style="width: 110px; height: 1px;" required="">
                          <em id="image-error" class="error invalid-feedback">Please enter a image</em>
                        </div>
                      </div>
                      <div class="form-group col-md-8">
                        <label class="col-form-label" for="linkimg">*Link</label>
                        <div class="input-group">
                          <input type="text" name="linkimg[]" class="form-control" placeholder="Ex Https://Hoky/BI">
                        </div>
                      </div>
                    </div>                     
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Add
              <small>new Copyright Footer</small>
            </div>
            <div class="card-body">
              <label class="col-form-label" for="copyright">*Value</label>
              <div class="option-card">
                <div class="form-group">
                  <div id="copyright" class="control-group input-group" style="margin-top:10px">
                    <input type="text" id="copyright" name="copyright" class="form-control" placeholder="Ex @copyright.2018" aria-describedby="copyright-error" required>
                    <em id="copyright-error" class="error invalid-feedback">Please enter a copyright</em>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="modal-body">
              <div class="btn-group">
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  <button type="submit" class="btn btn-success">Save</button>
              </div>
                <a class="btn btn-secondary" href="{{route('footer.index')}}">
                  <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                </a>
            </div>
          </div> 
        </div>
    </div>
  </div>
</div>
</form>

@include('panel.footer-management.footer.fade-form-create')
@endsection

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.footer-management.footer.form-create-js')
@endsection