<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Macbrame Backend">
    <meta name="author" content="fiture-dev">
    <meta name="keyword" content="fiture,e-rp,e-erp macbrame">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

    <title>Macbrame Backend</title>

    <!-- Icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Styles required by this views -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>

<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->has('email'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Login Failed..</strong> The email or password is incorrect.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
        </div>     
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h1>Login</h1><!-- <p class="text-muted">ADMIN<br>
                            Email : admin@macbrame.com<br> Pass : macbrame</p> -->
                        <p class="text-muted">Sign In to your account</p>
                        <form method="POST" action="{{ route('login') }}">

                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" required
                                       autofocus placeholder="email">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       required>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary px-4">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <h2>Macbrame Backend ERP</h2><br>
                        <div>
                            <p>Project development ERP Web. copyright@fiture.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script>$(".alert").delay(1000).fadeOut(1000);</script>
</body>
</html>
