<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mstudentaccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'student_user_account';

    protected $fillable = [
        'username',
        'password',
        'student_number',
        'avatar',
        'last_avatar_change',
        'last_password_change',
        // Add other fields as necessary
    ];

    protected $hidden = [
        'student_number','password', 'remember_token', 'avatar',
    ];

    protected $casts = [
        'last_password_change' => 'datetime',
    ];
    

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password); // Hash the password when setting
    }
}
