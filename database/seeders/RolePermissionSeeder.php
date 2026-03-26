<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approveDonor = Permission::create([ 'name' => 'approve-donor' ]);
        $rejectDonor = Permission::create([ 'name' => 'reject-donor' ]);
        $addDonor = Permission::create([ 'name' => 'add-donor' ]);
        $deleteDonor = Permission::create([ 'name' => 'delete-donor' ]);
        $blockDonor = Permission::create([ 'name' => 'block-donor' ]);
        $viewDonorsList = Permission::create([ 'name' => 'view-donors-list' ]);
        $viewDonorsRequests = Permission::create([ 'name' => 'view-donors-requests' ]);
        $viewBlockedDonorsList = Permission::create([ 'name' => 'view-blocked-donors-list' ]);
        $unblockDonor = Permission::create([ 'name' => 'unblock-donor' ]);

        $sendMessages = Permission::create([ 'name' => 'send-messages' ]);
        $viewMessages = Permission::create([ 'name' => 'view-messages' ]);

        $searchRecord = Permission::create([ 'name' => 'search-record' ]);
        $sendBloodDonationRequest = Permission::create([ 'name' => 'send-blood-donation-request' ]);
        $viewBloodDonationRequests = Permission::create([ 'name' => 'view-blood-donation-requests' ]);
        $sendBloodRequest = Permission::create([ 'name' => 'send-blood-request' ]);
        $viewBloodRequests = Permission::create([ 'name' => 'view-blood-requests' ]);
        $acceptDonation = Permission::create([ 'name' => 'accept-donation' ]);
        $donateBlood = Permission::create([ 'name' => 'donate-blood' ]);

        $searchActiveDonor = Permission::create([ 'name' => 'search-active-donor' ]);
        $viewPatientsList = Permission::create([ 'name' => 'view-patients-list' ]);
        $deletePatients = Permission::create([ 'name' => 'delete-patients' ]);

        $admin = Role::create([ 'name' => 'admin' ]);
        $donor = Role::create([ 'name' => 'donor' ]);
        $patient = Role::create([ 'name' => 'patient' ]);


        $admin->syncPermissions([
            $approveDonor,
            $rejectDonor,
            $addDonor,
            $deleteDonor,
            $blockDonor,
            $viewDonorsList,
            $viewDonorsRequests,
            $viewPatientsList,
            $deletePatients,
            $sendMessages,
            $viewBlockedDonorsList,
            $unblockDonor
        ]);


        $donor->syncPermissions([
            $searchRecord,
            $sendBloodDonationRequest,
            $viewBloodRequests,
            $viewPatientsList,
            $viewMessages,
            $donateBlood
        ]);


        $patient->syncPermissions([
            $searchActiveDonor,
            $sendBloodRequest,
            $viewDonorsList,
            $viewBloodDonationRequests,
            $viewMessages,
            $acceptDonation
        ]);
    }
}
