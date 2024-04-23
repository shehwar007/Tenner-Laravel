<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tenner Bussiness</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets2/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets2/css/style.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
  <header class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-wrapper">
            <div class="header-logo"><a href="{{route('vendor.welcome')}}"><img src="{{ asset('assets2/images/logo.png')}}" alt="site logo"></a></div>
            <div class="header-btn"><a class="contact-btn" href="#">Contact Us</a></div>
          </div>
        </div>
      </div>
    </div>

  </header>
  <section class="main welcome-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
      
          @if(session('danger'))
          <div class="alert alert-danger">
            {{ session('danger') }}
          </div>
          @endif

          @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
        </div>
        <div class="col-12">
          @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
        </div>

      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card-wrapper">
            <div class="signin-card Card">
              <h3 class="card-title">Business Sign in</h3>

              <form class="site-form signin-form" action="{{ route('vendor.authentication') }}" method="POST">
                @csrf
                <div class="form-field">
                  <label for="" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="" name="email" placeholder="Enter Email Address">
                </div>
                <div class="form-field">
                  <label for="password" class="form-label">Enter Password</label>
                  <div class="password-field">
                    <input name="password" type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                    <span class="password-icon" id="show_password" onclick="password_show_hide()">
                      <i class="fa-regular fa-eye-slash" id="show_eye" style="display: block;"></i>
                      <i class="fa-regular fa-eye" id="hide_eye" style="display: none;"></i>
                    </span>
                    <a class="forget-password" href="{{route('vendor.resetPassword')}}">Forgot Password</a>
                  </div>
                </div>
                <div class="form-field m-0">
                  <button type="submit" class="form-btn">Sign in</button>
                </div>
              </form>
              <p class="form-note">Don’t have an account? <a class="link" href="{{route('vendor.signup')}}">Sign Up</a></p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets2/js/bootstrap.bundle.min.js') }}"></script>


  <script>
    //show password function
    function password_show_hide() {
      var x = document.getElementById("password");
      var show_eye = document.getElementById("show_eye");
      var hide_eye = document.getElementById("hide_eye");
      hide_eye.classList.remove("d-none");
      if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
      } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";

      }
    }
  </script>
</body>

</html>