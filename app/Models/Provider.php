<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'user_id',
        'title',
        'specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
