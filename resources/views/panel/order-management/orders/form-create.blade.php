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
                        <td>Pending</td>
                        <td>2012/01/01</td>
                      </tr>
                      <tr>
                        <td>Processed</td>
                        <td>2012/02/01</td>
                      </tr>
                      <tr>
                        <td>Delivered</td>
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
                        <td>nia ramadhani</td>
                        <td>nia@gmail.com</td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- <div class="form-group">
                      <label class="col-form-label" for="value">*Sales</label>
                        <select id="notification" name="notification" class="form-control" aria-describedby="notification-error" value="" required>
                          @foreach ($modUser as $modUser)
                          <option value="{{$modUser->id}}">{{$modUser->name}}</option>
                          @endforeach
                        </select>
                      <em id="notification-error" class="error invalid-feedback">Please enter a new notification</em>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Update sales</button>
                  </div> -->
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
                        <td>Lebaran Meriah</td>
                        <td>50.000</td>
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
                        <td>Member</td>
                        <td>member@ecommerce.com</td>
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
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#tab-billing-info" role="tab" aria-controls="home" aria-selected="true">Billing info</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab-shipping-address">
                        <h5>Shipping address</h5>
                          <table class="table table-condensed table-hover">
                            <tbody><tr>
                              <td>Contact Person</td>
                              <td>Jerry Williams</td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td>
                                South Fabien Street <br>
                                No. 34
                              </td>
                            </tr>
                            <tr>
                              <td>County</td>
                              <td>Bucharest</td>
                            </tr>
                            <tr>
                              <td>City</td>
                              <td>Bucharest</td>
                            </tr>
                            <tr>
                              <td>Postal Code</td>
                              <td>123456</td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td>+413-26-9811311</td>
                            </tr>
                            <tr>
                              <td>Mobile phone</td>
                              <td>+257-35-5785588</td>
                            </tr>
                            <tr>
                              <td>Comment</td>
                              <td>Lorem ipsum dolor sit amet.</td>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class="tab-pane" id="tab-billing-info">
                        <h5>Billing company details</h5>
                          <table class="table table-condensed table-hover">
                            <tbody>
                              <tr>
                                <td>Company name</td>
                                <td>Company Name</td>
                              </tr>
                              <tr>
                                <td>Address</td>
                                <td>
                                  Flowers street <br>
                                  No. 25
                                </td>
                              </tr>
                              <tr>
                                <td>County</td>
                                <td>Bucharest</td>
                              </tr>
                              <tr>
                                <td>City</td>
                                <td>Bucharest</td>
                              </tr>
                              <tr>
                                <td>Tax Identification Number</td>
                                <td>12345678</td>
                              </tr>
                              <tr>
                                <td>Trade Registry Number</td>
                                <td>J1/123/2000</td>
                              </tr>
                            </tbody>
                          </table>
                        <h5>Billing address</h5>
                          <table class="table table-condensed table-hover">
                            <tbody>
                              <tr>
                                <td>Contact Person</td>
                                <td>Jerry Williams</td>
                              </tr>
                              <tr>
                                <td>Address</td>
                                <td>
                                  South Fabien Street <br>
                                  No. 34
                                </td>
                              </tr>
                              <tr>
                                <td>County</td>
                                <td>Bucharest</td>
                              </tr>
                              <tr>
                                <td>City</td>
                                <td>Bucharest</td>
                              </tr>
                              <tr>
                                <td>Postal Code</td>
                                <td>123456</td>
                              </tr>
                              <tr>
                                <td>Phone</td>
                                <td>+413-26-9811311</td>
                              </tr>
                              <tr>
                                <td>Mobile phone</td>
                                <td>+257-35-5785588</td>
                              </tr>
                              <tr>
                                <td>Comment</td>
                                <td>Lorem ipsum dolor sit amet.</td>
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
                        <th>Bank</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">ATM Transfer</td>
                        <td class="vertical-align-middle">BRI</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
                        <th>Type</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Delivery Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="vertical-align-middle">Courier</td>
                        <td class="vertical-align-middle">JNE</td>
                        <td class="vertical-align-middle">20.00 Euro</td>
                        <td class="vertical-align-middle">On Process (Warehouse rawamangun jakarta barat) </td>
                        <td class="vertical-align-middle">2018/03/01</td>
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
                        <tr>
                          <td class="vertical-align-middle">Trafometer 10.000 V</td>
                          <td class="vertical-align-middle">42.530.000 </td>
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
                        <td class="text-right">-50.000</td>
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