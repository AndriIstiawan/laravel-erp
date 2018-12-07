@extends('master')
@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
    <div class="col-sm-4">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>Total Produksi</center></b>
        </div>
        <div class="card-body" style="height:130px;margin-top:0px; width: 100%;" >
            <h1><center><strong><big><b><font size="8">{{$prod}}</font></b></big></strong></center></h1>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>Total Sales Order</center></b>
        </div>
        <div class="card-body" style="height:130px;margin-top:0px; width: 100%;" >
            <h1><center><strong><big><b><font size="8">{{$sor}}</font></b></big></strong></center></h1>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>Omset</center></b>
        </div>
        <div class="form-grup" style="height:130px;margin-top:0px; width: 100%;" >
        @foreach ($so as $salesorder3)
          <li style="list-style: decimal; padding-left: 10px;">
            <strong>{{$salesorder3['code']}}</strong>
          </li>
        @endforeach
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>New Sales Order</center></b>
        </div>
        <div class="form-grup" style="height:130px;margin-top:0px; width: 100%;" >
        @foreach ($so as $salesorder)
          <li style="list-style: decimal; padding-left: 10px;">
            <strong>{{$salesorder['code']}}</strong>
          </li>
        @endforeach
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>New Sales Order</center></b>
        </div>
        <div class="form-grup" style="height:130px;margin-top:0px; width: 100%;" >
        @foreach ($so as $salesorde)
          <li style="list-style: decimal; padding-left: 10px;">
            <strong>{{$salesorde['code']}}</strong>
          </li>
        @endforeach
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>New Sales Order</center></b>
        </div>
        <div class="form-grup" style="height:130px;margin-top:0px; width: 100%;" >
        @foreach ($so as $salesord)
          <li style="list-style: decimal; padding-left: 10px;">
            <strong>{{$salesord['code']}}</strong>
          </li>
        @endforeach
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card bg-primary">
        <div class="card-title">
          <center><b>New Sales Order</center></b>
        </div>
        <div class="form-grup" style="height:130px;margin-top:0px; width: 100%;" >
        @foreach ($so as $salesor)
          <li style="list-style: decimal; padding-left: 10px;">
            <strong>{{$salesor['code']}}</strong>
          </li>
        @endforeach
        </div>
      </div>
    </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><center>HIGLIGHTED FACTS</center></h4>
          </div>
        </div>
      </div>
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 5 SKU SALES (KGS)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #266a8b;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #8db2cd;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #317ea4;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a4bed2;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #3b8fb8;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 5 SKU SALES (IDR)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart1" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #266a8b;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #8db2cd;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #317ea4;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a4bed2;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #3b8fb8;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 5 SKU SALES LOSS (KGS)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart2" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #92403c;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #cd8b87;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ad4f49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #d9b1af;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c35b54;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 5 SKU SALES LOSS (IDR)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart3" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #92403c;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #cd8b87;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ad4f49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #d9b1af;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c35b54;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 10 CUSTOMER SALES (KGS)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart4" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #687d39;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a2c06c;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #758f42;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #b4c98e;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #829d49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c1d2a6;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #8ba950;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #cfddba;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #95b555;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #dbe4cd;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 10 CUSTOMER SALES (IDR)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart5" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #687d39;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a2c06c;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #758f42;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #b4c98e;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #829d49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c1d2a6;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #8ba950;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #cfddba;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #95b555;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #dbe4cd;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 10 CUSTOMER SALES LOSS (KGS)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart6" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #823330;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c56764;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #923a39;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ce8887;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a0423e;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #d5a2a1;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ad4745;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #dfb8b8;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #b94d49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #e7cdcc;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>TOP 10 CUSTOMER SALES LOSS (IDR)</center></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="bar-chart7" class="chart" height="300"></canvas>    
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <table>
            <tbody>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #823330;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>MOON BLUES - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #c56764;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SALUTE SELENITA - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #923a39;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>SIRENE GO - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ce8887;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #a0423e;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #d5a2a1;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #ad4745;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #dfb8b8;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
              <tr>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #b94d49;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>ROMANTICA WISH - VFM</strong></td>
                <td class="legendColorBox">
                  <div style="border:1px solid #ccc;padding:1px">
                    <div style="width:4px;height:0;border:5px solid #e7cdcc;;overflow:hidden"></div>
                  </div>
                </td>
                <td class="legendLabel"><strong>QUEEN TAYLOR PREMIO - VFM</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>SALES PERFORMANCE BY MARKET SEGMENTATION</center></h4>
        </div>
      </div>
    </div>
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #1f487b;"><b><center>SALES</center></b></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart" width="800" height="450"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #a6433f;"><b><center>SALES LOSS</center></b></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart1" width="800" height="450"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>SALES PERFORMANCE BY CATEGORY</center></h4>
        </div>
      </div>
    </div>
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #1f487b;"><b><center>SALES</center></b></h4>
          <div class="chart-wrapper" style="height:400px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart2" width="700" height="550"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #a6433f;"><b><center>SALES LOSS</center></b></h4>
          <div class="chart-wrapper" style="height:400px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart3" width="700" height="550"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><center>SALES PERFORMANCE BY MARKET SECTOR</center></h4>
        </div>
      </div>
    </div>
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #1f487b;"><b><center>SALES</center></b></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart4" width="800" height="450"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" style="color: #a6433f;"><b><center>SALES LOSS</center></b></h4>
          <div class="chart-wrapper" style="height:300px;margin-top:0px; width: 100%;" >
            <div class="row">
              <div class="col-md-12">
                <canvas id="pie-chart5" width="800" height="450"></canvas>    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end card  -->
    </div>
  </div>
