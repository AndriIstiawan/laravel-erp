@extends('master') @section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<form id="jxForm" novalidate="novalidate" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
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
                    <!--start card product -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Product
                            <small>Create </small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="col-md-12">
                                    <input type="text" name="name" class="form-control" placeholder="Product name" aria-describedby="name-error">
                                    <em id="name-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="col-md-2">
                                    <input type="text" class="form-control" name="code" placeholder="Product code" id="code" aria-describedby="code-error">
                                    <em id="code-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <select id="type" name="type" class="form-control" aria-describedby="type-error">
                                        <option value=""></option>
                                        @foreach($types as $type)
                                        <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="type-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-3">
                                    <select id="category" name="category" class="form-control" aria-describedby="category-error">
                                        <option value=""></option>
                                        <option value=""></option>
                                        @foreach($category as $category)
                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="category-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-3">
                                    <select id="commercial" name="commercial" class="form-control" aria-describedby="commercial-error">
                                        <option value=""></option>
                                        @foreach($commercialstatus as $commercialstatus)
                                        <option value="{{$commercialstatus->name}}">{{$commercialstatus->name}}</option>
                                        @endforeach
                                    </select>
                                    <em id="commercial-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <select id="currency" name="currency" class="form-control" aria-describedby="currency-error">
                                        <option value=""></option>
                                        <option value="Reguler">USD</option>
                                        <option value="New">IDR</option>
                                    </select>
                                    <em id="currency-error" class="error invalid-feedback"></em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end card product-->

                    <!--start card price -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Price
                            <small>Management </small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="250gPlastik" placeholder="250g Plastik" id="250gPlastik" aria-describedby="250gPlastik-error">
                                    <em id="250gPlastik-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="250gAluminium" placeholder="250g Aluminium" id="250gAluminium" aria-describedby="250gAluminium-error">
                                    <em id="250gAluminium-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="500gPlastik" placeholder="500g Plastik" id="500gPlastik" aria-describedby="500gPlastik-error">
                                    <em id="500gPlastik-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="500gAluminium" placeholder="500g Aluminium" id="500gAluminium" aria-describedby="500gAluminium-error">
                                    <em id="500gAluminium-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="1kgPlastik" placeholder="1kg Plastik" id="1kgPlastik" aria-describedby="1kgPlastik-error">
                                    <em id="1kgPlastik-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="1kgAluminium" placeholder="1kg Aluminium" id="1kgAluminium" aria-describedby="1kgAluminium-error">
                                    <em id="1kgAluminium-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="5kgJerigen" placeholder="5kg Jerigen" id="5kgJerigen" aria-describedby="5kgJerigen-error">
                                    <em id="5kgJerigen-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="25kgJerigen" placeholder="25kg Jerigen" id="25kgJerigen" aria-describedby="25kgJerigen-error">
                                    <em id="25kgJerigen-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="25kgDrum" placeholder="25kg Drum" id="25kgDrum" aria-describedby="25kgDrum-error">
                                    <em id="25kgDrum-error" class="error invalid-feedback"></em>
                                </p>
                                <p class="input-group col-md-2">
                                    <input type="text" class="form-control idr-currency" name="30kgJerigen" placeholder="30kg Jerigen" id="30kgJerigen" aria-describedby="30kgJerigen-error">
                                    <em id="30kgJerigen-error" class="error invalid-feedback"></em>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end card price-->

                    <!--start card stock -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Stock
                            <small>Management </small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="250gPlastiks" placeholder="250g Plastik" id="250gPlastiks" aria-describedby="250gPlastiks-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="250gPlastiks-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="250gAluminiums" placeholder="250g Aluminium" id="250gAluminiums"
                                                aria-describedby="250gAluminiums-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="250gAluminiums-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="500gPlastiks" placeholder="500g Plastik" id="500gPlastiks" aria-describedby="500gPlastiks-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="500gPlastiks-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="500gAluminiums" placeholder="500g Aluminium" id="500gAluminiums"
                                                aria-describedby="500gAluminiums-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="500gAluminiums-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="1kgPlastiks" placeholder="1kg Plastik" id="1kgPlastiks" aria-describedby="1kgPlastiks-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="1kgPlastiks-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="1kgAluminiums" placeholder="1kg Aluminium" id="1kgAluminiums" aria-describedby="1kgAluminiums-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="1kgAluminiums-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="5kgJerigens" placeholder="5kg Jerigen" id="5kgJerigens" aria-describedby="5kgJerigens-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="5kgJerigens-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="25kgJerigens" placeholder="25kg Jerigen" id="25kgJerigens" aria-describedby="25kgJerigens-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="25kgJerigens-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="25kgDrums" placeholder="25kg Drum" id="25kgDrums" aria-describedby="25kgDrums-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="25kgDrums-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="input-group col-md-12">
                                            <input type="text" class="form-control input-float" name="30kgJerigens" placeholder="30kg Jerigens" id="30kgJerigens" aria-describedby="30kgJerigens-error">
                                            <div class="input-group-append">
                                                <span class="input-group-text text-sm">kg</span>
                                            </div>
                                            <em id="30kgJerigens-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card stock-->

                    <!--start card button -->
                    <div class="card">
                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" name="save" id="save" class="btn btn-success">Save</button>&nbsp;
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                    <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <!--end card button-->

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
