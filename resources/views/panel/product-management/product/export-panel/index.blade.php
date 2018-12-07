@extends('master')
@section('content')
<div class="container-fluid">
	<div class="animate fadeIn">
		<div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Export product!</h4>
                    <p>Before export the product, make sure the product is in accordance with {{env('APP_NAME','FITURE')}} terms
                        and conditions.</p>
                </div>
                <p>
                    <a class="btn btn-primary" href="{{route('product.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                </p>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Export
                        <small>Form </small>
                    </div>
                    <div class="card-body">
                        <form id="jxForm" onsubmit="return false;" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /.container-fluid -->