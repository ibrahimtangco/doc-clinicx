<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'brgy_code',
        'brgy_name',
        'city_code',
        'province_code',
        'region_code'
    ];
}
