<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Madminaccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_user_account';

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password); // Hash the password when setting
    }
}
