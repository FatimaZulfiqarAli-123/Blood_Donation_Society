<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::where('status', 'active')->withoutRole('admin')->get();

        $donorRequests = $users->where('role', 'donor')->where('is_approved', false)->count();
        $donors = $users->where('role', 'donor')->where('is_approved', true)->count();
        $patients = $users->where('role', 'patient')->count();
        $totalUsers = $users->count();

        $authPatient = $users->where('id', auth()->id())->first();
        if($authPatient && $authPatient->hasRole('patient'))
        {
            return view('dashboard', compact([
                'donorRequests',
                'donors',
                'patients',
                'totalUsers',
                'authPatient'
            ]));
        }

        return view('dashboard', compact([
            'donorRequests',
            'donors',
            'patients',
            'totalUsers',
        ]));
    }
}
