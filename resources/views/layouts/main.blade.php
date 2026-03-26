<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <!--
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/popper.min.js"></script>
    -->
    <style>
        .notification-badge {
            position: absolute;
            top: -10px; /* Adjust as needed */
            right: -10px; /* Adjust as needed */
            width: 20px; /* Adjust as needed */
            height: 20px; /* Adjust as needed */
            border-radius: 50%; /* Makes it rounded */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem; /* Adjust as needed */
            background-color: #dc3545; /* Bootstrap danger color for reference */
        }
    </style>

</head>



<body class="g-sidenav-show  bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ env('APP_URL') }}">
                <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">{{ env('APP_NAME') }}</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active bg-gradient-primary' : '' }}" href="{{ route('dashboard') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                @unlessrole('donor')
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('donor.create') || request()->routeIs('donors.index') || request()->routeIs('donation.requests.index') || request()->routeIs('donor.requests') || request()->routeIs('blocked.donors') ? 'active bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#donorSubMenu" role="button" aria-expanded="false" aria-controls="donorSubMenu">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">favorite</i>
                            </div>
                            <span class="nav-link-text ms-1">Donors</span>
                        </a>
                        <div class="collapse {{ request()->routeIs('donor.create') || request()->routeIs('donors.index') || request()->routeIs('donation.requests.index') || request()->routeIs('donor.requests') || request()->routeIs('blocked.donors') ? 'show' : '' }}" id="donorSubMenu">
                            <ul class="nav flex-column">
                                @role('admin')
                                    <li class="nav-item">
                                        <a class="nav-link text-white {{ request()->routeIs('donor.create') ? 'active bg-gradient-primary' : '' }}" href="{{ route('donor.create') }}">
                                            <span class="nav-link-text ms-1">Add Donor</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white {{ request()->routeIs('donor.requests') ? 'active bg-gradient-primary' : '' }}" href="{{ route('donor.requests') }}">
                                            <span class="nav-link-text ms-1">Donor Requests</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white {{ request()->routeIs('blocked.donors') ? 'active bg-gradient-primary' : '' }}" href="{{ route('blocked.donors') }}">
                                            <span class="nav-link-text ms-1">Blocked Donors</span>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->routeIs('donors.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('donors.index') }}">
                                        <span class="nav-link-text ms-1">Donors List</span>
                                    </a>
                                </li>
                                @role('patient')
                                    <li class="nav-item">
                                        <a class="nav-link text-white {{ request()->routeIs('donation.requests.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('donation.requests.index') }}">
                                            <span class="nav-link-text ms-1">Donations Requests</span>
                                        </a>
                                    </li>
                                @endrole
                            </ul>
                        </div>
                    </li>
                @endunlessrole

                @unlessrole('patient')
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('patients.index') || request()->routeIs('blood.requests.index') ? 'active bg-gradient-primary' : '' }}" data-bs-toggle="collapse" href="#patientSubMenu" role="button" aria-expanded="false" aria-controls="patientSubMenu">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">person</i>
                            </div>
                            <span class="nav-link-text ms-1">Patients</span>
                        </a>
                        <div class="collapse {{ request()->routeIs('patients.index') || request()->routeIs('blood.requests.index') ? 'show' : '' }}" id="patientSubMenu">
                            <ul class="nav flex-column">
                                @role('donor')
                                    <li class="nav-item">
                                        <a class="nav-link text-white {{ request()->routeIs('blood.requests.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('blood.requests.index') }}">
                                            <span class="nav-link-text ms-1">Blood Requests</span>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item">
                                    <a class="nav-link text-white {{ request()->routeIs('patients.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('patients.index') }}">
                                        <span class="nav-link-text ms-1">Patients List</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endunlessrole

                @unlessrole('admin')
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('messages.index') ? 'active bg-gradient-primary' : '' }}" href="{{ route('messages.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">message</i>
                            </div>
                            <span class="nav-link-text ms-1">Messages</span>
                        </a>
                    </li>
                @endunlessrole

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('notifications') ? 'active bg-gradient-primary' : '' }}" href="{{ route('notifications') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-bell cursor-pointer fa-lg"></i>
                        </div>
                        <span class="nav-link-text ms-1">Notifications</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('profile.edit') ? 'active bg-gradient-primary' : '' }}" href="{{ route('profile.edit') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" onclick="document.getElementById('logout-form').submit();">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">logout</i>
                        </div>
                        <span class="nav-link-text ms-1">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('pageTitle')</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">@yield('pageTitle')</h6>
                </nav>



                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group input-group-outline">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        @if(isset($notifications))
                            <li class="nav-item dropdown pe-4 d-flex align-items-center">
                                <!-- Notification icon and count -->
                                <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="position-relative">
                                        <i class="fa fa-bell cursor-pointer fa-lg"></i>
                                        @if($notifications->count() > 0)
                                            <span class="badge badge-danger rounded-circle notification-badge">{{ $notifications->count() }}</span>
                                        @endif
                                    </div>
                                </a>
                                <!-- Notification dropdown -->
                                @role('admin')
                                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                        @foreach($notifications as $notification)
                                            @php
                                                $notificationData = $notification->data;
                                            @endphp
                                            <li class="mb-2">
                                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                                    <div class="d-flex py-1">
                                                        <div class="my-auto">
                                                            @if (isset($notificationData['donor']['profile_picture']) && $notificationData['donor']['profile_picture'])
                                                                <img src="{{ asset('storage/' . $notificationData['donor']['profile_picture']) }}" alt="profile_image" class="avatar avatar-sm me-3">
                                                            @else
                                                                <img src="{{ asset('assets/img/profile_picture_placeholder.jpg') }}" alt="profile_image" class="avatar avatar-sm me-3">
                                                            @endif
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="text-sm font-weight-normal mb-1">
                                                                {!! $notificationData['message'] !!}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a class="dropdown-item text-center text-primary font-weight-bold py-3" href="{{ route('donor.requests') }}">
                                                Show all donor requests
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                        @foreach($notifications as $notification)
                                            @php
                                                $notificationData = $notification->data;
                                            @endphp
                                            <li class="mb-2">
                                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                                    <div class="d-flex py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="text-sm font-weight-normal mb-1">
                                                                {!! $notificationData['message'] !!}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a class="dropdown-item text-center text-primary font-weight-bold py-3" href="{{ route('notifications') }}">
                                                Show all notifications
                                            </a>
                                        </li>
                                    </ul>
                                @endrole
                            </li>
                        @endif

                        <li class="nav-item dropdown pe-4 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-sm-1 fa-lg"></i>
                                @php
                                    $name = explode(' ', auth()->user()->name);
                                @endphp
                                <span class="d-sm-inline d-none"> {{ $name[0] }} </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="{{ route('profile.edit') }}">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="avatar avatar-sm me-3">
                                                @auth
                                                    @if (auth()->user()->profile_picture)
                                                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                                    @else
                                                        <img src="{{ asset('assets/img/profile_picture_placeholder.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                                    @endif
                                                @endauth
                                            </div>
                                            <span class="font-weight-bold">Edit Profile</span>
                                        </div>
                                    </a>
                                </li>
                                <hr class="horizontal dark my-1">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;" onclick="document.getElementById('logout-form').submit();">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="icon-container me-3">
                                                <i class="fa fa-sign-out-alt"></i>
                                            </div>
                                            <span class="font-weight-bold">Logout</span>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        @if(session('status') == 'success')
            <div class="alert-container">
                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                    <span class="alert-icon align-middle">
                    <span class="material-icons text-md">
                        thumb_up_off_alt
                    </span>
                    </span>
                    <span class="alert-text"><strong>Success!</strong> {{ session('message') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if(session('status') == 'error')
            <div class="alert-container">
                <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">error</span>
                    </span>
                    <span class="alert-text"><strong>Error!</strong> {{ session('message') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-container">
                <div class="alert alert-danger alert-dismissible text-white fade show" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">error</span>
                    </span>
                    <div class="alert-text">
                        <strong>Errors:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')

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
