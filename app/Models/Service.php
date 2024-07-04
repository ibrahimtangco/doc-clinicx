<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'availability'
    ];

    public function getFormattedDurationAttribute()
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0 && $minutes > 0) {
            return "{$hours} hr {$minutes} mins";
        } elseif ($hours > 0) {
            return "{$hours} hr";
        } else {
            return "{$minutes} mins";
        }
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, '.', ',');
    }


    // service and appointment relationship
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function storeServicedetails($validated)
    {

        return Service::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'price' => $validated['price'],
            'availability' =>
            array_key_exists('availability', $validated) ? ($validated['availability'] == true ? 1 : 0) : 0,
        ]);
    }

    public function updateServiceDetails($validated, $service_id)
    {
        $serviceToUpdate = Service::findOrFail($service_id);

        return $serviceToUpdate->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'duration' => $validated['duration'],
            'price' => $validated['price'],
            'availability' => array_key_exists('availability', $validated) ? ($validated['availability'] == true ? 1 : 0) : 0,
        ]);
    }

    public function deleteService($service)
    {
        return $service->delete();
    }
}
