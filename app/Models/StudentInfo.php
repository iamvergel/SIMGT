<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;

    protected $table = 'student_info'; // Specify the table if it differs from the pluralized model name

    protected $fillable = [
        'student_number',
        'lrn',
        'grade',
        'school_year',
        'section',
        'status',
        'student_last_name',
        'student_first_name',
        'student_middle_name',
        'student_suffix_name',
        'place_of_birth',
        'birth_date',
        'sex',
        'age',
        'email_address_send',
        'contact_number',
        'religion',
        'house_number',
        'street',
        'barangay',
        'province',
        'city',
        // Add any other fillable fields
    ];

    // Define the relationship to StudentAdditionalInfo
    public function additionalInfo()
    {
        return $this->hasOne(StudentAdditionalInfo::class, 'student_number', 'student_number');
    }

    // Define the relationship to StudentDocuments
    public function documents()
    {
        return $this->hasOne(StudentDocuments::class, 'student_number', 'student_number');
    }

    public function gradebookOne()
    {
        return $this->hasMany(Mstudentgradeone::class, 'student_number', localKey: 'student_number');
    }

    public function gradebookTwo()
    {
        return $this->hasMany(Mstudentgradetwo::class, 'student_number', localKey: 'student_number');
    }

    public function gradebookThree()
    {
        return $this->hasMany(Mstudentgradethree::class, 'student_number', localKey: 'student_number');
    }

    public function gradebookFour()
    {
        return $this->hasMany(Mstudentgradefour::class, 'student_number', localKey: 'student_number');
    }

    public function gradebookFive()
    {
        return $this->hasMany(Mstudentgradefive::class, 'student_number', localKey: 'student_number');
    }

    public function gradebookSix()
    {
        return $this->hasMany(Mstudentgradesix::class, 'student_number', localKey: 'student_number');
    }
}
