<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing/css/login.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing/css/loginEdit.css')}}">
    <link rel="stylesheet" href="{{asset('assets/landing/css/all.min.css')}}">
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('assets/landing/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <style>

    </style>
</head>

<body>
    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="login-form">
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('assets/landing/images/Betaldata.png')}}">
                    </a>
                    <form>
                        <div class="input-form">
                            <input type="email" placeholder="Email Address">
                            <input type="password" placeholder="Password">
                            {{-- <i class="fa-solid fa-eye"></i> --}}
                        </div>
                        <p>Forgot Password ?</p>
                        <button>SIGN IN NOW</button>
                    </form>
                </div>
                <div class="two">
                    <p>Welcome to ByatData</p>
                    <img src="{{asset('assets/landing/images/Group.png')}}">
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/landing/js/all.min.js')}}"></script>
</body>

</html>
