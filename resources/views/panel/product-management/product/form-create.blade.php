@extends('master')
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm1" novalidate="novalidate" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">New product!</h4>
                    
                </div>
                <p>
                    <a class="btn btn-primary" href="{{route('product.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    
                </p>
                
                    <!--start card general -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Product
                            <small>Information </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">*Product Name
                                    <br>
                                    <small class="text-muted">Write product names according to product type, brand, and details.</small>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" placeholder="Enter product name.." aria-describedby="name-error">
                                    <em id="name-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="type">*Type
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <select id="type" name="type" class="form-control" style="width: 100% !important;" aria-describedby="packaging-error" required>
                                                    <option value=""></option>
                                                    <option value="BP" >BP</option>
                                                    <option value="LC">LC</option>  
                                                    <option value="AC">AC</option>  
                                                    <option value="CM">CM</option>  
                                                    <option value="PK">PK</option>
                                                </select>
                                                <em id="type-error" class="error invalid-feedback">Please select type</em>
                                            </div>
                                            
                                    </div>

                                </div>
                                <label class="col-md-3 col-form-label" for="Code">*Code
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="code" id="code" >
                                            </div>
                                            
                                    </div>
                                </div>
                                <label class="col-md-3 col-form-label" for="Stock">*Stock
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="stock" id="stock" >
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card general-->

                    <!--start card price -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Price
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" >*Price 250 gr
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                    <div class="col-md-4">
                                        <input type="text" name="satu" class="form-control" placeholder="250 gr" style="width:200px;" aria-describedby="250-error">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="Stockl">*Price 500 gr
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <input type="text" name="dua" class="form-control" placeholder="500 gr" style="width:200px;" aria-describedby="500-error">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="Stockl">*Price 1 Kg
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" name="tiga" class="form-control" placeholder="1 Kg" style="width:200px;" aria-describedby="1-error">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="price">*Price 5 Kg
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" name="empat" class="form-control" placeholder="5 Kg" style="width:200px;" aria-describedby="5-error">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="price">*Price 25 Kg
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" name="lima" class="form-control" placeholder="25 Kg" style="width:200px;" aria-describedby="25-error">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="price">*Price 30 Kg
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="text" name="enam" class="form-control" placeholder="30 Kg" style="width:200px;" aria-describedby="30-error">
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="price">*Currency
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <select id="type" name="currency" class="form-control" style="width: 100% !important;" aria-describedby="packaging-error" required>
                                                    <option value=""></option>
                                                    <option value="USD">USD</option>
                                                    <option value="Rp">Rp</option>  
                                                    </select>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--end card price-->
                    <!--start action -->
                    <div class="card">
                        <div class="card">
                            <p>
                            <div class="btn-group"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <button type="submit" name="save" id="save" class="btn btn-success">Save</button>&nbsp;
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                                </button>
                            </div>
                            </p>
                        </div>
                    </div>
                    <!--end card action -->
            </div>
        </div>
    </div>
</div>
</form>
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.product-management.product.form-create-js')
@endsection