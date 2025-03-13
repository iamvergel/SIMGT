<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject', function (Blueprint $table) {
            $table->id();
            $table->string('grade');
            $table->string('subject');

            $table->timestamps();
        });

        // Insert data
        $data = [
            ['grade' => 'Grade One', 'subject' => 'Reading and Literacy'],
            ['grade' => 'Grade One', 'subject' => 'Language'],
            ['grade' => 'Grade One', 'subject' => 'Mathematics'],
            ['grade' => 'Grade One', 'subject' => 'GMRC'],
            ['grade' => 'Grade One', 'subject' => 'Makabansa'],

            ['grade' => 'Grade Two', 'subject' => 'Filipino / Mother Tongue'],
            ['grade' => 'Grade Two', 'subject' => 'English'],
            ['grade' => 'Grade Two', 'subject' => 'Mathematics'],
            ['grade' => 'Grade Two', 'subject' => 'Science and Health'],
            ['grade' => 'Grade Two', 'subject' => 'AP'],
            ['grade' => 'Grade Two', 'subject' => 'Computer'],
            ['grade' => 'Grade Two', 'subject' => 'MAPEH'],
            ['grade' => 'Grade Two', 'subject' => 'Christian Living Education'],

            ['grade' => 'Grade Three', 'subject' => 'Mother Tongue'],
            ['grade' => 'Grade Three', 'subject' => 'English'],
            ['grade' => 'Grade Three', 'subject' => 'Mathematics'],
            ['grade' => 'Grade Three', 'subject' => 'Science and Health'],
            ['grade' => 'Grade Three', 'subject' => 'AP'],
            ['grade' => 'Grade Three', 'subject' => 'Computer'],
            ['grade' => 'Grade Three', 'subject' => 'MAPEH'],
            ['grade' => 'Grade Three', 'subject' => 'Christian Living Education'],

            ['grade' => 'Grade Four', 'subject' => 'Filipino'],
            ['grade' => 'Grade Four', 'subject' => 'English'],
            ['grade' => 'Grade Four', 'subject' => 'Mathematics'],
            ['grade' => 'Grade Four', 'subject' => 'Science'],
            ['grade' => 'Grade Four', 'subject' => 'Health'],
            ['grade' => 'Grade Four', 'subject' => 'Technology and Livelihood Education'],
            ['grade' => 'Grade Four', 'subject' => 'AP'],
            ['grade' => 'Grade Four', 'subject' => 'Computer'],
            ['grade' => 'Grade Four', 'subject' => 'MAPEH'],
            ['grade' => 'Grade Four', 'subject' => 'Christian Living Education'],

            ['grade' => 'Grade Five', 'subject' => 'Filipino'],
            ['grade' => 'Grade Five', 'subject' => 'English'],
            ['grade' => 'Grade Five', 'subject' => 'Mathematics'],
            ['grade' => 'Grade Five', 'subject' => 'Science'],
            ['grade' => 'Grade Five', 'subject' => 'Health'],
            ['grade' => 'Grade Five', 'subject' => 'Technology and Livelihood Education'],
            ['grade' => 'Grade Five', 'subject' => 'AP'],
            ['grade' => 'Grade Five', 'subject' => 'Computer'],
            ['grade' => 'Grade Five', 'subject' => 'MAPEH'],
            ['grade' => 'Grade Five', 'subject' => 'Christian Living Education'],

            ['grade' => 'Grade Six', 'subject' => 'Filipino'],
            ['grade' => 'Grade Six', 'subject' => 'English'],
            ['grade' => 'Grade Six', 'subject' => 'Mathematics'],
            ['grade' => 'Grade Six', 'subject' => 'Science'],
            ['grade' => 'Grade Six', 'subject' => 'Health'],
            ['grade' => 'Grade Six', 'subject' => 'Technology and Livelihood Education'],
            ['grade' => 'Grade Six', 'subject' => 'AP'],
            ['grade' => 'Grade Six', 'subject' => 'Computer'],
            ['grade' => 'Grade Six', 'subject' => 'MAPEH'],
            ['grade' => 'Grade Six', 'subject' => 'Christian Living Education'],
        ];

        DB::table('subject')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
    }
}

