<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Fiture - ERP">
  <meta name="author" content="fiture-dev">
  <meta name="keyword" content="fiture,erp">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
  <title>Macbrame Backend</title>

  <!-- Icons -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="{{ asset('fiture-style/css/'.env('STYLE_CSS','style').'.css') }}" rel="stylesheet">
  <!-- Styles required by this views -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link href="{{ asset('fiture-style/toastr/toastr.min.css') }}" rel="stylesheet">
  @yield('css')
</head>
<!-- BODY options, add following classes to body to change options
'.header-fixed' - Fixed Header
'.brand-minimized' - Minimized brand (Only symbol)
'.sidebar-fixed' - Fixed Sidebar
'.sidebar-hidden' - Hidden Sidebar
'.sidebar-off-canvas' - Off Canvas Sidebar
'.sidebar-minimized'- Minimized Sidebar (Only icons)
'.sidebar-compact'    - Compact Sidebar
'.aside-menu-fixed' - Fixed Aside Menu
'.aside-menu-hidden'- Hidden Aside Menu
'.aside-menu-off-canvas' - Off Canvas Aside Menu
'.breadcrumb-fixed'- Fixed Breadcrumb
'.footer-fixed'- Fixed footer
-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  @include('panel.navbar')

  <div class="app-body">
    @include('panel.sidebar')
    <!-- Main content -->
	<?php
		$uriLists = Route::current()->getName();
        $uriLists = explode(".", $uriLists);
	?>
    <main class="main">
		<ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{url('/')}}">Home</a></li>
            <?php
                if(count($uriLists) > 1){
                    for($countUri=0; $countUri < count($uriLists); $countUri++){
                        $valUrl = '<a href="'.url($uriLists[$countUri]).'">'.$uriLists[$countUri].'</a>';
                        $statusUrl = "";
                        if($countUri == count($uriLists)-1){
                            $valUrl = $uriLists[$countUri];
                            $statusUrl = "active";
                        }
                        ?>
                        <li class="breadcrumb-item {{$statusUrl}}"><?php echo ($valUrl!='show'?$valUrl:(isset($uriLink)?$uriLink:'')); ?></li>
                        <?php
                    }
                }
            ?>
			<li class="breadcrumb-menu d-md-down-none">
			<!-- <div class="btn-group" role="group" aria-label="Button group">
			<a class="btn" href="#"><i class="icon-speech"></i></a>
			<a class="btn" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
      @if(Auth::user()->hasAcc('master-setting'))
			<a class="btn" href=""><i class="icon-settings"></i> &nbsp;Settings</a>
      @endif
			</div> -->
			</li>
		</ol>
      <!-- Breadcrumb -->
      @include('panel.breadcrumb')

      @yield('content')
      <!-- /.container-fluid -->
	  @include('panel.modal')
    </main>
  </div>

  @include('panel.footer')

  @include('panel.scripts')
  <script src="{{ asset('fiture-style/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('fiture-style/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('fiture-style/jquery.priceformat.min.js') }}"></script>
  @yield('myscript')

</body>
</html>
