@extends('layouts.main')

@section('pageTitle', 'Blood Requests')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Donation Requests</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Donor Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Phone</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">City</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Address</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Reseived at</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donationRequests as $donationRequest)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->requester->name }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->requester->email }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->requester->phone }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->requester->city }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->requester->address }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $donationRequest->created_at->format('H:i d-m-Y') }}</h6>
                                        </td>
                                        </a>
                                        <td class="align-middle text-center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $donationRequest->requester->id }}">
                                                {{-- <i class="material-icons text-md mb-0 position-relative">delete</i> --}}
                                                <button class="btn btn-primary">Accept Blood Donation</button>
                                            </a>
                                        </td>

                                        <div class="modal fade mt-6" id="deleteModal{{ $donationRequest->requester->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-custom">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h5>Do you want to accept blood donation from this donor</h5>
                                                        <div>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form{{ $donationRequest->requester->id }}').submit();">Yes</button>
                                                        </div>
                                                        <form id="delete-form{{ $donationRequest->requester->id }}" action="{{ route('donate.blood', $donationRequest->requester->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
