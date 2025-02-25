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
        Schema::create('register_student_additional_info', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->unique();               // Student number (unique identifier)
            $table->string('father_last_name');                       // Father's last name
            $table->string('father_first_name');                      // Father's first name
            $table->string('father_middle_name')->nullable();         // Father's middle name (optional)
            $table->string('father_suffix_name')->nullable();
            $table->string('father_occupation');          // Father's occupation (optional)

            $table->string('mother_last_name');                       // Mother's last name
            $table->string('mother_first_name');                      // Mother's first name
            $table->string('mother_middle_name')->nullable();         // Mother's middle name (optional)
            $table->string('mother_occupation');          // Mother's occupation (optional)

            $table->string('guardian_last_name');         // Guardian's last name (optional)
            $table->string('guardian_first_name');        // Guardian's first name (optional)
            $table->string('guardian_middle_name')->nullable();       // Guardian's middle name (optional)
            $table->string('guardian_suffix_name')->nullable();
            $table->string('guardian_relationship');      // Guardian's relationship to the student (optional)
            $table->string('guardian_contact_number');    // Guardian's contact number (optional)

            $table->string('guardian_religion');                   // Religion (optional)

            $table->string('emergency_contact_person');               // Emergency contact person
            $table->string('emergency_contact_number');               // Emergency contact number
            $table->string('email_address');              // Email address (optional)
            $table->string('messenger_account')->nullable();          // Messenger account (optional)
            $table->timestamps();                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_student_additional_info');
    }
};
