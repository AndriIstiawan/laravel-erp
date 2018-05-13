@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="animate fadeIn">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <p>
                        <a class="btn btn-primary" href="{{route('product.index')}}">
                            <i class="fa fa-backward"></i>&nbsp; Back to List
                        </a>
                    </p>
                    <!--start card general -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Product
                            <small>Create </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <p class="col-md-12">
                                    <input type="text" name="name" class="form-control" placeholder="Enter product name.." aria-describedby="name-error">
                                    <em id="name-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="form-group col-md-3">
                                    <select id="category" name="category" class="form-control" style="width: 100% !important;" aria-describedby="category-error"
                                        required>
                                        <option value=""></option>
                                        <option value="VFM">VFM</option>
                                        <option value="FM">FM</option>
                                        <option value="MOD">MOD</option>
                                        <option value="SM">SM</option>
                                        <option value="NM">NM</option>
                                    </select>
                                    <em id="category-error" class="error invalid-feedback">Please select type</em>
                                </p>
                                <p class="form-group col-md-3">
                                    <select id="commercial" name="commercial" class="form-control" style="width: 100% !important;" aria-describedby="commercial-error"
                                        required>
                                        <option value=""></option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="New">New</option>
                                        <option value="Stop">Stop</option>
                                        <option value="Promo">Promo</option>
                                    </select>
                                    <em id="commercial-error" class="error invalid-feedback">Please select type</em>
                                </p>
                                <p class="form-group col-md-3">
                                    <input type="text" class="form-control" name="code" placeholder="Code Product" id="code" aria-describedby="code-error" required="">
                                    <em id="code-error" class="error invalid-feedback">Please select type</em>
                                </p>
                                <p class="form-group col-md-3">
                                    <select id="type" name="type" class="form-control" style="width: 100% !important;" aria-describedby="type-error" required>
                                        <option value=""></option>
                                        <option value="BP">BP</option>
                                        <option value="LC">LC</option>
                                        <option value="AC">AC</option>
                                        <option value="CM">CM</option>
                                        <option value="PK">PK</option>
                                    </select>
                                    <em id="type-error" class="error invalid-feedback">Please select type</em>
                                </p>
                                <!-- <p class="form-group col-md-3">
                                    <input type="number" class="form-control" placeholder="Stok" name="stock" id="stock" aria-describedby="stock-error">
                                    <em id="stock-error" class="error invalid-feedback">Please select type</em>
                                </p> -->
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" name="save" id="save" class="btn btn-success">Save</button>&nbsp;
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                    <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--end card general-->
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.product-management.product.form-create-js') @endsection