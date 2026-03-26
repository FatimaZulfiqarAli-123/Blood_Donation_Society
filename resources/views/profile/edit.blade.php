@extends('layouts.main')

@section('pageTitle', 'Profile')

@section('content')


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileButton = document.querySelector('.profileButton');
            const passwordButton = document.querySelector('.passwordButton');
            const historyButton = document.querySelector('.historyButton');
            const profileForm = document.getElementById('profileForm');
            const passwordForm = document.getElementById('passwordForm');
            const history = document.getElementById('history');

            profileForm.style.display = 'block';
            passwordForm.style.display = 'none';
            history.style.display = 'none';

            profileButton.addEventListener('click', function() {
                profileForm.style.display = 'block';
                passwordForm.style.display = 'none';
                history.style.display = 'none';
            });

            passwordButton.addEventListener('click', function() {
                passwordForm.style.display = 'block';
                profileForm.style.display = 'none';
                history.style.display = 'none';
            });

            historyButton.addEventListener('click', function() {
                history.style.display = 'block';
                passwordForm.style.display = 'none';
                profileForm.style.display = 'none';
            });
        });
    </script>


    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        @else
                            <img src="{{ asset('assets/img/profile_picture_placeholder.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            {{ $role }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active profileButton" href="javascript:;" role="tab">
                                    <i class="material-icons text-lg position-relative">person</i>
                                    <span class="ms-1">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 passwordButton" href="javascript:;" role="tab">
                                    <i class="material-icons text-lg position-relative">password</i>
                                    <span class="ms-1">Password</span>
                                </a>
                            </li>
                            @role('donor')
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 historyButton" href="javascript:;" role="tab">
                                        <i class="material-icons text-lg position-relative">history</i>
                                        <span class="ms-1">Donation History</span>
                                    </a>
                                </li>
                            @endrole
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <form id="profileForm" role="form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <label class="form-label">Select Profile Picture</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" accept="image/*" name="profile_picture" class="form-control">
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="tel" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="Phone" required>
                            </div>
                            @unlessrole('admin')
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-select form-control" id="bloodGroup" name="blood_group">
                                        <option disabled selected>Select Blood Group</option>
                                        <option value="A+" @if (old('blood_group', $user->blood_group) == 'A+') selected @endif>A+</option>
                                        <option value="A-" @if (old('blood_group', $user->blood_group) == 'A-') selected @endif>A-</option>
                                        <option value="B+" @if (old('blood_group', $user->blood_group) == 'B+') selected @endif>B+</option>
                                        <option value="B-" @if (old('blood_group', $user->blood_group) == 'B-') selected @endif>B-</option>
                                        <option value="O+" @if (old('blood_group', $user->blood_group) == 'O+') selected @endif>O+</option>
                                        <option value="O-" @if (old('blood_group', $user->blood_group) == 'O-') selected @endif>O-</option>
                                        <option value="AB+" @if (old('blood_group', $user->blood_group) == 'AB+') selected @endif>AB+</option>
                                        <option value="AB-" @if (old('blood_group', $user->blood_group) == 'AB-') selected @endif>AB-</option>
                                    </select>
                                </div>
                            @endunlessrole
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" id="city" name="city">
                                    <option disabled selected>Select Your City</option>
                                    <option value="Sialkot" @if (old('city', $user->city) == 'Sialkot') selected @endif>Sialkot</option>
                                    <option value="Lahore" @if (old('city', $user->city) == 'Lahore') selected @endif>Lahore</option>
                                    <option value="Gujranwala" @if (old('city', $user->city) == 'Gujranwala') selected @endif>Gujranwala</option>
                                    <option value="Islamabad" @if (old('city', $user->city) == 'Islamabad') selected @endif>Islamabad</option>
                                    <option value="Rawalpindi" @if (old('city', $user->city) == 'Rawalpindi') selected @endif>Rawalpindi</option>
                                    <option value="Gujrat" @if (old('city', $user->city) == 'Gujrat') selected @endif>Gujrat</option>
                                    <option value="Jehlum" @if (old('city', $user->city) == 'Jehlum') selected @endif>Jehlum</option>
                                    <option value="Kharian" @if (old('city', $user->city) == 'Kharian') selected @endif>Kharian</option>
                                </select>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="address" class="form-control" cols="30" rows="3" placeholder="Address" required>{{ $user->address }}</textarea>
                            </div>
                            <div>
                                <label class="form-label"><b>Gender</b></label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Male</label>
                                <input type="radio" name="gender" value="male"
                                    {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>

                                <label class="form-label">Female</label>
                                <input type="radio" name="gender" value="female"
                                    {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>

                                <label class="form-label">Other</label>
                                <input type="radio" name="gender" value="other"
                                    {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }}>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Update</button>
                            </div>
                        </form>

                        <form id="passwordForm" role="form" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" name="current_password" class="form-control"
                                    placeholder="Current Password" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" name="password" class="form-control" placeholder="New Password"
                                    required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm Password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Update</button>
                            </div>
                        </form>

                    </div>
                    <div class="row mt-4" id="history">
                        <div class="col-12">
                            <div class="card my-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                        <h6 class="text-white text-capitalize ps-3">Donation History</h6>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Date of Donation</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Patient Name</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Patient Email</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Patient Phone</th>
                                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Patient Address</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donationHistory as $donation)
                                                    @php
                                                        $isDonor = $donation->requester_id == auth()->id();
                                                        $patient = $isDonor ? $donation->receiver : $donation->requester;
                                                    @endphp
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs mb-0">{{ $donation->request_date_time }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs mb-0">{{ $patient->name }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs mb-0">{{ $patient->email }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs mb-0">{{ $patient->phone }}</p>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <p class="text-xs mb-0">{{ $patient->address }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
