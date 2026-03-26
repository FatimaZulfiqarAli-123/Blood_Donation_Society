<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donor\BlockedDonorRequest;
use App\Http\Requests\Donor\IndexDonorRequest;
use App\Http\Requests\Donor\StoreDonorRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DonorController extends Controller
{
    public function donorRequests()
    {
        $user = User::find(auth()->id());
        if ($user && $user->hasRole('admin')) {
            // Mark all unread notifications as read
            $user->unreadNotifications->markAsRead();
            $donors = User::where('role', 'donor')->where('is_approved', false)->get();

            return view('donors.requests', compact('donors'));
        }

        return redirect()->back()->with([
            'status' => 'error',
            'message' => 'You are not authorized to view this page.'
        ]);
    }

    public function notApproved()
    {
        $user = User::find(auth()->id());
        if($user->hasRole('donor') && $user->is_approved)
        {
            return redirect()->route('dashboard');
        }
        return view('donors.notapproved');
    }

    public function approveDonor($id)
    {
        $donor = User::find($id);

        $donor->is_approved = true;
        $donor->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Donor approved.'
        ]);
    }

    public function rejectDonor(Request $request, $id)
    {
        $donor = User::find($id);

        if(!$donor)
        {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Donor not found.'
            ]);
        }

        $donor->status = 'rejected';
        $donor->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Donor request rejected.'
        ]);
    }

    public function index(IndexDonorRequest $request)
    {
        $search = $request->input('search');
        $city = $request->input('city');
        $bloodGroup = $request->input('blood_group');
        $donors = User::getDonors($search, $bloodGroup, $city);

        $filters = $request->only('search', 'blood_group', 'city');

        return view('donors.index', compact('donors', 'filters'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->role == 'donor')
        {
            $user->status = 'deleted';
            $user->save();
            $user->delete();
            return back()->with('success', 'Donor deleted successfully.');
        }

        return back()->with([
            'status' => 'error',
            'message' => 'Donor not found.'
        ]);
    }

    public function blockDonor($id)
    {
        $user = User::find($id);
        if($user && $user->role == 'donor')
        {
            $user->status = 'blocked';
            $user->save();
            return back()->with([
                'status' => 'success',
                'message' => 'Donor blocked successfully.'
            ]);
        }

        return back()->with([
            'status' => 'error',
            'message' => 'Donor not found.'
        ]);
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(StoreDonorRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'donor',
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'city' => $request->city,
            'is_approved' => true,
            'status' => 'active',
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('donor');

        return redirect()->route('donors.index')->with([
            'status' => 'success',
            'message' => 'Donor added successfully.'
        ]);
    }

    public function blockedDonors(BlockedDonorRequest $request)
    {
        $search = $request->input('search');
        $city = $request->input('city');
        $bloodGroup = $request->input('blood_group');
        $donors = User::getBlockedDonors($search, $bloodGroup, $city);

        $filters = $request->only('search', 'blood_group', 'city');

        $blockedDonors = User::where('role', 'donor')->where('status', 'blocked')->get();
        return view('donors.blocked-donors', compact('blockedDonors', 'filters'));
    }

    public function unblockDonor($id)
    {
        $user = User::find($id);
        if($user && $user->role == 'donor')
        {
            if($user->isEligibleForDonation())
            {
                $user->status = 'active';
            }
            else
            {
                $user->status = 'sleeping';
            }
            $user->save();
            return back()->with([
                'status' => 'success',
                'message' => 'Donor unblocked successfully.'
            ]);
        }

        return back()->with([
            'status' => 'error',
            'message' => 'Donor not found.'
        ]);
    }
}
