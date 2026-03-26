<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="{{ env('APP_URL') }}" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <style>
        .main-content {
            min-height: calc(60vh - 100px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>

</head>

<body>

    <div class="main-content">
        <div class="wrapper">
            <!-- nav bar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="{{ route('welcome') }}"><h5 class="fw-bolder text-primary">{{ env('APP_NAME') }}</h5></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            @auth
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><h6>Dashboard</h6></a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><h6>Login</h6></a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><h6>Register</h6></a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- end nav bar -->

            <!-- welcome -->
            <div class="welcome-banner" style="position: relative; text-align: center; color: white;">
                <img src="{{ asset('assets/img/banner.jpg') }}" alt="Banner"
                    style="width: 100%; height: auto; opacity: 0.5;">
                <div style="position: absolute; top: 10%; left: 50%; transform: translate(-50%, -50%);">
                    <h3>Welcome to the {{ env('APP_NAME') }}</h3>
                </div>
                <div style="position: absolute; top: 85%; left: 50%; transform: translate(-50%, -50%);">
                    <p class="lead" style="color: #344767; margin-bottom: 1em;">Your single donation can brighten
                        multiple lives. Take a step towards humanity.</p>
                    <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Register Now</a>
                </div>
            </div>
            <!-- end welcome -->
        </div>
    </div>

    <section class="bg-light py-2">
        <div class="container px-2">
            <div class="row gx-5 justify-content-center">
                <div class="col-xxl-8">
                    <div class="text-center my-5">
                        <h2 class="display-5 fw-bolder" style="color: #343a40;">
                            <span class="text-dark d-inline">Our Mission</span>
                        </h2>
                        <p class="lead fw-light mb-4" style="color: #343a40;">
                            The VU Blood Donation Society is committed to connecting lives and fostering hope through
                            the selfless act of blood donation.
                        </p>
                        <p class="text-muted" style="color: #343a40;">
                            With a community built on the pillars of empathy and altruism, we strive to ensure that no
                            life is lost for want of blood. Our platform bridges the gap between donors and recipients,
                            making each drop count in the quest to save and enrich lives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>

</body>

</html>
