@extends('layouts.main')

@section('pageTitle', 'Dashboard')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            @role('admin')
                <div class="col">
                    <div class="card" style="height: 120px">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">weekend</i>
                            </div>
                        </div>
                        <div class="card-body d-flex">
                            <div class="d-flex align-items-center justify-content-start" style="flex-grow: 1;">
                                <h4 class="mb-3" style="font-size: 24px; margin-left: 75px;">Donor Requests</h4>
                            </div>
                            <div class="d-flex align-items-center justify-content-end pe-3">
                                <h4 class="mb-3" style="font-size: 24px;">{{ $donorRequests }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
            <div class="col">
                <div class="card" style="height: 120px">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-center justify-content-start" style="flex-grow: 1;">
                            <h4 class="mb-3" style="font-size: 24px; margin-left: 75px;">All Donors</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pe-3">
                            <h4 class="mb-3" style="font-size: 24px;">{{ $donors }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 mt-5"></div>

            <div class="col">
                <div class="card" style="height: 120px">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-center justify-content-start" style="flex-grow: 1;">
                            <h4 class="mb-3" style="font-size: 24px; margin-left: 75px;">Patients</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pe-3">
                            <h4 class="mb-3" style="font-size: 24px;">{{ $patients }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="height: 120px">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div class="d-flex align-items-center justify-content-start" style="flex-grow: 1;">
                            <h4 class="mb-3" style="font-size: 24px; margin-left: 75px;">Total Users</h4>
                        </div>
                        <div class="d-flex align-items-center justify-content-end pe-3">
                            <h4 class="mb-3" style="font-size: 24px;">{{ $totalUsers }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
