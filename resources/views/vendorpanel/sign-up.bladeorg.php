
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href="{{ asset('assets/css/vendor.css') }}" rel="stylesheet" />
  @includeIf('vendorpanel.partials.styles')
  {{-- additional style --}}

  
  <title>
    Tenners SignUp
  </title>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/food.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  {{-- <p class="mb-0">Enter your email and password to register</p> --}}
                </div>
                <div class="card-body">
                  {{-- <form role="form"> --}}
                  <form method="post" name="login_form" class="login-form" action="{{ route('vendor.create') }}" enctype="multipart/form-data"> 
                    @csrf
                    <div class="form-group">
                      
                      <div class="thumb-preview">
                          <img  style="width:150px;" src="{{ asset('assets/img/noimage.jpg') }}" alt="..." class="uploaded-img"/>
                      </div>
                      <br>
                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          {{ __('Choose Logo') }}
                          <input type="file" accept="image/*" class="img-input" name="logo">
                        </div>
                        @if ($errors->has('logo'))
                          <p class="mt-2 mb-0 text-danger">{{ $errors->first('logo') }}</p>
                        @endif
                      </div>
                    </div>
                    <label class="form-label">Business Name</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" name="name" id="name" placeholder="Enter Business Name" class="form-control" value="{{ old('name') }}"
                      >              
                    </div>
                    <div>
                      @error('name')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                    <label class="form-label">Email</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="email" name="email" placeholder="Enter Business Name" value="{{ old('email') }}" id="email"
                      class="form-control">
                      {{-- <input type="email" class="form-control"> --}}
                    </div>
                    <div>
                      @error('email')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

    
                    <input type="text" hidden class="form-control" placeholder="latitude"
                              name="latitude" id="lat" value="32.1496129">
                  
                    <input type="text" hidden class="form-control" placeholder="longitude"
                              name="longitude" id="lng" value="74.214759">
                    
                  

                    <label class="form-label">Address</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="text" name="address" placeholder="Enter Business Name" value="{{ old('address') }}" id="address"
                      class="form-control">
                      {{-- <input type="email" class="form-control"> --}}
                    </div>
                    <div>
                      @error('address')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <label class="form-label">Phone</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="phone" name="phone" placeholder="Enter Phone" value="{{ old('phone') }}" id="phone"
                      class="form-control">
                      {{-- <input type="email" class="form-control"> --}}
                    </div>
                    <div>
                      @error('phone')
                          <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>

                    <label class="form-label">Password</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="password" placeholder="Enter Password" id="password" class="form-control"
                     >
                    </div>
                    <div>
                      @error('password')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group input-group-outline mb-3">
                      <input type="password" name="password_confirmation" placeholder="Enter Confirm Password" id="password_confirmation" class="form-control"
                     >
                    </div>
                    <div>
                      @error('confirmed')
                        <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>



                    <div class="form-group col-md-12">
                        <center>
                            <div id="map" style="height: 143px;" class="form-control my-3"></div>
                        </center>
                    </div>



                    {{-- <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div> --}}
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('vendor.login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->

     <!-- For Map -->
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>

    <script>
        let map;

        function initMap() {

            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    // lat: 32.2448,
                    // lng: 74.0153
                    lat: 32.1496129,
                    lng: 74.214759
                
                },
                zoom: 13,
                scrollwheel: true,
                mapTypeId: "satellite",
            });

            const uluru = {
                lat: 32.1496129,
                lng: 74.214759
            };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })
            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    marker.setPosition(pos)
                })

            map.setTilt(45);
        }
        window.initMap = initMap;
    </script>
  @includeIf('vendorpanel.partials.scripts')
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