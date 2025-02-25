<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject'; // Specify the table name if it's different from the default (plural form of the model name)

    protected $fillable = [
        'grade', // Columns that can be mass-assigned
        'subject',
    ];
}
