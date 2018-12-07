<div class="fade" style="display:none">
  <div class="optt">
    <div class="optts">
    <div class="row">
      <div class="col-md-2">
        <button class="btn btn-danger rounded btn-sm pull-right" id="minmore" onclick="$(this).closest('.option-card1 .optts').remove()" style="position:relative;top:-30px;right:-850px;"><i class="fa fa-trash"></i>
        </button>
        <div class="form-group">
          <label class="col-form-label" for="name">*Name Product</label>
            <select id="products" name="product[]" style="width: 100% !important;" class="form-control form-control-sm" aria-describedby="product-error" required>
              <option value=""></option>
              
            </select>
          <em id="product-error" class="error invalid-feedback">Please select product</em>
      </div>
      </div>
      <div class="col-md-2">
      <label class="col-form-label" for="type">*Type</label>
        <div class="form-group">
          <input type="text" class="form-control form-control-sm" name="type[]" id="products-type" readonly>
        </div>
      </div>
      <div class="col-md-2">
        <label class="col-form-label" for="code">*Code</label>
      <div class="form-group">
        <input type="text" class="form-control form-control-sm" name="code[]" id="products-code" readonly>
      </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="col-form-label" for="total">*Total (Kg)</label>
          <input type="number" onkeyup="findTotals()" class="form-control form-control-sm" id="totals" name="total[]" placeholder="00" aria-describedby="totals-error">
            <em id="totals-error" class="error invalid-feedback">
              Please enter a total
            </em>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="col-form-label" >*Packaging Option</label>
          <select id="packagings" name="packaging[]" class="form-control form-control-sm" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotals()" required>
            <option value=""></option>
            <option value="0.25" >250 gram</option>
            <option value="0.5">500 gram</option>  
            <option value="1">1 kg</option>  
            <option value="5">5 kg</option>  
            <option value="25">25 kg</option>
            <option value="30">30 kg</option>
          </select>
          <em id="packaging-error" class="error invalid-feedback">Please select packaging</em>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label class="col-form-label" >*Amount</label>
          <input class="form-control form-control-sm" type="text" name="amount[]" id="amounts" placeholder="00" readonly/>
        </div>
      </div>
      <!-- <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Package</label>
          <select id="package" name="package[]" class="form-control" style="width: 100% !important;" aria-describedby="package-error" required>
            <option value=""></option>
            <option value="drum" >Drum</option>
            <option value="Jerigen">Jerigen</option>  
            <option value="Aluminium">Aluminium</option>  
            <option value="Plastik">Plastik</option>
          </select>
        <em id="package-error" class="error invalid-feedback">Please select package</em>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Realisasi (Kg)</label>
          <input class="form-control" type="text" name="realisasi[]" id="realisasi" aria-describedby="realisasi-error"/>
        <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Stock Kapuk</label>
          <input class="form-control" type="text" name="stockk[]" id="stockk" aria-describedby="stockk-error" />
        <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Pending SO</label>
          <input class="form-control" type="text" name="pending[]" id="pending" aria-describedby="pending-error"/>
        <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Balance Stock</label>
          <input class="form-control" type="text" name="balance[]" id="balance" aria-describedby="balance-error"/>
        <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="col-form-label" >*Pending PR</label>
          <input class="form-control" type="text" name="pendingpr[]" id="pendingpr" aria-describedby="pendingpr-error"/>
        <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
        </div>
      </div> -->
      <div>
    </div>
  </div>
            <hr style="position:relative; width: 95%; right: 2.5%;">
</div>
</div>