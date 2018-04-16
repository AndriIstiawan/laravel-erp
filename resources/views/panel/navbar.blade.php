<header class="app-header navbar">
	<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#"></a>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
		<span class="navbar-toggler-icon"></span>
	</button>
	<ul class="nav navbar-nav ml-auto">
		<li class="nav-item d-md-down-none">
			Hello, {{Auth::user()->name}}
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img src="{{ (Auth::user()->picture? asset('img/avatars/'.Auth::user()->picture) : asset('img/avatars/1.jpg') ) }}" class="img-avatar"
				    alt="{{ Auth::user()->email }}">
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-header text-center">
					<strong>Setting Account</strong>
				</div>
				<a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#primaryModal" data-link="{{url('profile/reset-password')}}"
				    onclick="funcModal($(this))">
					<i class="fa fa-lock"></i> Reset Password </a>
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i> Logout
				</a>
			</div>
		</li>
	</ul>
	<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		{{ csrf_field() }}
	</form>
</header>