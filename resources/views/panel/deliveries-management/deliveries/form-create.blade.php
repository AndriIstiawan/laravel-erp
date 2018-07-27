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
                  <i class="fa fa-ticket"></i> Transaction Status
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead> <h5>Status history</h5></p>
                      <tr>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{$orders->status}}</td>
                        <td>{{$orders->created_at}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-ticket"></i> Data Sales
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{(isset($orders->sales[0]['name'])?$orders->sales[0]['name']:'')}}</td>
                        <td>{{(isset($orders->sales[0]['detail']['email'])?$orders->sales[0]['detail']['email']:'')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-ticket"></i> Data Discount
                </div>
                <div class="card-body">
                  <table class="table table-responsive-sm">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Value</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{(isset($orders->discount[0]['name'])?$orders->discount[0]['name']:'')}}</td>
                        <td>{{(isset($orders->discount[0]['value'])?$orders->discount[0]['value']:'')}}</td>
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
                  <i class="fa fa-user"></i> Data Member
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
                        <td>{{(isset($orders->client[0]['display_name'])?$orders->client[0]['display_name']:'')}}</td>
                        <td>{{(isset($orders->client[0]['email'])?$orders->client[0]['email']:'')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card">
                <div class="card-header with-border">
                      <span><i class="fa fa-user"></i> Shipping details</span>
                </div>
                <div class="card-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active show" data-toggle="tab" href="#tab-shipping-address" role="tab" aria-controls="home" aria-selected="true">Shipping address</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab-shipping-address">
                          <table class="table table-condensed table-hover">
                            <tbody>
                            <tr>
                              <td>Address</td>
                              <td>
                                {{(isset($orders->shipping)?$orders->shipping:'')}}
                              </td>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/.row-->

          <div class="row">

            <!-- <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <span><i class="fa fa-credit-card"></i> Payment Method</span>
                </div>
                <div class="card-body">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Type Payment</th>
                        <th>Bank</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">{{(isset($orders->payment[0]['type'])?$orders->member[0]['type']:'')}}</td>
                        <td class="vertical-align-middle">{{(isset($orders->payment[0]['name'])?$orders->member[0]['name']:'')}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> -->
            <!--/.col-->

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <span><i class="fa fa-truck"></i> Data Delivery</span>
                </div>
                <div class="card-body">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Delivery Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">{{(isset($orders->delivery[0]['name'])?$orders->delivery[0]['name']:'')}}</td>
                        <td class="vertical-align-middle">{{(isset($orders->delivery[0]['price'])?$orders->delivery[0]['price']:'')}}</td>
                        <td class="vertical-align-middle">{{(isset($orders->status)?$orders->status:'')}}</td>
                        <td class="vertical-align-middle">{{(isset($orders->delivery[0]['created_at'])?$orders->delivery[0]['created_at']:'')}}</td>
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
                        <span><i class="fa fa-shopping-cart"></i> Products Carts</span>
                  </div>
                  <div class="card-body">
                    <div class="col-md-12">
                      <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th class="text-right">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($orders->products as $prod_list)
                          <tr>
                              <td class="vertical-align-middle">{{$prod_list['name']}}</td>
                              <td class="vertical-align-middle">Rp. {{str_replace(',00','',number_format(isset($prod_list['price']),2,',','.'))}}</td>
                              <td class="vertical-align-middle">{{$prod_list['quantity']}}</td>
                              <td class="vertical-align-middle text-right">Rp. {{str_replace(',00','',number_format(isset($prod_list['totalPrice']),2,',','.'))}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="col-md-12">
                      <table class="table table-condensed">
                          <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                    <strong>Total:</strong>
                                </td>
                                <td class="text-right">
                                    <strong>{{(isset($orders->total_price)?'Rp. '.str_replace(',00','',number_format($orders->total_price,2,',','.')):'')}}</strong>
                                </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
                  </div>
                </div>
            </div>
            <!--/.col-->
        
        <!--/.row-->

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