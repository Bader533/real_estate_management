<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <base href="">
    <title>Register</title>
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

</head>


<body id="kt_body" class="bg-body">

    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/14.png') }}">

            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

                <a href="../../demo1/dist/index.html" class="mb-12">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-1.svg') }}" class="h-40px" />
                </a>

                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form">

                        <div class="text-center mb-10">

                            <h1 class="text-dark mb-3">Register</h1>


                        </div>

                        {{-- begin::name --}}
                        <div class="fv-row mb-10">

                            <label class="form-label fs-6 fw-bolder text-dark">Name</label>

                            <input class="form-control form-control-lg form-control-solid" type="text" id="name"
                                name="name" autocomplete="off" />

                        </div>
                        {{-- end::name --}}

                        {{-- begin::email --}}
                        <div class="fv-row mb-10">

                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>

                            <input class="form-control form-control-lg form-control-solid" type="email" id="email"
                                name="email" autocomplete="off" />

                        </div>
                        {{-- end::email --}}

                        {{-- begin::phone --}}
                        <div class="fv-row mb-10">

                            <label class="form-label fs-6 fw-bolder text-dark">Phone</label>

                            <input class="form-control form-control-lg form-control-solid" type="text" id="phone"
                                name="phone" autocomplete="off" />

                        </div>
                        {{-- end::phone --}}

                        {{-- end::password --}}
                        <div class="fv-row mb-10">
                            <div class="d-flex flex-stack mb-2">

                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>

                                {{-- <a href="../../demo1/dist/authentication/flows/basic/password-reset.html"
                                    class="link-primary fs-6 fw-bolder">Forgot Password ?</a> --}}

                            </div>
                            <input class="form-control form-control-lg form-control-solid" id="password"
                                type="password" name="password" autocomplete="off" />
                        </div>
                        {{-- end::password --}}

                        <div class="text-center">
                            <button type="button" onclick="register()" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex flex-center flex-column-auto p-10">

                <div class="d-flex align-items-center fw-bold fs-6">
                    <a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">About</a>
                    <a href="mailto:support@keenthemes.com" class="text-muted text-hover-primary px-2">Contact</a>
                    <a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2">Contact Us</a>
                </div>

            </div>

        </div>

    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function register() {
            axios.post('/register', {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value,
                    password: document.getElementById('password').value,
                })
                .then(function(response) {
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
                    window.location.href = '/owner/login';
                })
                .catch(function(error) {
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
