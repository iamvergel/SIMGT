<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Define the table name (if not following Laravel convention)
    protected $table = 'images';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name', 'file_name',
    ];
}
