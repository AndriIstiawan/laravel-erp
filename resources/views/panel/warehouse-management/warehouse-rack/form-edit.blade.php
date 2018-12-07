@extends('master') 
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('warehouse-rack.update',['id' => $wr->id]) }}" enctype="multipart/form-data">
{{ method_field('PUT') }}
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
              <i class="fa fa-align-justify"></i> Edit
              <small>Warehouse Rack</small>
            </div>
            <div class="card-body">
              <div class="option-card">
                <div class="form-group input_fields_wrap">
                  <div class="option-card">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" id="no" name="no" class="form-control number" placeholder="No warehouse" aria-describedby="no-error" value="{{$wr->no}}" required>
                      <em id="no-error" class="error invalid-feedback">Please enter a no</em>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" name="type" class="form-control" placeholder="Type" aria-describedby="type-error" value="{{$wr->type}}" required>
                      <em id="type-error" class="error invalid-feedback">Please enter a type</em>
                    </div>
                    <div class="form-group col-md-6">
                      <select id="item_type" name="item_type" style="width: 100%;" class="form-control" aria-describedby="item_type-error">
                        <option value=""></option>
                        <option value="VFM" >VFM</option>
                        <option value="FM">FM</option>
                        <option value="MOD">MOD</option>
                        <option value="SM">SM</option>
                        <option value="NM">NM</option>
                      </select>
                      <em id="item_type-error" class="error invalid-feedback">Please enter a item type</em>
                      <script>
                          var x = document.getElementById("item_type");
                          var btrue = true;
                          for (i = 0; i < x.options.length; i++) {
                              if (x.options[i].value == "{{$wr->item_type}}") {
                                  x.options[i].selected = true;
                                  btrue = false;
                              }
                          }
                          if (btrue === true) {
                              x.insertAdjacentHTML('beforeend',
                                  '<option value="{{$wr->item_type}}" selected>{{$wr->item_type}}</option>'
                              );
                          }
                      </script>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" name="assign_area" class="form-control" placeholder="Assign area" aria-describedby="link-error" value="{{$wr->assign_area}}" required>
                      <em id="link-error" class="error invalid-feedback">Please enter a assign area</em>
                    </div>
                  </div>
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
                <a class="btn btn-secondary" href="{{route('warehouse-rack.index')}}">
                  <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                </a>
            </div>
          </div> 
        </div>
    </div>
  </div>
</div>
</form>
<!-- @include('panel.warehouse-management.warehouse-rack.fade-form-edit') -->
@endsection

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.warehouse-management.warehouse-rack.form-edit-js')
@endsection