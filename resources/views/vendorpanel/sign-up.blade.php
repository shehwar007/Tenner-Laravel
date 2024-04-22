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
            <div class="header-logo"><a href="index.html"><img src="{{ asset('assets2/images/logo.png')}}" alt="site logo"></a></div>
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
          @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card-wrapper">
            <div class="signup-card Card">
              <form method="post" name="login_form" class="site-form signup-form" action="{{ route('vendor.create') }}" enctype="multipart/form-data">
                @csrf

                <ul id="js-stepForm-menu" class="stepForm-menu">
                  <li id="account" class="active">1</li>
                  <li id="personal">2</li>
                  <li id="payment">3</li>
                  <li id="confirm">4</li>
                </ul>
                <fieldset>
                  <div class="signUp-form-heading">
                    <h2 class="title">Basic Information</h2>
                    <p class="sub-title">Business Name & Logo</p>
                  </div>
                  <div class="signUp-form-content">
                    <div class="form-field">
                      <label for="" class="form-label">Business Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter Business Name">
                      <span class="field-note">*30 character limit</span>
                    </div>
                    <div class="form-field m-0">
                      <label for="" class="form-label">Upload Business Logo</label>
                      <div class="file-upload">
                        <div class="file-upload-preview">
                          <i class="fa-regular fa-image"></i>
                        </div>
                        <div class="file-upload-content">
                          <p class="note">Please upload an image, Max size of 100MB</p>
                          <div class="file-input">
                            <label class="site-btn">
                              <input type="file" name="logo">
                            </label>
                            <!-- <span class="file-text">No File Chosen</span> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="button" name="next" class="next action-button site-btn bg-btn" value="Save Information">

                </fieldset>
                <fieldset>
                  <div class="signUp-form-heading">
                    <h2 class="title">Business Address</h2>
                    <p class="sub-title">Enter Business Lcoation</p>
                  </div>
                  <div class="signUp-form-content">
                    <div class="form-field">
                      <label for="" class="form-label">Select Address</label>
                      <input type="text" name="address" class="form-control" id="" placeholder="Enter Business Address">
                    </div>
                    <div class="form-map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.274257380938!2d-70.56068388481569!3d41.45496659976631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e52963ac45bbcb%3A0xf05e8d125e82af10!2sDos%20Mas!5e0!3m2!1sen!2sus!4v1671220374408!5m2!1sen!2sus" width="100%" height="290" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                  </div>

                  <input type="button" name="next" class="next action-button site-btn bg-btn" value="Save Information">
                  <input type="button" name="previous" class="previous action-button-previous site-btn border-btn" value="Previous" />

                </fieldset>
                <fieldset>
                  <div class="signUp-form-heading">
                    <h2 class="title">Contact Information</h2>
                    <p class="sub-title">Contact information and password</p>
                  </div>
                  <div class="signUp-form-content">
                    <div class="form-field">
                      <label for="" class="form-label">Business Phone Number</label>
                      <input type="text" class="form-control" name="phone" id="" placeholder="+1 | --- --- ----">
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" id="" placeholder="Enter Email Address">
                    </div>
                    <div class="grp-form-field">
                      <div class="form-field">
                        <label for="" class="form-label">Set Password</label>
                        <input name="password" type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                      </div>
                      <div class="form-field">
                        <label for="" class="form-label">Confirm Password</label>
                        <input name="password" type="password" name="password_confirmation" class="form-control" id="password" placeholder="Confirm your password">
                      </div>
                    </div>
                    <div class="form-field m-0">
                      <label for="" class="form-label">Two-Factor authentiaction</label>
                      <div class="form-option-select">
                        <label class="control control--checkbox">Receive verification codes via email.
                          <input type="checkbox" checked="checked">
                          <div class="control__indicator"></div>
                        </label>
                        <label class="control control--checkbox">By Signing up you agree to our <a class="link" href="#">Terms and Conditions</a> and <a class="link" href="#">Privacy
                            Policy</a>
                          <input type="checkbox">
                          <div class="control__indicator"></div>
                        </label>
                      </div>
                    </div>
                  </div>

                  <input type="button" name="next" class="next action-button site-btn bg-btn" value="Save Information">
                  <input type="button" name="previous" class="previous action-button-previous site-btn border-btn" value="Previous" />

                </fieldset>
                <fieldset>
                  <div class="signUp-form-heading">
                    <h2 class="title">Confirm Email, Wait for Verification</h2>
                  </div>
                  <div class="signUp-form-content verification-row">
                    <div class="form-verification">
                      <div class="verification-info">
                        <div class="info-icon"><img src="{{ asset('assets2/images/mail-icon.png')}}" alt="" /></div>
                        <div class="info-content">
                          A confirmation email has been sent to you. Please check your email and confirm your account
                        </div>
                      </div>
                      <div class="verification-info">
                        <div class="info-icon"><img src="{{ asset('assets2/images/check-icon.png')}}" alt="" /></div>
                        <div class="info-content">
                          We are working to verify your account right now. Once it has been verified you can create your Tenner Promotion.
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="site-btn bg-btn">Resend Email</button>
                  <!-- <input type="button" name="next" class="next action-button site-btn bg-btn" value="Resend Email"> -->
                  <input type="button" name="previous" class="previous action-button-previous site-btn border-btn" value="Previous" />

                </fieldset>
              </form>
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
  <!-- main js -->
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
    // step form 
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function() {

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      //Add Class Active
      $("#js-stepForm-menu li").eq($("fieldset").index(next_fs)).addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function(now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({
            'opacity': opacity
          });
        },
        duration: 500
      });
      setProgressBar(++current);
    });

    $(".previous").click(function() {

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();

      //Remove class active
      $("#js-stepForm-menu li").eq($("fieldset").index(current_fs)).removeClass("active");

      //show the previous fieldset
      previous_fs.show();

      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function(now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          previous_fs.css({
            'opacity': opacity
          });
        },
        duration: 500
      });
      setProgressBar(--current);
    });

    function setProgressBar(curStep) {
      var percent = parseFloat(100 / steps) * curStep;
      percent = percent.toFixed();
      $(".progress-bar")
        .css("width", percent + "%")
    }

    $(".submit").click(function() {
      return false;
    })
  </script>
</body>

</html>