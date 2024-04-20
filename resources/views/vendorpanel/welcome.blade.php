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
    <div class="overlay"></div>
    <header class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-wrapper">
                        <div class="header-logo"><a href="index.html"><img src="{{ asset('assets2/images/logo.png')}}" alt="site logo"></a></div>
                        <div class="header-btn">
                            <a id="js-contact-btn" class="contact-btn" href="#">Contact Us</a>
                        </div>
                            <!--Contact Screen-->
                            <div class="contactScreen" style="display: none;">
                                <div class="contact-title">
                                    <h3 class="title">Contact Us</h3>
                                    <span class="close-btn"><i class="fas fa-times"></i></span>
                                </div>
                                <div class="contact-detail">
                                    <div class="user-profile">
                                        <div class="profile-image">
                                            <img src="images/conact-profile-image.png" alt="">
                                        </div>
                                        <h4 class="profile-title">Nicholas LeJeune, Founder</h4>
                                        <ul class="profile-contacts">
                                            <li><a href="#"><i class="fa-solid fa-phone"></i> (337) 294-5999</a></li>
                                            <li><a href="#"><i class="fa-solid fa-envelope-open"></i> support@tennerlocaldeals.com</a></li>
                                        </ul>
                                    </div>
                            
                                </div>
                            </div>
                      
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
                        <div class="welcome-card Card">
                            <h3 class="card-title">Welcome to Tenner Local Deals Business Management</h3>
                            <div class="welcome-video">
                                <img class="img-fluid" src="{{ asset('assets2/images/video-image.jpg')}}" alt="video cover image" />
                                <a class="video-btn" href="#"><i class="fa-solid fa-play"></i></a>
                            </div>
                            <div class="grp-btns">
                                <a class="site-btn bg-btn" href="{{route('vendor.login')}}">Business Sign in</a>
                                <a class="site-btn border-btn" href="{{route('vendor.signup')}}">Business Sign up</a>
                            </div>
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
        $(document).ready(function () {
            $('#js-contact-btn').click(function () {
                $('.contactScreen').slideToggle('fast');
                if (window.innerWidth < 768) { // Check for mobile view
                    $('.overlay').fadeToggle('fast');
                }
            });

            $('.close-btn, .overlay').click(function () {
                $('.contactScreen').slideUp('fast');
                $('.overlay').fadeOut('fast');
            });
        });
    </script>
</body>
</html>