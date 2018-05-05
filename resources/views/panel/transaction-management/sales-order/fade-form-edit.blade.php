<div class="fade" style="display: none;">
    <div class="optt">
        <div class="optts">
            <div class="row">
                <p class="col-md-4">
                    <select name="product[]" style="width: 100% !important;" class="form-control form-control-sm products" aria-describedby="product[]-error">
                        <option value=""></option>
                        @foreach ($products as $productss)
                        <option data-code="{{$productss->code}}" data-type="{{$productss->type}}" value="{{$productss->id}}">{{$productss->code}}-{{$productss->type}}-{{$productss->name}}</option>
                        @endforeach
                    </select>
                    <em id="product[]-error" class="error invalid-feedback"></em>
                </p>
                <div style="display: none;" class="col-md-2">
                    <input type="text" class="form-control" name="type[]" id="products-type" readonly>
                </div>
                <div style="display: none;" class="col-md-2">
                    <input type="text" class="form-control" name="code[]" id="products-code" readonly>
                </div>
                <p class="col-md-1">
                    <input type="number" onkeyup="findTotal($(this))" class="form-control total" id="total" name="total[]" placeholder="kg" aria-describedby="totals-error">
                    <em id="totals-error" class="error invalid-feedback">
                      Please enter a totals
                    </em>
                </p>
                <p class="col-md-3">
                    <select name="packaging[]" class="form-control packaging" style="width: 100% !important;" aria-describedby="packaging-error"
                        onchange="findTotal($(this))">
                        <option value=""></option>
                        <option data-new="250 gram" data-package="Plastik" value="0.25" >250 gram - Plastik</option>
                        <option data-new="500 gram" data-package="Plastik" value="0.5">500 gram - Plastik</option>  
                        <option data-new="1 kg" data-package="Plastik" value="1">1 kg - Plastik</option> 
                        <option data-new="250 gram" data-package="Aluminium" value="0.25" >250 gram - Aluminium</option>
                        <option data-new="500 gram" data-package="Aluminium" value="0.5">500 gram - Aluminium</option>
                        <option data-new="1 kg" data-package="Aluminium" value="1">1 kg - Aluminium</option>   
                        <option data-new="5 kg" data-package="Jerigen" value="5">5 kg - Jerigen</option>  
                        <option data-new="25 kg" data-package="Jerigen" value="25">25 kg - Jerigen</option>
                        <option data-new="30 kg" data-package="Jerigen" value="30">30 kg - Jerigen</option>
                        <option data-new="25 kg" data-package="Drum" value="25">25 kg - Drum</option>

                    </select>
                    <em id="packaging-error" class="error invalid-feedback">Please select packaging</em>
                </p>
                <div class="col-md-4">
                    <div class="control-group input-group">
                        <input class="form-control" type="text" name="amount[]" id="amount" placeholder="Amount" aria-describedby="amount-error" readonly/>
                        <!-- <span class="input-group-text">x</span> -->
                        <input type="hidden" class="form-control packages" name="new[]" readonly>
                        <span class="input-group-append">
                            <button class="btn btn-danger rounded pull-right" id="minmore" onclick="$(this).closest('.option-card2 .optts').remove()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </span>
                    </div>
                    <em id="amount-error" class="error invalid-feedback"></em>
                </div>
                <div class="col-md-2">
                    <div class="control-group input-group">
                    <input type="hidden" class="form-control packages" name="package[]" readonly>
                    </div>
                 </div>
                <div class="col-md-4" style="display: none;">
                    <div class="form-group">
                        <label class="col-form-label">*Realisasi (Kg)</label>
                        <input class="form-control" type="text" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error" />
                        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
                    </div>
                </div>
                <div class="col-md-4" style="display: none;">
                    <div class="form-group">
                        <label class="col-form-label">*Stock Kapuk</label>
                        <input class="form-control" type="text" name="stockk[]" id="stockk" aria-describedby="stockk-error" />
                        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
                    </div>
                </div>
                <div class="col-md-4" style="display: none;">
                    <div class="form-group">
                        <label class="col-form-label">*Pending SO</label>
                        <input class="form-control" type="text" name="pending[]" id="pending" aria-describedby="pending-error" />
                        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
                    </div>
                </div>
                <div class="col-md-4" style="display: none;">
                    <div class="form-group">
                        <label class="col-form-label">*Balance Stock</label>
                        <input class="form-control" type="text" name="balance[]" id="balance" aria-describedby="balance-error" />
                        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
                    </div>
                </div>
                <div class="col-md-4" style="display: none;">
                    <div class="form-group">
                        <label class="col-form-label">*Pending PR</label>
                        <input class="form-control" type="text" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error" />
                        <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
                    </div>
                </div>
            </div>
            <p>
            <!-- <hr style="border-top: 4px solid #20a8d8"> -->
        </div>
    </div>
</div>