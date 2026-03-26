<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\User;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($userId)
    {
        $user = User::find(auth()->id());

        $donor = "";
        $patient = "";

        if($user && $user->hasRole('donor'))
        {
            $donor = $user;
        }
        elseif($user && $user->hasRole('patient'))
        {
            $patient = $user;
        }

        if($user->isEligibleForDonation())
        {
            $user->status = 'active';
            $user->save();
        }

        if($donor && !$user->isEligibleForDonation())
        {
            return back()->with([
                'status' => 'error',
                'message' => 'You are currently in a sleeping state. According to our policy, this state will be maintained for six months from your last donation. Please check back after this period to schedule your next donation.'
            ]);
        }
        elseif($donor && $donor->status == 'active')
        {
            $patient = User::find($userId);

            $donor->last_donation_date = now();
            $donor->status = 'sleeping';
            $donor->save();

            $patient->blood_request_count = $patient->blood_request_count - 1;
            $patient->save();

            $bloodRequest = BloodRequest::where('receiver_id', auth()->id())->where('requester_id', $userId)->first();
            $bloodRequest->is_active = false;
            $bloodRequest->save();

            Donation::create([
                'blood_request_id' => $bloodRequest->id,
                'donation_date' => today()
            ]);

            return back()->with([
                'status' => 'success',
                'message' => 'Donation successful.'
            ]);
        }

        if($patient)
        {
            $donor = User::find($userId);

            $donor->last_donation_date = now();
            $donor->status = 'sleeping';
            $donor->save();

            $patient->blood_request_count = $patient->blood_request_count - 1;
            $patient->save();

            $donationRequest = BloodRequest::where('receiver_id', auth()->id())->where('requester_id', $userId)->first();
            $donationRequest->is_active = false;
            $donationRequest->save();

            return back()->with([
                'status' => 'success',
                'message' => 'Donation successful.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
