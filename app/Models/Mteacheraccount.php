<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Use Authenticatable
use Illuminate\Notifications\Notifiable;

class Mteacheraccount extends Authenticatable  // Extend Authenticatable
{
    use Notifiable;

    protected $table = 'teacher_user';

    protected $fillable = [
        'teacher_number',
        'username',
        'password',
        'avatar',
        'last_avatar_change',
        'last_password_change',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_avatar_change' => 'datetime',
        'last_password_change' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);  // Hash the password before saving
    }
}