<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
 
  <title>
    Tenners EMail Verify
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200">

  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100">
    
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Verify your Email</h4>
                
                </div>
              </div>
              <div class="card-body">
                  @if (session()->has('alert'))
                    <div class="alert alert-danger fade show" role="alert">
                      <strong>{{ session('alert') }}</strong>
                    </div>
                  @endif
                {{-- <form role="form" class="text-start"> --}}
                <form class="login-form" action="{{ route('email.sendcode') }}" method="POST">
                  @csrf  
                  Before proceeding, please check your email for a verification link
                  {{-- <div class="form-check form-switch d-flex align-items-center mb-3">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                  </div> --}}
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Send Email </button>
                  </div>
              
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </main>
  <!--   Core JS Files   -->
  @includeIf('backend.partials.scripts')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  {{-- <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script> --}}
</body>

</html>