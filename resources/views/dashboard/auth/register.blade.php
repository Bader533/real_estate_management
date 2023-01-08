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
    <title>register</title>
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

                    <form action="{{route('register.store')}}" method="post">
                        @csrf
                        <div style="direction: ltr" id="div_radio_2">
                            <input type="radio" name="kitchen" class="input_radio_2" value="open" id="open" checked>
                            <label for="open" class="radio_label_2"
                                style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">
                                Homeowners</label>

                            <input type="radio" name="kitchen" class="input_radio_2" value="closed" id="closed">
                            <label for="closed" class="radio_label_2"
                                style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;">Company</label>
                        </div><br>

                        {{-- begin::name --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" required>
                            <label for="name">Name</label>
                        </div>
                        {{-- end::name --}}

                        {{-- begin::email --}}
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" required>
                            <label for="email">Email</label>
                        </div>
                        {{-- end::email --}}

                        {{-- begin::phone --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="phone" name="phone" required>
                            <label for="phone">Phone</label>
                        </div>
                        {{-- end::phone --}}

                        {{-- begin::password --}}
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        {{-- end::password --}}

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accept" id="accept" required>
                            <label class="form-check-label" for="accept">
                                I have accepted the <b><u> Term and Conditions</u></b>
                            </label>
                        </div><br>

                        <button type="submit" class="button-verify">Submit</button>
                    </form>
                </div>
                <div class="two">
                    <p>Welcome to ByatData</p>
                    <img src="{{asset('assets/landing/images/Group.png')}}">
                </div>
            </div>
        </div>
    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
