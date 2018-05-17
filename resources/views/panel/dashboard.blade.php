@extends('master')
@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
    <!-- card -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">TOP 5 SKU SALES (KGS)</h4>
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
          <h4 class="card-title">TOP 5 SKU SALES (IDR)</h4>
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
          <h4 class="card-title">TOP 5 SKU SALES LOSS (KGS)</h4>
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
          <h4 class="card-title">TOP 5 SKU SALES LOSS (IDR)</h4>
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
                              data: [584,393,365,339,289]
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
        </script>
@endsection