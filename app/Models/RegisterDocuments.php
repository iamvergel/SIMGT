<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterDocuments extends Model
{
    use HasFactory;

    protected $table = 'register_student_document';

    protected $fillable = [
        'lrn',
        'birth_certificate',
        'proof_of_residency',
    ];
}
