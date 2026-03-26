<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $admin = User::create([
            'name' => 'Fatima',
            'email' => 'fatima@test.com',
            'date_of_birth' => $faker->date,
            'city' => 'Sialkot',
            'address' => 'Address, City',
            'phone' => $faker->phoneNumber,
            'role' => 'admin',
            'gender' => 'female',
            'password' => Hash::make('qwerty123')
        ]);

        $admin->assignRole('admin');
    }
}
