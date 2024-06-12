<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\AppointmentFormatterService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $casts = [
        'time' => 'datetime:H:i'
    ];

    protected $guarded = [];

    //* RELATIONSHIPS
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

    //* ACCESSORS
    public function getFormattedDateAttribute()
    {
        return AppointmentFormatterService::getFormattedDate($this->attributes['date']);
    }

    public function getFormattedTimeAttribute()
    {
        return AppointmentFormatterService::getFormattedTime($this->attributes['time']);
    }

    public function getFormattedDurationAttribute()
    {
        return AppointmentFormatterService::getFormattedDuration($this->attributes['duration']);
    }

    public function canBeCancelled()
    {
        return $this->status != 'cancelled' && now()->diffInMinutes($this->created_at) < 60;
    }
}
