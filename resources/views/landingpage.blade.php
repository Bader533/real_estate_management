<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/landing/css/styles.css')}}">
    <title>Welcome</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/landing/images/Betaldata.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#business">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-us">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#content-section">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#real-state">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.login','owner')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End NavBar -->
    <div class="business" id="business">
        <div class="container">
            <div class="row">
                <div class="smart">
                    <p class="p-title">Business to Business Solution</p>
                    <h2>Smart Solution Style For Smart People</h2>
                    <p class="p-content">Much did had call new drew that kept. Limits expect wonder law she. Now has you
                        views
                        woman noisy match money rooms.</p>
                    <button>Get Started</button>
                </div>
                <div class="two">
                    <img src="{{asset('assets/landing/images/Group.png')}}">
                </div>
            </div>
        </div>
    </div>
    <!-- End business -->
    <div class="about-us" id="about-us">
        <div class="container">
            <div class="row">
                <div class="about-img">
                    <img src="{{asset('assets/landing/images/Card03.png')}}">
                </div>
                <div class="about-p">
                    <p class="p-title">About Us</p>
                    <h2>Nullam quis neque vel est <br> egestas condimentum <br> mollis at nisi</h2>
                    <p class="p-content">Much did had call new drew that kept. Limits expect wonder law she. Now has you
                        views
                        woman noisy match money rooms.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->
    <div class="content-section" id="content-section">
        <div class="container">
            <div class="content-details">
                <div class="main">
                    <div class="one">
                        <p>25,356</p>
                        <span>Home Records</span>
                    </div>
                    <div class="one">
                        <p>1M+</p>
                        <span>Companies</span>
                    </div>
                    <div class="one">
                        <p>95%</p>
                        <span>Happy Customers</span>
                    </div>
                </div>
                <div class="content-text">
                    <p class="p-ask">Want to start a With us?</p>
                    <p class="p-ask-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed congue est
                        <br>eget mi vehicula pellentesque..
                    </p>
                    <button>Get Started</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End content -->
    <div class="real-state" id="real-state">
        <div class="container">
            <div class="real-main">
                <h2>Best Business Solution For Real <br>State Business With Greate Saas</h2>
                <div class="real-img">
                    <img src="{{asset('assets/landing/images/Group2.png')}}">
                    <div class="lorem-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>Sed congue est eget mi vehicula
                            pellentesque..</p>
                    </div>
                    <div class="lorem-2">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>Sed congue est eget mi vehicula
                            pellentesque..</p>
                    </div>
                    <div class="lorem-3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>Sed congue est eget mi vehicula
                            pellentesque..</p>
                    </div>
                    <div class="lorem-4">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br>Sed congue est eget mi vehicula
                            pellentesque..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End real-state -->
    <section id="slider" class="pt-5">
        <div class="container">
            <div class="slider">
                <div class="owl-carousel">
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="images/slide-1.jpg" alt="">
                        </div>
                        <h5 class="mb-0 text-center">
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                        </h5>
                        <p class="text-center p-4" id="text-conten-slider">Certainty say suffering his him collected
                            <br>
                            intention promotion. Hill sold ham men<br>
                            made lose case. Views abode law heard<br>
                            jokes too.
                        </p>

                        <p class="slider-name">Andrew Chris</p>
                        <p class="slider-content">Client from <br>
                            Uganda</p>

                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="{{asset('assets/landing/images/slide-1.jpg')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center">
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                        </h5>
                        <p class="text-center p-4" id="text-conten-slider">Certainty say suffering his him collected
                            <br>
                            intention promotion. Hill sold ham men<br>
                            made lose case. Views abode law heard<br>
                            jokes too.
                        </p>

                        <p class="slider-name">Andrew Chris</p>
                        <p class="slider-content">Client from <br>
                            Uganda</p>

                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="{{asset('assets/landing/images/slide-1.jpg')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center">
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                        </h5>
                        <p class="text-center p-4" id="text-conten-slider">Certainty say suffering his him collected
                            <br>
                            intention promotion. Hill sold ham men<br>
                            made lose case. Views abode law heard<br>
                            jokes too.
                        </p>

                        <p class="slider-name">Andrew Chris</p>
                        <p class="slider-content">Client from <br>
                            Uganda</p>

                    </div>
                    <div class="slider-card">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                            <img src="{{asset('assets/landing/images/slide-1.jpg')}}" alt="">
                        </div>
                        <h5 class="mb-0 text-center">
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                            <span class="fa fa-star checked" id="star"></span>
                        </h5>
                        <p class="text-center p-4" id="text-conten-slider">Certainty say suffering his him collected
                            <br>
                            intention promotion. Hill sold ham men<br>
                            made lose case. Views abode law heard<br>
                            jokes too.
                        </p>

                        <p class="slider-name">Andrew Chris</p>
                        <p class="slider-content">Client from <br>
                            Uganda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider -->
    <div class="news-letter">
        <div class="container">
            <div class="main-news">
                <div class="news-1">
                    <h2>Get Our Newsletter</h2>
                    <p>To join the worldwide community</p>
                </div>
                <div class="input-news">
                    <div class="input-1">
                        <p>Type Your Email Address</p>
                        <span>Betaldata.com</span>
                    </div>
                    <div class="input-2">
                        <button>Send Now</button>
                    </div>
                </div>
            </div>
            <nav class="navbar-2 navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{asset('assets/landing/images/Betaldata.png')}}">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Service</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End NavBar -->
            <div class="footer">
                Copyright © 2021 AR Shakir . All Rights Reseved.
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/landing/js/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function () {
              $(".owl-carousel").owlCarousel({
                  loop: true,
                  margin: 10,
                  nav: true,
                  autoplay: true,
                  autoplayTimeout: 3000,
                  autoplayHoverPause: true,
                  center: true,
                  navText: [
                      "<i class='fa fa-arrow-left' id='arrow'></i>",
                      "<i class='fa fa-arrow-right' id='arrow'></i>"
                  ],
                  responsive: {
                      0: {
                          items: 1
                      },
                      600: {
                          items: 1
                      },
                      1000: {
                          items: 3
                      }

                  }
              });
          });
    </script>
</body>

</html>
