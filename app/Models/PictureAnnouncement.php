<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PictureAnnouncement extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's the plural of the model name)
    protected $table = 'picture_announcements';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'image', 
        'date', 
        'update'
    ];
}
