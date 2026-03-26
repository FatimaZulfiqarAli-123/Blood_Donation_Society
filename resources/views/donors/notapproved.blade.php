@extends('layouts.main')

@section('pageTitle', 'Not Approved')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                          <h6 class="text-white text-capitalize ps-3">Awaiting Approval</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hi {{ auth()->user()->name }},</h5>
                        <p class="card-text">Thank you for registering to become a donor with the VU Blood Donation Society. Your willingness to help is greatly appreciated!</p>
                        <p class="card-text">Your account is currently pending approval from our administration team. We review each application carefully to ensure the safety and reliability of our donor network.</p>
                        <p class="card-text">You will receive a notification once your account has been reviewed and activated.</p>
                        <p class="card-text">We are excited to have you on board and look forward to your contribution to saving lives.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
