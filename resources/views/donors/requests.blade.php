@extends('layouts.main')

@section('pageTitle', 'Donor Requests')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Donor Requests</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Donor</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Blood Group</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        {{-- <th class="text-secondary opacity-7"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donors as $donor)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if (isset($donor->profile_picture))
                                                            <img src="{{ asset('storage/' . $donor->profile_picture) }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        @else
                                                            <img src="{{ asset('assets/img/profile_picture_placeholder.jpg') }}"
                                                                alt="profile_image"
                                                                class="avatar avatar-sm me-3 border-radius-lg">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $donor->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $donor->blood_group }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $donor->email }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $donor->phone }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn btn-success"
                                                    onclick="document.getElementById('approve-form-{{ $donor->id }}').submit();">
                                                    Approve
                                                </button>
                                                <form id="approve-form-{{ $donor->id }}"
                                                    action="{{ route('approve.donor', $donor->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectReasonModal">
                                                    Reject
                                                </button>

                                                <div class="modal fade mt-6" id="rejectReasonModal" tabindex="-1"
                                                    aria-labelledby="rejectReasonModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-custom">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5>Do you want to reject this donor's request</h5>
                                                                <div>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('reject-form').submit();">Reject</button>
                                                                </div>
                                                                <form id="reject-form"
                                                                    action="{{ route('reject.donor', $donor->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

@endsection
