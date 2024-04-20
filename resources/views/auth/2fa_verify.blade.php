
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- include styles --}}
  @includeIf('vendorpanel.partials.styles')

  {{-- additional style --}}
  @yield('style')
  <title>
    Tenners
  </title>

</head>

<body class="g-sidenav-show  bg-gray-200">

 
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @if(Auth::guard('vendor')->check())
    @includeIf('vendorpanel.partials.top-navbar')
    @else
    @includeIf('backend.partials.top-navbar')
    @endif
    <!-- End Navbar -->
    <div class="container-fluid py-4">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 ">
                <div class="card">
                    <div class="card-header">Two Factor Authentication</div>
                    <div class="card-body">
                        <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        Enter the pin from Google Authenticator app:<br/><br/>

                        @if(Auth::guard('vendor')->check())
                        <form class="form-horizontal" action="{{ url('/vendor/2fa/2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <label for="one_time_password" class="control-label">One Time Password</label>
                                <input id="one_time_password" name="one_time_password" style="border: 1px solid black;" class="form-control col-md-4"  type="text" required/>
                            </div>
                            <br>
                            <button class="btn btn-primary" type="submit">Authenticate</button>
                        </form>

                        @else
                        <form class="form-horizontal" action="{{ url('/admin/2fa/2faVerify') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                <label for="one_time_password" class="control-label">One Time Password</label>
                                <input id="one_time_password" name="one_time_password" style="border: 1px solid black;" class="form-control col-md-4"  type="text" required/>
                            </div>
                            <br>
                            <button class="btn btn-primary" type="submit">Authenticate</button>
                        </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
      @includeIf('vendorpanel.partials.footer')
    </div>
  </main>
  @includeIf('vendorpanel.partials.plugins')
  @includeIf('vendorpanel.partials.scripts')

</body>

</html>
  
