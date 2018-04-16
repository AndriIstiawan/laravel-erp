<div class="fade" style="display:none;">
    <!--image card -->
    <div class="picture-card">
        <div class="pull-left">
            <a class="btn" style="cursor:default;">
                <img class="rounded picturePrev" src="{{ asset('img/add-photo.png') }}" style="width: 150px; height: 150px;">
            </a><br>
            <button type="button" class="btn btn-danger rounded btn-sm pull-right" onclick="$(this).closest('.pull-left').remove()" 
                style="position: relative;top:-150px;right:20px;"><i class="fa fa-trash"></i>
            </button>
            <input class="fade" type="file" name="image[]" accept="image/jpg, image/jpeg, image/png" style="width: 1px; height: 1px;"
                onchange="readURL(this, 'true')">
        </div>
    </div>
    
    <!-- table variant -->
    <div class="table-variant">
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
                <tr>
                    <td class="text-center">
                        <a class="btn vars-btn" style="cursor:default;margin:0 auto;padding:0;">
                            <img class="rounded picturePrev" src="{{ asset('img/add-photo.png') }}" style="width: 110px; height: 110px;">
                        </a>
                        <br>
                        <a class="btn btn-warning btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').click()">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').val('');$(this).siblings('.vars-btn').find('.picturePrev').attr('src','{{ asset('img/add-photo.png') }}');">
                            <i class="fa fa-trash"></i>
                        </a>
                        <input class="fileVars" type="hidden" name="fileVars[]" value="">
                        <input class="fade varsPicture" type="file" name="varsPicture[]" onchange="readURL(this)" accept="image/jpg, image/jpeg, image/png"
                            style="width: 110px; height: 1px;">
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="variants[]" class="form-control" placeholder="input variant" style="width:200px;" aria-describedby="variants[]-error">
                        <em id="variants[]-error" class="error invalid-feedback"></em>
                    </td>
                    <td style="vertical-align:top;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp. </span>
                            </div>
                            <input type="text" class="form-control idr-currency" name="varPrice[]" placeholder="00" aria-describedby="varPrice[]-error"
                                onchange="priceStock('price')">
                        </div>
                        <em id="varPrice[]-error" class="error invalid-feedback">please enter product price</em>
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="varSku[]" class="form-control" placeholder="Insert sku">
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="varStock[]" class="form-control text-right input-number" placeholder="00" onchange="priceStock('stock')">
                    </td>
                    <td class="text-center" style="vertical-align:top;">
                        <a class="btn btn-danger" onclick="$(this).closest('tr').remove()">
                            <i class="fa fa-close"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--end table variant -->

    <!-- variant button add -->
    <div class="variant-btn-add">
        <button type="button" class="btn btn-secondary btn-block varBtn" onclick="funcVariant('add')">
            <i class="fa fa-plus"></i>Add variant</button>
    </div>

    <!-- variant button add -->
    <div class="variant-btn-action">
        <button type="button" class="btn btn-success" onclick="$('.variant-col .var-tbody-col').append($('.var-tbody .var-tbody-col').html());refreshNumberFormat();">
            <i class="fa fa-plus"></i>Add more variant</button>
        <button type="button" class="btn btn-secondary" onclick="funcVariant('close')">
            <i class="fa fa-close"></i>Close variant</button>
    </div>

    <!-- variant tbody -->
    <div class="var-tbody">
        <table class="table table-responsive-sm table-hover table-outline mb-0">
            <tbody class="var-tbody-col">
                <tr>
                    <td class="text-center">
                        <a class="btn vars-btn" style="cursor:default;margin:0 auto;padding:0;">
                            <img class="rounded picturePrev" src="{{ asset('img/add-photo.png') }}" style="width: 110px; height: 110px;">
                        </a>
                        <br>
                        <a class="btn btn-warning btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').click()">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" style="position: relative;top:-105px;right:-20px;" onclick="$(this).siblings('.fade').val('');$(this).siblings('.vars-btn').find('.picturePrev').attr('src','{{ asset('img/add-photo.png') }}');">
                            <i class="fa fa-trash"></i>
                        </a>
                        <input class="fileVars" type="hidden" name="fileVars[]" value="">
                        <input class="fade varsPicture" type="file" name="varsPicture[]" onchange="readURL(this)" accept="image/jpg, image/jpeg, image/png"
                            style="width: 110px; height: 1px;">
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="variants[]" class="form-control" placeholder="input variant" style="width:200px;" aria-describedby="variants[]-error">
                        <em id="variants[]-error" class="error invalid-feedback"></em>
                    </td>
                    <td style="vertical-align:top;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp. </span>
                            </div>
                            <input type="text" class="form-control idr-currency" name="varPrice[]" placeholder="00" aria-describedby="varPrice[]-error"
                                onchange="priceStock('price')">
                        </div>
                        <em id="varPrice[]-error" class="error invalid-feedback"></em>
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="varSku[]" class="form-control" placeholder="Insert sku">
                    </td>
                    <td style="vertical-align:top;">
                        <input type="text" name="varStock[]" class="form-control text-right input-number" placeholder="00" onchange="priceStock('stock')">
                    </td>
                    <td class="text-center" style="vertical-align:top;">
                        <a class="btn btn-danger" onclick="$(this).closest('tr').remove()">
                            <i class="fa fa-close"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- price columns -->
    <div class="price-range">
        <div class="col-md-5">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp. </span>
                </div>
                <input type="text" class="form-control idr-currency prodPrice" name="minPrice" placeholder="00" readonly>
            </div>
        </div>
        <div class="col-md-1">
            <label class="col-form-label">to</label>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp. </span>
                </div>
                <input type="text" class="form-control idr-currency prodPrice" name="maxPrice" placeholder="00" readonly>
            </div>
        </div>
    </div>
    <div class="price-input">
        <div class="col-md-5">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rp. </span>
                </div>
                <input type="text" class="form-control idr-currency prodPrice" name="prodPrice" placeholder="00" aria-describedby="prodPrice-error">
                <em id="prodPrice-error" class="error invalid-feedback">Please enter product price</em>
            </div>
        </div>
    </div>
</div>