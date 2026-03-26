<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->enum('role', ['admin', 'donor', 'patient']);
            $table->enum('status', ['active', 'rejected', 'deleted', 'sleeping', 'blocked'])->default('active');
            $table->date('last_donation_date')->nullable();
            $table->integer('donation_frequency_per_year')->nullable();
            $table->integer('blood_request_count')->default(0)->nullable();
            $table->boolean('is_approved')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['email', 'role']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
