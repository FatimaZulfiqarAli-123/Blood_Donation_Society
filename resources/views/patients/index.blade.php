@extends('layouts.main')

@section('pageTitle', 'Patients')

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var searchedQuery = urlParams.get('search');
        var selectedCity = urlParams.get('city');
        var selectedBloodGroup = urlParams.get('blood_group');

        if (searchedQuery) {
            $('#search').val(searchedQuery);
        }

        if (selectedCity) {
            $('#city').val(selectedCity);
        }

        if (selectedBloodGroup) {
            $('#bloodGroup').val(selectedBloodGroup);
        }

        function clearFilters() {
            $('#search').val('');
            $('#city').val('');
            $('#bloodGroup').val('');
        }

        $('#clearFilters').on('click', function(e) {
            e.preventDefault();
            clearFilters();
            $('#searchForm').submit();
        });

        function performSearch() {
            var searchData = {
                search: $('#search').val(),
                city: $('#city').val(),
                bloodGroup: $('#bloodGroup').val()
            };

            $('#searchForm').submit();
        }

        $('#search, #city, #bloodGroup').on('change keyup', function(e) {
            performSearch();
        });

        // Send Message
        $('form[id^="message-form"]').on('submit', function(event) {
            event.preventDefault();
            var formId = $(this).attr('id');
            var patientId = formId.replace('message-form', '');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var message = $('#message' + patientId).val();

            $.ajax({
                url: `{{ route('messages.store') }}`,
                type: 'POST',
                dataType: 'json',
                data: { message: message, id: patientId },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if(response.status == 200) {
                        console.log(response.message);
                        $('#messageModal' + patientId).modal('hide');

                        // Show success message
                        $('#success').html(`
                            <div class="alert-container">
                                <div class="alert alert-success alert-dismissible text-white fade show" role="alert">
                                    <span class="alert-icon align-middle">
                                        <span class="material-icons text-md">
                                            thumb_up_off_alt
                                        </span>
                                    </span>
                                    <span class="alert-text"><strong>Success!</strong> ${response.message}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        `);
                    } else {
                        // show error message
                        $('#error').html(`
                            <div class="alert-container">
                                <div class="alert alert-error alert-dismissible text-white fade show" role="alert">
                                    <span class="alert-icon align-middle">
                                        <span class="material-icons text-md">
                                            thumb_up_off_alt
                                        </span>
                                    </span>
                                    <span class="alert-text"><strong>Error!</strong> ${response.message}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        `);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);

                    // Parse the response text as JSON if it's JSON-formatted
                    var errorResponse;
                    try {
                        errorResponse = JSON.parse(xhr.responseText);
                    } catch (e) {
                        errorResponse = xhr.responseText;
                    }

                    // Show error message
                    var errorMessage = '<div class="alert-container"><div class="alert alert-danger alert-dismissible text-white fade show" role="alert"><span class="alert-icon align-middle"><span class="material-icons text-md">error</span></span><div class="alert-text"><strong>Errors:</strong><ul>';

                    // Append each error as a list item
                    if (Array.isArray(errorResponse)) {
                        errorResponse.forEach(function(error) {
                            errorMessage += '<li>' + error + '</li>';
                        });
                    } else {
                        errorMessage += '<li>' + errorResponse + '</li>';
                    }

                    errorMessage += '</ul></div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';

                    $('#error').html(errorMessage);
                }

            });
        });
    });

</script>

<div id="success"></div>
<div id="error"></div>


