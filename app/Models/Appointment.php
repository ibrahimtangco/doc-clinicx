<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'time' => 'datetime:H:i'
    ];

    protected $guarded = [];

    public function getTimeeAttribute()
    {
        return $this->attributes['time']->format('H:i');
    }

    // user and appointmetn relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // service and appointmetn relationship
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