</div>
@endsection
<!-- /.conainer-fluid -->

@section('myscript')
  <script src="{{ asset('js/vendor/Chart.min.js') }}"></script>
  <script>
        $(document).ready(function(){
            var ctx = document.getElementById("bar-chart");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#266a8b", "#317ea4","#3b8fb8","#8db2cd","#a4bed2"],
                              data: 
                              [@foreach($chart as $charts)
                              {{$charts->total_kg}}/1000,
                              @endforeach]
                              
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES (KGS)'
                      }
                  }
              });
            var ctx = document.getElementById("bar-chart1");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#266a8b", "#317ea4","#3b8fb8","#8db2cd","#a4bed2"],
                              data: [198000000,146000000,145000000,144000000,98000000]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES (IDR)'
                      }
                  }
              });
        });
        $(document).ready(function(){
            var ctx = document.getElementById("bar-chart2");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#92403c", "#ad4f49","#c35b54","#cd8b87","#d9b1af"],
                              data: [311,148,114,98,76]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (KGS)'
                      }
                  }
              });
              var ctx = document.getElementById("bar-chart3");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#92403c", "#ad4f49","#c35b54","#cd8b87","#d9b1af"],
                              data: [116000000,53000000,49000000,39500000,35000000]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (IDR)'
                      }
                  }
              });
        });
        $(document).ready(function(){
            var ctx = document.getElementById("bar-chart4");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", "","", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#687d39", "#758f42","#829d49","#8ba950","#95b555","#a2c06c","#b4c98e","#c1d2a6","#cfddba","#dbe4cd"],
                              data: [311,148,114,98,76,311,148,114,98,76]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (KGS)'
                      }
                  }
              });
              var ctx = document.getElementById("bar-chart5");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", "","", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#687d39", "#758f42","#829d49","#8ba950","#95b555","#a2c06c","#b4c98e","#c1d2a6","#cfddba","#dbe4cd"],
                              data: [116000000,53000000,49000000,39500000,35000000,116000000,53000000,49000000,39500000,35000000]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (IDR)'
                      }
                  }
              });
        });
        $(document).ready(function(){
            var ctx = document.getElementById("bar-chart6");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", "","", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#823330", "#923a39","#a0423e","#ad4745","#b94d49","#c56764","#ce8887","#d5a2a1","#dfb8b8","#e7cdcc"],
                              data: [311,148,114,98,76,311,148,114,98,76]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (KGS)'
                      }
                  }
              });
              var ctx = document.getElementById("bar-chart7");
                var myChart = new Chart(ctx, {
                  type: 'bar',
                  responsive:true,
                  data: {
                      labels: ["", "", "", "", "","", "", "", "", ""],
                      datasets: [{
                              backgroundColor: ["#823330", "#923a39","#a0423e","#ad4745","#b94d49","#c56764","#ce8887","#d5a2a1","#dfb8b8","#e7cdcc"],
                              data: [116000000,53000000,49000000,39500000,35000000,116000000,53000000,49000000,39500000,35000000]
                      }]
                  },
                  options: {
                      legend: { display: false },
                      title: {
                        display: false,
                        text: 'TOP 5 SKU SALES LOSS (IDR)'
                      }
                  }
              });
        });
        $(document).ready(function(){
          var ctx = document.getElementById("pie-chart");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["BODY PERFUME", "LAUNDRY", "AIR CARE"],
                datasets: [{
                  backgroundColor: ["#3670b7", "#8e5ea2","#3cba9f"],
                  data: [88.8,9.3,1.6]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
          var ctx = document.getElementById("pie-chart1");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["BODY PERFUME", "LAUNDRY", "AIR CARE"],
                datasets: [{
                  backgroundColor: ["#b03431", "#d78583 ","#e6c6c6"],
                  data: [96,3]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
        });
        $(document).ready(function(){
          var ctx = document.getElementById("pie-chart2");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["VERY FAST MOVING", "FAST MOVING", "MODERATE","SLOW MOVING", "NON MOVING"],
                datasets: [{
                  backgroundColor: ["#3b7ac6", "#b73734","#96be45","#72569b","#32a7c6"],
                  data: [35,12,19,20,15]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
          var ctx = document.getElementById("pie-chart3");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["VERY FAST MOVING", "FAST MOVING", "MODERATE","SLOW MOVING", "NON MOVING"],
                datasets: [{
                  backgroundColor: ["#dfbbbb", "#d19292","#c0504d","#aa4643","#903938"],
                  data: [24,11,13,6,46]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
        });
        $(document).ready(function(){
          var ctx = document.getElementById("pie-chart4");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["RETAIL", "INDUSTRI", "EXPORT"],
                datasets: [{
                  backgroundColor: ["#3877c1", "#b53633","#94bb44"],
                  data: [89,7,4]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
          var ctx = document.getElementById("pie-chart5");
          var myChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ["RETAIL", "INDUSTRI", "EXPORT"],
                datasets: [{
                  backgroundColor: ["#942a28", "#cb3d39","#d09796"],
                  data: [82,14,4]
                }]
              },
              options: {
                title: {
                  display: false,
                  text: 'Predicted world population (millions) in 2050'
                }
              }
            });
        });
        </script>
@endsection