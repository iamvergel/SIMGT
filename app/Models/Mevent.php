<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mevent extends Model
{
    use HasFactory;
    protected $table = 'activities_event';
    protected $fillable = ['activity_name', 'event_date'];
}
