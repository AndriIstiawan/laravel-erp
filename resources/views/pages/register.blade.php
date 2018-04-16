<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>CoreUI Bootstrap 4 Admin Template</title>

  <!-- Icons -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- Main styles for this application -->

  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mx-4">
          <div class="card-body p-4">
            <h1>Register</h1>
            <p class="text-muted">Create your account</p>
            <form method="POST" action="{{ route('register') }}">
              {{ csrf_field() }} 
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Username">
              </div>              
  
              <div class="input-group mb-3">
                <span class="input-group-addon">@</span>
                <input type="text" name="email" class="form-control" placeholder="Email">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>

              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
              </div>

              <button type="submit" class="btn btn-block btn-warning">Create Account</button>
            </form>

            <a href="/login" class="btn btn-block btn-secondary mt-2">You have already an account? Sign in</a>
          </div>
          <div class="card-footer p-4">
            <div class="row">
              <div class="col-6">
                <button class="btn btn-block btn-facebook" type="button">
                  <span>facebook</span>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-block btn-twitter" type="button">
                  <span>twitter</span>
                </button>
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

</body>
</html>