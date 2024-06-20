<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function storeProviderDetails($validated, $user_id)
    {
        return
            Provider::create([
                'user_id' => $user_id,
                'title' => $validated['title'],
                'specialization' => $validated['specialization']
            ]);
    }

    public function updateProviderDetails($validated, $provider_id)
    {
        $providerToUpdate = Provider::findOrFail($provider_id);

        return $providerToUpdate->update([
            'title' => $validated['title'],
            'specialization' => $validated['specialization']
        ]);
    }
}
