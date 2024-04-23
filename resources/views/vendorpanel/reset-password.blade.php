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
                <div class="col-lg-12">
                    <div class="card-wrapper">
                        <div class="reset-password-card Card">
                            <h3 class="card-title">Reset Password</h3>
                            <form class="site-form">
                                <label class="note">We will send you an email to reset your password</label>
                                <div class="form-field">
                                    <label for="" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="" placeholder="Enter Email Address">
                                </div>
                                <div class="form-field m-0">
                                    <button type="submit" class="form-btn">Submit</button>
                                </div>
                            </form>
                            <p class="form-note">Remember password? <a class="link" href="{{route('vendor.login')}}">Sign In</a></p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-wrapper">
                        <div class="reset-password-card Card">
                            <h3 class="card-title">Email Sent</h3>
                            <img src="{{ asset('assets2/images/checked.png')}}" alt="" srcset="" style="width:80px;padding-bottom:12px;padding-top:6px;margin-left: auto;margin-right: auto;">
                            <label class="note" style="text-align: center;">An email has been sent to your mail containing a link to reset your password</label>

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
</body>

</html>