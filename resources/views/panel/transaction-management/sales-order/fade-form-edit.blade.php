<div class="fade" style="display: none;">
  <div class="optt">
    <div class="optts">
      <div class="row">
        <div class="col-md-2">
          <label class="col-form-label" for="name">*Name Product</label>
            <select name="product[]" style="width: 100% !important;" class="form-control form-control-sm products" aria-describedby="product[]-error">
              <option value=""></option>
              @foreach ($products as $productss)
                  <option data-code="{{$productss->code}}" data-type="{{$productss->type}}" value="{{$productss->id}}" >{{$productss->name}}</option>
              @endforeach
            </select>
          <em id="product[]-error" class="error invalid-feedback"></em>
        </div>
        <div class="col-md-2">
        <label class="col-form-label" for="type">*Type</label>
          <input type="text" class="form-control" name="type[]" id="products-type" readonly>
        </div>
        <div class="col-md-2">
          <label class="col-form-label" for="code">*Code</label>
            <input type="text" class="form-control" name="code[]" id="products-code" readonly>
        </div>
        <div class="col-md-2">
            <label class="col-form-label" for="total">*Total (Kg)</label>
            <input type="number" onkeyup="findTotal($(this))" class="form-control total" id="total" name="total[]" placeholder="00" aria-describedby="total-error">
              <em id="total-error" class="invalid-feedback">
                each field are required
              </em>
        </div>
        <div class="col-md-2">
            <label class="col-form-label" >*Packaging Option</label>
            <select id="packaging" name="packaging[]" class="form-control packaging" style="width: 100% !important;" aria-describedby="packaging-error" onchange="findTotal($(this))">
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
        <div class="col-md-2">
        <label class="col-form-label" >Amount</label>
          <div class="control-group input-group">
            <input class="form-control" type="number" min="1" name="amount[]" id="amount" placeholder="00" 
            aria-describedby="amount-error" required="" readonly/>
            <span class="input-group-append">
              <button class="btn btn-danger rounded pull-right" id="minmore" onclick="$(this).closest('.option-card2 .optts').remove()"><i class="fa fa-trash"></i>
              </button>
            </span>
          </div>
          <em id="amount-error" class="error invalid-feedback"></em>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Package</label>
            <select id="package" name="package[]" value="1" class="form-control" style="width: 100% !important;" aria-describedby="package-error">
              <option value=""></option>
              <option value="drum" selected>Drum</option>
              <option value="Jerigen">Jerigen</option>  
              <option value="Aluminium">Aluminium</option>  
              <option value="Plastik">Plastik</option>
            </select>
          <em id="package-error" class="error invalid-feedback">Please select package</em>
          </div>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Realisasi (Kg)</label>
            <input class="form-control" type="text" name="realisasi[]" value="1" id="realisasi" aria-describedby="realisasi-error"/>
          <em id="realisasi-error" class="error invalid-feedback">Please enter a realisasi</em>
          </div>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Stock Kapuk</label>
            <input class="form-control" type="text" name="stockk[]" value="1" id="stockk" aria-describedby="stockk-error" />
          <em id="stockk-error" class="error invalid-feedback">Please enter a stockk</em>
          </div>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Pending SO</label>
            <input class="form-control" type="text" name="pending[]" value="1" id="pending" aria-describedby="pending-error"/>
          <em id="pending-error" class="error invalid-feedback">Please enter a pending</em>
          </div>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Balance Stock</label>
            <input class="form-control" type="text" name="balance[]" value="1" id="balance" aria-describedby="balance-error"/>
          <em id="balance-error" class="error invalid-feedback">Please enter a balance</em>
          </div>
        </div>
        <div class="col-md-4" style="display: none;">
          <div class="form-group">
            <label class="col-form-label" >*Pending PR</label>
            <input class="form-control" type="text" name="pendingpr[]" value="1" id="pendingpr" aria-describedby="pendingpr-error"/>
          <em id="pendingpr-error" class="error invalid-feedback">Please enter a pendingpr</em>
          </div>
        </div>
      </div>
      <hr style="border-top: 4px solid #20a8d8">
    </div>
  </div>
</div>