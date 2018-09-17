<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')
                ->references('id')->on('courses');
            $table->morphs('courseables');
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
        Schema::dropIfExists('courseables');
    }
}
