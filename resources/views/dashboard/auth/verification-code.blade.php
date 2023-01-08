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
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <title>verification</title>
    <style>
        h3 {
            font-family: 'Roboto';
        }

        p {
            font-family: 'Roboto';
            font-size: 14px;
        }

        .form_content {
            margin-top: 40px;
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
                    <div class="form_content">
                        <h3>OTP Verification</h3>
                        <p>The Six Digit Code Has Sent To Your Email And Phone Number. <br>
                            Kindly Enter Your Code Here To Complete Your Sign Up Process.</p>
                        <form action="#">
                            <div class="d-flex mb-3">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_1">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_2">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_3">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_4">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_5">
                                <input type="tel" maxlength="1" pattern="[0-9]" class="form-control_verification"
                                    id="input_6">
                            </div>
                            <button type="button" onclick="register('{{$owner_id}}')" class="button-verify">Verify
                                account</button>
                        </form>
                    </div>
                </div>
                <div class="two">
                    <p>Welcome to ByatData</p>
                    <img src="{{asset('assets/landing/images/Group.png')}}">
                </div>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/crud.js') }}"></script>

    <script>
        const form = document.querySelector('form')
                const inputs = form.querySelectorAll('input')
                const KEYBOARDS = {
                    backspace: 8,
                    arrowLeft: 37,
                    arrowRight: 39,
                }

                function handleInput(e) {
                    const input = e.target
                    const nextInput = input.nextElementSibling
                    if (nextInput && input.value) {
                        nextInput.focus()
                        if (nextInput.value) {
                        nextInput.select()
                        }
                    }
                }

                function handlePaste(e) {
                    e.preventDefault()
                    const paste = e.clipboardData.getData('text')
                    inputs.forEach((input, i) => {
                    input.value = paste[i] || ''
                    })
                }

                function handleBackspace(e) {
                    const input = e.target
                    if (input.value) {
                        input.value = ''
                        return
                    }

                    input.previousElementSibling.focus()
                }

                function handleArrowLeft(e) {
                    const previousInput = e.target.previousElementSibling
                    if (!previousInput) return
                    previousInput.focus()
                }

                function handleArrowRight(e) {
                    const nextInput = e.target.nextElementSibling
                    if (!nextInput) return
                    nextInput.focus()
                }

                form.addEventListener('input', handleInput)
                inputs[0].addEventListener('paste', handlePaste)

                inputs.forEach(input => {
                    input.addEventListener('focus', e => {
                        setTimeout(() => {
                        e.target.select()
                        }, 0)
                    })

                    input.addEventListener('keydown', e => {
                        switch(e.keyCode) {
                            case KEYBOARDS.backspace:
                            handleBackspace(e)
                            break
                            case KEYBOARDS.arrowLeft:
                            handleArrowLeft(e)
                            break
                            case KEYBOARDS.arrowRight:
                            handleArrowRight(e)
                            break
                            default:
                        }
                    })
                })

                function register(id) {
                    var verification=[];

                    for (let i = 1; i < 7; i++) {
                        verification.push(document.getElementById('input_'+i).value);
                     }
                    axios.post('/verification/'+id, {
                            verify : verification,
                        })
                        .then(function(response) {
                            //2xx
                            console.log(response);
                            toastr.success(response.data.message);
                            window.location.href = '/owner/login';
                        })
                        .catch(function(error) {
                            toastr.error('Error');
                            toastr.error(error.response.data.message);
                        });
                }
    </script>

</body>

</html>
