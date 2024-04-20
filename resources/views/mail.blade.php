<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirportBee</title>
    <style>
        body {
            background: #eff0eb;
            background-image: url('https://i.postimg.cc/MTbfnkj6/bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif; /* Adding a fallback font */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .text-center {
            text-align: center;
        }

        .py-5 {
            padding-top: 3.125rem;
            padding-bottom: 3.125rem;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-inner {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }

        .blockquote-custom-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #17a2b8;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        .blockquote-custom-icon i {
            color: #fff;
        }

        .blockquote-custom p {
            margin-top: 0;
            font-style: italic;
        }

        .blockquote-footer {
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .blockquote-footer cite {
            font-style: normal;
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-inner">
                        <div class="blockquote-custom-icon bg-info shadow-sm"><i class="fa fa-quote-left text-white"></i></div>
                        <h3>Tenners </h3>
                             <p class="mb-0 mt-2 font-italic">
                                <h3>Hello {{ $email }}</h3>
                                <br>
                            Please Verify your email though this link : {{ isset($link) ? $link : '' }} <br>
                            
                          
                        </p>
                        <footer class="blockquote-footer pt-4 mt-4 border-top">
                            <cite title="Source Title">Thank you</cite>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
