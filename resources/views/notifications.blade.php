@extends('layouts.main')

@section('pageTitle', 'Notifications')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Notifications</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Type</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Notification</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Date & Time</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->notifications as $notification)
                                    <tr>
                                        @php
                                            $type = explode('\\', $notification->type);
                                        @endphp
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $type[2] }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($type[2] == 'Message')
                                                <a href="{{ route('messages.index') }}">
                                                    <h6 class="text-xs mb-0">{{ $notification->data['message'] }}</h6>
                                                </a>
                                            @elseif($type[2] == 'DonorRegistered')
                                                <a href="{{ route('donor.requests') }}">
                                                    <h6 class="text-xs mb-0">{{ strip_tags($notification->data['message']) }}</h6>
                                                </a>
                                            @elseif($type[2] == 'BloodRequest' && auth()->user()->hasRole('donor'))
                                                <a href="{{ route('blood.requests.index') }}">
                                                    <h6 class="text-xs mb-0">{{ $notification->data['message'] }}</h6>
                                                </a>
                                            @else
                                                {{-- <a href="{{ route('blood.requests.index') }}"> --}}
                                                <a href="{{ route('donation.requests.index') }}">
                                                    <h6 class="text-xs mb-0">{{ $notification->data['message'] }}</h6>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $notification->created_at->format('H:i d-m-Y') }}</h6>
                                        </td>
                                        </a>
                                        <td class="align-middle text-center">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $notification->id }}">
                                                <i class="material-icons text-md mb-0 position-relative">delete</i>
                                            </a>
                                        </td>

                                        <div class="modal fade mt-6" id="deleteModal{{ $notification->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-custom">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h5>Do you want to delete this notification</h5>
                                                        <div>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form{{ $notification->id }}').submit();">Delete</button>
                                                        </div>
                                                        <form id="delete-form{{ $notification->id }}" action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
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
