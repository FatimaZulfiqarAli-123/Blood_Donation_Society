<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blood_request_id',
        'donation_date'
    ];

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class);
    }
}
