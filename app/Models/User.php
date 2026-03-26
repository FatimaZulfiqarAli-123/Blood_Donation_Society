<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_picture',
        'date_of_birth',
        'role',
        'city',
        'address',
        'gender',
        'blood_group',
        'last_donation_date',
        'donation_frequency_per_year',
        'blood_request_count',
        'is_approved',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getDonors($search = null, $bloodGroup = null, $city = null)
    {
        $user = User::find(auth()->id());

        $query = User::where('role', 'donor')
                        ->where('is_approved', true)
                        ->where('status', 'active')
                        ->orWhere('status', 'sleeping');

        if($user->hasRole('donor'))
        {
            $city = User::find(auth()->id())->city;
            $query->where('city', $city);
        }

        if($user->hasRole('admin'))
        {
            if ($city)
            {
                $query->where('city', $city);
            }
        }

        if ($search)
        {
            $query->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if ($bloodGroup)
        {
            $query->where('blood_group', $bloodGroup);
        }
        return $query->get();
    }

    public static function getBlockedDonors($search = null, $bloodGroup = null, $city = null)
    {
        $query = User::where('role', 'donor')->where('status', 'blocked');

        if ($city)
        {
            $query->where('city', $city);
        }

        if ($search)
        {
            $query->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if ($bloodGroup)
        {
            $query->where('blood_group', $bloodGroup);
        }
        return $query->get();
    }

    public static function getPatients($search = null, $city = null, $bloodGroup = null)
    {
        $query = User::where('role', 'patient');
        if ($search)
        {
            $query->where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        if ($city)
        {
            $query->where('city', $city);
        }
        if ($bloodGroup)
        {
            $query->where('blood_group', $bloodGroup);
        }
        return $query->get();
    }

    public function profileCompleted()
    {
        $requiredFields = [
            'name',
            'email',
            'phone',
            'date_of_birth',
            'city',
            'address',
            'gender',
            'blood_group',
        ];

        foreach ($requiredFields as $field)
        {
            if (empty($this->$field))
            {
                return false;
            }
        }

        return true;
    }

    public function isEligibleForDonation()
    {
        if (is_null($this->last_donation_date))
        {
            return true;
        }

        $sixMonthsAgo = now()->subMonths(6);

        return $this->last_donation_date <= $sixMonthsAgo;
    }

    public function bloodRequestsRequested()
    {
        return $this->hasMany(BloodRequest::class, 'requester_id');
    }

    public function bloodRequestsReceived()
    {
        return $this->hasMany(BloodRequest::class, 'receiver_id');
    }
}
