@extends('master') @section('content')
<link href="{{ asset('fiture-style/bootstrap-fileinput/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
    <div class="animate fadeIn">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Edit product!</h4>
                    <p>Make sure the product is in accordance with {{env('APP_NAME','FITURE')}} terms and conditions.</p>
                </div>
                <p>
                    <a class="btn btn-primary" href="{{route('product.index')}}">
                        <i class="fa fa-backward"></i>&nbsp; Back to List
                    </a>
                    <button type="button" class="btn btn-success" onclick="save('exit')">
                        &nbsp; Save all and Exit
                    </button>
                </p>
                <form id="jxForm" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$product->id}}"> {{ csrf_field() }}
                    <!--start card general -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Product
                            <small>Information </small>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="">*Product Image
                                    <br>
                                    <small class="text-muted">Recommendations: 3-5 Product Images. Use the 5 best photos for this product. (format
                                        .JPG .JPEG .PNG max 10 MB)</small>
                                </label>
                                <div class="col-md-9">
                                    @foreach($product->image as $prodImage)
                                    <div class="pull-left">
                                        <a class="btn" style="cursor:default;">
                                            <img class="rounded picturePrev" src="{{ asset('img/products/'.$prodImage['filename']) }}" style="width: 150px; height: 150px;">
                                        </a><br>
                                        <button type="button" class="btn btn-danger rounded btn-sm pull-right" onclick="$(this).closest('.pull-left').remove()" 
                                            style="position: relative;top:-150px;right:20px;"><i class="fa fa-trash"></i>
                                        </button>
                                        <input type="hidden" name="fileImage[]" style="width: 1px; height: 1px;" value="{{$prodImage['filename']}}">
                                    </div>
                                    @endforeach
                                    <div class="image-add">
                                        <a class="btn btn-add-picture" onclick="$('.fade .picture-card .fade').click();">
                                            <img src="{{ asset('img/add-photo.png') }}" style="width: 150px; height: 150px;">
                                        </a><br>
                                        <button type="button" class="fade btn btn-sm"><i class="fa fa-pencil"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">*Product Name
                                    <br>
                                    <small class="text-muted">Write product names according to product type, brand, and details.</small>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" placeholder="Enter product name.." aria-describedby="name-error" 
                                        value="{{$product->name}}">
                                    <em id="name-error" class="error invalid-feedback"></em>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="hf-email">*Category
                                    <br>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <?php
                                        $arrProdCat = [];
                                        foreach($product->categories as $prodCats){
                                            $arrProdCat[] = $prodCats['slug'];
                                        }
                                        function nested($listArr, $categories, $parent, $arrProdCat){
                                            $parentKey = explode(' ',$parent);
                                            $parentKey = $parentKey[count($parentKey)-1];
                                            $parentCut = str_replace("cat-","",$parentKey);
                                            ?>
                                            <div class="col-md-4 {{$parent}} {{ ($parent != 'cat-null' && !in_array($parentCut,$arrProdCat)?'d-none':'') }}">
                                                <select name="category[]" data-parent="{{$parentKey}}" class="form-control category" style="width: 100% !important;" aria-describedby="category[]-error">
                                                    <option value=""></option>
                                                    <?php
                                                foreach($listArr as $la){
                                                    echo '<option value="'.$la['slug'].'" '.(in_array($la['slug'],$arrProdCat)?'selected':'').'>'.$la['name'].'</option>';
                                                }
                                                ?>
                                                </select>
                                                <em id="category[]-error" class="error invalid-feedback">Please select category</em>
                                            </div>
                                            <?php
                                            foreach($listArr as $la){
                                                $like = $la['slug'];
                                                $result = array_filter($categories, function ($item) use ($like){
                                                    foreach($item['parent'] as $parList){
                                                        if($parList['slug'] == $like){ return true; }
                                                    }
                                                    return false;
                                                });
                                                if(count($result) > 0){
                                                    $parent .= '-child cat-'.$la['slug'];
                                                    nested($result, $categories, $parent, $arrProdCat);
                                                }
                                            }
                                        }
                                        $like = null;
                                        $result = array_filter($categories, function ($item) use ($like){
                                            if ($item['parent'] == $like) {
                                                return true;
                                            }
                                            return false;
                                        });
                                        nested($result, $categories, 'cat-null', $arrProdCat);
                                        ?>
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
                                <label class="col-md-3 col-form-label" for="name">*Price
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row price-col">
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp. </span>
                                                </div>
                                                <input type="text" class="form-control idr-currency prodPrice" name="prodPrice" placeholder="00" aria-describedby="prodPrice-error">
                                                <em id="prodPrice-error" class="error invalid-feedback"></em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Product Stock
                                    <br>
                                    <small class="text-muted">Stock will be reduced automatically when entered in cart or product by buyer has been
                                        verified.
                                    </small>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-2">
                                            <input type="text" name="stock" class="form-control text-right input-number stock" placeholder="00" 
                                                value="{{$product->stock}}" {{ ($product->variant?'readonly':'') }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Product Variant
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-5 variant-btn">
                                            @if($product->variant)
                                            <button type="button" class="btn btn-success" onclick="$('.variant-col .var-tbody-col').append($('.var-tbody .var-tbody-col').html());refreshNumberFormat();">
                                                <i class="fa fa-plus"></i>Add more variant</button>
                                            <button type="button" class="btn btn-secondary" onclick="funcVariant('close')">
                                                <i class="fa fa-close"></i>Close variant</button>
                                            @else
                                            <button type="button" class="btn btn-secondary btn-block varBtn" onclick="funcVariant('add')">
                                                <i class="fa fa-plus"></i>Add variant</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 variant-col">
                                    @if($product->variant)
                                    <hr>
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" width="20%">Image</th>
                                                <th width="20%">Variant</th>
                                                <th width="25%">*Price</th>
                                                <th width="20%">SKU</th>
                                                <th width="10%">Stock</th>
                                                <th class="text-center" width="5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="var-tbody-col">
                                            @foreach($product->variant as $prodVar)
                                            <tr>
                                                <td class="text-center">
                                                    <a class="btn vars-btn" style="cursor:default;margin:0 auto;padding:0;">
                                                        <img class="rounded picturePrev" src="{{ ($prodVar['image'] != null ? asset('img/products/'.$prodVar['image']):asset('img/add-photo.png')) }}" style="width: 110px; height: 110px;">
                                                    </a>
                                                    <br>
                                                    <a class="btn btn-warning btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.varsPicture').click()">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" style="position: relative;top:-105px;right:-20px;" 
                                                        onclick="$(this).siblings('.varsPicture').val('');$(this).siblings('.vars-btn').find('.picturePrev').attr('src','{{ asset('img/add-photo.png') }}');$(this).siblings('.fileVars').val('');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <input class="fileVars" type="hidden" name="fileVars[]" value="{{$prodVar['image']}}">
                                                    <input class="fade varsPicture" type="file" name="varsPicture[]" onchange="readURL(this);$(this).siblings('.fileVars').val('');" accept="image/jpg, image/jpeg, image/png"
                                                        style="width: 110px; height: 1px;">
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <input type="text" name="variants[]" class="form-control" placeholder="input variant" style="width:200px;" aria-describedby="variants[]-error" value="{{$prodVar['key']}}">
                                                    <em id="variants[]-error" class="error invalid-feedback"></em>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp. </span>
                                                        </div>
                                                        <input type="text" class="form-control idr-currency" name="varPrice[]" placeholder="00" aria-describedby="varPrice[]-error"
                                                            onchange="priceStock('price')" value="{{ str_replace(',00','',number_format($prodVar['price'],2,',','.')) }}">
                                                    </div>
                                                    <em id="varPrice[]-error" class="error invalid-feedback">please enter product price</em>
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <input type="text" name="varSku[]" class="form-control" placeholder="Insert sku" value="{{$prodVar['sku']}}">
                                                </td>
                                                <td style="vertical-align:top;">
                                                    <input type="text" name="varStock[]" class="form-control text-right input-number" placeholder="00" onchange="priceStock('stock')" value="{{$prodVar['varStock']}}">
                                                </td>
                                                <td class="text-center" style="vertical-align:top;">
                                                    <a class="btn btn-danger" onclick="$(this).closest('tr').remove()">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card price-->

                    <!--start card management -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Management
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">SKU (Stock Keeping Unit)
                                    <br>
                                    <small class="text-muted">Use SKU to add unique code to this product.</small>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <input type="text" name="sku" class="form-control sku" placeholder="Insert sku" aria-describedby="sku-error" value="{{$product->sku}}">
                                            <em id="sku-error" class="error invalid-feedback"></em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">*Product description
                                    <br>
                                    <small class="text-muted">Describe the product completely & clearly. Long recommendation:> = 200 characters.</small>
                                </label>
                                <div class="col-md-9">
                                    <textarea rows="4" name="description" class="form-control" aria-describedby="description-error">{{$product->description}}</textarea>
                                    <em id="description-error" class="error invalid-feedback">Please describe the product</em>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card management-->

                    <!--start card management -->
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Delivery
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="name">Weight
                                    <br>
                                    <small class="text-muted">count with Volume Weight.</small>
                                </label>
                                <div class="col-md-9">
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <select name="weightUnit" class="form-control weight-unit">
                                                <option value="g" {{ ($product->weight[0]['unit']=='g'?'selected':'') }}>Gram</option>
                                                <option value="Kg"{{ ($product->weight[0]['unit']=='Kg'?'selected':'') }}>Kilogram</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" name="weight" class="form-control text-right input-number" placeholder="00" value="{{$product->weight[0]['weight']}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card management-->

                    <!--start action -->
                    <div class="card">
                        <div class="card-footer">
                            <div class="btn-group">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <button type="button" class="btn btn-success" onclick="save('continue')">Save and Continue</button>
                                <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="save('exit')">Save and Exit</a>
                                </div>
                            </div>
                            <a class="btn btn-secondary" href="{{route('variant.index')}}">
                                <i class="fa fa-times-rectangle"></i>&nbsp; Cancel
                            </a>
                        </div>
                    </div>
                    <!--end card action -->

                </form>
            </div>
        </div>
    </div>
</div>
@include('panel.product-management.product.fade-form-edit')
@endsection
<!-- /.container-fluid -->

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
@include('panel.product-management.product.form-edit-js')
@endsection