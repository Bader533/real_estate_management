<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/login.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <style>
        .button-verify {
            width: 100%;
            background-color: #E76F3C;
            color: white;
            border: 0;
            padding: 10px 0px;
        }

        #div_radio_2 {
            display: flex;
        }

        .input_radio_2 {
            flex: 1;
            display: none;
            width: 100%;
        }

        .input_radio_2:checked+.radio_label_2 {
            background-color: #E76F3C;
            border: white;
            color: white;
        }

        .radio_label_2 {
            background-color: #F5F8FA;
            position: relative;
            color: #7E8299;
            font-size: 17px;
            font-weight: 200;
            font-family: sans-serif;
            padding: 10px 10px;
            width: 50%;
            text-align: center;

        }

        .radio_label_2:hover {
            background-color: #E76F3C;
            color: white;
            border: white;
        }

        .input_radio_2:checked+.radio_label_2+svg {
            background-color: #E76F3C;
            border: white;
            color: white;


        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 248px;
        }

        .register {
            color: #E76F3C;
            font-family: 'Roboto';
            text-decoration: none;
        }
    </style>

</head>

<body>

    <header>
        <h1><img src="{{asset('assets/images/Betaldata.png')}}" alt=""></h1>
        <nav>
        </nav>

    </header>

    <section class="main-section">

        <article class="main-article">
            <form action="{{route('register.store')}}" method="post">
                @csrf

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

                <button type="button" onclick="login()" class="button-verify">Submit</button>
            </form>
            <p class="footer">Don't Have An Account ? <a class="register" href="{{route('register.create')}}"> Sign Up
                    Now </a></p>

        </article>
        <aside>
            <p>Welcome to BetalData</p>
            <img src="{{asset('assets/images/Group.png')}}" alt="">
        </aside>
    </section>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/crud.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                    console.log(email);
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                        });
                    window.location.href = '/';
                })
                .catch(function (error) {
                    //4xx - 5xx
                    // console.log(error.response.data.message);
                        Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error.response.data.message,
                        showConfirmButton: false,
                        timer: 1500
                        });
                });
            }
    </script>
</body>

</html>
