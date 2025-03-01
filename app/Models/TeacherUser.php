<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TeacherUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'teacher_user';

    // Fillable fields for mass assignment
    protected $fillable = [
        'teacher_number',
        'username',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'address',
        'email',
        'contact_number',
        'department',
        'position',
        'status',
        'gender',
        'birthdate',
        'religion',
        'avatar',
        'last_avatar_change',
        'last_password_change',
    ];

    // Hidden fields (won't be serialized to the output)
    protected $hidden = [
        'password', 'remember_token', 'avatar',
    ];

    // Cast 'last_password_change' and 'last_avatar_change' to datetime type
    protected $casts = [
        'last_password_change' => 'datetime',
        'last_avatar_change' => 'datetime',
    ];

    // Mutator to automatically hash the password when setting it
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password); // Hash the password when setting
    }

    public function advisory()
    {
        return $this->hasMany(TeacherAdvisory::class, 'teacher_number', localKey: 'teacher_number');
    }

    public function subject()
    {
        return $this->hasMany(TeacherSubjectClass::class, 'teacher_number', localKey: 'teacher_number');
    }
}
