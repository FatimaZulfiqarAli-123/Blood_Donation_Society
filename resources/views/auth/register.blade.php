<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="{{ env('APP_URL') }}" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{ asset("assets/img/illustrations/illustration-signup.jpg") }}'); background-size: cover;">
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                    <h3>{{ env('APP_NAME') }}</h3>
                    <p class="text-left">"Every drop you give is a lifeline to someone in need. Be the hero in someone's story – donate blood, share life, and let the rhythm of your heartbeat resonate with the symphony of compassion."</p>
                    <h2 class="font-weight-bolder">Sign Up</h2>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-primary alert-dismissible text-white fade show" role="alert">
                            <span class="alert-text"><strong>Error!</strong>
                                @foreach($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select form-control" id="city" name="city" required>
                                <option class="form-label" default>Select Your City</option>
                                <option class="form-option" value="Sialkot">Sialkot</option>
                                <option class="form-option" value="Lahore">Lahore</option>
                                <option class="form-option" value="Gujranwala">Gujranwala</option>
                                <option class="form-option" value="Islamabad">Islamabad</option>
                                <option class="form-option" value="Rawalpindi">Rawalpindi</option>
                                <option class="form-option" value="Gujrat">Gujrat</option>
                                <option class="form-option" value="Jehlum">Jehlum</option>
                                <option class="form-option" value="Kharian">Kharian</option>
                            </select>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="input-group input-group-outline mb-3">
                            <select class="form-select form-control" id="bloodGroup" name="blood_group" required>
                                <option class="form-label" default>Select Blood Group</option>
                                <option class="form-option" value="A+">A+</option>
                                <option class="form-option" value="A-">A-</option>
                                <option class="form-option" value="B+">B+</option>
                                <option class="form-option" value="B-">B-</option>
                                <option class="form-option" value="O+">O+</option>
                                <option class="form-option" value="O-">O-</option>
                                <option class="form-option" value="AB+">AB+</option>
                                <option class="form-option" value="AB-">AB-</option>
                            </select>
                        </div>
                        <fieldset>
                            <legend class="form-label"><b>Gender</b></legend>
                            <div class="form-check mb-2">
                                <label class="form-check-label">Male</label>
                                <input class="form-check-input" type="radio" name="gender" value="male">
                                <label class="form-check-label">Female</label>
                                <input class="form-check-input" type="radio" name="gender" value="female">
                                <label class="form-check-label">Other</label>
                                <input class="form-check-input" type="radio" name="gender" value="other">
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="form-label"><b>Register as:</b></legend>
                            <div class="form-check mb-2">
                                <label class="form-check-label" for="donor">Donor</label>
                                <input class="form-check-input" type="radio" name="role" id="donor" value="donor">
                                <label class="form-check-label" for="patient">Patient</label>
                                <input class="form-check-input" type="radio" name="role" id="patient" value="patient">
                            </div>
                        </fieldset>
                        <div class="text-center">
                            <button type="submit" class="btn btn-md bg-gradient-primary w-100 mt-2 mb-0">Sign up</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
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
