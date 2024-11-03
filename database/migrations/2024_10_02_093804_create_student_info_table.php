<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_info', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();               // Student number (unique identifier)
            $table->string('School')->default('St. Emilie learning center');                                 // School name
            $table->string('lrn');                                   // LRN (Learner's Reference Number)
            $table->string('grade');                                 // Grade level
            $table->string('school_year');                           // School year (e.g., 2023-2024)
            $table->string('section');                               // Section of the student
            $table->string('status')->default('Active');                          // Type of student (e.g., Elementary, Secondary, or High School)
        
            $table->string('student_last_name');                     // Student's last name
            $table->string('student_first_name');                    // Student's first name
            $table->string('student_middle_name')->nullable();       // Student's middle name (optional)
            $table->string('student_suffix_name')->nullable();
            $table->string('place_of_birth');                        // Place of birth
            $table->date('birth_date');                              // Birth date (mm/dd/yyyy)
            $table->string('sex');                                   // Sex
            $table->integer('age');                                  // Age
            $table->string('email_address_send');
            $table->string('contact_number'); 
            $table->string('religion');
        
            // Detailed address fields
            $table->string('house_number');                           // House number
            $table->string('street');                                 // Street
            $table->string('barangay');                               // Barangay
            $table->string('province');                               // Province
            $table->string('city');                                   // City
        
            $table->timestamps();                                     // Adds created_at and updated_at columns
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_info');
    }
};
