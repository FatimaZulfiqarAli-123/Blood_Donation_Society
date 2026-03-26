<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $role = $user->getRoleNames();

        $donationsMade = $user->bloodRequestsRequested()->where('is_active', false)->with('receiver')->get();
        $donationsReceived = $user->bloodRequestsReceived()->where('is_active', false)->with('requester')->get();

        $donationHistory = $donationsMade->merge($donationsReceived)->sortByDesc('request_date_time');

        return view('profile.edit', [
            'user' => $user,
            'role' => $role[0],
            'donationHistory' => $donationHistory
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        if(!$user->hasRole('admin'))
        {
            $user->blood_group = $request->blood_group;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->save();

        return Redirect::route('profile.edit')->with([
            'status' => 'success',
            'message' => 'Profile updated successfully.'
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
