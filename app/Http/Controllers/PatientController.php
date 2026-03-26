<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\IndexPatientRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(IndexPatientRequest $request)
    {
        $user = User::find(auth()->id());

        if($user->hasRole('admin'))
        {
            $search = $request->input('search');
            $city = $request->input('city');
            $bloodGroup = $request->input('blood_group');
            $patients = $user->getPatients($search, $city, $bloodGroup);
        }

        if($user->hasRole('donor'))
        {
            $search = $request->input('search');
            $city = $request->input('city');
            $patients = $user->getPatients($search, $city)->where('blood_group', $user->blood_group);
        }

        $filters = $request->only('search', 'blood_group', 'city');

        return view('patients.index', compact('patients', 'filters'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user && $user->role == 'patient')
        {
            $user->status = 'deleted';
            $user->save();
            $user->delete();
            return back()->with([
                'status' => 'success',
                'message' => 'Patient deleted successfully.'
            ]);
        }

        return back()->with([
            'status' => 'error',
            'message' => 'Patient not found.'
        ]);
    }
}
