<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'email',
        'userType',
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
    ];

    // user and appointment relationship
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function getFullNameAttribute()
    {
        $firstName = $this->first_name;
        $middleName = $this->middle_name;
        $lastName = $this->last_name;

        if ($middleName) {
            $middleInitial = ucfirst(substr($middleName, 0, 1));
            return "$firstName $middleInitial. $lastName";
        } else {
            return "$firstName $lastName";
        }
    }

    public function storeUserDetails($validated, $address)
    {
        return User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'address' => $address,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }

    public function updateUserDetails($validated, $address, $user_id)
    {
        $userToUpdate = User::findOrFail($user_id);

        return $userToUpdate->update([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'address' => $address,
            'email' => $validated['email'],
        ]);
    }
}
