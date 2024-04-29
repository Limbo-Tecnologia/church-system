<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory, Timestamp;

    protected $fillable = [
        'name',
        'email',
        'document_number',
        'phone',
        'address',
        'geolocation',
        'foundation_date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
