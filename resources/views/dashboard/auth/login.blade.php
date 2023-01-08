<!DOCTYPE html>
<html lang="en">

<head>


    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing/css/loginEdit.css')}}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/login.css')}}">
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
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
                        {{-- @csrf --}}
                        {{-- begin::email --}}
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" required>
                            <label for="email">Email</label>
                        </div>
                        {{-- end::email --}}

                        {{-- begin::password --}}
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        {{-- end::password --}}
                        <br>

                        <button type="button" onclick="login()">Submit</button>
                    </form><br>
                    <p class="footer">Don't Have An Account ? <a class="register" href="{{route('register.create')}}">
                            Sign Up
                            Now </a></p>
                </div>
                <div class="two">
                    <p>Welcome to ByatData</p>
                    <img src="{{asset('assets/landing/images/Group.png')}}">
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/landing/js/all.min.js')}}"></script>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

    <script>
        function login() {
                        axios.post('/login', {
                            email: document.getElementById('email').value,
                            password: document.getElementById('password').value,
                            guard: '{{$guard}}',
                        })
                        .then(function (response) {
                            //2xx
                            console.log(response);
                            // console.log(email);
                            toastr.success(response.data.message);
                            window.location.href = '/dashboard';
                        })
                        .catch(function (error) {
                            //4xx - 5xx
                            console.log(error.response.data.message);
                            toastr.error(error.response.data.message);

                        });
                    }
    </script>


</body>

</html>
