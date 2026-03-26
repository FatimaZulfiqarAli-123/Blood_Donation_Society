@extends('layouts.main')

@section('title', 'Add Donor')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Add Donor</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <form role="form" method="POST" action="{{ route('donor.store') }}">
                            @csrf
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-select form-control" id="city" name="city" required>
                                    <option class="form-label" default>Select Donor's City</option>
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-md bg-gradient-primary w-100 mt-2 mb-0">Add Donor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
