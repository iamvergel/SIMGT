<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mannouncement extends Model
{
    use HasFactory;
    protected $table = 'announcements';
    protected $fillable = [
        'announcements_head',
        'announcements_body',
    ];
}
