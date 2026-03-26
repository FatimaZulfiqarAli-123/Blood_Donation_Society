<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodRequest\StoreBloodRequestRequest;
use App\Models\BloodRequest;
use App\Models\User;
use App\Notifications\BloodRequest as BloodRequestNotification;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bloodRequests = BloodRequest::where('receiver_id', auth()->id())->where('is_active', true)->get();

        return view('blood-requests.index', compact('bloodRequests'));
    }

    public function donationRequests()
    {
        $donationRequests = BloodRequest::where('receiver_id', auth()->id())->where('is_active', true)->get();

        return view('donation-requests.index', compact('donationRequests'));
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
    public function store(StoreBloodRequestRequest $request)
    {
        $user = User::find(auth()->id());

        if($user->profileCompleted())
        {
            if($user->hasRole('patient') && $user->blood_request_count == 3)
            {
                return back()->with([
                    'status' => 'error',
                    'message' => 'It looks like you\'ve exceeded the request limit. You can only send a maximum of 3 requests at a time. Don\'t worry though! Once your current requests have been fulfilled, you can send more.'
                ]);
            }
            else
            {
                $user->blood_request_count++;
                $user->save();
            }

            $bloodRequest = BloodRequest::create([
                'requester_id' => $request->requester_id,
                'receiver_id' => $request->receiver_id,
                'requested_blood_group' => $request->blood_group,
                'is_active' => true,
                'request_date_time' => now(),
            ]);

            $donor = User::find($request->receiver_id);
            $donor->notify(new BloodRequestNotification($bloodRequest));

            return back()->with([
                'status' => 'success',
                'message' => 'Blood request sended successfully.'
            ]);
        }
        else
        {
            return back()->with([
                'status' => 'error',
                'message' => 'It seems like your profile is incomplete. Please fill out all fields in your profile before sending a blood request.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodRequest $bloodRequest)
    {
        //
    }
}
