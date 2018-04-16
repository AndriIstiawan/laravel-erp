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
                  <i class="fa fa-ticket"></i> Payment PO Status
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead>
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
                  <i class="fa fa-id-card"></i> Data Member
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th><i class="fa fa-user-circle-o"></i> Name</th>
                        <th><i class="fa fa-envelope"></i> Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Member</td>
                        <td>member@ecommerce.com</td>
                      </tr>
                    </tbody>
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
                        <th>Type Payment</th>
                        <th>Name Bank</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">ATM Transfer</td>
                        <td class="vertical-align-middle">MANDIRI</td>
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
                          <th>Quantity</th>
                          <th class="text-right">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="vertical-align-middle">Trafometer 10.000 V</td>
                          <td class="vertical-align-middle">Rp 42.530.000</td>
                          <td class="vertical-align-middle">1</td>
                          <td class="vertical-align-middle text-right">Rp 42.530.000</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <table class="table table-condensed">
                      <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Discount:</td>
                        <td class="text-right">-50000</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Shipping cost:</td>
                        <td class="text-right">200.000</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><strong>Rp 42.680.000</strong></td>
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