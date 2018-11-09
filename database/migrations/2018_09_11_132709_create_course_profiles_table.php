<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->text('course_description')->nullable();
            $table->bigInteger('course_credits')->nullable();
            $table->text('course_qualifications');
            $table->string('course_duration');
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
        Schema::dropIfExists('course_profiles');
    }
}
