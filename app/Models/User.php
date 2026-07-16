<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [

        'name',

        'student_id',

        'email',

        'password',

        'phone_number',

        'role'

    ];

    protected $hidden = [

        'password',

        'remember_token'

    ];

    protected function casts(): array
    {
        return [

            'password' => 'hashed',

        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}