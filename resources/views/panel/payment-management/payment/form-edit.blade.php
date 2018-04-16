@extends('master')
@section('content')
<link href="{{ asset('fiture-style/select2/select2.min.css') }}" rel="stylesheet">
        <div class="container-fluid">
          <p>
        <button type="button" class="btn btn-primary" onclick="window.history.back()">
          <i class="fa fa-backward"></i>&nbsp; Back to List
        </button>
        </p>
        </div>
        <div class="container-fluid">
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-ticket"></i> Payment Status
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead> <h5>Status Payment</h5></p>
                      <tr>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Processed</td>
                        <td>2012/02/01</td>
                      </tr>
                      <tr>
                        <td>Done</td>
                        <td>2012/03/01</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--/.col-->

            <div class="col-md-5">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-user"></i> Member
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm table-striped">
                    <thead> <h5>Data</h5></p>
                    </thead>
                    <div class="row">
                        <div class="col-md-7">
                          <i class="fa fa-user-circle-o"></i> Member <br>
                          <i class="fa fa-envelope"></i> <a href="#">member@ecommerce.com</a> <br>
                        </div>
                        <div class="col-md-6">
                          <i class="fa fa-mars"></i> Male
                        </div>
                    </div>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--/.row-->

          <div class="row">

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <span><i class="fa fa-credit-card"></i> Payment Method</span>
                </div>
                <div class="card-body">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Bank</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">BANK MANDIRI</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--/.col-->

            <div class="col-md-12">
              <div class="card">
                  <div class="card-header with-border">
                        <span><i class="fa fa-shopping-cart"></i> Products</span>
                  </div>
                  <div class="card-body">
                    <div class="col-md-12">
                      <table class="table table-responsive-sm table-hover table-striped table-sm datatable">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Price with Tax</th>
                          <th>Quantity</th>
                          <th class="text-right">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="vertical-align-middle">
                            T-Shirt                          </td>
                          <td class="vertical-align-middle">22.73 Euro</td>
                          <td class="vertical-align-middle">25.00 Euro</td>
                          <td class="vertical-align-middle">1</td>
                          <td class="vertical-align-middle text-right">25.00 Euro</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-condensed">
                      <tbody><tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Shipping cost:</td>
                        <td class="text-right">20.00 Euro</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><strong>45.00 Euro</strong></td>
                      </tr>
                    </tbody></table>
                  </div>

                  </div>
                </div>
            </div>
            <!--/.col-->

          </div>
          <!--/.row-->
        </div>

      </div>
@endsection

@section('myscript')
<script src="{{ asset('fiture-style/select2/select2.min.js') }}"></script>
<script>

  $('#notification').select2({theme:"bootstrap", placeholder:'Please select', tags:true});
  $('#notification').on('change', function(){
    $(this).addClass('is-valid').removeClass('is-invalid');
  });

  $("#jxForm1").validate({
    rules:{
      notification:{required:true}
    },
    messages:{
      notification:{
        required:'Please select a status'
      }
    },
    errorElement:'em',
    errorPlacement:function(error,element){
      error.addClass('invalid-feedback');
    },
    highlight:function(element,errorClass,validClass){
      $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight:function(element,errorClass,validClass){
      $(element).addClass('is-valid').removeClass('is-invalid');
    }
  });
  
</script>
@endsection