<div class="container-fluid mt-3 mb-3" style="background-color: white; border-radius: 10px; align: center;">
    <form action="{{ route('patients.index') }}" method="POST" id="searchForm">
        @csrf
        @method('GET')
        <div class="row">
            <div class="col-md-3 mt-3 mb-2">
                <div class="input-group input-group-outline">
                    <label class="form-label">Search</label>
                    <input type="text" id="search" name="search" class="form-control" value="{{ $filters['search'] ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 mt-3 mb-2">
                <div class="input-group input-group-outline">
                    <select class="form-select form-control" id="city" name="city">
                        <option class="form-label" value="" selected>Select City</option>
                        <option class="form-option" value="Sialkot" {{ isset($filters['city']) && $filters['city'] == 'Sialkot' ? 'selected' : '' }}>Sialkot</option>
                        <option class="form-option" value="Lahore" {{ isset($filters['city']) && $filters['city'] == 'Lahore' ? 'selected' : '' }}>Lahore</option>
                        <option class="form-option" value="Gujranwala" {{ isset($filters['city']) && $filters['city'] == 'Gujranwala' ? 'selected' : '' }}>Gujranwala</option>
                        <option class="form-option" value="Islamabad" {{ isset($filters['city']) && $filters['city'] == 'Islamabad' ? 'selected' : '' }}>Islamabad</option>
                        <option class="form-option" value="Rawalpindi" {{ isset($filters['city']) && $filters['city'] == 'Rawalpindi' ? 'selected' : '' }}>Rawalpindi</option>
                        <option class="form-option" value="Gujrat" {{ isset($filters['city']) && $filters['city'] == 'Gujrat' ? 'selected' : '' }}>Gujrat</option>
                        <option class="form-option" value="Jehlum" {{ isset($filters['city']) && $filters['city'] == 'Jehlum' ? 'selected' : '' }}>Jehlum</option>
                        <option class="form-option" value="Kharian" {{ isset($filters['city']) && $filters['city'] == 'Kharian' ? 'selected' : '' }}>Kharian</option>
                    </select>
                </div>
            </div>
            @role('admin')
                <div class="col-md-3 mt-3 mb-2">
                    <div class="input-group input-group-outline">
                        <select class="form-select form-control" id="bloodGroup" name="blood_group">
                            <option class="form-label" value="" selected>Select Blood Group</option>
                            <option class="form-option" value="A+" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'A+' ? 'selected' : '' }}>A+</option>
                            <option class="form-option" value="A-" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'A-' ? 'selected' : '' }}>A-</option>
                            <option class="form-option" value="B+" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'B+' ? 'selected' : '' }}>B+</option>
                            <option class="form-option" value="B-" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'B-' ? 'selected' : '' }}>B-</option>
                            <option class="form-option" value="O+" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'O+' ? 'selected' : '' }}>O+</option>
                            <option class="form-option" value="O-" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'O-' ? 'selected' : '' }}>O-</option>
                            <option class="form-option" value="AB+" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option class="form-option" value="AB-" {{ isset($filters['blood_group']) && $filters['blood_group'] == 'AB-' ? 'selected' : '' }}>AB-</option>
                        </select>
                    </div>
                </div>
            @endrole
            <div class="col-md-3 mt-3 mb-2">
                <button id="clearFilters" class="btn btn-primary">Clear Filters</button>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Patients List</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Patient</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Phone</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">City</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Blood Group</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                                    @role('admin')<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Actions</th>@endrole
                                    @role('donor')<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Request</th>@endrole
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if ($patient->profile_picture)
                                                        <img src="{{ asset('storage/' . $patient->profile_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="profile picture">
                                                    @else
                                                        <img src="{{ asset('assets/img/profile_picture_placeholder.jpg') }}" alt="profile_image" class="avatar avatar-sm me-3">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs mb-0">{{ $patient->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $patient->phone }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $patient->email }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $patient->city }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <h6 class="text-xs mb-0">{{ $patient->blood_group }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($patient->status == 'sleeping')
                                                <span class="badge badge-sm bg-gradient-danger">Sleeping</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            @endif
                                        </td>
                                        @role('admin')
                                            <td class="align-middle text-center">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $patient->id }}">
                                                    <i class="material-icons text-md mb-0 position-relative">delete</i>
                                                </a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#messageModal{{ $patient->id }}">
                                                    <i class="material-icons text-md mb-0 position-relative">message</i>
                                                </a>
                                            </td>

                                            <div class="modal fade mt-6" id="deleteModal{{ $patient->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-custom">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h5>Do you want to delete this Patient</h5>
                                                            <div>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form{{ $patient->id }}').submit();">Delete</button>
                                                            </div>
                                                            <form id="delete-form{{ $patient->id }}" action="{{ route('patient.delete', $patient->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade mt-6" id="messageModal{{ $patient->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-custom">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Send Message to {{ $patient->name }}
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="message-form{{ $patient->id }}" method="POST">
                                                                @csrf
                                                                <textarea name="message" id="message{{ $patient->id }}" cols="56" rows="3" placeholder="Type your message here..."></textarea>
                                                                <input type="hidden" value="{{ $patient->id }}" id="patientId{{ $patient->id }}">
                                                                <div>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endrole

                                        @role('donor')
                                            <td class="align-middle text-center">
                                                <a href="" data-bs-toggle="modal" data-bs-target="#sendRequestModal{{ $patient->id }}">
                                                    <button class="btn btn-danger">Request for Donation</button>
                                                </a>
                                            </td>

                                            <div class="modal fade mt-6" id="sendRequestModal{{ $patient->id }}" tabindex="-1" aria-labelledby="sendRequestModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-custom">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <h5>Do you want to send blood request to this patient with following details?</h5>
                                                            <div class="card border shadow mb-3">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <span class="fw-bold">Name:</span> {{ auth()->user()->name }}
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <span class="fw-bold">Blood Group:</span> {{ $patient->blood_group }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-2">
                                                                            <span class="fw-bold">Email:</span> {{ auth()->user()->email }}
                                                                        </div>
                                                                        <div class="col-md-6 mb-2">
                                                                            <span class="fw-bold">Phone:</span> {{ auth()->user()->phone }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-12">
                                                                            <span class="fw-bold">Address:</span> {{ auth()->user()->address }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <form id="send-request-form{{ $patient->id }}" action="{{ route('blood.request') }}" method="POST" style="display: none;">
                                                                @csrf
                                                                <input type="hidden" name="requester_id" value="{{ auth()->id() }}">
                                                                <input type="hidden" name="receiver_id" value="{{ $patient->id }}">
                                                                <input type="hidden" name="blood_group" value="{{ $patient->blood_group }}">
                                                            </form>
                                                            <div>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="document.getElementById('send-request-form{{ $patient->id }}').submit();">Send</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endrole
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
